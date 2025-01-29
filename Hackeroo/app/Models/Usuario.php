<?php

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    // Relación muchos a muchos con los cursos (para los alumnos)
    public function cursos()
    {
        return $this->belongsToMany(Curso::class, 'curso_usuario', 'usuario_dni', 'curso_id');
    }

    // Relación uno a muchos con los cursos (para los profesores)
    public function cursos_profesor()
    {
        return $this->hasMany(Curso::class, 'profesor_dni', 'DNI');
    }
}
