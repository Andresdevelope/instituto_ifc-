<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MateriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Para las claves foráneas, se asumen ids existentes en facilitadores, roles y estudiantes
        DB::table('materias')->insert([
            [
                'nombre' => 'Matemáticas',
                'codigo' => 'MAT101',
                'descripcion' => 'Curso básico de matemáticas',
                'estado' => 'activa',
                'facilitador_id' => 1,
                'user_id' => null,
                'rol_id' => 1,
                'estudiante_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Historia',
                'codigo' => 'HIS101',
                'descripcion' => 'Curso básico de historia',
                'estado' => 'activa',
                'facilitador_id' => 2,
                'user_id' => null,
                'rol_id' => 1,
                'estudiante_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
