<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServeisSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('serveis')->insert([
            [
                'tipus' => 'general',
                'name' => 'Cuina',
                'desc' => 'Servei de cuina.',
                'observacions' => '',
                'user_id' => null,
                'internal_doc_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tipus' => 'general',
                'name' => 'Neteja i Bugaderia',
                'desc' => 'Servei de neteja i bugaderia.',
                'observacions' => '',
                'user_id' => null,
                'internal_doc_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
