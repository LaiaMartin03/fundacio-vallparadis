<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Resource;
use App\Models\User;

class ResourceSeeder extends Seeder
{
    public function run(): void
    {
        // Find Jana and Carlos
        $jana = User::where('email', 'jana@gmail.com')->first();
        $carlos = User::where('email', 'carlos.rodriguez@gmail.com')->first();

        if ($jana && $carlos) {
            // Create 2 uniforms for Jana
            Resource::create([
                'shirt_size' => '40',
                'pants_size' => '38',
                'lab_coat' => true,
                'shoe_size' => '40',
                'user_id' => $jana->id,
                'given_by_user_id' => $carlos->id,
                'delivered_at' => now()->subDays(30),
            ]);

            Resource::create([
                'shirt_size' => '38',
                'pants_size' => '40',
                'lab_coat' => false,
                'shoe_size' => '40',
                'user_id' => $jana->id,
                'given_by_user_id' => $carlos->id,
                'delivered_at' => now()->subDays(15),
            ]);
        }
    }
}