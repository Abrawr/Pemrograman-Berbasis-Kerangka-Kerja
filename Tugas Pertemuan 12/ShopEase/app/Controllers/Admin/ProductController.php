<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use App\Models\ProductImageModel;
use App\Models\ProductModel;

class ProductController extends BaseController
{
    private const MAX_IMAGES_PER_PRODUCT = 6;
    private const MAX_IMAGE_BYTES        = 2097152; // 2 MB
    private const ALLOWED_MIME_TYPES     = ['image/png', 'image/jpeg', 'image/webp'];

    public function index(): string
    {
        $filters = [
            'q'           => trim((string) $this->request->getGet('q')),
            'category_id' => trim((string) $this->request->getGet('category_id')),
            'status'      => trim((string) $this->request->getGet('status')),
        ];

        $productModel = new ProductModel();
        $products     = $productModel->getAdminProducts($filters, 8);

        return view('admin/products/index', [
            'title'       => 'Manajemen Produk (CRUD & Search)',
            'activePanel' => 'products',
            'products'    => $products,
            'pager'       => $productModel->pager,
            'categories'  => (new CategoryModel())->orderBy('name', 'ASC')->findAll(),
            'filters'     => $filters,
        ]);
    }

    public function create(): string
    {
        return view('admin/products/form', [
            'title'       => 'Tambah Produk Baru',
            'activePanel' => 'products',
            'product'     => null,
            'images'      => [],
            'categories'  => (new CategoryModel())->orderBy('name', 'ASC')->findAll(),
            'action'      => site_url('admin/products/store'),
        ]);
    }

    public function store()
    {
        $productModel = new ProductModel();
        $sku          = strtoupper(trim((string) $this->request->getPost('sku')));
        $name         = trim((string) $this->request->getPost('name'));

        if ($productModel->where('sku', $sku)->countAllResults() > 0) {
            return redirect()->back()->withInput()->with('error', "SKU {$sku} sudah terdaftar.");
        }

        $stock         = max(0, (int) $this->request->getPost('stock'));
        $status        = $stock === 0 ? 'tidak_tersedia' : (string) $this->request->getPost('status');
        $originalPrice = trim((string) $this->request->getPost('original_price'));

        $data = [
            'category_id'    => (int) $this->request->getPost('category_id'),
            'sku'            => $sku,
            'name'           => $name,
            'slug'           => unique_slug($name, 'products'),
            'price'          => (int) $this->request->getPost('price'),
            'original_price' => $originalPrice !== '' ? (int) $originalPrice : null,
            'stock'          => $stock,
            'status'         => in_array($status, ['tersedia', 'tidak_tersedia'], true) ? $status : 'tersedia',
            'short_desc'     => trim((string) $this->request->getPost('short_desc')),
            'description'    => trim((string) $this->request->getPost('description')),
            'featured'       => $this->request->getPost('featured') ? 1 : 0,
        ];

        $productId = $productModel->insert($data, true);
        if (! $productId) {
            return redirect()->back()->withInput()->with('errors', $productModel->errors());
        }

        $uploadErrors = $this->handleImageUploads((int) $productId);
        if (! empty($uploadErrors)) {
            return redirect()->to(site_url('admin/products/edit/' . $productId))
                ->with('success', "Produk \"{$name}\" tersimpan.")
                ->with('error', implode(' ', $uploadErrors));
        }

        return redirect()->to(site_url('admin/products'))
            ->with('success', "Produk \"{$name}\" berhasil ditambahkan beserta galeri gambarnya.");
    }

    public function edit(int $id)
    {
        $product = (new ProductModel())->find($id);
        if (! $product) {
            return redirect()->to(site_url('admin/products'))->with('error', 'Produk tidak ditemukan.');
        }

        return view('admin/products/form', [
            'title'       => 'Edit Produk & Galeri Gambar',
            'activePanel' => 'products',
            'product'     => $product,
            'images'      => (new ProductImageModel())->getByProduct($id),
            'categories'  => (new CategoryModel())->orderBy('name', 'ASC')->findAll(),
            'action'      => site_url('admin/products/update/' . $id),
        ]);
    }

    public function update(int $id)
    {
        $productModel = new ProductModel();
        $existing     = $productModel->find($id);
        if (! $existing) {
            return redirect()->to(site_url('admin/products'))->with('error', 'Produk tidak ditemukan.');
        }

        $sku  = strtoupper(trim((string) $this->request->getPost('sku')));
        $name = trim((string) $this->request->getPost('name'));

        if ($productModel->where('sku', $sku)->where('id !=', $id)->countAllResults() > 0) {
            return redirect()->back()->withInput()->with('error', "SKU {$sku} sudah digunakan produk lain.");
        }

        $stock         = max(0, (int) $this->request->getPost('stock'));
        $status        = $stock === 0 ? 'tidak_tersedia' : (string) $this->request->getPost('status');
        $originalPrice = trim((string) $this->request->getPost('original_price'));

        $data = [
            'category_id'    => (int) $this->request->getPost('category_id'),
            'sku'            => $sku,
            'name'           => $name,
            'slug'           => unique_slug($name, 'products', $id),
            'price'          => (int) $this->request->getPost('price'),
            'original_price' => $originalPrice !== '' ? (int) $originalPrice : null,
            'stock'          => $stock,
            'status'         => in_array($status, ['tersedia', 'tidak_tersedia'], true) ? $status : 'tersedia',
            'short_desc'     => trim((string) $this->request->getPost('short_desc')),
            'description'    => trim((string) $this->request->getPost('description')),
            'featured'       => $this->request->getPost('featured') ? 1 : 0,
        ];

        if (! $productModel->update($id, $data)) {
            return redirect()->back()->withInput()->with('errors', $productModel->errors());
        }

        $uploadErrors = $this->handleImageUploads($id);
        if (! empty($uploadErrors)) {
            return redirect()->to(site_url('admin/products/edit/' . $id))
                ->with('success', "Produk \"{$name}\" diperbarui.")
                ->with('error', implode(' ', $uploadErrors));
        }

        return redirect()->to(site_url('admin/products/edit/' . $id))
            ->with('success', "Perubahan produk \"{$name}\" berhasil disimpan.");
    }

    public function delete(int $id)
    {
        $productModel = new ProductModel();
        $product      = $productModel->find($id);
        if (! $product) {
            return redirect()->to(site_url('admin/products'))->with('error', 'Produk tidak ditemukan.');
        }

        $imageModel = new ProductImageModel();
        foreach ($imageModel->getByProduct($id) as $img) {
            $imageModel->deleteWithFallback($id, (int) $img['id']);
        }

        $productModel->delete($id);

        return redirect()->to(site_url('admin/products'))->with('success', "Produk \"{$product['name']}\" berhasil dihapus.");
    }

    public function setPrimaryImage(int $productId, int $imageId)
    {
        if (! (new ProductImageModel())->setPrimary($productId, $imageId)) {
            return redirect()->back()->with('error', 'Gambar tidak ditemukan pada produk ini.');
        }

        return redirect()->to(site_url('admin/products/edit/' . $productId))
            ->with('success', 'Gambar utama produk berhasil diperbarui.');
    }

    public function deleteImage(int $productId, int $imageId)
    {
        if (! (new ProductImageModel())->deleteWithFallback($productId, $imageId)) {
            return redirect()->back()->with('error', 'Gambar tidak ditemukan.');
        }

        return redirect()->to(site_url('admin/products/edit/' . $productId))
            ->with('success', 'Gambar berhasil dihapus dari galeri produk.');
    }

    private function handleImageUploads(int $productId): array
    {
        $files = $this->request->getFileMultiple('images');
        if (empty($files)) {
            return [];
        }

        $imageModel  = new ProductImageModel();
        $existing    = $imageModel->getByProduct($productId);
        $currentCount = count($existing);
        $hasPrimary  = false;
        $maxSort     = 0;

        foreach ($existing as $img) {
            if ((int) $img['is_primary'] === 1) {
                $hasPrimary = true;
            }
            $maxSort = max($maxSort, (int) $img['sort_order']);
        }

        $targetDir = FCPATH . 'uploads' . DIRECTORY_SEPARATOR . 'products';
        if (! is_dir($targetDir)) {
            mkdir($targetDir, 0775, true);
        }

        $errors = [];
        foreach ($files as $file) {
            if (! $file || $file->getError() === UPLOAD_ERR_NO_FILE) {
                continue;
            }
            if ($currentCount >= self::MAX_IMAGES_PER_PRODUCT) {
                $errors[] = 'Batas maksimal 6 gambar per produk tercapai.';
                break;
            }
            if (! $file->isValid() || $file->hasMoved()) {
                $errors[] = 'Salah satu file gambar gagal diunggah.';
                continue;
            }
            if ($file->getSize() > self::MAX_IMAGE_BYTES) {
                $errors[] = "{$file->getClientName()} melebihi batas 2 MB.";
                continue;
            }
            if (! in_array($file->getMimeType(), self::ALLOWED_MIME_TYPES, true)) {
                $errors[] = "{$file->getClientName()} harus berupa PNG, JPG, atau WEBP.";
                continue;
            }

            $newName = $file->getRandomName();
            $file->move($targetDir, $newName);
            $maxSort++;
            $currentCount++;

            $imageModel->insert([
                'product_id' => $productId,
                'image_path' => 'uploads/products/' . $newName,
                'is_primary' => $hasPrimary ? 0 : 1,
                'sort_order' => $maxSort,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
            $hasPrimary = true;
        }

        return $errors;
    }
}
