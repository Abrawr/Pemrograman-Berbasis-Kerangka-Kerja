<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProductModel;

class InventoryController extends BaseController
{
    public function index(): string
    {
        $mode = (string) $this->request->getGet('mode');
        if (! in_array($mode, ['all', 'low', 'out'], true)) {
            $mode = 'all';
        }

        $model = new ProductModel();

        return view('admin/inventory/index', [
            'title'       => 'Manajemen Inventaris & Stok',
            'activePanel' => 'inventory',
            'mode'        => $mode,
            'items'       => $model->getInventoryList($mode),
            'stats'       => $model->getDashboardStats(),
        ]);
    }

    public function update(int $id)
    {
        $model   = new ProductModel();
        $product = $model->find($id);
        if (! $product) {
            return redirect()->to(site_url('admin/inventory'))->with('error', 'Produk tidak ditemukan.');
        }

        $newStock = max(0, (int) $this->request->getPost('stock'));
        $status   = $newStock > 0 ? 'tersedia' : 'tidak_tersedia';

        $model->update($id, [
            'stock'  => $newStock,
            'status' => $status,
        ]);

        return redirect()->back()
            ->with('success', "Stok \"{$product['name']}\" diperbarui menjadi {$newStock} unit ({$status}).");
    }
}
