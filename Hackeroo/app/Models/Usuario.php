<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use App\Models\Curso;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'usuarios'; 
    protected $primaryKey = 'DNI';
    public $incrementing = false; 
    protected $keyType = 'string'; 

    protected $fillable = [
        'DNI',
        'nombre',
        'apellidos',
        'email',
        'contraseña',
        'rol',
        'puntos',
        'color',
        'avatar',
    ];

    protected $hidden = [
        'contraseña',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'rol' => 'string',
    ];

    public function getAuthIdentifierName()
    {
        return 'email';
    }

    public function getAuthPassword()
    {
        return $this->contraseña;
    }

    public function cursos()
    {
        return $this->belongsToMany(Curso::class, 'curso_usuario', 'usuario_dni', 'curso_id');
    }

    public function cursos_profesor()
    {
        return $this->hasMany(Curso::class, 'profesor_dni', 'DNI');
    }
}
 