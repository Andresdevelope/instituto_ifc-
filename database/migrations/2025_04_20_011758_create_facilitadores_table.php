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
        Schema::create('facilitadores', function (Blueprint $table) {
            $table->id();
            // Información personal del facilitador
            $table->string('nombre');
            $table->string('apellido');
            $table->string('email')->unique();
            $table->string('telefono')->nullable();
            $table->string('direccion')->nullable();
            $table->enum('estado', ['activo', 'inactivo'])->default('activo');
            
            // Relación con la tabla users (uno a uno)
            $table->unsignedBigInteger('user_id')->unique();
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');

            // Relación con la tabla roles//porque se relaciona con roles osea cual es la causa, ya que un facilitador puede tener un rol asignado en el sistema, lo que permite asignar diferentes permisos y funcionalidades a cada facilitador en el sistema.
            $table->unsignedBigInteger('rol_id');
            $table->foreign('rol_id')
                  ->references('id')
                  ->on('roles')
                  ->onDelete('restrict');

            // Campos de especialidad o área
            $table->string('especialidad')->nullable();
            $table->text('biografia')->nullable();
            
            // Timestamps
            $table->timestamps();
            $table->softDeletes(); // Para borrado lógico
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //que significa el down? lo que hace es eliminar la tabla facilitadores y luego las claves foráneas que se crearon en el up
        Schema::table('facilitadores', function (Blueprint $table) {
            // Eliminar primero las claves foráneas
            // Esto es importante porque no se pueden eliminar las tablas que tienen claves foráneas
            $table->dropForeign(['user_id']);
            $table->dropForeign(['rol_id']);
        });

        Schema::dropIfExists('facilitadores');
    }
};