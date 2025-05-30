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
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 50);
            $table->string('apellido', 50);
            $table->string('cedula', 8)->unique();
            $table->enum('estado', ['matriculado', 'graduado', 'retirado']);
            $table->enum('genero', ['masculino', 'femenino']);
            $table->integer('edad');
            $table->date('fecha_nacimiento');
            $table->string('telefono', 15);
            $table->string('correo')->unique();
            $table->foreignId('user_id')->nullable()->constrained(); // Relación con usuario
            $table->timestamps(); // created_at y updated_at
        });
       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('estudiantes', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
        Schema::dropIfExists('estudiantes');
    }
};
