<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(UserSeeder::class);

        $now = date('Y-m-d H:i:s');

        if ($this->db->table('categories')->countAllResults() === 0) {
            $this->db->table('categories')->insertBatch([
                ['id' => 1, 'name' => 'Elektronik', 'slug' => 'elektronik', 'description' => 'Audio studio, perangkat input presisi, dan wearable kerja harian.', 'created_at' => $now, 'updated_at' => $now],
                ['id' => 2, 'name' => 'Fashion', 'slug' => 'fashion', 'description' => 'Alas kaki urban, jaket luar ruang, dan kemeja breathable.', 'created_at' => $now, 'updated_at' => $now],
                ['id' => 3, 'name' => 'Aksesoris', 'slug' => 'aksesoris', 'description' => 'Ransel komuter anti-air, dompet kulit, dan perlindungan mata.', 'created_at' => $now, 'updated_at' => $now],
                ['id' => 4, 'name' => 'Rumah Tangga', 'slug' => 'rumah-tangga', 'description' => 'Pencahayaan meja belajar dan perlengkapan seduh harian.', 'created_at' => $now, 'updated_at' => $now],
            ]);
        }

        if ($this->db->table('products')->countAllResults() === 0) {
            $products = [
                ['id' => 1,  'category_id' => 1, 'sku' => 'SE-EL-101', 'name' => 'Headphone Bluetooth Studio',    'slug' => 'headphone-bluetooth-studio',    'price' => 549000, 'original_price' => 699000, 'stock' => 18, 'status' => 'tersedia',       'short_desc' => 'Driver 40mm akurat dengan Active Noise Cancelling dan baterai 36 jam.',       'description' => 'Dirancang untuk fokus belajar dan panggilan kerja jernih dengan memory foam nyaman.', 'featured' => 1, 'image' => 'assets/images/products/headphone-bluetooth-studio.svg'],
                ['id' => 2,  'category_id' => 1, 'sku' => 'SE-EL-102', 'name' => 'Smartwatch FitPro AMOLED',      'slug' => 'smartwatch-fitpro-amoled',      'price' => 785000, 'original_price' => 920000, 'stock' => 4,  'status' => 'tersedia',       'short_desc' => 'Layar AMOLED 1.43 inci selalu aktif dengan pelacakan detak jantung dan GPS.',  'description' => 'Jam pintar ringan dengan bingkai aluminium matte, ketahanan air 5 ATM, dan baterai 12 hari.', 'featured' => 1, 'image' => 'assets/images/products/smartwatch-fitpro-amoled.svg'],
                ['id' => 3,  'category_id' => 1, 'sku' => 'SE-EL-103', 'name' => 'Keyboard Mekanikal Nirkabel',   'slug' => 'keyboard-mekanikal-nirkabel',   'price' => 695000, 'original_price' => 790000, 'stock' => 11, 'status' => 'tersedia',       'short_desc' => 'Tata letak ringkas 75% hot-swappable dengan switch tactile senyap.',           'description' => 'Tiga mode koneksi (USB-C, 2.4GHz, Bluetooth) dan keycaps PBT anti-kilap.', 'featured' => 0, 'image' => 'assets/images/products/keyboard-mekanikal-nirkabel.svg'],
                ['id' => 4,  'category_id' => 1, 'sku' => 'SE-EL-104', 'name' => 'Speaker Portabel Nordic',       'slug' => 'speaker-portabel-nordic',       'price' => 415000, 'original_price' => null,   'stock' => 9,  'status' => 'tersedia',       'short_desc' => 'Speaker meja berlapis kain tenun akustik dengan suara 360 derajat.',            'description' => 'Vokal jernih dan bass seimbang untuk ruang kerja atau kamar tidur.', 'featured' => 0, 'image' => 'assets/images/products/speaker-portabel-nordic.svg'],
                ['id' => 5,  'category_id' => 1, 'sku' => 'SE-EL-105', 'name' => 'Stand Laptop Aluminium Lipat',  'slug' => 'stand-laptop-aluminium-lipat',  'price' => 235000, 'original_price' => 280000, 'stock' => 2,  'status' => 'tersedia',       'short_desc' => 'Penyangga laptop ergonomis dengan 6 tingkat kemiringan.',                      'description' => 'Material aluminium anodisasi kokoh menahan laptop 11 hingga 16 inci.', 'featured' => 0, 'image' => 'assets/images/products/keyboard-mekanikal-nirkabel.svg'],
                ['id' => 6,  'category_id' => 2, 'sku' => 'SE-FS-201', 'name' => 'Sepatu Sneakers Urban',         'slug' => 'sepatu-sneakers-urban',         'price' => 429000, 'original_price' => 520000, 'stock' => 16, 'status' => 'tersedia',       'short_desc' => 'Sneakers berpotongan rendah dengan sol EVA responsif dan kanvas premium.',     'description' => 'Nyaman untuk mobilitas tinggi di kampus dengan insole ortopedi yang dapat dicuci.', 'featured' => 1, 'image' => 'assets/images/products/sepatu-sneakers-urban.svg'],
                ['id' => 7,  'category_id' => 2, 'sku' => 'SE-FS-202', 'name' => 'Jaket Windbreaker Pine',        'slug' => 'jaket-windbreaker-pine',        'price' => 365000, 'original_price' => 430000, 'stock' => 3,  'status' => 'tersedia',       'short_desc' => 'Jaket tahan angin dan gerimis berbahan nilon ripstop ringan.',                 'description' => 'Ritsleting tahan air, ventilasi punggung, dan kantong lipat ringkas.', 'featured' => 0, 'image' => 'assets/images/products/jaket-windbreaker-pine.svg'],
                ['id' => 8,  'category_id' => 2, 'sku' => 'SE-FS-203', 'name' => 'Kemeja Linen Harian',           'slug' => 'kemeja-linen-harian',           'price' => 249000, 'original_price' => null,   'stock' => 21, 'status' => 'tersedia',       'short_desc' => 'Campuran katun-linen sejuk dengan potongan santai yang tetap rapi.',           'description' => 'Sirkulasi udara optimal untuk iklim tropis sepanjang hari.', 'featured' => 0, 'image' => 'assets/images/products/kemeja-linen-harian.svg'],
                ['id' => 9,  'category_id' => 2, 'sku' => 'SE-FS-204', 'name' => 'Kaos Polo Pique Katun',         'slug' => 'kaos-polo-pique-katun',         'price' => 195000, 'original_price' => null,   'stock' => 15, 'status' => 'tersedia',       'short_desc' => 'Kaos berkerah bahan katun pique 200gsm yang lembut dan menyerap keringat.',    'description' => 'Cocok untuk kegiatan kuliah maupun acara semi-formal.', 'featured' => 0, 'image' => 'assets/images/products/kemeja-linen-harian.svg'],
                ['id' => 10, 'category_id' => 3, 'sku' => 'SE-AK-301', 'name' => 'Tas Ransel Commuter 22L',       'slug' => 'tas-ransel-commuter',           'price' => 389000, 'original_price' => 450000, 'stock' => 14, 'status' => 'tersedia',       'short_desc' => 'Kompartemen laptop 16 inci berlapis busa dengan tali dada ergonomis.',         'description' => 'Kapasitas 22L berbahan Cordura 600D tahan cipratan air.', 'featured' => 1, 'image' => 'assets/images/products/tas-ransel-commuter.svg'],
                ['id' => 11, 'category_id' => 3, 'sku' => 'SE-AK-302', 'name' => 'Dompet Kulit Minimalis',        'slug' => 'dompet-kulit-minimalis',        'price' => 185000, 'original_price' => null,   'stock' => 25, 'status' => 'tersedia',       'short_desc' => 'Profil tipis 6 slot kartu dengan pelindung pemindaian RFID.',                  'description' => 'Kulit sapi full-grain bertekstur halus.', 'featured' => 0, 'image' => 'assets/images/products/dompet-kulit-minimalis.svg'],
                ['id' => 12, 'category_id' => 3, 'sku' => 'SE-AK-303', 'name' => 'Kacamata Antiradiasi Layar',    'slug' => 'kacamata-antiradiasi',          'price' => 215000, 'original_price' => 260000, 'stock' => 0,  'status' => 'tidak_tersedia', 'short_desc' => 'Frame TR90 lentur dengan lensa penyaring cahaya biru 40%.',                    'description' => 'Mengurangi ketegangan mata saat bekerja di depan monitor.', 'featured' => 0, 'image' => 'assets/images/products/kacamata-antiradiasi.svg'],
                ['id' => 13, 'category_id' => 4, 'sku' => 'SE-RT-401', 'name' => 'Lampu Meja Minimalis LED',      'slug' => 'lampu-meja-minimalis',          'price' => 275000, 'original_price' => 330000, 'stock' => 12, 'status' => 'tersedia',       'short_desc' => 'Tiga suhu warna dengan kontrol sentuh bebas kedip (CRI >= 92).',               'description' => 'Leher lampu aluminium lipat 180 derajat bertenaga USB-C.', 'featured' => 0, 'image' => 'assets/images/products/lampu-meja-minimalis.svg'],
                ['id' => 14, 'category_id' => 4, 'sku' => 'SE-RT-402', 'name' => 'Teko Leher Angsa Termometer',   'slug' => 'teko-leher-angsa',              'price' => 310000, 'original_price' => null,   'stock' => 7,  'status' => 'tersedia',       'short_desc' => 'Kapasitas 800ml baja tahan karat 304 dengan aliran tuang presisi.',            'description' => 'Kompatibel dengan kompor gas, listrik, maupun induksi.', 'featured' => 0, 'image' => 'assets/images/products/teko-leher-angsa.svg'],
                ['id' => 15, 'category_id' => 4, 'sku' => 'SE-RT-403', 'name' => 'Tumbler Termos 750ml',          'slug' => 'tumbler-termos-750ml',          'price' => 165000, 'original_price' => 195000, 'stock' => 0,  'status' => 'tidak_tersedia', 'short_desc' => 'Insulasi vakum dua dinding menjaga minuman dingin hingga 18 jam.',             'description' => 'Tutup anti-bocor dengan pegangan jinjing terintegrasi.', 'featured' => 0, 'image' => 'assets/images/products/teko-leher-angsa.svg'],
            ];

            $prodRows = [];
            $imgRows  = [];
            foreach ($products as $p) {
                $img = $p['image'];
                unset($p['image']);
                $p['created_at'] = $now;
                $p['updated_at'] = $now;
                $prodRows[] = $p;

                $imgRows[] = [
                    'product_id' => $p['id'],
                    'image_path' => $img,
                    'is_primary' => 1,
                    'sort_order' => 1,
                    'created_at' => $now,
                ];
            }

            $this->db->table('products')->insertBatch($prodRows);
            $this->db->table('product_images')->insertBatch($imgRows);
        }
    }
}
