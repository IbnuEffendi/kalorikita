<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserTarget extends Model
{
    protected $fillable = [
        'user_id',
        'bmr',
        'tdee',
        'kalori_target',
        'karbo_target',
        'protein_target',
        'lemak_target',
        'goal',
        'insight',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
