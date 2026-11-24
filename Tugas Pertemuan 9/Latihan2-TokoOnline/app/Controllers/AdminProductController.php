<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\ProductModel;

class AdminProductController extends BaseController
{
    private function cartCount(): int
    {
        $cart = session()->get('cart') ?? [];

        return array_sum(array_column($cart, 'qty'));
    }

    private function slugify(string $text): string
    {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $text), '-'));

        return $slug !== '' ? $slug : 'produk-' . time();
    }

    public function index(): string
    {
        return view('admin/products_index', [
            'title'      => 'Admin — Kelola Produk NusaMart',
            'activeMenu' => 'admin',
            'products'   => (new ProductModel())->getAllAdmin(),
            'cartCount'  => $this->cartCount(),
        ]);
    }

    public function create(): string
    {
        return view('admin/products_form', [
            'title'      => 'Tambah Produk Baru',
            'activeMenu' => 'admin',
            'product'    => null,
            'categories' => (new CategoryModel())->orderBy('id', 'ASC')->findAll(),
            'cartCount'  => $this->cartCount(),
            'action'     => site_url('admin/products/store'),
        ]);
    }

    public function store()
    {
        $model = new ProductModel();
        $name  = trim((string) $this->request->getPost('name'));
        $sku   = strtoupper(trim((string) $this->request->getPost('sku')));

        if ($model->where('sku', $sku)->countAllResults() > 0) {
            return redirect()->back()->withInput()->with('error', "SKU {$sku} sudah terdaftar.");
        }

        $slug = $this->slugify($name);
        if ($model->where('slug', $slug)->countAllResults() > 0) {
            $slug .= '-' . substr(bin2hex(random_bytes(2)), 0, 4);
        }

        $data = [
            'category_id' => (int) $this->request->getPost('category_id'),
            'sku'         => $sku,
            'name'        => $name,
            'slug'        => $slug,
            'price'       => (int) $this->request->getPost('price'),
            'stock'       => (int) $this->request->getPost('stock'),
            'image'       => trim((string) $this->request->getPost('image')) ?: 'assets/images/produk-headset.svg',
            'description' => trim((string) $this->request->getPost('description')),
            'is_active'   => $this->request->getPost('is_active') ? 1 : 0,
        ];

        if (! $model->insert($data)) {
            return redirect()->back()->withInput()->with('errors', $model->errors());
        }

        return redirect()->to(site_url('admin/products'))->with('success', "Produk \"{$name}\" berhasil ditambahkan.");
    }

    public function edit(int $id)
    {
        $product = (new ProductModel())->find($id);
        if (! $product) {
            return redirect()->to(site_url('admin/products'))->with('error', 'Produk tidak ditemukan.');
        }

        return view('admin/products_form', [
            'title'      => 'Edit Produk',
            'activeMenu' => 'admin',
            'product'    => $product,
            'categories' => (new CategoryModel())->orderBy('id', 'ASC')->findAll(),
            'cartCount'  => $this->cartCount(),
            'action'     => site_url('admin/products/update/' . $id),
        ]);
    }

    public function update(int $id)
    {
        $model   = new ProductModel();
        $product = $model->find($id);
        if (! $product) {
            return redirect()->to(site_url('admin/products'))->with('error', 'Produk tidak ditemukan.');
        }

        $sku = strtoupper(trim((string) $this->request->getPost('sku')));
        if ($model->where('sku', $sku)->where('id !=', $id)->countAllResults() > 0) {
            return redirect()->back()->withInput()->with('error', "SKU {$sku} sudah digunakan produk lain.");
        }

        $data = [
            'category_id' => (int) $this->request->getPost('category_id'),
            'sku'         => $sku,
            'name'        => trim((string) $this->request->getPost('name')),
            'price'       => (int) $this->request->getPost('price'),
            'stock'       => (int) $this->request->getPost('stock'),
            'image'       => trim((string) $this->request->getPost('image')) ?: $product['image'],
            'description' => trim((string) $this->request->getPost('description')),
            'is_active'   => $this->request->getPost('is_active') ? 1 : 0,
        ];

        if (! $model->update($id, $data)) {
            return redirect()->back()->withInput()->with('errors', $model->errors());
        }

        return redirect()->to(site_url('admin/products'))->with('success', 'Data produk berhasil diperbarui.');
    }

    public function delete(int $id)
    {
        $model = new ProductModel();
        if (! $model->find($id)) {
            return redirect()->to(site_url('admin/products'))->with('error', 'Produk tidak ditemukan.');
        }

        try {
            $model->delete($id);

            return redirect()->to(site_url('admin/products'))->with('success', 'Produk berhasil dihapus.');
        } catch (\Throwable $e) {
            return redirect()->to(site_url('admin/products'))
                ->with('error', 'Produk tidak dapat dihapus karena sudah tercatat pada riwayat pesanan.');
        }
    }
}
