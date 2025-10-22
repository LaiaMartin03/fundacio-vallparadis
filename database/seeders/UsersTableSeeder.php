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
            'surname'=> 'Lopez',
            'name' => 'Jana',
            'email' => 'jana@gmail.com',
            'password' => Hash::make('Test123!'), // bcrypt
            'address' => 'Carrer de prova, 123, 08001 Barcelona',
            'phone' => '123456789',
            'birthday' => '1990-01-01',
            'curriculum' => 'curriculum_jana.pdf',
            'active' => true,
        ]);

        User::create([
            'surname'=> 'Gomez',
            'name' => 'Fran',
            'email' => 'fran@gmail.com',
            'password' => Hash::make('Test123!'), // bcrypt
            'address' => 'Carrer de prova, 456, 08002 Barcelona',
            'phone' => '987654321',
            'birthday' => '1985-05-15',
            'curriculum' => 'curriculum_fran.pdf',
            'active' => true,
        ]);

        User::create([
            'surname'=> 'Gimenez',
            'name' => 'asd',
            'email' => 'asd@gmail.com',
            'password' => Hash::make('123456789'), // bcrypt
            'address' => 'Carrer de prova, 123, 08001 Barcelona',
            'phone' => '123456789',
            'birthday' => '1990-01-01',
            'curriculum' => 'curriculum_asd.pdf',
            'active' => true
        ]);
    }
}
