<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CenterFollowup;
use App\Models\Professional;
use Illuminate\Support\Facades\Auth;

class CenterFollowupController extends Controller
{
    public function index(Professional $professional)
    {
        $followups = CenterFollowup::where('professional_user_id', $professional->id)
            ->latest()
            ->get();

        return view('professional.followups.index', compact('professional', 'followups'));
    }

    public function store(Request $request, Professional $professional)
    {
        $data = $request->validate([
            'type' => 'required|in:obert,restringit,origen,fi_vinculacio',
            'date' => 'nullable|date',
            'topic' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'attached_docs' => 'nullable|string',
        ]);

        // center_id fijo a 1
        CenterFollowup::create([
            'date' => $data['date'] ?? now()->toDateString(),
            'description' => $data['description'] ?? '',
            'center_id' => 1,
            'professional_user_id' => $professional->id,
            'registrant_user_id' => Auth::id(),
            'type' => $data['type'],
            'topic' => $data['topic'] ?? null,
            'attached_docs' => $data['attached_docs'] ?? null,
        ]);

        return back()->with('success', 'Seguiment afegit');
    }

    public function partial(Professional $professional)
    {
        $followups = CenterFollowup::where('professional_user_id', $professional->id)
            ->latest()
            ->get();

        return view('professional.partials._followups', compact('professional', 'followups'));
    }
}