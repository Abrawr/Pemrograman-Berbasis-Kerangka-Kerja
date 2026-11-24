<?php

namespace App\Controllers;

use App\Models\ProductModel;

class AccountController extends BaseController
{
    public function index(): string
    {
        $allProducts = (new ProductModel())->getPublicCatalog(['sort' => 'featured']);

        return view('account/index', [
            'title'           => 'Akun Saya — ShopEase',
            'activeMenu'      => 'account',
            'user'            => [
                'id'       => session()->get('user_id'),
                'name'     => session()->get('user_name'),
                'email'    => session()->get('user_email'),
                'phone'    => session()->get('user_phone'),
                'role'     => session()->get('user_role'),
                'login_at' => session()->get('login_at'),
            ],
            'recommendations' => array_slice($allProducts, 0, 4),
        ]);
    }
}
