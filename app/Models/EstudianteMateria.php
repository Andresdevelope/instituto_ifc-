<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstudianteMateria extends Model
{
    use HasFactory;

    protected $table = 'estudiante_materia';
    //
    protected $fillable = [
        'estudiante_id',
        'materia_id',
        'fecha_inscripcion',
    ];

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class);
    }

    public function materia()
    {
        return $this->belongsTo(Materia::class);
    }
}
