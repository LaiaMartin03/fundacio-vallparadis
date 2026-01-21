<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class InternalDoc extends Model
{
    protected $fillable = [
        'title',
        'desc',
        'type',
        'file_path',
        'original_filename',
        'added_by',
    ];

    /**
     * Get the user who added this document
     */
    public function addedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    /**
     * Get the display filename with extension
     */
    public function getDisplayFilenameAttribute(): string
    {
        if ($this->original_filename) {
            return $this->original_filename;
        }

        // Try to get extension from file_path
        $extension = null;
        if ($this->file_path) {
            $extension = pathinfo($this->file_path, PATHINFO_EXTENSION);
            
            // If no extension in path, try to get it from the actual file
            if (!$extension && Storage::disk('public')->exists($this->file_path)) {
                $mimeType = Storage::disk('public')->mimeType($this->file_path);
                $extension = $this->getExtensionFromMimeType($mimeType);
            }
        }

        $filename = $this->title;
        if ($extension) {
            $filename .= '.' . $extension;
        }

        return $filename;
    }

    /**
     * Get file extension from MIME type
     */
    private function getExtensionFromMimeType(?string $mimeType): ?string
    {
        if (!$mimeType) {
            return null;
        }

        $mimeToExtension = [
            'application/pdf' => 'pdf',
            'application/msword' => 'doc',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'docx',
            'text/plain' => 'txt',
            'application/vnd.ms-excel' => 'xls',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'xlsx',
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'image/gif' => 'gif',
        ];

        return $mimeToExtension[$mimeType] ?? null;
    }

    /**
     * Get file extension for badge display
     */
    public function getFileExtensionAttribute(): ?string
    {
        if ($this->original_filename) {
            $extension = pathinfo($this->original_filename, PATHINFO_EXTENSION);
            return strtoupper($extension ?: '');
        }

        if ($this->file_path) {
            $extension = pathinfo($this->file_path, PATHINFO_EXTENSION);
            if ($extension) {
                return strtoupper($extension);
            }
            
            // Try to get from MIME type
            if (Storage::disk('public')->exists($this->file_path)) {
                $mimeType = Storage::disk('public')->mimeType($this->file_path);
                $extension = $this->getExtensionFromMimeType($mimeType);
                return $extension ? strtoupper($extension) : null;
            }
        }

        return null;
    }

    /**
     * Get badge color classes based on file extension
     */
    public function getBadgeColorClassesAttribute(): string
    {
        $extension = $this->file_extension;
        
        $colorMap = [
            'PDF' => 'bg-red-100 text-red-400',
            'TXT' => 'bg-blue-100 text-blue-400',
            'DOC' => 'bg-blue-100 text-blue-400',
            'DOCX' => 'bg-blue-100 text-blue-400',
            'XLS' => 'bg-green-100 text-green-400',
            'XLSX' => 'bg-green-100 text-green-400',
        ];

        return $colorMap[$extension] ?? 'bg-gray-100 text-gray-400';
    }
}
