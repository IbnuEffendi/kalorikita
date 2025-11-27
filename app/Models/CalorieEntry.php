<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CalorieEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'eaten_at',
        'meal',
        'category',
        'calories',
        'carbs',
        'protein',
        'fat',
        'source',
        'ai_prompt',
        'ai_raw_response',
    ];

    protected $casts = [
        'eaten_at' => 'datetime',
    ];
}
