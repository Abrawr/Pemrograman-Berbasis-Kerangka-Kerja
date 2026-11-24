<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\ProductModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class StoreController extends BaseController
{
    public function index(): string
    {
        $categorySlug = trim((string) $this->request->getGet('kategori'));
        $search       = trim((string) $this->request->getGet('q'));

        $productModel  = new ProductModel();
        $categoryModel = new CategoryModel();
        $cart          = session()->get('cart') ?? [];

        return view('store/index', [
            'title'           => 'NusaMart — Toko Online Kebutuhan Mahasiswa',
            'activeMenu'      => 'store',
            'categories'      => $categoryModel->orderBy('id', 'ASC')->findAll(),
            'products'        => $productModel->getCatalog($categorySlug !== '' ? $categorySlug : null, $search),
            'activeCategory'  => $categorySlug,
            'searchQuery'     => $search,
            'cartCount'       => array_sum(array_column($cart, 'qty')),
        ]);
    }

    public function detail(string $slug): string
    {
        $product = (new ProductModel())->findBySlugWithCategory($slug);
        if (! $product) {
            throw PageNotFoundException::forPageNotFound("Produk \"{$slug}\" tidak ditemukan.");
        }

        $cart = session()->get('cart') ?? [];

        return view('store/detail', [
            'title'      => $product['name'],
            'activeMenu' => 'store',
            'product'    => $product,
            'cartCount'  => array_sum(array_column($cart, 'qty')),
        ]);
    }
}
