<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DefaultUserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Alan',
            'email' => 'alan@alan.com',
            'password' => Hash::make('alan'),
            'rol' => 'Laboratorio', // Asumiendo que tienes un campo 'rol' en tu tabla de usuarios
        ]);
    }
}