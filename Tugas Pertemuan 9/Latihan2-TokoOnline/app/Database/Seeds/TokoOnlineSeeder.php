<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TokoOnlineSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        if ($this->db->table('categories')->countAllResults() === 0) {
            $this->db->table('categories')->insertBatch([
                ['name' => 'Elektronik', 'slug' => 'elektronik', 'description' => 'Perangkat kerja dan audio harian', 'created_at' => $now, 'updated_at' => $now],
                ['name' => 'Fashion', 'slug' => 'fashion', 'description' => 'Pakaian dan perlengkapan gaya kasual', 'created_at' => $now, 'updated_at' => $now],
                ['name' => 'Aksesoris', 'slug' => 'aksesoris', 'description' => 'Tas, botol minum, dan pelengkap mobilitas', 'created_at' => $now, 'updated_at' => $now],
                ['name' => 'Buku & Alat Tulis', 'slug' => 'buku-alat-tulis', 'description' => 'Perlengkapan belajar dan catatan kuliah', 'created_at' => $now, 'updated_at' => $now],
            ]);
        }

        if ($this->db->table('products')->countAllResults() === 0) {
            $this->db->table('products')->insertBatch([
                ['category_id' => 1, 'sku' => 'NM-EL-001', 'name' => 'Headset Nirkabel Studio', 'slug' => 'headset-nirkabel-studio', 'price' => 485000, 'stock' => 18, 'image' => 'assets/images/produk-headset.svg', 'description' => 'Headset nirkabel ringan dengan peredam bising pasif dan baterai hingga 28 jam.', 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
                ['category_id' => 1, 'sku' => 'NM-EL-002', 'name' => 'Keyboard Mekanikal Ringkas 75%', 'slug' => 'keyboard-mekanikal-75', 'price' => 690000, 'stock' => 12, 'image' => 'assets/images/produk-keyboard.svg', 'description' => 'Keyboard mekanikal tata letak 75% dengan switch senyap dan koneksi ganda.', 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
                ['category_id' => 2, 'sku' => 'NM-FS-001', 'name' => 'Jaket Kanvas Kampus', 'slug' => 'jaket-kanvas-kampus', 'price' => 325000, 'stock' => 22, 'image' => 'assets/images/produk-jaket.svg', 'description' => 'Jaket bahan katun kanvas tebal yang nyaman untuk aktivitas luar ruangan.', 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
                ['category_id' => 2, 'sku' => 'NM-FS-002', 'name' => 'Sepatu Kanvas Harian', 'slug' => 'sepatu-kanvas-harian', 'price' => 295000, 'stock' => 14, 'image' => 'assets/images/produk-sepatu.svg', 'description' => 'Sepatu kanvas sol karet fleksibel untuk penggunaan kuliah dan harian.', 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
                ['category_id' => 3, 'sku' => 'NM-AK-001', 'name' => 'Tas Laptop Anti Air 15 Inci', 'slug' => 'tas-laptop-anti-air', 'price' => 265000, 'stock' => 25, 'image' => 'assets/images/produk-tas.svg', 'description' => 'Ransel kompartemen empuk dengan lapisan tahan cipratan air.', 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
                ['category_id' => 3, 'sku' => 'NM-AK-002', 'name' => 'Tumbler Stainless 600ml', 'slug' => 'tumbler-stainless-600ml', 'price' => 145000, 'stock' => 30, 'image' => 'assets/images/produk-tumbler.svg', 'description' => 'Botol minum insulasi vakum dua dinding menjaga suhu hingga 12 jam.', 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
                ['category_id' => 4, 'sku' => 'NM-BK-001', 'name' => 'Buku Catatan Grid A5 Hardcover', 'slug' => 'buku-catatan-grid-a5', 'price' => 68000, 'stock' => 40, 'image' => 'assets/images/produk-buku.svg', 'description' => 'Buku catatan kertas 100gsm ramah tinta pena dengan sampul keras.', 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
                ['category_id' => 4, 'sku' => 'NM-BK-002', 'name' => 'Paket Pena Teknikal 0.5mm', 'slug' => 'paket-pena-teknikal', 'price' => 52000, 'stock' => 35, 'image' => 'assets/images/produk-pena.svg', 'description' => 'Set 4 pena gel tinta pigmen cepat kering untuk catatan dan sketsa.', 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ]);
        }

        if ($this->db->table('orders')->countAllResults() === 0) {
            $this->db->table('orders')->insert([
                'order_code'       => 'ORD-202611-001',
                'customer_name'    => 'Abrar Maulana',
                'customer_email'   => '5025241125@student.its.ac.id',
                'shipping_address' => 'Asrama Mahasiswa ITS Blok B-12, Sukolilo, Surabaya',
                'total_amount'     => 553000,
                'status'           => 'Selesai',
                'created_at'       => $now,
                'updated_at'       => $now,
            ]);
            $orderId = $this->db->insertID();
            $this->db->table('order_items')->insertBatch([
                ['order_id' => $orderId, 'product_id' => 1, 'product_name' => 'Headset Nirkabel Studio', 'price' => 485000, 'qty' => 1, 'subtotal' => 485000],
                ['order_id' => $orderId, 'product_id' => 7, 'product_name' => 'Buku Catatan Grid A5 Hardcover', 'price' => 68000, 'qty' => 1, 'subtotal' => 68000],
            ]);
        }
    }
}
