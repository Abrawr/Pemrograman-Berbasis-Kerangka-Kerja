<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Models\UserModel;

class DashboardController extends BaseController
{
    public function index(): string
    {
        $productModel = new ProductModel();
        $stats        = $productModel->getDashboardStats();
        $categories   = (new CategoryModel())->getWithProductCount();
        $lowWatch     = $productModel->getInventoryList('low');
        $outWatch     = $productModel->getInventoryList('out');

        return view('admin/dashboard', [
            'title'       => 'Dashboard Manajemen Produk — ShopEase',
            'activePanel' => 'dashboard',
            'stats'       => $stats,
            'categories'  => $categories,
            'alerts'      => array_slice(array_merge($outWatch, $lowWatch), 0, 6),
            'totalUsers'  => (new UserModel())->countAllResults(),
        ]);
    }
}
