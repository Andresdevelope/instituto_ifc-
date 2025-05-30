<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    // Relación con facilitadores
    public function facilitadores()
    {
        return $this->hasMany(Facilitador::class);
    }
}
