<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SiakadSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        if ($this->db->table('dosen')->countAllResults() === 0) {
            $this->db->table('dosen')->insertBatch([
                ['nidn' => '0012087901', 'nama' => 'Fajar Baskoro, S.Kom., M.T.', 'email' => 'fajar.baskoro@if.its.ac.id', 'keahlian' => 'Rekayasa Perangkat Lunak & Framework', 'created_at' => $now, 'updated_at' => $now],
                ['nidn' => '0024058302', 'nama' => 'Ratna Kusuma Wardani, S.Kom., M.Cs.', 'email' => 'ratna.wardani@if.its.ac.id', 'keahlian' => 'Basis Data & Sistem Informasi', 'created_at' => $now, 'updated_at' => $now],
                ['nidn' => '0019118604', 'nama' => 'Budi Santoso, S.T., M.Kom.', 'email' => 'budi.santoso@if.its.ac.id', 'keahlian' => 'Arsitektur Aplikasi Web', 'created_at' => $now, 'updated_at' => $now],
                ['nidn' => '0008038805', 'nama' => 'Dina Permatasari, S.Kom., M.Sc.', 'email' => 'dina.permata@if.its.ac.id', 'keahlian' => 'Interaksi Manusia & Komputer', 'created_at' => $now, 'updated_at' => $now],
            ]);
        }

        if ($this->db->table('mahasiswa')->countAllResults() === 0) {
            $this->db->table('mahasiswa')->insertBatch([
                ['nrp' => '5025241125', 'nama' => 'Abrar Maulana', 'email' => '5025241125@student.its.ac.id', 'angkatan' => 2024, 'prodi' => 'Teknik Informatika', 'dosen_wali_id' => 1, 'status' => 'Aktif', 'created_at' => $now, 'updated_at' => $now],
                ['nrp' => '5025241019', 'nama' => 'Jahhaza Assiqooyah', 'email' => '5025241019@student.its.ac.id', 'angkatan' => 2024, 'prodi' => 'Teknik Informatika', 'dosen_wali_id' => 1, 'status' => 'Aktif', 'created_at' => $now, 'updated_at' => $now],
                ['nrp' => '5025241047', 'nama' => 'Kinanti Ayu Caesandria', 'email' => '5025241047@student.its.ac.id', 'angkatan' => 2024, 'prodi' => 'Teknik Informatika', 'dosen_wali_id' => 2, 'status' => 'Aktif', 'created_at' => $now, 'updated_at' => $now],
                ['nrp' => '5025241059', 'nama' => 'Puspita Wijayanti', 'email' => '5025241059@student.its.ac.id', 'angkatan' => 2024, 'prodi' => 'Teknik Informatika', 'dosen_wali_id' => 2, 'status' => 'Aktif', 'created_at' => $now, 'updated_at' => $now],
                ['nrp' => '5025241067', 'nama' => 'Bagus Cahya Saputra', 'email' => '5025241067@student.its.ac.id', 'angkatan' => 2024, 'prodi' => 'Teknik Informatika', 'dosen_wali_id' => 3, 'status' => 'Aktif', 'created_at' => $now, 'updated_at' => $now],
                ['nrp' => '5025241049', 'nama' => 'Ibrahim Ferel', 'email' => '5025241049@student.its.ac.id', 'angkatan' => 2024, 'prodi' => 'Teknik Informatika', 'dosen_wali_id' => 4, 'status' => 'Aktif', 'created_at' => $now, 'updated_at' => $now],
            ]);
        }

        if ($this->db->table('mata_kuliah')->countAllResults() === 0) {
            $this->db->table('mata_kuliah')->insertBatch([
                ['kode' => 'EF234501', 'nama' => 'Pemrograman Berbasis Kerangka Kerja', 'sks' => 3, 'semester' => 5, 'dosen_id' => 1, 'created_at' => $now, 'updated_at' => $now],
                ['kode' => 'EF234502', 'nama' => 'Manajemen Basis Data Lanjut', 'sks' => 3, 'semester' => 5, 'dosen_id' => 2, 'created_at' => $now, 'updated_at' => $now],
                ['kode' => 'EF234503', 'nama' => 'Pemrograman Web Modern', 'sks' => 3, 'semester' => 5, 'dosen_id' => 3, 'created_at' => $now, 'updated_at' => $now],
                ['kode' => 'EF234504', 'nama' => 'Desain Antarmuka Pengguna', 'sks' => 3, 'semester' => 5, 'dosen_id' => 4, 'created_at' => $now, 'updated_at' => $now],
                ['kode' => 'EF234505', 'nama' => 'Rekayasa Perangkat Lunak', 'sks' => 4, 'semester' => 5, 'dosen_id' => 1, 'created_at' => $now, 'updated_at' => $now],
            ]);
        }

        if ($this->db->table('krs')->countAllResults() === 0) {
            $this->db->table('krs')->insertBatch([
                ['mahasiswa_id' => 1, 'mata_kuliah_id' => 1, 'tahun_ajaran' => '2026/2027-Ganjil', 'nilai_huruf' => 'A',  'nilai_angka' => 4.00, 'created_at' => $now, 'updated_at' => $now],
                ['mahasiswa_id' => 1, 'mata_kuliah_id' => 2, 'tahun_ajaran' => '2026/2027-Ganjil', 'nilai_huruf' => 'AB', 'nilai_angka' => 3.50, 'created_at' => $now, 'updated_at' => $now],
                ['mahasiswa_id' => 1, 'mata_kuliah_id' => 3, 'tahun_ajaran' => '2026/2027-Ganjil', 'nilai_huruf' => 'A',  'nilai_angka' => 4.00, 'created_at' => $now, 'updated_at' => $now],
                ['mahasiswa_id' => 1, 'mata_kuliah_id' => 5, 'tahun_ajaran' => '2026/2027-Ganjil', 'nilai_huruf' => 'AB', 'nilai_angka' => 3.50, 'created_at' => $now, 'updated_at' => $now],
                ['mahasiswa_id' => 2, 'mata_kuliah_id' => 1, 'tahun_ajaran' => '2026/2027-Ganjil', 'nilai_huruf' => 'A',  'nilai_angka' => 4.00, 'created_at' => $now, 'updated_at' => $now],
                ['mahasiswa_id' => 2, 'mata_kuliah_id' => 4, 'tahun_ajaran' => '2026/2027-Ganjil', 'nilai_huruf' => 'A',  'nilai_angka' => 4.00, 'created_at' => $now, 'updated_at' => $now],
                ['mahasiswa_id' => 3, 'mata_kuliah_id' => 1, 'tahun_ajaran' => '2026/2027-Ganjil', 'nilai_huruf' => 'AB', 'nilai_angka' => 3.50, 'created_at' => $now, 'updated_at' => $now],
                ['mahasiswa_id' => 4, 'mata_kuliah_id' => 2, 'tahun_ajaran' => '2026/2027-Ganjil', 'nilai_huruf' => 'A',  'nilai_angka' => 4.00, 'created_at' => $now, 'updated_at' => $now],
            ]);
        }
    }
}
