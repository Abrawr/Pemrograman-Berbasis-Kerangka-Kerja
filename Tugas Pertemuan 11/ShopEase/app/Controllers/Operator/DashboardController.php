<?php

namespace App\Controllers\Operator;

use App\Controllers\BaseController;
use App\Libraries\CatalogData;

class DashboardController extends BaseController
{
    public function index(): string
    {
        $products = CatalogData::products();
        $lowOrEmpty = array_values(array_filter(
            $products,
            static fn (array $p): bool => (int) $p['stock'] <= 5
        ));

        return view('operator/dashboard', [
            'title'       => 'Dashboard Operator Toko — ShopEase',
            'activePanel' => 'operator',
            'products'    => $products,
            'watchList'   => $lowOrEmpty,
            'categories'  => CatalogData::categories(),
        ]);
    }
}
