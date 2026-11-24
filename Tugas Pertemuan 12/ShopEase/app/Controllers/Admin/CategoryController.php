<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CategoryModel;

class CategoryController extends BaseController
{
    public function index(): string
    {
        return view('admin/categories/index', [
            'title'       => 'Kelola Kategori Produk',
            'activePanel' => 'categories',
            'categories'  => (new CategoryModel())->getWithProductCount(),
        ]);
    }

    public function create(): string
    {
        return view('admin/categories/form', [
            'title'       => 'Tambah Kategori Baru',
            'activePanel' => 'categories',
            'category'    => null,
            'action'      => site_url('admin/categories/store'),
        ]);
    }

    public function store()
    {
        $model = new CategoryModel();
        $name  = trim((string) $this->request->getPost('name'));

        $data = [
            'name'        => $name,
            'slug'        => unique_slug($name, 'categories'),
            'description' => trim((string) $this->request->getPost('description')),
        ];

        if (! $model->insert($data)) {
            return redirect()->back()->withInput()->with('errors', $model->errors());
        }

        return redirect()->to(site_url('admin/categories'))->with('success', "Kategori \"{$name}\" berhasil ditambahkan.");
    }

    public function edit(int $id)
    {
        $category = (new CategoryModel())->find($id);
        if (! $category) {
            return redirect()->to(site_url('admin/categories'))->with('error', 'Kategori tidak ditemukan.');
        }

        return view('admin/categories/form', [
            'title'       => 'Edit Kategori',
            'activePanel' => 'categories',
            'category'    => $category,
            'action'      => site_url('admin/categories/update/' . $id),
        ]);
    }

    public function update(int $id)
    {
        $model = new CategoryModel();
        if (! $model->find($id)) {
            return redirect()->to(site_url('admin/categories'))->with('error', 'Kategori tidak ditemukan.');
        }

        $name = trim((string) $this->request->getPost('name'));
        $data = [
            'name'        => $name,
            'slug'        => unique_slug($name, 'categories', $id),
            'description' => trim((string) $this->request->getPost('description')),
        ];

        if (! $model->update($id, $data)) {
            return redirect()->back()->withInput()->with('errors', $model->errors());
        }

        return redirect()->to(site_url('admin/categories'))->with('success', "Kategori \"{$name}\" berhasil diperbarui.");
    }

    public function delete(int $id)
    {
        $model    = new CategoryModel();
        $category = $model->find($id);
        if (! $category) {
            return redirect()->to(site_url('admin/categories'))->with('error', 'Kategori tidak ditemukan.');
        }

        $productCount = $model->hasProducts($id);
        if ($productCount > 0) {
            return redirect()->to(site_url('admin/categories'))
                ->with('error', "Kategori \"{$category['name']}\" tidak dapat dihapus (RESTRICT): masih digunakan oleh {$productCount} produk.");
        }

        $model->delete($id);

        return redirect()->to(site_url('admin/categories'))->with('success', "Kategori \"{$category['name']}\" berhasil dihapus.");
    }
}
