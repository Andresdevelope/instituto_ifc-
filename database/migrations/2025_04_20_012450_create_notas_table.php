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
        Schema::create('notas', function (Blueprint $table) {
            $table->id();
            $table->decimal('nota', 4, 2);
            $table->date('fecha');
            $table->foreignId('estudiante_id')->constrained();
            $table->foreignId('materia_id')->constrained();
            $table->foreignId('facilitador_id')->constrained('facilitadores');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notas');
    }
};
