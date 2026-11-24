<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BiodataSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        if ($this->db->table('users')->where('username', 'admin')->countAllResults() === 0) {
            $this->db->table('users')->insert([
                'username'   => 'admin',
                'name'       => 'Abrar Maulana',
                'password'   => password_hash('admin123', PASSWORD_BCRYPT),
                'role'       => 'admin',
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        if ($this->db->table('catatan')->countAllResults() === 0) {
            $this->db->table('catatan')->insertBatch([
                [
                    'judul'      => 'Instalasi & Konfigurasi Awal CodeIgniter 4',
                    'kategori'   => 'Setup',
                    'modul_pbkk' => 'PBKK 2-1',
                    'isi'        => 'Menyiapkan struktur project appstarter, konfigurasi .env, dan menampilkan halaman biodata mahasiswa.',
                    'status'     => 'Selesai',
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'judul'      => 'Routing Eksplisit & Controller Halaman Profil',
                    'kategori'   => 'Routing',
                    'modul_pbkk' => 'PBKK 2-2',
                    'isi'        => 'Menonaktifkan auto-routing serta memetakan rute /, /about, dan /contact pada HomeController.',
                    'status'     => 'Selesai',
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'judul'      => 'Template Bootstrap 5 & Partial SB Admin',
                    'kategori'   => 'View',
                    'modul_pbkk' => 'PBKK 2-3 & 2-4',
                    'isi'        => 'Memecah tampilan antarmuka menjadi layout utama sbadmin dan partial sidebar, topbar, serta footer.',
                    'status'     => 'Selesai',
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'judul'      => 'Model CRUD, File Upload, dan Autentikasi Sesi',
                    'kategori'   => 'Backend',
                    'modul_pbkk' => 'PBKK 2-5 s.d. 2-7',
                    'isi'        => 'Mengimplementasikan CatatanModel, validasi upload berkas ke public/uploads, dan AuthFilter.',
                    'status'     => 'Selesai',
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
            ]);
        }
    }
}
