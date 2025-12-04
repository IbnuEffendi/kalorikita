<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaketOptionSeeder extends Seeder
{
    public function run(): void
    {
        // === 1. WEIGHT LOSS ===
        $weightLoss = [
            [ 'nama_opsi' => 'Mingguan', 'durasi' => 7,  'harga' => 250000, 'deskripsi' => 'Paket 7 hari Weight Loss.' ],
            [ 'nama_opsi' => '2 Minggu', 'durasi' => 14, 'harga' => 450000, 'deskripsi' => 'Paket 14 hari Weight Loss.' ],
            [ 'nama_opsi' => 'Bulanan',  'durasi' => 30, 'harga' => 900000, 'deskripsi' => 'Paket bulanan Weight Loss.' ],
        ];

        // === 2. MAINTAIN ===
        $maintain = [
            [ 'nama_opsi' => 'Mingguan', 'durasi' => 7,  'harga' => 280000, 'deskripsi' => 'Paket 7 hari Maintain.' ],
            [ 'nama_opsi' => '2 Minggu', 'durasi' => 14, 'harga' => 500000, 'deskripsi' => 'Paket 14 hari Maintain.' ],
            [ 'nama_opsi' => 'Bulanan',  'durasi' => 30, 'harga' => 950000, 'deskripsi' => 'Paket bulanan Maintain.' ],
        ];

        // === 3. BULKING ===
        $bulking = [
            [ 'nama_opsi' => 'Mingguan', 'durasi' => 7,  'harga' => 300000, 'deskripsi' => 'Paket 7 hari Bulking.' ],
            [ 'nama_opsi' => '2 Minggu', 'durasi' => 14, 'harga' => 550000, 'deskripsi' => 'Paket 14 hari Bulking.' ],
            [ 'nama_opsi' => 'Bulanan',  'durasi' => 30, 'harga' => 1100000, 'deskripsi' => 'Paket bulanan Bulking.' ],
        ];

        // FUNGSI UTAMA INSERT KE DB
        $allOptions = [];

        // Masukkan Weight Loss (ID 1)
        foreach ($weightLoss as $opt) {
            $allOptions[] = [
                'paket_category_id' => 1,
                'nama_opsi' => $opt['nama_opsi'], // <--- INI YANG TADI KURANG
                'durasi_hari' => $opt['durasi'],
                'harga' => $opt['harga'],
                'deskripsi' => $opt['deskripsi'],
                'created_at' => now(), 
                'updated_at' => now(),
            ];
        }

        // Masukkan Maintain (ID 2)
        foreach ($maintain as $opt) {
            $allOptions[] = [
                'paket_category_id' => 2,
                'nama_opsi' => $opt['nama_opsi'], // <--- INI JUGA
                'durasi_hari' => $opt['durasi'],
                'harga' => $opt['harga'],
                'deskripsi' => $opt['deskripsi'],
                'created_at' => now(), 
                'updated_at' => now(),
            ];
        }

        // Masukkan Bulking (ID 3)
        foreach ($bulking as $opt) {
            $allOptions[] = [
                'paket_category_id' => 3,
                'nama_opsi' => $opt['nama_opsi'], // <--- INI JUGA
                'durasi_hari' => $opt['durasi'],
                'harga' => $opt['harga'],
                'deskripsi' => $opt['deskripsi'],
                'created_at' => now(), 
                'updated_at' => now(),
            ];
        }

        // Eksekusi Insert
        DB::table('paket_options')->insert($allOptions);
    }
}