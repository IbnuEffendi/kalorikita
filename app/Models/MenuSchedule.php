<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuSchedule extends Model
{
    use HasFactory;

    // Izinkan semua kolom diisi
    protected $guarded = ['id'];

    // Relasi ke Paket (Menu ini milik paket apa?)
    public function paketCategory()
    {
        return $this->belongsTo(PaketCategory::class, 'paket_category_id');
    }

    // Relasi ke Menu Siang (Ini resep apa?)
    public function lunchMenu()
    {
        return $this->belongsTo(Menu::class, 'lunch_menu_id');
    }

    // Relasi ke Menu Malam (Ini resep apa?)
    public function dinnerMenu()
    {
        return $this->belongsTo(Menu::class, 'dinner_menu_id');
    }
}