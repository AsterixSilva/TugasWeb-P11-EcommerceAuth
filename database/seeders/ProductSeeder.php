<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            ['name' => 'Admin', 'password' => bcrypt('password123')]
        );

        // 0. Bersihkan sisa factory acak yang tidak terpakai (0 produk)
        Category::doesntHave('products')->whereNotIn('slug', ['elektronik', 'fashion', 'makanan-minuman', 'rumah-tangga', 'olahraga'])->delete();
        Tag::doesntHave('products')->whereNotIn('slug', ['baru', 'promo', 'best-seller', 'premium', 'murah', 'original', 'limited', 'terlaris', 'diskon', 'impor'])->delete();

        // 1. Kategori pasti — pembeda utama (5 kategori)
        $kategori = [
            ['name' => 'Elektronik', 'slug' => 'elektronik', 'description' => 'Gadget, laptop, aksesoris elektronik.'],
            ['name' => 'Fashion', 'slug' => 'fashion', 'description' => 'Pakaian, sepatu, tas, aksesoris fashion.'],
            ['name' => 'Makanan & Minuman', 'slug' => 'makanan-minuman', 'description' => 'Snack, kopi, makanan kemasan.'],
            ['name' => 'Rumah Tangga', 'slug' => 'rumah-tangga', 'description' => 'Perabot dan kebutuhan rumah.'],
            ['name' => 'Olahraga', 'slug' => 'olahraga', 'description' => 'Peralatan fitness, lari, badminton.'],
        ];

        $categoryIds = [];
        foreach ($kategori as $k) {
            $cat = Category::updateOrCreate(['slug' => $k['slug']], $k);
            $categoryIds[$k['slug']] = $cat->id;
        }

        // 2. Tag pasti — pembeda tambahan
        $daftarTag = ['Baru', 'Promo', 'Best Seller', 'Premium', 'Murah', 'Original', 'Limited', 'Terlaris', 'Diskon', 'Impor'];
        $tagIds = [];
        foreach ($daftarTag as $namaTag) {
            $tag = Tag::updateOrCreate(
                ['slug' => Str::slug($namaTag)],
                ['name' => $namaTag]
            );
            $tagIds[$namaTag] = $tag->id;
        }

        // 3. 50 produk dengan pembeda jelas:
        // [kategori_slug, nama, deskripsi, harga, stok, tags]
        $produk = [
            // --- ELEKTRONIK (10) : harga 299rb - 7,5jt ---
            ['elektronik', 'Laptop ASUS Vivobook 14 Core i5 8/512GB', 'Laptop harian kuliah/kerja, layar 14 inch FHD, RAM 8GB SSD 512GB.', 7500000, 15, ['Premium', 'Original']],
            ['elektronik', 'Smartphone Samsung Galaxy A54 8/128GB', 'HP 5G kamera 50MP OIS, layar Super AMOLED 120Hz, baterai 5000mAh.', 5999000, 25, ['Premium', 'Baru']],
            ['elektronik', 'TWS Xiaomi Redmi Buds 4 Lite', 'Earphone bluetooth murah, baterai 20 jam, cocok buat online meeting.', 299000, 100, ['Promo', 'Best Seller']],
            ['elektronik', 'Smartwatch Amazfit GTS 4 Mini', 'Jam pintar GPS, AMOLED, baterai 15 hari, 120+ mode olahraga.', 1299000, 30, ['Baru', 'Original']],
            ['elektronik', 'Keyboard Mechanical Rexus Daxa M71', 'Keyboard gaming 65% hot-swap, RGB, switch linear, koneksi 3 mode.', 899000, 0, ['Limited', 'Impor']],
            ['elektronik', 'Mouse Logitech G304 Wireless Gaming', 'Mouse gaming wireless HERO sensor, baterai 250 jam, ringan 99g.', 449000, 50, ['Best Seller', 'Terlaris']],
            ['elektronik', 'Monitor LG 24 inch Full HD IPS 100Hz', 'Monitor IPS bezel tipis, eye-care flicker free, HDMI+VGA.', 1899000, 12, ['Premium', 'Diskon']],
            ['elektronik', 'Charger Anker 65W GaN Fast Charging', 'Charger 2 port USB-C super cepat buat laptop + HP sekaligus.', 599000, 3, ['Original', 'Limited']],
            ['elektronik', 'Speaker Bluetooth JBL Flip 6 Waterproof', 'Speaker portable anti air IP67, bass kencang, baterai 12 jam.', 1999000, 20, ['Premium', 'Impor']],
            ['elektronik', 'Powerbank Xiaomi 20000mAh 18W', 'Powerbank jumbo 2 output, fast charging 18W, indikator LED.', 349000, 80, ['Murah', 'Terlaris']],

            // --- FASHION (10) : harga 49rb - 1,15jt ---
            ['fashion', 'Kaos Polos Cotton Combed 30s Hitam', 'Kaos polos adem, sablonable, size S-XXL, jahitan rapi.', 59000, 200, ['Murah', 'Best Seller']],
            ['fashion', 'Kemeja Flanel Pria Lengan Panjang', 'Kemeja flanel kotak-kotak, bahan tebal hangat, buat harian.', 149000, 75, ['Baru', 'Promo']],
            ['fashion', 'Hoodie Fleece Unisex Abu Misty', 'Hoodie fleece tebal hangat, saku kanguru, unisex cowok cewek.', 179000, 60, ['Terlaris', 'Diskon']],
            ['fashion', 'Celana Jeans Slim Fit Pria Biru', 'Jeans stretch slim fit, tidak mudah melar, size 27-34.', 199000, 40, ['Original', 'Baru']],
            ['fashion', 'Sepatu Sneakers Putih Casual', 'Sneakers putih gampang mix and match, sol anti slip ringan.', 299000, 35, ['Best Seller', 'Baru']],
            ['fashion', 'Tas Ransel Laptop Anti Air 30L', 'Ransel muat laptop 15.6 inch, USB port, bahan water resistant.', 249000, 0, ['Limited', 'Diskon']],
            ['fashion', 'Topi Baseball Cap Hitam Polos', 'Topi snapback adjustable, bahan twill premium, unisex.', 49000, 150, ['Murah', 'Promo']],
            ['fashion', 'Jam Tangan Casio Vintage Gold', 'Jam retro gold original, water resist, garansi resmi 1 tahun.', 1150000, 10, ['Premium', 'Original']],
            ['fashion', 'Dompet Kulit Pria Slim Card Holder', 'Dompet kulit sintetis slim, muat 8 kartu + uang lipat.', 89000, 90, ['Murah', 'Terlaris']],
            ['fashion', 'Kacamata Hitam Polarized UV400', 'Kacamata polarized anti silau buat motor/mobil, free pouch.', 129000, 4, ['Promo', 'Limited']],

            // --- MAKANAN & MINUMAN (10) : harga 15rb - 185rb ---
            ['makanan-minuman', 'Kopi Susu Gula Aren 1 Liter', 'Kopi susu kekinian manis pas, tahan 3 hari di kulkas.', 45000, 50, ['Best Seller', 'Baru']],
            ['makanan-minuman', 'Basreng Pedas Daun Jeruk 250g', 'Basreng renyah pedas nampol, cemilan wajib anak kos.', 25000, 120, ['Murah', 'Terlaris']],
            ['makanan-minuman', 'Seblak Instan Komplit Level 3', 'Seblak instan isi kerupuk + makaroni + bumbu pedas level 3.', 15000, 200, ['Murah', 'Promo']],
            ['makanan-minuman', 'Rendang Sapi Kemasan 500g Asli Padang', 'Rendang sapi empuk bumbu medok, tinggal panasin, awet.', 120000, 30, ['Original', 'Premium']],
            ['makanan-minuman', 'Madu Hutan Sumbawa Murni 500ml', 'Madu hutan asli tanpa campuran, kental, uji bakar tisu.', 185000, 25, ['Premium', 'Original']],
            ['makanan-minuman', 'Keripik Pisang Coklat Lumer 200g', 'Keripik pisang tipis renyah dilapis coklat lumer manis.', 22000, 0, ['Limited', 'Murah']],
            ['makanan-minuman', 'Susu Almond Unsweetened 1L', 'Susu almond tanpa gula, rendah kalori, cocok buat diet.', 55000, 60, ['Baru', 'Diskon']],
            ['makanan-minuman', 'Coklat Silverqueen Chunky Bar 100g', 'Coklat kacang mede chunky, favorit sejuta umat.', 28000, 110, ['Terlaris', 'Promo']],
            ['makanan-minuman', 'Teh Botol Kotak 450ml Dus isi 24', 'Teh manis kemasan dus hemat buat acara hajatan/kantin.', 95000, 45, ['Best Seller', 'Diskon']],
            ['makanan-minuman', 'Mie Pedas Level 4 Frozen Pack', 'Mie frozen pedas gurih isi 5 pack, tinggal rebus 3 menit.', 35000, 2, ['Limited', 'Baru']],

            // --- RUMAH TANGGA (10) : harga 39rb - 429rb ---
            ['rumah-tangga', 'Sapu Lidi + Pengki Set Gagang Panjang', 'Set sapu + pengki gagang panjang, tidak perlu bungkuk.', 39000, 70, ['Murah', 'Terlaris']],
            ['rumah-tangga', 'Ember Mandi 30L + Gayung Plastik', 'Ember jumbo tebal anti pecah + gayung gagang nyaman.', 55000, 55, ['Murah', 'Best Seller']],
            ['rumah-tangga', 'Lampu LED Philips 12 Watt isi 4', 'Lampu hemat listrik terang 1100 lumen, garansi 1 tahun.', 110000, 90, ['Promo', 'Original']],
            ['rumah-tangga', 'Kipas Angin Cosmos 16 inch Standing', 'Kipas berdiri 3 kecepatan, angin kencang tapi hemat daya.', 429000, 18, ['Original', 'Diskon']],
            ['rumah-tangga', 'Rice Cooker Miyako 1.8L MCM-508', 'Magic com anti lengket, masak nasi pulen + penghangat.', 385000, 22, ['Best Seller', 'Original']],
            ['rumah-tangga', 'Set Pisau Dapur Stainless 6 pcs + Talenan', 'Pisau set tajam anti karat + talenan kayu + pengasah.', 159000, 0, ['Limited', 'Promo']],
            ['rumah-tangga', 'Sprei Katun King 180x200 Motif Minimalis', 'Sprei katun adem tidak panas, +2 sarung bantal guling.', 189000, 33, ['Baru', 'Diskon']],
            ['rumah-tangga', 'Gorden Blackout Anti Tembus Cahaya', 'Gorden blackout 135x200, kamar gelap siang hari, free hook.', 99000, 48, ['Promo', 'Baru']],
            ['rumah-tangga', 'Vacuum Cleaner Mini Portable USB', 'Vacuum mini buat mobil/meja/kasur, sedot debu + remah.', 149000, 5, ['Baru', 'Limited']],
            ['rumah-tangga', 'Rak Sepatu Susun 5 Tingkat Portable', 'Rak sepatu bongkar pasang, muat 15 pasang, hemat tempat kos.', 119000, 27, ['Diskon', 'Terlaris']],

            // --- OLAHRAGA (10) : harga 45rb - 499rb ---
            ['olahraga', 'Matras Yoga Anti Slip 6mm + Tas', 'Matras yoga tebal 6mm tidak sakit lutut, free tas jaring.', 135000, 42, ['Baru', 'Original']],
            ['olahraga', 'Dumbbell Vinyl 5kg Sepasang', 'Dumbbell 5kg x2 lapis vinyl, tidak merusak lantai.', 210000, 28, ['Original', 'Best Seller']],
            ['olahraga', 'Sepatu Lari Ortus Hyperglide Merah', 'Sepatu lari lokal ringan breathable, sol empuk buat daily run.', 499000, 16, ['Premium', 'Original']],
            ['olahraga', 'Jersey Badminton Dryfit Printing', 'Jersey dryfit adem nyerap keringat, sablon fullprint custom nama.', 85000, 65, ['Murah', 'Terlaris']],
            ['olahraga', 'Raket Badminton + Senar + Tas', 'Raket ringan 82g tarikan 30lbs, sudah disenar + tas + grip.', 325000, 0, ['Limited', 'Premium']],
            ['olahraga', 'Bola Sepak Original Ukuran 5', 'Bola kaki jahit mesin awet, cocok lapangan rumput/semen.', 175000, 38, ['Original', 'Best Seller']],
            ['olahraga', 'Skipping Jump Rope Speed Cable', 'Lompat tali kabel baja + bearing cepat, gagang busa anti slip.', 45000, 95, ['Murah', 'Promo']],
            ['olahraga', 'Sarung Tangan Gym Full + Wrist Wrap', 'Glove gym anti kapalan + wrist support, velcro kuat.', 75000, 6, ['Baru', 'Limited']],
            ['olahraga', 'Botol Minum Sport 1L Anti Tumpah', 'Botol 1 liter BPA free, sedotan + tali, tidak bocor dibawa lari.', 65000, 110, ['Murah', 'Terlaris']],
            ['olahraga', 'Resistance Band Set 5 in 1 Latex', 'Karet latihan 5 level resistance, buat home workout + yoga.', 99000, 58, ['Promo', 'Best Seller']],
        ];

        foreach ($produk as $row) {
            [$catSlug, $nama, $deskripsi, $harga, $stok, $tags] = $row;

            $product = Product::updateOrCreate(
                ['slug' => Str::slug($nama)],
                [
                    'category_id' => $categoryIds[$catSlug],
                    'user_id' => $user->id,
                    'name' => $nama,
                    'description' => $deskripsi,
                    'price' => $harga,
                    'stock' => $stok,
                ]
            );

            $ids = collect($tags)->map(fn ($t) => $tagIds[$t])->toArray();
            $product->tags()->sync($ids);
        }
    }
}
