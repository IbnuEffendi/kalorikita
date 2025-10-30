<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        $menus = [
            // 1
            [
                'nama_menu'   => 'Nasi Goreng Telur',
                'deskripsi'   => 'Nasi goreng simple dengan telur orak-arik, cocok untuk makan siang cepat.',
                'kategori'    => 'makan_siang',
                'tipe_makanan'=> 'non_vegan',
                'kalori'      => 520,
                'protein'     => 18,
                'karbohidrat' => 65,
                'lemak'       => 20,
                'gambar'      => 'https://images.pexels.com/photos/5864616/pexels-photo-5864616.jpeg?auto=compress&cs=tinysrgb&w=800',
            ],
            // 2
            [
                'nama_menu'   => 'Ayam Bakar Madu',
                'deskripsi'   => 'Ayam bakar manis gurih dengan olesan madu dan rempah.',
                'kategori'    => 'makan_malam',
                'tipe_makanan'=> 'non_vegan',
                'kalori'      => 480,
                'protein'     => 35,
                'karbohidrat' => 25,
                'lemak'       => 15,
                'gambar'      => 'https://images.pexels.com/photos/4106485/pexels-photo-4106485.jpeg?auto=compress&cs=tinysrgb&w=800',
            ],
            // 3
            [
                'nama_menu'   => 'Soto Ayam',
                'deskripsi'   => 'Kuah hangat dengan suwiran ayam dan sayuran, rendah lemak.',
                'kategori'    => 'makan_siang',
                'tipe_makanan'=> 'non_vegan',
                'kalori'      => 390,
                'protein'     => 28,
                'karbohidrat' => 20,
                'lemak'       => 9,
                'gambar'      => 'https://images.pexels.com/photos/6287528/pexels-photo-6287528.jpeg?auto=compress&cs=tinysrgb&w=800',
            ],
            // 4
            [
                'nama_menu'   => 'Nasi Uduk Komplit',
                'deskripsi'   => 'Nasi uduk gurih dengan lauk telur, tempe, dan sambal.',
                'kategori'    => 'sarapan',
                'tipe_makanan'=> 'non_vegan',
                'kalori'      => 560,
                'protein'     => 16,
                'karbohidrat' => 72,
                'lemak'       => 22,
                'gambar'      => 'https://images.pexels.com/photos/9096563/pexels-photo-9096563.jpeg?auto=compress&cs=tinysrgb&w=800',
            ],
            // 5
            [
                'nama_menu'   => 'Mie Goreng Sayur',
                'deskripsi'   => 'Mie goreng dengan tambahan sayur dan telur, cocok untuk malam.',
                'kategori'    => 'makan_malam',
                'tipe_makanan'=> 'non_vegan',
                'kalori'      => 500,
                'protein'     => 15,
                'karbohidrat' => 62,
                'lemak'       => 17,
                'gambar'      => 'https://images.pexels.com/photos/3298183/pexels-photo-3298183.jpeg?auto=compress&cs=tinysrgb&w=800',
            ],
            // 6
            [
                'nama_menu'   => 'Tumis Tahu Brokoli',
                'deskripsi'   => 'Tahu dan brokoli ditumis bawang putih, rendah kalori dan tinggi serat.',
                'kategori'    => 'makan_siang',
                'tipe_makanan'=> 'vegan',
                'kalori'      => 320,
                'protein'     => 14,
                'karbohidrat' => 24,
                'lemak'       => 11,
                'gambar'      => 'https://images.pexels.com/photos/884600/pexels-photo-884600.jpeg?auto=compress&cs=tinysrgb&w=800',
            ],
            // 7
            [
                'nama_menu'   => 'Nasi Merah Tempe Orek',
                'deskripsi'   => 'Pilihan menu vegan dengan tempe orek manis pedas dan nasi merah.',
                'kategori'    => 'makan_malam',
                'tipe_makanan'=> 'vegan',
                'kalori'      => 410,
                'protein'     => 16,
                'karbohidrat' => 56,
                'lemak'       => 9,
                'gambar'      => 'https://images.pexels.com/photos/6546025/pexels-photo-6546025.jpeg?auto=compress&cs=tinysrgb&w=800',
            ],
            // 8
            [
                'nama_menu'   => 'Salad Sayur Segar',
                'deskripsi'   => 'Salad kombinasi sayur hijau, tomat ceri, dan dressing ringan.',
                'kategori'    => 'snack',
                'tipe_makanan'=> 'vegan',
                'kalori'      => 180,
                'protein'     => 5,
                'karbohidrat' => 15,
                'lemak'       => 8,
                'gambar'      => 'https://images.pexels.com/photos/5938/food-salad-healthy-lunch.jpg?auto=compress&cs=tinysrgb&w=800',
            ],
            // 9
            [
                'nama_menu'   => 'Sup Jagung Sayur',
                'deskripsi'   => 'Sup hangat jagung dan sayur, cocok untuk menu diet.',
                'kategori'    => 'makan_siang',
                'tipe_makanan'=> 'vegan',
                'kalori'      => 220,
                'protein'     => 6,
                'karbohidrat' => 30,
                'lemak'       => 7,
                'gambar'      => 'https://images.pexels.com/photos/1267320/pexels-photo-1267320.jpeg?auto=compress&cs=tinysrgb&w=800',
            ],
            // 10
            [
                'nama_menu'   => 'Tempe Bacem',
                'deskripsi'   => 'Tempe dimasak manis gurih khas rumahan, cocok jadi lauk tambahan.',
                'kategori'    => 'snack',
                'tipe_makanan'=> 'vegan',
                'kalori'      => 160,
                'protein'     => 8,
                'karbohidrat' => 12,
                'lemak'       => 5,
                'gambar'      => 'https://images.pexels.com/photos/6546011/pexels-photo-6546011.jpeg?auto=compress&cs=tinysrgb&w=800',
            ],
            // 11
            [
                'nama_menu'   => 'Oatmeal Buah',
                'deskripsi'   => 'Oatmeal dengan topping buah segar, menu sarapan rendah lemak.',
                'kategori'    => 'sarapan',
                'tipe_makanan'=> 'vegan',
                'kalori'      => 260,
                'protein'     => 7,
                'karbohidrat' => 46,
                'lemak'       => 5,
                'gambar'      => 'https://images.pexels.com/photos/1640772/pexels-photo-1640772.jpeg?auto=compress&cs=tinysrgb&w=800',
            ],
            // 12
            [
                'nama_menu'   => 'Smoothie Pisang Kacang',
                'deskripsi'   => 'Minuman tinggi energi untuk sarapan cepat.',
                'kategori'    => 'snack',
                'tipe_makanan'=> 'vegan',
                'kalori'      => 250,
                'protein'     => 10,
                'karbohidrat' => 35,
                'lemak'       => 6,
                'gambar'      => 'https://images.pexels.com/photos/1337825/pexels-photo-1337825.jpeg?auto=compress&cs=tinysrgb&w=800',
            ],
            // 13
            [
                'nama_menu'   => 'Nasi Campur Bali',
                'deskripsi'   => 'Menu khas Bali dengan lauk lengkap dan sambal matah.',
                'kategori'    => 'makan_siang',
                'tipe_makanan'=> 'non_vegan',
                'kalori'      => 620,
                'protein'     => 24,
                'karbohidrat' => 74,
                'lemak'       => 24,
                'gambar'      => 'https://images.pexels.com/photos/6613073/pexels-photo-6613073.jpeg?auto=compress&cs=tinysrgb&w=800',
            ],
            // 14
            [
                'nama_menu'   => 'Ikan Bakar Sambal Matah',
                'deskripsi'   => 'Ikan bakar segar dengan sambal matah khas nusantara.',
                'kategori'    => 'makan_malam',
                'tipe_makanan'=> 'non_vegan',
                'kalori'      => 430,
                'protein'     => 36,
                'karbohidrat' => 14,
                'lemak'       => 13,
                'gambar'      => 'https://images.pexels.com/photos/4110007/pexels-photo-4110007.jpeg?auto=compress&cs=tinysrgb&w=800',
            ],
            // 15
            [
                'nama_menu'   => 'Capcay Sayur',
                'deskripsi'   => 'Capcay kuah dengan sayuran beragam, rendah kalori.',
                'kategori'    => 'makan_siang',
                'tipe_makanan'=> 'vegan',
                'kalori'      => 280,
                'protein'     => 8,
                'karbohidrat' => 22,
                'lemak'       => 10,
                'gambar'      => 'https://images.pexels.com/photos/3026808/pexels-photo-3026808.jpeg?auto=compress&cs=tinysrgb&w=800',
            ],
            // 16
            [
                'nama_menu'   => 'Gado-Gado',
                'deskripsi'   => 'Sayuran rebus dengan bumbu kacang, tinggi serat dan mengenyangkan.',
                'kategori'    => 'makan_siang',
                'tipe_makanan'=> 'vegan',
                'kalori'      => 360,
                'protein'     => 12,
                'karbohidrat' => 30,
                'lemak'       => 18,
                'gambar'      => 'https://images.pexels.com/photos/10875239/pexels-photo-10875239.jpeg?auto=compress&cs=tinysrgb&w=800',
            ],
            // 17
            [
                'nama_menu'   => 'Bubur Kacang Hijau',
                'deskripsi'   => 'Camilan hangat dengan santan, cocok sore hari.',
                'kategori'    => 'snack',
                'tipe_makanan'=> 'vegan',
                'kalori'      => 210,
                'protein'     => 7,
                'karbohidrat' => 34,
                'lemak'       => 4,
                'gambar'      => 'https://images.pexels.com/photos/5339077/pexels-photo-5339077.jpeg?auto=compress&cs=tinysrgb&w=800',
            ],
            // 18
            [
                'nama_menu'   => 'Nasi Kuning Spesial',
                'deskripsi'   => 'Nasi kuning gurih dengan lauk pilihan untuk sarapan.',
                'kategori'    => 'sarapan',
                'tipe_makanan'=> 'non_vegan',
                'kalori'      => 540,
                'protein'     => 16,
                'karbohidrat' => 70,
                'lemak'       => 20,
                'gambar'      => 'https://images.pexels.com/photos/8951492/pexels-photo-8951492.jpeg?auto=compress&cs=tinysrgb&w=800',
            ],
            // 19
            [
                'nama_menu'   => 'Nasi Putih Tahu Rica',
                'deskripsi'   => 'Tahu pedas rica dengan nasi putih hangat.',
                'kategori'    => 'makan_malam',
                'tipe_makanan'=> 'vegan',
                'kalori'      => 400,
                'protein'     => 15,
                'karbohidrat' => 58,
                'lemak'       => 8,
                'gambar'      => 'https://images.pexels.com/photos/6546024/pexels-photo-6546024.jpeg?auto=compress&cs=tinysrgb&w=800',
            ],
            // 20
            [
                'nama_menu'   => 'Opor Ayam',
                'deskripsi'   => 'Ayam bersantan dengan bumbu khas, cocok menu akhir pekan.',
                'kategori'    => 'makan_malam',
                'tipe_makanan'=> 'non_vegan',
                'kalori'      => 530,
                'protein'     => 29,
                'karbohidrat' => 22,
                'lemak'       => 28,
                'gambar'      => 'https://images.pexels.com/photos/7625056/pexels-photo-7625056.jpeg?auto=compress&cs=tinysrgb&w=800',
            ],
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }
}
