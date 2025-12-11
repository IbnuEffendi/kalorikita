<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // [PENTING] Kosongkan guarded agar SEMUA data dari controller diizinkan masuk
    protected $guarded = [];

    // [OPSIONAL TAPI BAGUS] Ubah kolom tanggal jadi format Tanggal Otomatis (Carbon)
    // Supaya di view nanti bisa langsung $order->start_date->format('d M Y')
    protected $casts = [
        'start_date' => 'datetime',
        'end_date'   => 'datetime',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Paket Category (Induk: Weight Loss, Maintain, dll)
    public function paketCategory()
    {
        return $this->belongsTo(PaketCategory::class, 'paket_category_id');
    }

    // Relasi ke Paket Option (Durasi: 7 Hari, 14 Hari, dll)
    public function paketOption()
    {
        return $this->belongsTo(PaketOption::class, 'paket_option_id');
    }
}