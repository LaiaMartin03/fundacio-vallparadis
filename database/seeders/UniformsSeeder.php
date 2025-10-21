<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Uniform;

class UniformsSeeder extends Seeder
{
    public function run(): void
    {
        Uniform::create([
            'shirt_size' => 38,
            'pants_size' => 40,
            'lab_coat' => true,
            'shoe_size' => 42,
        ]);

        Uniform::create([
            'shirt_size' => 40,
            'pants_size' => 42,
            'lab_coat' => false,
            'shoe_size' => 44,
        ]);
    }
}
