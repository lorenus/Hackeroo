<?php

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    // Relación muchos a muchos con los alumnos
    public function alumnos()
    {
        return $this->belongsToMany(Usuario::class, 'curso_usuario', 'curso_id', 'usuario_dni');
    }

    // Relación uno a muchos con el profesor
    public function profesor()
    {
        return $this->belongsTo(Usuario::class, 'profesor_dni', 'DNI');
    }
}

