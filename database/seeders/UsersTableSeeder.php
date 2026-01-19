<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        $professions = ['Psicòleg', 'Educador', 'Treballador Social', 'Infermer'];
        
        // Jana - Directora (Equip Directiu)
        User::create([
            'surname'=> 'Martínez',
            'name' => 'Jana',
            'email' => 'jana@gmail.com',
            'password' => Hash::make('Test123!'),
            'address' => 'Avinguda Diagonal, 123, 08001 Barcelona',
            'phone' => '612345678',
            'birthday' => '1988-03-15',
            'curriculum' => 'curriculum_jana.pdf',
            'role' => 'Equip Directiu',
            'profession' => 'Psicòleg',
            'active' => true,
        ]);

        // Carlos - Administrador
        User::create([
            'surname'=> 'Rodríguez',
            'name' => 'Carlos',
            'email' => 'carlos.rodriguez@gmail.com',
            'password' => Hash::make('Test123!'),
            'address' => 'Carrer Balmes, 45, 08007 Barcelona',
            'phone' => '623456789',
            'birthday' => '1992-07-22',
            'curriculum' => 'curriculum_carlos.pdf',
            'role' => 'Administració',
            'profession' => 'Educador',
            'active' => true,
        ]);

        // Elena - Psicóloga (Responsable/Equip Tècnic)
        User::create([
            'surname'=> 'Fernández',
            'name' => 'Elena',
            'email' => 'elena.fernandez@gmail.com',
            'password' => Hash::make('Test123!'),
            'address' => 'Carrer Gran de Gràcia, 89, 08012 Barcelona',
            'phone' => '634567890',
            'birthday' => '1991-11-30',
            'curriculum' => 'curriculum_elena.pdf',
            'role' => 'Responsable/Equip Tecnic',
            'profession' => 'Psicòleg',
            'active' => true,
        ]);

        // Miguel - Educador
        User::create([
            'surname'=> 'López',
            'name' => 'Miguel',
            'email' => 'miguel.lopez@gmail.com',
            'password' => Hash::make('Test123!'),
            'address' => 'Carrer Aragó, 156, 08011 Barcelona',
            'phone' => '645678901',
            'birthday' => '1987-05-18',
            'curriculum' => 'curriculum_miguel.pdf',
            'role' => 'Treballador',
            'profession' => 'Educador',
            'active' => true,
        ]);

        // Ana - Trabajadora Social
        User::create([
            'surname'=> 'García',
            'name' => 'Ana',
            'email' => 'ana.garcia@gmail.com',
            'password' => Hash::make('Test123!'),
            'address' => 'Carrer Muntaner, 234, 08021 Barcelona',
            'phone' => '656789012',
            'birthday' => '1993-09-12',
            'curriculum' => 'curriculum_ana.pdf',
            'role' => 'Treballador',
            'profession' => 'Treballador Social',
            'active' => true,
        ]);

        // asd - Para pruebas
        User::create([
            'surname'=> 'asd',
            'name' => 'asd',
            'email' => 'asd@gmail.com',
            'password' => Hash::make('123456789'),
            'address' => 'Carrer Muntaner, 234, 08021 Barcelona',
            'phone' => '656789012',
            'birthday' => '1993-09-12',
            'curriculum' => 'curriculum_ana.pdf',
            'role' => 'Equip Directiu',
            'profession' => 'Infermer',
            'active' => true,
        ]);

        // David - Administrativo
        User::create([
            'surname'=> 'Pérez',
            'name' => 'David',
            'email' => 'david.perez@gmail.com',
            'password' => Hash::make('Test123!'),
            'address' => 'Carrer Valencia, 67, 08015 Barcelona',
            'phone' => '667890123',
            'birthday' => '1989-12-05',
            'curriculum' => 'curriculum_david.pdf',
            'role' => 'Administració',
            'profession' => 'Educador',
            'active' => true,
        ]);

        // Isabel - Responsable/Equip Tècnic
        User::create([
            'surname'=> 'Sánchez',
            'name' => 'Isabel',
            'email' => 'isabel.sanchez@gmail.com',
            'password' => Hash::make('Test123!'),
            'address' => 'Carrer Provença, 189, 08008 Barcelona',
            'phone' => '678901234',
            'birthday' => '1990-02-28',
            'curriculum' => 'curriculum_isabel.pdf',
            'role' => 'Responsable/Equip Tecnic',
            'profession' => 'Treballador Social',
            'active' => true,
        ]);

        // Javier - Treballador
        User::create([
            'surname'=> 'Ramírez',
            'name' => 'Javier',
            'email' => 'javier.ramirez@gmail.com',
            'password' => Hash::make('Test123!'),
            'address' => 'Carrer Bruc, 76, 08009 Barcelona',
            'phone' => '689012345',
            'birthday' => '1986-08-14',
            'curriculum' => 'curriculum_javier.pdf',
            'role' => 'Treballador',
            'profession' => 'Infermer',
            'active' => true,
        ]);

        // Carmen - Treballador
        User::create([
            'surname'=> 'Torres',
            'name' => 'Carmen',
            'email' => 'carmen.torres@gmail.com',
            'password' => Hash::make('Test123!'),
            'address' => 'Carrer Mallorca, 321, 08013 Barcelona',
            'phone' => '690123456',
            'birthday' => '1994-04-03',
            'curriculum' => 'curriculum_carmen.pdf',
            'role' => 'Treballador',
            'profession' => 'Psicòleg',
            'active' => true,
        ]);

        // Roberto - Treballador
        User::create([
            'surname'=> 'Flores',
            'name' => 'Roberto',
            'email' => 'roberto.flores@gmail.com',
            'password' => Hash::make('Test123!'),
            'address' => 'Carrer Rosselló, 98, 08029 Barcelona',
            'phone' => '601234567',
            'birthday' => '1985-10-25',
            'curriculum' => 'curriculum_roberto.pdf',
            'role' => 'Treballador',
            'profession' => 'Educador',
            'active' => true,
        ]);

        // Patricia - Treballador
        User::create([
            'surname'=> 'Díaz',
            'name' => 'Patricia',
            'email' => 'patricia.diaz@gmail.com',
            'password' => Hash::make('Test123!'),
            'address' => 'Carrer Urgell, 154, 08011 Barcelona',
            'phone' => '612345679',
            'birthday' => '1992-06-17',
            'curriculum' => 'curriculum_patricia.pdf',
            'role' => 'Treballador',
            'profession' => 'Treballador Social',
            'active' => true,
        ]);

        // Sergio - Treballador
        User::create([
            'surname'=> 'Ortega',
            'name' => 'Sergio',
            'email' => 'sergio.ortega@gmail.com',
            'password' => Hash::make('Test123!'),
            'address' => 'Carrer Casanova, 56, 08011 Barcelona',
            'phone' => '623456780',
            'birthday' => '1988-01-09',
            'curriculum' => 'curriculum_sergio.pdf',
            'role' => 'Treballador',
            'profession' => 'Infermer',
            'active' => true,
        ]);

        // Teresa - Treballador
        User::create([
            'surname'=> 'Molina',
            'name' => 'Teresa',
            'email' => 'teresa.molina@gmail.com',
            'password' => Hash::make('Test123!'),
            'address' => 'Carrer Entença, 87, 08015 Barcelona',
            'phone' => '634567891',
            'birthday' => '1991-03-22',
            'curriculum' => 'curriculum_teresa.pdf',
            'role' => 'Treballador',
            'profession' => 'Psicòleg',
            'active' => true,
        ]);

        // Alberto - Treballador
        User::create([
            'surname'=> 'Ruiz',
            'name' => 'Alberto',
            'email' => 'alberto.ruiz@gmail.com',
            'password' => Hash::make('Test123!'),
            'address' => 'Carrer Viladomat, 234, 08015 Barcelona',
            'phone' => '645678902',
            'birthday' => '1987-07-31',
            'curriculum' => 'curriculum_alberto.pdf',
            'role' => 'Treballador',
            'profession' => 'Educador',
            'active' => true,
        ]);

        // Rosa - Treballador
        User::create([
            'surname'=> 'Hernández',
            'name' => 'Rosa',
            'email' => 'rosa.hernandez@gmail.com',
            'password' => Hash::make('Test123!'),
            'address' => 'Carrer Comte d\'Urgell, 123, 08011 Barcelona',
            'phone' => '656789013',
            'birthday' => '1993-12-08',
            'curriculum' => 'curriculum_rosa.pdf',
            'role' => 'Treballador',
            'profession' => 'Treballador Social',
            'active' => true,
        ]);

        // Fernando - Treballador
        User::create([
            'surname'=> 'Jiménez',
            'name' => 'Fernando',
            'email' => 'fernando.jimenez@gmail.com',
            'password' => Hash::make('Test123!'),
            'address' => 'Carrer Londres, 45, 08029 Barcelona',
            'phone' => '667890124',
            'birthday' => '1989-05-19',
            'curriculum' => 'curriculum_fernando.pdf',
            'role' => 'Treballador',
            'profession' => 'Infermer',
            'active' => true,
        ]);

        // Silvia - Treballador
        User::create([
            'surname'=> 'Moreno',
            'name' => 'Silvia',
            'email' => 'silvia.moreno@gmail.com',
            'password' => Hash::make('Test123!'),
            'address' => 'Carrer Paris, 67, 08029 Barcelona',
            'phone' => '678901235',
            'birthday' => '1990-09-26',
            'curriculum' => 'curriculum_silvia.pdf',
            'role' => 'Treballador',
            'profession' => 'Psicòleg',
            'active' => true,
        ]);

        // Pablo - Treballador
        User::create([
            'surname'=> 'Álvarez',
            'name' => 'Pablo',
            'email' => 'pablo.alvarez@gmail.com',
            'password' => Hash::make('Test123!'),
            'address' => 'Carrer Berlín, 89, 08029 Barcelona',
            'phone' => '689012346',
            'birthday' => '1986-02-14',
            'curriculum' => 'curriculum_pablo.pdf',
            'role' => 'Treballador',
            'profession' => 'Educador',
            'active' => true,
        ]);

        // Lucía - Treballador
        User::create([
            'surname'=> 'Romero',
            'name' => 'Lucía',
            'email' => 'lucia.romero@gmail.com',
            'password' => Hash::make('Test123!'),
            'address' => 'Carrer Numància, 156, 08029 Barcelona',
            'phone' => '690123457',
            'birthday' => '1994-11-07',
            'curriculum' => 'curriculum_lucia.pdf',
            'role' => 'Treballador',
            'profession' => 'Treballador Social',
            'active' => true,
        ]);

        // Ricardo - Treballador
        User::create([
            'surname'=> 'Navarro',
            'name' => 'Ricardo',
            'email' => 'ricardo.navarro@gmail.com',
            'password' => Hash::make('Test123!'),
            'address' => 'Carrer Sants, 234, 08014 Barcelona',
            'phone' => '601234568',
            'birthday' => '1985-04-30',
            'curriculum' => 'curriculum_ricardo.pdf',
            'role' => 'Treballador',
            'profession' => 'Infermer',
            'active' => true,
        ]);
    }
}