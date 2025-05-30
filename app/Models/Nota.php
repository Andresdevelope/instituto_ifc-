<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    use HasFactory;

    protected $table = 'notas';

    protected $fillable = [
        'nota',
        'fecha',
        'estudiante_id',
        'materia_id',
        'facilitador_id',
    ];

    // Relación con estudiante
    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class);
    }

    // Relación con materia
    public function materia()
    {
        return $this->belongsTo(Materia::class);
    }

    // Relación con facilitador
    public function facilitador()
    {
        return $this->belongsTo(Facilitador::class);
    }
}
