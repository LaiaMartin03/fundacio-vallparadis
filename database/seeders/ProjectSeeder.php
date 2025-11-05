<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
Use App\Models\Project;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Project::create([
            'center_id' => 1,
            'name' => 'Proyecto A',
            'responsible_professional' => 1,
            'description' => 'Descripción del Proyecto A',
            'observations' => 'Observaciones del Proyecto A',
            'type' => 'project',
            'active' => true,
            'docs' => null,
            'start_date' => '2025-10-01',
            'finish_date' => '2025-12-31',
        ]);

        Project::create([
            'center_id' => 2,
            'name' => 'Proyecto B',
            'responsible_professional' => 2,
            'description' => 'Descripción del Proyecto B',
            'observations' => 'Observaciones del Proyecto B',
            'type' => 'comision',
            'active' => true,
            'docs' => 'doc_b.pdf',
            'start_date' => '2025-09-01',
            'finish_date' => '2025-11-30',
        ]);

        Project::create([
            'center_id' => 1,
            'name' => 'Proyecto C',
            'responsible_professional' => 3,
            'description' => 'Descripción del Proyecto C',
            'observations' => 'Observaciones del Proyecto C',
            'type' => 'project',
            'active' => false,
            'docs' => null,
            'start_date' => '2025-08-01',
            'finish_date' => '2025-09-30',
        ]);
    }
}
