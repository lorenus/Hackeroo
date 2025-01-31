<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecursoMultimedia extends Model
{
    use HasFactory;

    protected $fillable = ['tipo', 'url', 'tarea_id'];

    public function tarea()
    {
        return $this->belongsTo(Tarea::class);
    }
}
