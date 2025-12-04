<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketOption extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relasi kebalikannya: Opsi ini milik Kategori apa?
    public function category()
    {
        return $this->belongsTo(PaketCategory::class, 'paket_category_id');
    }
}