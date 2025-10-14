<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Jana',
            'email' => 'jana@gmail.com',
            'password' => Hash::make('Test123!'), // bcrypt
        ]);

        User::create([
            'name' => 'Fran',
            'email' => 'fran@gmail.com',
            'password' => Hash::make('Test123!'), // bcrypt
        ]);
    }
}
