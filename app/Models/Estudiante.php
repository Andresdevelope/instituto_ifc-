<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Nota;
use App\Models\Materia;

class Estudiante extends Model
{
    use HasFactory;

    protected $table = 'estudiantes';

    protected $fillable = [
        'nombre',
        'apellido',
        'cedula',
        'estado',
        'genero',
        'edad',
        'fecha_nacimiento',
        'telefono',
        'correo',
        'user_id',
    ];

    // Relación con usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con notas
    public function notas()
    {
        return $this->hasMany(Nota::class);
    }

    // Relación muchos a muchos con materias
    public function materias()
    {
        return $this->belongsToMany(Materia::class, 'estudiante_materia')
            ->withPivot('fecha_inscripcion')
            ->withTimestamps();
    }
}

