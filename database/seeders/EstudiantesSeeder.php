<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstudiantesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('estudiantes')->insert([
            [
                'nombre' => 'Carlos',
                'apellido' => 'Lopez',
                'cedula' => '11112222',
                'estado' => 'matriculado',
                'genero' => 'masculino',
                'edad' => 20,
                'fecha_nacimiento' => '2003-01-15',
                'telefono' => '3216549870',
                'correo' => 'carlos.lopez@example.com',
                'user_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Ana',
                'apellido' => 'Martinez',
                'cedula' => '33334444',
                'estado' => 'graduado',
                'genero' => 'femenino',
                'edad' => 22,
                'fecha_nacimiento' => '2001-05-20',
                'telefono' => '9876543210',
                'correo' => 'ana.martinez@example.com',
                'user_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
