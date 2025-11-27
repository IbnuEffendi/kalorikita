<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaketCategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('paket_categories')->insert([
            [
                'nama_kategori' => 'Weight Loss',
                'deskripsi' => 'Program untuk menurunkan berat badan secara sehat.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategori' => 'Maintain',
                'deskripsi' => 'Paket untuk menjaga berat badan ideal.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategori' => 'Bulking',
                'deskripsi' => 'Program untuk menaikkan berat badan dan massa otot.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
