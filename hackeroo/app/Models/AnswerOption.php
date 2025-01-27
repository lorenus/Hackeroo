<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerOption extends Model
{
    use HasFactory;

    protected $fillable = ['exercise_id', 'text', 'is_correct'];

    public function exercise()
    {
        return $this->belongsTo(Exercise::class);
    }
}
