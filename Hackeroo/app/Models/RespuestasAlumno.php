<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RespuestasAlumno extends Model
{
    use HasFactory;

    protected $fillable = [
        'usuario_dni',        
        'opcion_respuesta_id', 
        'pregunta_id',     
        'es_correcta',    
    ];

    public function alumno()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function opciones_respuesta()
    {
        return $this->belongsTo(OpcionesRespuesta::class);
    }

    public function pregunta()
    {
        return $this->belongsTo(Pregunta::class);
    }
}
