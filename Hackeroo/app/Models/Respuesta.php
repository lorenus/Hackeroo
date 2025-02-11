<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
    use HasFactory;

    protected $fillable = ['usuario_dni', 'pregunta_id', 'respuesta', 'es_correcta'];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_dni', 'DNI');
    }

    public function pregunta()
    {
        return $this->belongsTo(Pregunta::class);
    }
}

