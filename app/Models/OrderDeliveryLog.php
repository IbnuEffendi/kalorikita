<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDeliveryLog extends Model
{
    protected $guarded = [];

    protected $casts = [
        'delivery_date' => 'date',
        'lunch_delivered_at' => 'datetime',
        'dinner_delivered_at' => 'datetime',
    ];

    public function order()
    {
        return $this->belongsTo(\App\Models\Order::class);
    }
}
