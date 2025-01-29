<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuarios extends Authenticatable
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
    ];
    
    public function getAuthIdentifierName()
    {
        return 'email';
    }
    
    public function getAuthPassword()
    {
        return $this->contraseña;
    }
}
