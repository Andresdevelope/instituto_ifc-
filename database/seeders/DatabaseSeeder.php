<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\DB;  // Agregado para usar DB facade
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear un rol por defecto
        $role = DB::table('roles')->where('name', 'default')->first();
        if (!$role) {
            $roleId = DB::table('roles')->insertGetId([
                'name' => 'default',
                'description' => 'Rol por defecto',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } else {
            $roleId = $role->id;
        }

        // Crear usuario con role_id asignado solo si no existe
        if (!DB::table('users')->where('email', 'test@example.com')->exists()) {
            User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
                'role_id' => $roleId,
            ]);
        }

        // Llamar a los seeders de las tablas
        $this->call([
            FacilitadoresSeeder::class,
            EstudiantesSeeder::class,
            MateriasSeeder::class,
            NotasSeeder::class,
        ]);
    }
}
