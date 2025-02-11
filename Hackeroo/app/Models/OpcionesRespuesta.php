<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpcionesRespuesta extends Model
{
    use HasFactory;

    protected $fillable = [
        'pregunta_id', 
        'respuesta',  
        'es_correcta',  
    ];

    public function pregunta()
    {
        return $this->belongsTo(Pregunta::class);
    }
}
