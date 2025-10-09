<?php

namespace App\Imports;

use App\Models\Uniform;
use Maatwebsite\Excel\Concerns\ToModel;

class UniformsImport implements ToModel
{
    public function model(array $row)
    {
        return new Uniform([
            'id' => $row[0] ?? null,
            'given_by_user_id' => $row[1] ?? null,
            'user_id' => $row[2] ?? null,
            'shirt_size' => $row[3] ?? null,
            'pants_size' => $row[4] ?? null,
            'lab_coat' => $row[5] ?? null,
            'shoe_size' => $row[6] ?? null,
            'delivery_at' => $row[7] ?? null,
        ]);
    }
}
