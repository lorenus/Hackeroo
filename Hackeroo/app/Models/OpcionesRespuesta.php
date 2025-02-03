<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpcionesRespuesta extends Model
{
    use HasFactory;

    protected $fillable = [
        'pregunta_id', // Relación con la pregunta
        'respuesta',    // Texto de la respuesta
        'es_correcta',  // Indica si es la respuesta correcta
    ];

    // Relación con el modelo Pregunta
    public function pregunta()
    {
        return $this->belongsTo(Pregunta::class);
    }
}
