<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class Usuario extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create(['url_imagen' => "foto001.jpg","name" => "Andres777","email" => "andres.caicedo@hotmail.com","estado" => 1,"id_tipo_usuario" => 1,'password' => Hash::make('12345678')]);
    }
}
