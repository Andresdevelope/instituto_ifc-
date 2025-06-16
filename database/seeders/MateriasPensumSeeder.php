<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Materia;

class MateriasPensumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $materias = [
            // Primer periodo
            ['nombre' => 'Disciplinas Espirituales', 'codigo' => 'DIS101', 'estado' => 'activa'],
            ['nombre' => 'Discipulado Infantil', 'codigo' => 'DIS102', 'estado' => 'activa'],
            ['nombre' => 'Hacedores de Discipulos', 'codigo' => 'DIS103', 'estado' => 'activa'],
            // Segundo periodo
            ['nombre' => 'Panorama Al Antiguo Testamento', 'codigo' => 'PAN201', 'estado' => 'activa'],
            ['nombre' => 'Panorama Al Nuevo Testamento', 'codigo' => 'PAN202', 'estado' => 'activa'],
            ['nombre' => 'Alabanza Y Adoracion', 'codigo' => 'AYA203', 'estado' => 'activa'],
            ['nombre' => 'Evangelismo', 'codigo' => 'EVA204', 'estado' => 'activa'],
            // Tercer periodo
            ['nombre' => 'Liderazgo', 'codigo' => 'LID301', 'estado' => 'activa'],
            ['nombre' => 'Homiletica', 'codigo' => 'HOM302', 'estado' => 'activa'],
            ['nombre' => 'Sectas Y Religiones', 'codigo' => 'SYR303', 'estado' => 'activa'],
        ];
            // que significa el foreach?. 
        // El foreach itera sobre cada elemento del array $materias y ejecuta el bloque de código para cada uno de ellos.
        // El bloque de código dentro del foreach crea una nueva instancia del modelo Materia y la guarda en la base de datos.
            foreach ($materias as $materia) {
            Materia::create($materia);
        }
    }
}
