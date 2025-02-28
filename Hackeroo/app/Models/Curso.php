<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $table = 'cursos';

    protected $fillable = [
        'nombre',
        'descripcion',
        'profesor_dni',
    ];

    public function alumnos()
    {
        return $this->belongsToMany(Usuario::class, 'curso_usuario', 'curso_id', 'usuario_dni')
            ->where('rol', 'alumno');
    }

    public function profesor()
    {
        return $this->belongsTo(Usuario::class, 'profesor_dni', 'DNI')
            ->where('rol', 'profesor'); 
    }
    public function tareas()
    {
        return $this->hasMany(Tarea::class, 'curso_id'); 
    }
}
