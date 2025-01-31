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

    protected $table = 'usuarios'; // Se especifica el nombre de la tabla
    protected $primaryKey = 'DNI'; // La clave primaria es el DNI
    public $incrementing = false; // Ya que el DNI no es auto-incremental
    protected $keyType = 'string'; // El DNI es de tipo string

    protected $fillable = [
        'DNI',
        'nombre',
        'apellidos',
        'email',
        'contraseña',
        'rol',
    ];

    protected $hidden = [
        'contraseña',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'rol' => 'string',
    ];
    
    // Autenticación: Indicar que el email es el identificador del usuario
    public function getAuthIdentifierName()
    {
        return 'email';
    }
    
    public function getAuthPassword()
    {
        return $this->contraseña;
    }

    // 🔹 Relación muchos a muchos con los cursos (para los alumnos)
    public function cursos()
    {
        return $this->belongsToMany(Curso::class, 'curso_usuario', 'usuario_dni', 'curso_id');
    }

    // 🔹 Relación uno a muchos con los cursos (para los profesores)
    public function cursos_profesor()
    {
        return $this->hasMany(Curso::class, 'profesor_dni', 'DNI');
    }
}
