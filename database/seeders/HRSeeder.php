<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HR;
use App\Models\Professional;

class HRSeeder extends Seeder
{
    public function run()
    {
        // Obtener algunos profesionales para usar en los seeders
        $professionals = Professional::take(15)->get();

        HR::create([
            'affected_professional' => $professionals[0]->id,
            'description' => 'Solicitud de aumento salarial por desempeño excepcional durante el último trimestre.',
            'attached_docs' => 'evaluacion_desempeno_q3.pdf, metricas_rendimiento.xlsx',
            'assigned_to' => $professionals[1]->id,
            'derivated_to' => $professionals[10]->id,
            'center_id' => 1,
            'active' => true,
            'created_at' => now()->subDays(5),
            'updated_at' => now()->subDays(5)
        ]);

        HR::create([
            'affected_professional' => $professionals[2]->id,
            'description' => 'Proceso de onboarding para nuevo equipo de trabajo. Coordinar formación y recursos necesarios.',
            'attached_docs' => 'plan_onboarding.pdf, checklist_recursos.docx',
            'assigned_to' => $professionals[3]->id,
            'derivated_to' => $professionals[11]->id,
            'center_id' => 1,
            'active' => true,
            'created_at' => now()->subDays(3),
            'updated_at' => now()->subDays(3)
        ]);

        HR::create([
            'affected_professional' => $professionals[4]->id,
            'description' => 'Revisión de contrato y condiciones laborales. El profesional solicita cambio a jornada parcial.',
            'attached_docs' => 'contrato_actual.pdf, solicitud_jornada_parcial.docx',
            'assigned_to' => $professionals[5]->id,
            'derivated_to' => $professionals[12]->id,
            'center_id' => 1,
            'active' => false,
            'created_at' => now()->subDays(10),
            'updated_at' => now()->subDays(2)
        ]);

        HR::create([
            'affected_professional' => $professionals[6]->id,
            'description' => 'Incidente reportado entre miembros del equipo. Requiere mediación y seguimiento.',
            'attached_docs' => 'reporte_incidente.pdf, declaraciones_testigos.zip',
            'assigned_to' => $professionals[7]->id,
            'derivated_to' => $professionals[13]->id,
            'center_id' => 1,
            'active' => true,
            'created_at' => now()->subDays(1),
            'updated_at' => now()->subDays(1)
        ]);

        HR::create([
            'affected_professional' => $professionals[8]->id,
            'description' => 'Solicitud de formación continua en nuevas tecnologías aplicadas al sector.',
            'attached_docs' => 'plan_formacion.pdf, presupuesto_cursos.xlsx',
            'assigned_to' => $professionals[9]->id,
            'derivated_to' => $professionals[14]->id,
            'center_id' => 1,
            'active' => true,
            'created_at' => now()->subHours(6),
            'updated_at' => now()->subHours(6)
        ]);
    }
}