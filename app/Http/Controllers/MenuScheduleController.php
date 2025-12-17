<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuSchedule;
use App\Models\PaketCategory;
use App\Models\Menu;

class MenuScheduleController extends Controller
{
    /**
     * STORE: Menyimpan Data Jadwal Baru
     */
    public function store(Request $request)
    {
        // 1. Validasi inputan
        $validated = $request->validate([
            'paket_category_id' => 'required|exists:paket_categories,id',
            'schedule_date'     => 'required|date',
            
            // PERBAIKAN: Menggunakan 'menu' (singular) sesuai nama tabel database kamu
            'lunch_menu_id'     => 'required|exists:menu,id', 
            'dinner_menu_id'    => 'required|exists:menu,id',
        ]);

        // 2. Cek Duplikat (Agar tidak ada jadwal ganda untuk paket & tanggal yang sama)
        $exists = MenuSchedule::where('paket_category_id', $request->paket_category_id)
                    ->where('schedule_date', $request->schedule_date)
                    ->exists();

        if ($exists) {
            return back()->with('error', 'Jadwal untuk paket & tanggal tersebut sudah ada! Silakan edit jadwal yang lama.');
        }

        // 3. Simpan Data Baru
        MenuSchedule::create($validated);

        return back()->with('success', 'Jadwal Menu berhasil disimpan!');
    }

    /**
     * EDIT: Menampilkan Halaman Edit Jadwal
     */
    public function edit($id)
    {
        $schedule = MenuSchedule::findOrFail($id);
        
        // Ambil data pendukung untuk Dropdown
        $packets = PaketCategory::all();
        $menus   = Menu::all();

        return view('admin.paket.edit-schedule', compact('schedule', 'packets', 'menus'));
    }

    /**
     * UPDATE: Menyimpan Perubahan Jadwal
     */
    public function update(Request $request, $id)
    {
        $schedule = MenuSchedule::findOrFail($id);

        $validated = $request->validate([
            'paket_category_id' => 'required|exists:paket_categories,id',
            'schedule_date'     => 'required|date',
            
            // PERBAIKAN: Menggunakan 'menu' (singular)
            'lunch_menu_id'     => 'required|exists:menu,id',
            'dinner_menu_id'    => 'required|exists:menu,id',
        ]);

        $schedule->update($validated);

        return redirect()->route('admin.paket.schedules')->with('success', 'Jadwal berhasil diperbarui!');
    }

    /**
     * DESTROY: Menghapus Jadwal
     */
    public function destroy($id)
    {
        $schedule = MenuSchedule::findOrFail($id);
        $schedule->delete();

        return back()->with('success', 'Jadwal berhasil dihapus!');
    }
}