<?php

namespace App\Http\Controllers;

use App\Models\InternalDoc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use ZipArchive;

class InternalDocController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $documents = InternalDoc::with('addedBy')
            ->orderBy('created_at', 'desc')
            ->get();

        $breadcrumbs = [
            'Inicio' => route('dashboard'),
            'Documentació interna' => route('internal-docs.index')
        ];

        return view('internalDocs.index', compact('documents', 'breadcrumbs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $breadcrumbs = [
            'Inicio' => route('dashboard'),
            'Documentació interna' => route('internal-docs.index'),
            'Pujar nou document' => route('internal-docs.create')
        ];

        return view('internalDocs.create', compact('breadcrumbs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'desc' => 'nullable|string',
            'file' => 'required|file|max:10240', // max 10MB
        ]);

        $filePath = null;
        $originalFilename = null;
        $fileType = null;
        
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $originalFilename = $file->getClientOriginalName();
            $filePath = $file->store('internal-docs', 'public');
            
            // Get file extension from original filename
            $extension = strtoupper($file->getClientOriginalExtension());
            $fileType = $extension ?: null;
        }

        InternalDoc::create([
            'title' => $request->title,
            'desc' => $request->desc,
            'type' => $fileType,
            'file_path' => $filePath,
            'original_filename' => $originalFilename,
            'added_by' => Auth::id(),
        ]);

        return redirect()->route('internal-docs.index')
            ->with('success', 'Document creat correctament.');
    }

    /**
     * Display the specified resource.
     */
    public function show(InternalDoc $internalDoc)
    {
        $internalDoc->load('addedBy');
        
        $breadcrumbs = [
            'Inicio' => route('dashboard'),
            'Documentació interna' => route('internal-docs.index'),
            $internalDoc->title => route('internal-docs.show', $internalDoc->id)
        ];

        return view('internalDocs.show', compact('internalDoc', 'breadcrumbs'));
    }

    /**
     * Download the document file
     */
    public function download(InternalDoc $internalDoc)
    {
        if (!$internalDoc->file_path || !Storage::disk('public')->exists($internalDoc->file_path)) {
            abort(404, 'File not found');
        }

        $downloadName = $internalDoc->original_filename ?: $internalDoc->title;
        // Si no tiene extensión en el nombre original, intentar obtenerla del archivo
        if (!$internalDoc->original_filename && $internalDoc->file_path) {
            $extension = pathinfo($internalDoc->file_path, PATHINFO_EXTENSION);
            if ($extension) {
                $downloadName .= '.' . $extension;
            }
        }

        return Storage::disk('public')->download($internalDoc->file_path, $downloadName);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InternalDoc $internalDoc)
    {
        return view('internalDocs.edit', compact('internalDoc'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InternalDoc $internalDoc)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'desc' => 'nullable|string',
            'file' => 'nullable|file|max:10240',
        ]);

        $data = [
            'title' => $request->title,
            'desc' => $request->desc,
        ];

        if ($request->hasFile('file')) {
            // Delete old file if exists
            if ($internalDoc->file_path && Storage::disk('public')->exists($internalDoc->file_path)) {
                Storage::disk('public')->delete($internalDoc->file_path);
            }
            $file = $request->file('file');
            $data['file_path'] = $file->store('internal-docs', 'public');
            $data['original_filename'] = $file->getClientOriginalName();
            
            // Get file extension from original filename
            $extension = strtoupper($file->getClientOriginalExtension());
            $data['type'] = $extension ?: null;
        }

        $internalDoc->update($data);

        return redirect()->route('internal-docs.index')
            ->with('success', 'Document actualitzat correctament.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InternalDoc $internalDoc)
    {
        // Delete file if exists
        if ($internalDoc->file_path && Storage::disk('public')->exists($internalDoc->file_path)) {
            Storage::disk('public')->delete($internalDoc->file_path);
        }

        $internalDoc->delete();

        return redirect()->route('internal-docs.index')
            ->with('success', 'Document eliminat correctament.');
    }

    /**
     * Download multiple documents as a ZIP file
     */
    public function bulkDownload(Request $request)
    {
        $request->validate([
            'document_ids' => 'required|array',
            'document_ids.*' => 'exists:internal_docs,id',
        ]);

        $documentIds = $request->input('document_ids');
        $documents = InternalDoc::whereIn('id', $documentIds)->get();

        if ($documents->isEmpty()) {
            return redirect()->route('internal-docs.index')
                ->with('error', 'No s\'han trobat documents per descarregar.');
        }

        // Create a temporary ZIP file
        $zipFileName = 'documents_' . date('Y-m-d_His') . '.zip';
        $zipPath = storage_path('app/temp/' . $zipFileName);
        
        // Ensure temp directory exists
        if (!file_exists(storage_path('app/temp'))) {
            mkdir(storage_path('app/temp'), 0755, true);
        }

        $zip = new ZipArchive();
        
        if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== TRUE) {
            return redirect()->route('internal-docs.index')
                ->with('error', 'No s\'ha pogut crear l\'arxiu ZIP.');
        }

        $filesAdded = 0;
        foreach ($documents as $document) {
            if ($document->file_path && Storage::disk('public')->exists($document->file_path)) {
                $filePath = Storage::disk('public')->path($document->file_path);
                $fileName = $document->original_filename ?: ($document->title . '.' . pathinfo($filePath, PATHINFO_EXTENSION));
                
                // Avoid duplicate filenames
                $counter = 1;
                $originalFileName = $fileName;
                while ($zip->locateName($fileName) !== false) {
                    $pathInfo = pathinfo($originalFileName);
                    $fileName = $pathInfo['filename'] . '_' . $counter . '.' . ($pathInfo['extension'] ?? '');
                    $counter++;
                }
                
                $zip->addFile($filePath, $fileName);
                $filesAdded++;
            }
        }

        $zip->close();

        if ($filesAdded === 0) {
            @unlink($zipPath);
            return redirect()->route('internal-docs.index')
                ->with('error', 'No s\'han trobat fitxers vàlids per descarregar.');
        }

        // Return the ZIP file as download
        return response()->download($zipPath, $zipFileName)->deleteFileAfterSend(true);
    }

    /**
     * Search documents
     */
    public function search(Request $request)
    {
        $search = $request->input('search');
        
        $documents = InternalDoc::with('addedBy')
            ->where(function($query) use ($search) {
                $query->where('title', 'LIKE', "%{$search}%")
                      ->orWhere('desc', 'LIKE', "%{$search}%")
                      ->orWhere('type', 'LIKE', "%{$search}%");
            })
            ->get()
            ->map(function($doc) {
                return [
                    'id' => $doc->id,
                    'title' => $doc->title,
                    'display_filename' => $doc->display_filename,
                    'desc' => $doc->desc,
                    'type' => $doc->type,
                    'file_path' => $doc->file_path,
                    'file_extension' => $doc->file_extension,
                    'badge_color_classes' => $doc->badge_color_classes,
                    'created_at' => $doc->created_at->toISOString(),
                    'added_by' => $doc->addedBy ? [
                        'id' => $doc->addedBy->id,
                        'name' => $doc->addedBy->name,
                    ] : null,
                ];
            });
        
        return response()->json([
            'documents' => $documents,
            'count' => $documents->count()
        ]);
    }
}
