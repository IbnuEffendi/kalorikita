<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Boleh untuk development, tapi untuk production lebih aman pakai $fillable.
    protected $guarded = [];

    protected $casts = [
        'start_date'   => 'date',     // cukup date kalau tidak perlu jam
        'end_date'     => 'date',
        'paid_at'      => 'datetime', // kalau kamu simpan paid_at
        'total_box'    => 'integer',  // penting agar tidak float
        'box_terpakai' => 'integer',  // penting agar tidak float
        'total_hari'   => 'integer',
        'total_harga'  => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function paketCategory()
    {
        return $this->belongsTo(PaketCategory::class, 'paket_category_id');
    }
    public function paketOption()
    {
        return $this->belongsTo(PaketOption::class, 'paket_option_id');
    }

    public function deliveryLogs()
    {
        return $this->hasMany(\App\Models\OrderDeliveryLog::class);
    }
}
