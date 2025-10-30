<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // nama tabel, pakai bawaan Laravel
    protected $table = 'users';

    // kolom yang bisa diisi massal
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'foto',
        'no_hp',
        'alamat',
    ];

    // kolom yang disembunyikan kalau di-return sebagai JSON
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
