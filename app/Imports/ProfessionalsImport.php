<?php

namespace App\Imports;

use App\Models\Professional;
use Maatwebsite\Excel\Concerns\ToModel;

class ProfessionalsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Professional([
            'name' => $row['name'],
            'locker' => $row['locker']
        ]);
    }
}
