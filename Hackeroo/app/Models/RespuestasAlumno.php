<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RespuestasAlumno extends Model
{
    use HasFactory;

    protected $fillable = [
        'alumno_id',        // Relación con el alumno
        'opciones_respuesta_id', // Relación con la opción de respuesta seleccionada
        'pregunta_id',      // Relación con la pregunta
        'es_correcta',      // Indica si la respuesta es correcta o no
    ];

    // Relación con el alumno
    public function alumno()
    {
        return $this->belongsTo(Usuario::class);
    }

    // Relación con la opción de respuesta seleccionada
    public function opciones_respuesta()
    {
        return $this->belongsTo(OpcionesRespuesta::class);
    }

    // Relación con la pregunta
    public function pregunta()
    {
        return $this->belongsTo(Pregunta::class);
    }
}
