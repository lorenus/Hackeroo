<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    use HasFactory;

    protected $fillable = ['enunciado', 'tipo', 'tarea_id'];

    public function tarea()
    {
        return $this->belongsTo(Tarea::class);
    }
    public function opciones_respuestas()
    {
        return $this->hasMany(OpcionesRespuesta::class);
    }
}
