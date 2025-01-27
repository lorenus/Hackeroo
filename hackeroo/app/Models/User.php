<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Submission;

class User extends Model
{
    use HasFactory;

    // Definir los atributos que se pueden asignar masivamente
    protected $fillable = ['name', 'email', 'password', 'birth_date', 'role', 'status'];

    // Usar los mutadores para el campo 'password', así aseguramos que se guarde de manera cifrada
    protected $hidden = ['password'];

    // Para indicar que el password siempre debe ser cifrado al crearse o actualizarse
    public static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            if ($user->password) {
                $user->password = bcrypt($user->password);
            }
        });

        static::updating(function ($user) {
            if ($user->password) {
                $user->password = bcrypt($user->password);
            }
        });
    }

    // Método para validar si un usuario es un profesor
    public function isProfesor()
    {
        return $this->role === 'profesor';
    }

    // Método para validar si un usuario es un alumno
    public function isAlumno()
    {
        return $this->role === 'alumno';
    }

    // Relación de un usuario con las entregas
    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }

    // Relación con notificaciones
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
}
