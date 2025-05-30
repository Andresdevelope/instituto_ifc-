<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Se asumen ids existentes en estudiantes, materias y facilitadores
        DB::table('notas')->insert([
            [
                'nota' => 4.5,
                'fecha' => '2025-06-01',
                'estudiante_id' => 1,
                'materia_id' => 1,
                'facilitador_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nota' => 3.8,
                'fecha' => '2025-06-01',
                'estudiante_id' => 2,
                'materia_id' => 2,
                'facilitador_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
