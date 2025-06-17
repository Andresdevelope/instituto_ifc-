<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    use HasFactory;

    protected $table = 'materias';

    protected $fillable = [
        'nombre',
        'codigo',
        'descripcion',
        'estado',
        'facilitador_id',
        'user_id',
        'rol_id',
        'estudiante_id',
    ];

    // Relación con facilitador
    public function facilitador()
    {
        return $this->belongsTo(Facilitador::class);
    }

    // Relación con usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con rol
    public function rol()
    {
        return $this->belongsTo(Rol::class);
    }

    // Relación con estudiante
    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class);
    }

    // Relación con notas
    public function notas()
    {
        return $this->hasMany(Nota::class);
    }

    // Relación muchos a muchos con estudiantes
    public function estudiantes()
    {
        return $this->belongsToMany(Estudiante::class, 'estudiante_materia')
            ->withPivot('fecha_inscripcion')
            ->withTimestamps();
    }
}
