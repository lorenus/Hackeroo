<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    use HasFactory;

    protected $fillable = ['titulo', 'descripcion', 'tipo', 'curso_id'];

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    public function preguntas()
    {
        return $this->hasMany(Pregunta::class);
    }

    public function recursosMultimedia()
    {
        return $this->hasMany(RecursoMultimedia::class);
    }
}
