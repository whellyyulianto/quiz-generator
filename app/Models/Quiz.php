<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = [
        'topic',
        'difficulty',
        'questions',
    ];

    protected $casts = [
        'questions' => 'array',
    ];
}
