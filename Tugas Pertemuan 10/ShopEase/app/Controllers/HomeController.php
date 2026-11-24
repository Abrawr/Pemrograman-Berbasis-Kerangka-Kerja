<?php

namespace App\Controllers;

use App\Libraries\CatalogData;

class HomeController extends BaseController
{
    public function index(): string
    {
        $allProducts = CatalogData::products();
        $featured    = array_values(array_filter($allProducts, static fn (array $p): bool => $p['featured']));

        return view('frontend/home', [
            'title'          => 'ShopEase — Belanja Pilihan Cerdas Sehari-hari',
            'activeMenu'     => 'home',
            'categories'     => CatalogData::categories(),
            'featured'       => $featured,
            'spotlightLeft'  => $featured[0] ?? $allProducts[0],
            'spotlightRight' => array_slice($featured, 1, 2),
            'latestProducts' => array_slice($allProducts, 0, 8),
        ]);
    }

    public function about(): string
    {
        return view('frontend/about', [
            'title'      => 'Tentang ShopEase & Arsitektur RCV',
            'activeMenu' => 'about',
            'categories' => CatalogData::categories(),
        ]);
    }

    public function contact(): string
    {
        return view('frontend/contact', [
            'title'      => 'Hubungi Kami — ShopEase',
            'activeMenu' => 'contact',
        ]);
    }

    public function submitContact()
    {
        $rules = [
            'nama'    => 'required|min_length[3]|max_length[100]',
            'email'   => 'required|valid_email',
            'topik'   => 'required|min_length[3]|max_length[120]',
            'pesan'   => 'required|min_length[8]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $nama = trim((string) $this->request->getPost('nama'));

        return redirect()->to(site_url('contact'))
            ->with('success', "Terima kasih, {$nama}. Pertanyaan Anda telah kami terima oleh tim layanan pelanggan ShopEase.");
    }
}
