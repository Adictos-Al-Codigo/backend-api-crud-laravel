<?php

namespace Database\Seeders;

use App\Models\Tipo_usuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Tipo_usuario_seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tipo_usuario::create(['tipo' => 'administrador', 'estado' => 1]);
        Tipo_usuario::create(['tipo' => 'usuario', 'estado' => 1]);
    }
}
