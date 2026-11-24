<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\CatalogData;
use App\Models\UserModel;

class DashboardController extends BaseController
{
    public function index(): string
    {
        $userModel  = new UserModel();
        $roleCounts = $userModel->getRoleCounts();
        $products   = CatalogData::products();

        return view('admin/dashboard', [
            'title'         => 'Dashboard Admin — ShopEase',
            'activePanel'   => 'dashboard',
            'totalUsers'    => array_sum($roleCounts),
            'roleCounts'    => $roleCounts,
            'totalProducts' => count($products),
            'totalCats'     => count(CatalogData::categories()),
            'users'         => $userModel->orderBy('id', 'ASC')->findAll(),
        ]);
    }
}
