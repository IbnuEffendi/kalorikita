<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuSchedule extends Model
{
    use HasFactory;

    // Izinkan semua kolom diisi
    protected $guarded = ['id'];

    public function lunchMenu()
    {
        return $this->belongsTo(\App\Models\Menu::class, 'lunch_menu_id');
    }
    public function dinnerMenu()
    {
        return $this->belongsTo(\App\Models\Menu::class, 'dinner_menu_id');
    }
    public function paketCategory()
    {
        return $this->belongsTo(\App\Models\PaketCategory::class, 'paket_category_id');
    }
}
