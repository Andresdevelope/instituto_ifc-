<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Facilitador extends Model
{   // que es hasfactory y softdelete, que hace cada uno
    // HasFactory permite crear instancias de modelos de forma sencilla para pruebas y desarrollo. // que es una instancia de modelo es una clase que representa una tabla en la base de datos y proporciona métodos para interactuar con esa tabla.
    // SoftDeletes permite eliminar registros de forma lógica en lugar de físicamente, lo que permite mantener un registro de las eliminaciones y restaurar registros eliminados.
    // SoftDeletes se utiliza en la clase Facilitador para permitir la eliminación lógica de registros.
    use HasFactory, SoftDeletes;
        //porque se usa protected $table, que es eso. es la tabla de la base de datos
        // porque se usa protected $fillable, que es eso. es para proteger los campos de la base de datos y evitar que se puedan modificar desde el exterior
        
    protected $table = 'facilitadores';
        
    protected $fillable = [
        'nombre',
        'apellido',
        'cedula',
        'materia',
        'telefono',
        'email',
    ];

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

    // Relación con materias
    public function materias()
    {       //hasmany, es una relación muchos a muchos, es decir, que puede haber muchos materias para un facilitador y muchos facilitadores para una materia
        return $this->hasMany(Materia::class);
    }

    // Relación con notas
    public function notas()
    {       //hasmany, es una relación muchos a muchos, es decir, que puede haber muchos notas para un facilitador y muchos facilitadores para una nota
        return $this->hasMany(Nota::class);
    }
}
