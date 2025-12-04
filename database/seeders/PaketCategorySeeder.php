<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaketCategory;
use Illuminate\Support\Str;

class PaketCategorySeeder extends Seeder
{
    public function run(): void
    {
        // 1. WEIGHT LOSS (Gambar: Salad Segar)
        PaketCategory::create([
            'nama_kategori' => 'Weight Loss',
            'slug'          => Str::slug('Weight Loss'),
            'label_paket'   => 'POPULAR',
            'target_program'=> 'Turun 2 - 4 kg dalam 30 Hari',
            'range_kalori'  => '1100 - 1200 kkal',
            'level_protein' => '60 - 80 gram',
            'gambar_background' => 'https://images.pexels.com/photos/1640777/pexels-photo-1640777.jpeg?auto=compress&cs=tinysrgb&w=1260',
            'keuntungan'    => ['Menu Defisit Kalori', 'Target Turun Cepat', 'Konsultasi Ahli Gizi'],
            'deskripsi'     => 'Program diet defisit kalori untuk menurunkan berat badan tanpa rasa lapar.',
            'deskripsi_lengkap' => "<p class='mb-4'><strong>Program Weight Loss</strong> adalah solusi bagi kamu yang ingin menurunkan berat badan dengan cara sehat. Menu disusun dengan prinsip <em>Calorie Deficit</em> namun tetap padat nutrisi.</p><ul class='list-disc pl-5 space-y-2 mb-4'><li><strong>Benefit:</strong> Makan siang & malam rendah karbo, rendah garam, tanpa gorengan.</li><li><strong>Aturan:</strong> Dilarang mengonsumsi camilan manis di luar paket ini.</li></ul>",
        ]);

        // 2. MAINTAIN (Gambar: Makanan Seimbang/Bento)
        PaketCategory::create([
            'nama_kategori' => 'Maintain',
            'slug'          => Str::slug('Maintain'),
            'label_paket'   => 'BEST VALUE',
            'target_program'=> 'Pertahankan Berat Ideal & Imun Tubuh',
            'range_kalori'  => '1600 - 1800 kkal',
            'level_protein' => '90 - 100 gram',
            'gambar_background' => 'https://images.pexels.com/photos/1099680/pexels-photo-1099680.jpeg?auto=compress&cs=tinysrgb&w=1260',
            'keuntungan'    => ['Kalori Seimbang', 'Menu Bervariasi', 'Jaga Berat Badan'],
            'deskripsi'     => 'Paket nutrisi seimbang untuk menjaga berat badan ideal.',
            'deskripsi_lengkap' => "<p class='mb-4'><strong>Paket Maintain</strong> dirancang untuk kamu yang sudah mencapai berat ideal. Fokus utama adalah keragaman mikronutrisi agar tubuh tetap fit.</p><ul class='list-disc pl-5 space-y-2 mb-4'><li><strong>Benefit:</strong> Karbohidrat kompleks seimbang, protein medium, sayuran berlimpah.</li><li><strong>Cocok untuk:</strong> Pekerja kantoran sibuk yang ingin Eat Clean praktis.</li></ul>",
        ]);

        // 3. BULKING (Gambar BARU: Dada Ayam Panggang Besar)
        PaketCategory::create([
            'nama_kategori' => 'Bulking',
            'slug'          => Str::slug('Bulking'),
            'label_paket'   => 'HIGH PROTEIN',
            'target_program'=> 'Naik Massa Otot (Hypertrophy)',
            'range_kalori'  => '2500 - 2800 kkal',
            'level_protein' => '150 - 180 gram',
            // FOTO DIGANTI DI SINI 👇
            'gambar_background' => 'https://images.pexels.com/photos/2338407/pexels-photo-2338407.jpeg?auto=compress&cs=tinysrgb&w=1260', 
            'keuntungan'    => ['Tinggi Protein', 'Porsi Besar', 'Tambah Massa Otot'],
            'deskripsi'     => 'Menu surplus kalori tinggi protein untuk pembentukan otot.',
            'deskripsi_lengkap' => "<p class='mb-4'><strong>Program Bulking</strong> menyediakan surplus kalori dari protein berkualitas tinggi untuk mendukung hipertrofi otot.</p><ul class='list-disc pl-5 space-y-2 mb-4'><li><strong>Benefit:</strong> Porsi Jumbo! Double protein (Dada Ayam/Sapi tanpa lemak).</li><li><strong>Syarat:</strong> WAJIB dibarengi latihan angkat beban rutin.</li></ul>",
        ]);
    }
}