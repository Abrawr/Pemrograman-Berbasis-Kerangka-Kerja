<?php

namespace App\Controllers;

use App\Models\BerkasModel;
use App\Models\CatatanModel;

class HomeController extends BaseController
{
    public function index(): string
    {
        $catatanModel = new CatatanModel();
        $berkasModel  = new BerkasModel();

        $modules = [
            ['kode' => 'PBKK 2-1', 'judul' => 'Instalasi & Konfigurasi CI', 'fitur' => 'Welcome Message & Biodata Profil', 'rute' => '/'],
            ['kode' => 'PBKK 2-2', 'judul' => 'Router & Controller', 'fitur' => 'Halaman About & Contact (GET + POST)', 'rute' => '/about'],
            ['kode' => 'PBKK 2-3', 'judul' => 'Bootstrap untuk View CI', 'fitur' => 'Bootstrap 5.3.3 Offline Assets', 'rute' => '/'],
            ['kode' => 'PBKK 2-4', 'judul' => 'Template SB Admin & Partials', 'fitur' => 'Layout + Sidebar, Topbar, Footer', 'rute' => '/'],
            ['kode' => 'PBKK 2-5', 'judul' => 'Model & Operasi CRUD', 'fitur' => 'CatatanModel (Create, Read, Update, Delete)', 'rute' => '/catatan'],
            ['kode' => 'PBKK 2-6', 'judul' => 'Penanganan File Upload', 'fitur' => 'Upload Dokumen/Gambar + Validasi MIME', 'rute' => '/upload'],
            ['kode' => 'PBKK 2-7', 'judul' => 'Pengaturan Akses User', 'fitur' => 'Login Sesi & AuthFilter Proteksi CRUD', 'rute' => '/login'],
        ];

        return view('pages/home', [
            'title'         => 'Biodata & Ringkasan PBKK 2-1 s.d. 2-7',
            'activeMenu'    => 'home',
            'modules'       => $modules,
            'totalCatatan'  => $catatanModel->countAllResults(),
            'totalBerkas'   => $berkasModel->countAllResults(),
            'recentCatatan' => $catatanModel->orderBy('id', 'DESC')->findAll(3),
        ]);
    }

    public function about(): string
    {
        return view('pages/about', [
            'title'      => 'Tentang Aplikasi & Arsitektur MVC',
            'activeMenu' => 'about',
        ]);
    }

    public function contact(): string
    {
        return view('pages/contact', [
            'title'      => 'Kontak & Umpan Balik',
            'activeMenu' => 'contact',
        ]);
    }

    public function submitContact()
    {
        $rules = [
            'nama'    => 'required|min_length[3]|max_length[100]',
            'email'   => 'required|valid_email',
            'subjek'  => 'required|min_length[3]|max_length[120]',
            'pesan'   => 'required|min_length[8]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $nama = (string) $this->request->getPost('nama');

        return redirect()->to(site_url('contact'))
            ->with('success', "Terima kasih, {$nama}. Pesan uji coba dari form Contact berhasil divalidasi dan diterima.");
    }
}
