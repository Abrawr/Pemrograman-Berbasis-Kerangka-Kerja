<?php

namespace App\Libraries;

class CatalogData
{
    public static function categories(): array
    {
        return [
            [
                'id'          => 1,
                'name'        => 'Elektronik',
                'slug'        => 'elektronik',
                'description' => 'Audio studio, perangkat input presisi, dan wearable kerja harian.',
                'count'       => 4,
            ],
            [
                'id'          => 2,
                'name'        => 'Fashion',
                'slug'        => 'fashion',
                'description' => 'Alas kaki urban, jaket luar ruang, dan kemeja breathable.',
                'count'       => 3,
            ],
            [
                'id'          => 3,
                'name'        => 'Aksesoris',
                'slug'        => 'aksesoris',
                'description' => 'Ransel komuter anti-air, dompet kulit, dan perlindungan mata.',
                'count'       => 3,
            ],
            [
                'id'          => 4,
                'name'        => 'Rumah Tangga',
                'slug'        => 'rumah-tangga',
                'description' => 'Pencahayaan meja belajar dan perlengkapan seduh harian.',
                'count'       => 2,
            ],
        ];
    }

    public static function products(): array
    {
        return [
            [
                'id'             => 1,
                'sku'            => 'SE-EL-101',
                'name'           => 'Headphone Bluetooth Studio',
                'slug'           => 'headphone-bluetooth-studio',
                'category_slug'  => 'elektronik',
                'category_name'  => 'Elektronik',
                'price'          => 549000,
                'original_price' => 699000,
                'stock'          => 18,
                'rating'         => 4.9,
                'featured'       => true,
                'image'          => 'assets/images/products/headphone-bluetooth-studio.svg',
                'short_desc'     => 'Driver 40mm akurat dengan Active Noise Cancelling dan baterai 36 jam.',
                'description'    => 'Dirancang untuk fokus belajar dan panggilan kerja jernih. Bantalan telinga memory foam nyaman dipakai berjam-jam dengan pengisian cepat USB-C.',
                'specs'          => ['Koneksi' => 'Bluetooth 5.3 + Kabel AUX 3.5mm', 'Daya Tahan' => '36 Jam Pemutaran', 'Berat' => '245 gram'],
            ],
            [
                'id'             => 2,
                'sku'            => 'SE-EL-102',
                'name'           => 'Smartwatch FitPro AMOLED',
                'slug'           => 'smartwatch-fitpro-amoled',
                'category_slug'  => 'elektronik',
                'category_name'  => 'Elektronik',
                'price'          => 785000,
                'original_price' => 920000,
                'stock'          => 4,
                'rating'         => 4.8,
                'featured'       => true,
                'image'          => 'assets/images/products/smartwatch-fitpro-amoled.svg',
                'short_desc'     => 'Layar AMOLED 1.43 inci selalu aktif dengan pelacakan detak jantung dan GPS.',
                'description'    => 'Jam pintar ringan dengan bingkai aluminium matte, ketahanan air 5 ATM, serta sinkronisasi jadwal dan notifikasi instan.',
                'specs'          => ['Layar' => '1.43" AMOLED 60Hz', 'Ketahanan Air' => '5 ATM', 'Baterai' => 'Hingga 12 Hari'],
            ],
            [
                'id'             => 3,
                'sku'            => 'SE-EL-103',
                'name'           => 'Keyboard Mekanikal Nirkabel',
                'slug'           => 'keyboard-mekanikal-nirkabel',
                'category_slug'  => 'elektronik',
                'category_name'  => 'Elektronik',
                'price'          => 695000,
                'original_price' => 790000,
                'stock'          => 11,
                'rating'         => 4.9,
                'featured'       => false,
                'image'          => 'assets/images/products/keyboard-mekanikal-nirkabel.svg',
                'short_desc'     => 'Tata letak ringkas 75% hot-swappable dengan switch tactile senyap.',
                'description'    => 'Keyboard produktivitas dengan tiga mode koneksi (USB-C, 2.4GHz, dan Bluetooth multi-perangkat) serta keycaps PBT anti-kilap.',
                'specs'          => ['Layout' => '84 Tombol (75%)', 'Switch' => 'Tactile Silent Factory-Lubed', 'Kompatibilitas' => 'Windows, macOS, Linux'],
            ],
            [
                'id'             => 4,
                'sku'            => 'SE-EL-104',
                'name'           => 'Speaker Portabel Nordic',
                'slug'           => 'speaker-portabel-nordic',
                'category_slug'  => 'elektronik',
                'category_name'  => 'Elektronik',
                'price'          => 415000,
                'original_price' => null,
                'stock'          => 9,
                'rating'         => 4.7,
                'featured'       => false,
                'image'          => 'assets/images/products/speaker-portabel-nordic.svg',
                'short_desc'     => 'Speaker meja berlapis kain tenun akustik dengan suara 360 derajat.',
                'description'    => 'Menghasilkan vokal jernih dan bass seimbang untuk ruang kerja atau kamar tidur tanpa distorsi pada volume tinggi.',
                'specs'          => ['Output' => '15W RMS Dual Passive Radiator', 'Port' => 'USB-C Fast Charge', 'Bobot' => '490 gram'],
            ],
            [
                'id'             => 5,
                'sku'            => 'SE-FS-201',
                'name'           => 'Sepatu Sneakers Urban',
                'slug'           => 'sepatu-sneakers-urban',
                'category_slug'  => 'fashion',
                'category_name'  => 'Fashion',
                'price'          => 429000,
                'original_price' => 520000,
                'stock'          => 16,
                'rating'         => 4.9,
                'featured'       => true,
                'image'          => 'assets/images/products/sepatu-sneakers-urban.svg',
                'short_desc'     => 'Sneakers berpotongan rendah dengan sol EVA responsif dan kanvas premium.',
                'description'    => 'Nyaman untuk mobilitas tinggi di kampus maupun perjalanan harian. Dilengkapi insole ortopedi yang dapat dilepas dan dicuci.',
                'specs'          => ['Upper' => 'Kanvas Organik 12oz + Suede Trim', 'Sol' => 'Dual-Density EVA + Karet Anti-Selip', 'Ukuran' => '39 – 44 EU'],
            ],
            [
                'id'             => 6,
                'sku'            => 'SE-FS-202',
                'name'           => 'Jaket Windbreaker Pine',
                'slug'           => 'jaket-windbreaker-pine',
                'category_slug'  => 'fashion',
                'category_name'  => 'Fashion',
                'price'          => 365000,
                'original_price' => 430000,
                'stock'          => 3,
                'rating'         => 4.8,
                'featured'       => false,
                'image'          => 'assets/images/products/jaket-windbreaker-pine.svg',
                'short_desc'     => 'Jaket tahan angin dan gerimis berbahan nilon ripstop ringan.',
                'description'    => 'Dilengkapi ritsleting tahan air, ventilasi punggung tersembunyi, dan kantong lipat sehingga mudah dibawa dalam tas.',
                'specs'          => ['Material' => 'Nylon Ripstop Water-Repellent', 'Saku' => '3 Saku Beritsleting', 'Ukuran' => 'S, M, L, XL'],
            ],
            [
                'id'             => 7,
                'sku'            => 'SE-FS-203',
                'name'           => 'Kemeja Linen Harian',
                'slug'           => 'kemeja-linen-harian',
                'category_slug'  => 'fashion',
                'category_name'  => 'Fashion',
                'price'          => 249000,
                'original_price' => null,
                'stock'          => 21,
                'rating'         => 4.7,
                'featured'       => false,
                'image'          => 'assets/images/products/kemeja-linen-harian.svg',
                'short_desc'     => 'Campuran katun-linen sejuk dengan potongan santai yang tetap rapi.',
                'description'    => 'Cocok untuk iklim tropis, mudah disetrika, dan memiliki sirkulasi udara optimal sepanjang hari.',
                'specs'          => ['Bahan' => '55% Linen, 45% Katun Sisir', 'Potongan' => 'Relaxed Regular Fit', 'Perawatan' => 'Cuci Mesin Dingin'],
            ],
            [
                'id'             => 8,
                'sku'            => 'SE-AK-301',
                'name'           => 'Tas Ransel Commuter 22L',
                'slug'           => 'tas-ransel-commuter',
                'category_slug'  => 'aksesoris',
                'category_name'  => 'Aksesoris',
                'price'          => 389000,
                'original_price' => 450000,
                'stock'          => 14,
                'rating'         => 4.9,
                'featured'       => true,
                'image'          => 'assets/images/products/tas-ransel-commuter.svg',
                'short_desc'     => 'Kompartemen laptop 16 inci berlapis busa dengan tali dada ergonomis.',
                'description'    => 'Dirancang rapi untuk membawa laptop, charger, botol minum, dan dokumen kuliah tanpa terasa berat di bahu.',
                'specs'          => ['Kapasitas' => '22 Liter', 'Slot Laptop' => 'Hingga 16 Inci', 'Lapisan' => 'Polyester Cordura 600D'],
            ],
            [
                'id'             => 9,
                'sku'            => 'SE-AK-302',
                'name'           => 'Dompet Kulit Minimalis',
                'slug'           => 'dompet-kulit-minimalis',
                'category_slug'  => 'aksesoris',
                'category_name'  => 'Aksesoris',
                'price'          => 185000,
                'original_price' => null,
                'stock'          => 25,
                'rating'         => 4.8,
                'featured'       => false,
                'image'          => 'assets/images/products/dompet-kulit-minimalis.svg',
                'short_desc'     => 'Profil tipis 6 slot kartu dengan pelindung pemindaian RFID.',
                'description'    => 'Menggunakan kulit sapi full-grain bertekstur halus yang makin berkarakter seiring pemakaian.',
                'specs'          => ['Material' => 'Full-Grain Vegetable Tanned Leather', 'Kapasitas' => '6 Kartu + Uang Kertas', 'Fitur' => 'Lapisan Anti-RFID'],
            ],
            [
                'id'             => 10,
                'sku'            => 'SE-AK-303',
                'name'           => 'Kacamata Antiradiasi Layar',
                'slug'           => 'kacamata-antiradiasi',
                'category_slug'  => 'aksesoris',
                'category_name'  => 'Aksesoris',
                'price'          => 215000,
                'original_price' => 260000,
                'stock'          => 0,
                'rating'         => 4.6,
                'featured'       => false,
                'image'          => 'assets/images/products/kacamata-antiradiasi.svg',
                'short_desc'     => 'Frame TR90 lentur dengan lensa penyaring cahaya biru 40%.',
                'description'    => 'Mengurangi ketegangan mata saat menatap monitor berjam-jam dengan lapisan anti-refleksi bening.',
                'specs'          => ['Frame' => 'TR90 Ringan (18g)', 'Lensa' => 'Blue-Light Filter + Anti-Glare', 'Kelengkapan' => 'Hardcase & Kain Lap'],
            ],
            [
                'id'             => 11,
                'sku'            => 'SE-RT-401',
                'name'           => 'Lampu Meja Minimalis LED',
                'slug'           => 'lampu-meja-minimalis',
                'category_slug'  => 'rumah-tangga',
                'category_name'  => 'Rumah Tangga',
                'price'          => 275000,
                'original_price' => 330000,
                'stock'          => 12,
                'rating'         => 4.9,
                'featured'       => false,
                'image'          => 'assets/images/products/lampu-meja-minimalis.svg',
                'short_desc'     => 'Tiga suhu warna (hangat hingga putih fokus) dengan kontrol sentuh.',
                'description'    => 'Pencahayaan bebas kedip (flicker-free) berindeks CRI >= 92 untuk menjaga kenyamanan membaca dan mengetik malam hari.',
                'specs'          => ['Daya' => '10W USB-C', 'Suhu Warna' => '3000K / 4200K / 5700K', 'Leher Lampu' => 'Aluminium Lipat 180°'],
            ],
            [
                'id'             => 12,
                'sku'            => 'SE-RT-402',
                'name'           => 'Teko Leher Angsa Termometer',
                'slug'           => 'teko-leher-angsa',
                'category_slug'  => 'rumah-tangga',
                'category_name'  => 'Rumah Tangga',
                'price'          => 310000,
                'original_price' => null,
                'stock'          => 7,
                'rating'         => 4.8,
                'featured'       => false,
                'image'          => 'assets/images/products/teko-leher-angsa.svg',
                'short_desc'     => 'Kapasitas 800ml baja tahan karat 304 dengan aliran tuang presisi.',
                'description'    => 'Membantu seduh kopi atau teh manual lebih konsisten berkat pegangan seimbang dan penunjuk suhu tutup teko.',
                'specs'          => ['Material' => 'Stainless Steel 304 Food-Grade', 'Kapasitas' => '800 ml', 'Kompor' => 'Gas, Listrik, Induksi'],
            ],
        ];
    }

    public static function findCategory(string $slug): ?array
    {
        foreach (self::categories() as $cat) {
            if ($cat['slug'] === $slug) {
                return $cat;
            }
        }

        return null;
    }

    public static function findProductBySlug(string $slug): ?array
    {
        foreach (self::products() as $product) {
            if ($product['slug'] === $slug) {
                return $product;
            }
        }

        return null;
    }

    public static function filterProducts(?string $categorySlug = null, string $search = '', string $sort = 'featured'): array
    {
        $items = self::products();

        if ($categorySlug !== null && $categorySlug !== '') {
            $items = array_values(array_filter(
                $items,
                static fn (array $p): bool => $p['category_slug'] === $categorySlug
            ));
        }

        if ($search !== '') {
            $needle = mb_strtolower(trim($search));
            $items = array_values(array_filter(
                $items,
                static fn (array $p): bool => str_contains(mb_strtolower($p['name']), $needle)
                    || str_contains(mb_strtolower($p['sku']), $needle)
                    || str_contains(mb_strtolower($p['short_desc']), $needle)
                    || str_contains(mb_strtolower($p['category_name']), $needle)
            ));
        }

        usort($items, static function (array $a, array $b) use ($sort): int {
            return match ($sort) {
                'price_asc'  => $a['price'] <=> $b['price'],
                'price_desc' => $b['price'] <=> $a['price'],
                'name_asc'   => strcmp($a['name'], $b['name']),
                default      => ($b['featured'] <=> $a['featured']) ?: ($a['id'] <=> $b['id']),
            };
        });

        return $items;
    }
}
