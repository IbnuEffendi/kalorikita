<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaketCategory extends Model
{
    use HasFactory;

    // OPSI 1 (PALING GAMPANG):
    // $guarded = ['id'] artinya "Semua kolom BOLEH diisi KECUALI id"
    // Ini otomatis mengizinkan slug, keuntungan, dll masuk.
    protected $guarded = ['id']; 

    // OPSI 2 (Kalau kamu pakai $fillable, kamu harus daftarin manual):
    // protected $fillable = ['nama_kategori', 'slug', 'deskripsi', 'keuntungan'];

    // WAJIB ADA: Biar datanya bisa diloop di HTML
    protected $casts = [
        'keuntungan' => 'array',
    ];

    public function options()
    {
        return $this->hasMany(PaketOption::class, 'paket_category_id');
    }
}