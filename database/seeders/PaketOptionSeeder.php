<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaketOptionSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('paket_options')->insert([
            [
                'paket_category_id' => 1,
                'durasi_hari' => 7,
                'harga' => 250000,
                'deskripsi' => 'Paket 7 hari untuk Weight Loss.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'paket_category_id' => 1,
                'durasi_hari' => 14,
                'harga' => 450000,
                'deskripsi' => 'Paket 14 hari untuk Weight Loss.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'paket_category_id' => 1,
                'durasi_hari' => 30,
                'harga' => 900000,
                'deskripsi' => 'Paket bulanan Weight Loss.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Maintain
            [
                'paket_category_id' => 2,
                'durasi_hari' => 7,
                'harga' => 280000,
                'deskripsi' => 'Paket 7 hari Maintain.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'paket_category_id' => 2,
                'durasi_hari' => 14,
                'harga' => 500000,
                'deskripsi' => 'Paket 14 hari Maintain.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Bulking
            [
                'paket_category_id' => 3,
                'durasi_hari' => 7,
                'harga' => 300000,
                'deskripsi' => 'Paket 7 hari Bulking.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
