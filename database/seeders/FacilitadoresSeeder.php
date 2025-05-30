<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FacilitadoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('facilitadores')->insert([
            [
                'nombre' => 'Juan',
                'apellido' => 'Perez',
                'cedula' => '1234567890',
                'telefono' => '12345678901',
                'correo' => 'juan.perez@example.com',
            ],
            [
                'nombre' => 'Maria',
                'apellido' => 'Gomez',
                'cedula' => '0987654321',
                'telefono' => '10987654321',
                'correo' => 'maria.gomez@example.com',
            ],
        ]);
    }
}
