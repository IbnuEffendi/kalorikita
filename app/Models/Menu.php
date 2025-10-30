<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menu'; // nama tabel di database

    // Kolom yang boleh diisi secara mass-assignment (fillable)
    protected $fillable = [
        'nama_menu',
        'deskripsi',
        'kategori',
        'tipe_makanan',
        'kalori',
        'protein',
        'karbohidrat',
        'lemak',
        'gambar',
        'status',
    ];
}
