<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('materias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 50);
            $table->string('codigo', 10)->unique();
            $table->text('descripcion')->nullable();
            $table->enum('estado', ['activa', 'inactiva'])->default('activa');
            
            // Relaciones con otras tablas
            $table->unsignedBigInteger('facilitador_id')();
            $table->foreign('facilitador_id')
                  ->references('id')
                  ->on('facilitadores')
                  ->onDelete('cascade');

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null');

            $table->unsignedBigInteger('rol_id')->nullable();
            $table->foreign('rol_id')
                  ->references('id')
                  ->on('roles')
                  ->onDelete('set null');

            $table->unsignedBigInteger('estudiante_id')->nullable();
            $table->foreign('estudiante_id')
                  ->references('id')
                  ->on('estudiantes')
                  ->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('materias', function (Blueprint $table) {
            // Eliminar las claves foráneas primero
            $table->dropForeign(['facilitador_id']);
            $table->dropForeign(['user_id']);
            $table->dropForeign(['rol_id']);
            $table->dropForeign(['estudiante_id']);
        });

        Schema::dropIfExists('materias');
    }
};