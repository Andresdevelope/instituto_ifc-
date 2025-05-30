<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Nota;

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
}

