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
        Schema::table('users', function (Blueprint $table) {
            //que es constrained. Es una restriccion que se aplica a una columna de una tabla. y ->after es una funcion que se utiliza para especificar la posicion de la columna en la tabla
            //constrained() es un metodo que se utiliza para crear una clave foranea en una tabla.
            //en este caso se esta creando una clave foranea en la tabla users que hace referencia a la tabla roles.
            $table->foreignId('role_id')->constrained()->after('password');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropColumn('role_id');
        });
    }
};
