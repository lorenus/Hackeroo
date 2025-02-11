<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CursoUsuario extends Model
{
    use HasFactory;

    protected $table = 'cursos';

    protected $fillable = [
        'curso_id',
        'usuario_dni',
    ];

    public function alumnos()
    {
        return $this->hasMany(Usuario::class,'DNI','usuario_dni'); 
    }
}