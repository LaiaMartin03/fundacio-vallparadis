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
}
