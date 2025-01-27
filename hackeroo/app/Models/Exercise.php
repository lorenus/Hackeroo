<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;

    protected $fillable = ['subject_id', 'title', 'description'];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function answerOptions()
    {
        return $this->hasMany(AnswerOption::class);
    }
}
