<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Center;

class CenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Center::create([
            'name' => 'Centro Barcelona',
            'email' => 'barcelona@empresa.com',
            'phone' => '931234567',
            'location' => 'Barcelona',
            'active' => true,
        ]);

        Center::create([
            'name' => 'Centro Madrid',
            'email' => 'madrid@empresa.com',
            'phone' => '911234567',
            'location' => 'Madrid',
            'active' => true,
        ]);

        Center::create([
            'name' => 'Centro Valencia',
            'email' => 'valencia@empresa.com',
            'phone' => '961234567',
            'location' => 'Valencia',
            'active' => false,
        ]);
    }
}
