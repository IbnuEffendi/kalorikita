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
                'gambar'      => 'https://images.pexels.com/photos/32938733/pexels-photo-32938733.jpeg',
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
                'gambar'      => 'https://asset.kompas.com/crops/N8WTCiVClutwEkjIgCykYbt1e2Q=/142x72:863x553/1200x800/data/photo/2022/09/27/633297e88244b.jpg',
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
                'gambar'      => 'https://healthybelly.s3.amazonaws.com/product/media_1738841131_0.webp',
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
                'gambar'      => 'https://images.pexels.com/photos/5963873/pexels-photo-5963873.jpeg',
            ],
            // 5
            [
                'nama_menu'   => 'Power Beef Bowl',
                'deskripsi' => 'Nasi merah, daging sapi tumis lada hitam, telur rebus, dan brokoli. Tinggi protein untuk otot.',
                'kategori' => 'makan_siang',
                'tipe_makanan' => 'non_vegan',
                'kalori' => 650,
                'protein' => 45,
                'karbohidrat' => 60,
                'lemak' => 20,
                'gambar' => 'https://wearefeels.com/wp-content/uploads/2024/08/Beef-power-bowl.webp',
            ],
            // 6
            [
                'nama_menu' => 'Salad Wrap Ayam Panggang',
                'deskripsi' => 'Tortilla gandum isi dada ayam panggang, selada segar, dan dressing rendah lemak.',
                'kategori' => 'makan_siang',
                'tipe_makanan' => 'non_vegan',
                'kalori' => 320,
                'protein' => 25,
                'karbohidrat' => 30,
                'lemak' => 8,
                'gambar' => 'https://img.freepik.com/foto-premium/wrap-ayam-panggang-tertutup-di-latar-belakang-putih-wrap-tortilla-dengan-ayam-sayuran-dan-salad_817921-53360.jpg',
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
                'gambar'      => 'https://img-global.cpcdn.com/recipes/ed3a06fff363946b/1200x630cq80/photo.jpg',
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
                'gambar'      => 'https://asset.kompas.com/crops/vbUoFm_zyz80BXnD1eVXy2j_Nl8=/0x0:780x390/750x500/data/photo/2013/03/18/0936436-salad-sayuran-780x390.jpg',
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
                'gambar'      => 'https://akcdn.detik.net.id/visual/2020/01/12/c3396348-c3c9-4ea2-a074-487916a21c6f_43.jpeg?w=720&q=90',
            ],
            // 10
            [
                'nama_menu' => 'Peanut Butter Banana Toast',
                'deskripsi' => 'Roti gandum bakar dengan selai kacang alami dan potongan pisang.',
                'kategori' => 'snack',
                'tipe_makanan' => 'vegan',
                'kalori' => 450,
                'protein' => 15,
                'karbohidrat' => 55,
                'lemak' => 18,
                'gambar'      => 'https://www.aheadofthyme.com/wp-content/uploads/2018/02/peanut-butter-banana-toast.jpg',
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
                'gambar'      => 'https://images.pexels.com/photos/9027530/pexels-photo-9027530.jpeg',
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
                'gambar'      => 'https://www.darngoodveggies.com/wp-content/uploads/2021/08/Banana-Smoothie-Bowl-5-scaled.jpg',
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
                'gambar'      => 'https://img-global.cpcdn.com/recipes/bbdc38a8c3206126/680x781f0.5_0.552021_1.0q80/nasi-campur-bali-foto-resep-utama.jpg',
            ],
            // 14
            [
                'nama_menu'   => 'Ayam Teriyaki Panggang',
                'deskripsi'   => 'Dada ayam dipanggang dengan saus teriyaki homemade, disajikan dengan sayuran kukus.',
                'kategori'    => 'makan_malam',
                'tipe_makanan'=> 'non_vegan',
                'kalori'      => 350,
                'protein'     => 32,
                'karbohidrat' => 20,
                'lemak'       => 10,
                'gambar'      => 'https://asset.kompas.com/crops/-b8jj61ACSloKe1JGBgAGrgXDdU=/3x0:700x465/1200x800/data/photo/2020/12/17/5fdacb3363f6a.jpg',
            ],
            // 15
            [
                'nama_menu' => 'Pecel Madiun Komplit',
                'deskripsi' => 'Aneka sayuran rebus dengan bumbu kacang, tahu, tempe, dan nasi merah.',
                'kategori' => 'makan_siang',
                'tipe_makanan' => 'vegan',
                'kalori' => 520,
                'protein' => 20,
                'karbohidrat' => 60,
                'lemak' => 22,
                'gambar'      => 'https://d1vbn70lmn1nqe.cloudfront.net/prod/wp-content/uploads/2023/07/28023918/Ini-Cara-Membuat-Nasi-Pecel-Madiun-yang-Menggugah-Selera-.jpg.webp',
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
                'gambar'      => 'https://images.pexels.com/photos/31336118/pexels-photo-31336118.jpeg',
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
                'gambar'      => 'https://allofresh.id/blog/wp-content/uploads/2023/07/cara-membuat-bubur-kacang-hijau-2-2.jpg',
            ],
            // 18
            [
                'nama_menu' => 'Nasi Tim Ayam Merah',
                'deskripsi' => 'Nasi tim beras merah lembut dengan topping tumis dada ayam jamur kecap dan kuah kaldu bening.',
                'kategori' => 'sarapan',
                'tipe_makanan' => 'non_vegan',
                'kalori' => 380,
                'protein' => 26,
                'karbohidrat' => 45,
                'lemak' => 10,
                'gambar'      => 'https://cdn.grid.id/crop/0x0:0x0/filters:format(webp):quality(100)/photo/2023/06/19/resep-nasi-merah-tim-ayam-sayur-20230619043905.jpg',
            ],
            // 19
            [
                'nama_menu'   => 'Stir Fry Tofu & Sayur Hijau',
                'deskripsi'   => 'Tahu tinggi protein ditumis dengan brokoli, buncis, dan bayam menggunakan sedikit minyak zaitun. Rasanya ringan, sehat, dan cocok untuk makan malam.',
                'kategori'    => 'makan_malam',
                'tipe_makanan'=> 'vegan',
                'kalori'      => 210,
                'protein'     => 14,
                'karbohidrat' => 16,
                'lemak'       => 8,
                'gambar'      => 'https://www.bakedbymelissa.com/cdn/shop/articles/20250505061954-8_d0cff26f-fc3c-43f4-ac25-9195d318734e.png?v=1746725892',
            ],
            // 20
            [
                'nama_menu' => 'Sup Ayam Jahe & Sayur',
                'deskripsi' => 'Sup bening ayam kampung dengan wortel, buncis, dan aroma jahe hangat.',
                'kategori' => 'makan_malam',
                'tipe_makanan' => 'non_vegan',
                'kalori' => 250,
                'protein' => 22,
                'karbohidrat' => 15,
                'lemak' => 8,
                'gambar'      => 'https://www.dapurkobe.co.id/wp-content/uploads/sop-ayam-bening-jahe.jpg',
            ],
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }
}
