<?php

namespace App\Imports;

use App\Models\Resource;
use Maatwebsite\Excel\Concerns\ToModel;

class ResourcesImport implements ToModel
{
    public function model(array $row)
    {
        return new Resource([
            'uniform_id' => $row[1] ?? null,
            'user_id' => $row[2] ?? null,
            'given_by_user_id' => $row[3] ?? null,
            'delivered_at' => $row[4] ?? null,
        ]);
    }
}
