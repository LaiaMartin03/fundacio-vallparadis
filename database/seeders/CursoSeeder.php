<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Curso;

class CursoSeeder extends Seeder
{
    public function run(): void
    {
        $cursos = [
            [
                'name' => 'Primers Auxilis',
                'forcem' => '12',
                'hours' => 20,
                'type' => 'Formació Interna',
                'info' => 'Curs bàsic de primers auxilis',
                'start_date' => '2025-11-05',
                'finish_date' => '2025-11-25',
                'certification' => 'Pendent',
                'active' => true,
            ],
            [
                'name' => 'Manipulació d\'Aliments',
                'forcem' => '15',
                'hours' => 15,
                'type' => 'Formació Externa',
                'info' => 'Certificat de manipulador d\'aliments',
                'start_date' => '2025-11-06',
                'finish_date' => '2025-11-20',
                'certification' => 'Pendent',
                'active' => true,
            ],
            [
                'name' => 'Prevenció de Riscos Laborals',
                'forcem' => '18',
                'hours' => 30,
                'type' => 'Formació Salut laboral',
                'info' => 'Formació en prevenció de riscos laborals',
                'assistent' => null,
                'start_date' => '2025-11-07',
                'finish_date' => '2025-12-07',
                'certification' => 'Pendent',
                'active' => true,
            ],
            [
                'name' => 'Atenció a la Dependència',
                'forcem' => '20',
                'hours' => 40,
                'type' => 'Formació Interna',
                'info' => 'Formació especialitzada en atenció a persones dependents',
                'start_date' => '2025-11-08',
                'finish_date' => '2025-12-08',
                'certification' => 'Pendent',
                'active' => true,
            ],
            [
                'name' => 'Comunicació Efectiva',
                'forcem' => '10',
                'hours' => 10,
                'type' => 'Jorn/Taller/Seminari/Congrès',
                'info' => 'Tècniques de comunicació i treball en equip',
                'start_date' => '2025-11-09',
                'finish_date' => '2025-11-19',
                'certification' => 'Pendent',
                'active' => true,
            ],
        ];

        foreach ($cursos as $curso) {
            Curso::create($curso);
        }
    }
}
