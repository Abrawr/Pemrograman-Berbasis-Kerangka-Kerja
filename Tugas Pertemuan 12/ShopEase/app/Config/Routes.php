<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->setAutoRoute(false);

// Storefront Publik (terhubung ke database Pertemuan 12)
$routes->get('/', 'HomeController::index', ['as' => 'home']);
$routes->get('about', 'HomeController::about', ['as' => 'about']);
$routes->get('contact', 'HomeController::contact', ['as' => 'contact']);
$routes->post('contact', 'HomeController::submitContact');
$routes->get('products', 'ProductController::index', ['as' => 'products.index']);
$routes->get('products/(:segment)', 'ProductController::detail/$1', ['as' => 'products.detail']);
$routes->get('category/(:segment)', 'ProductController::category/$1', ['as' => 'category.show']);

// Autentikasi
$routes->group('', ['filter' => 'guest'], static function ($routes) {
    $routes->get('login', 'AuthController::login', ['as' => 'login']);
    $routes->post('login', 'AuthController::attemptLogin');
    $routes->get('register', 'AuthController::register', ['as' => 'register']);
    $routes->post('register', 'AuthController::attemptRegister');
});
$routes->post('logout', 'AuthController::logout', ['as' => 'logout', 'filter' => 'auth']);

$routes->get('account', 'AccountController::index', ['as' => 'account', 'filter' => 'auth:customer,admin,operator']);

$routes->group('operator', ['filter' => 'auth:admin,operator'], static function ($routes) {
    $routes->get('dashboard', 'Operator\DashboardController::index', ['as' => 'operator.dashboard']);
});

// Manajemen Produk, Kategori, Galeri, & Inventaris (Admin + Operator; hapus khusus Admin)
$routes->group('admin', ['filter' => 'auth:admin,operator'], static function ($routes) {
    $routes->get('dashboard', 'Admin\DashboardController::index', ['as' => 'admin.dashboard']);

    $routes->get('categories', 'Admin\CategoryController::index', ['as' => 'admin.categories']);
    $routes->get('categories/create', 'Admin\CategoryController::create');
    $routes->post('categories/store', 'Admin\CategoryController::store');
    $routes->get('categories/edit/(:num)', 'Admin\CategoryController::edit/$1');
    $routes->post('categories/update/(:num)', 'Admin\CategoryController::update/$1');

    $routes->get('products', 'Admin\ProductController::index', ['as' => 'admin.products']);
    $routes->get('products/create', 'Admin\ProductController::create');
    $routes->post('products/store', 'Admin\ProductController::store');
    $routes->get('products/edit/(:num)', 'Admin\ProductController::edit/$1');
    $routes->post('products/update/(:num)', 'Admin\ProductController::update/$1');
    $routes->post('products/(:num)/images/(:num)/primary', 'Admin\ProductController::setPrimaryImage/$1/$2');

    $routes->get('inventory', 'Admin\InventoryController::index', ['as' => 'admin.inventory']);
    $routes->post('inventory/update/(:num)', 'Admin\InventoryController::update/$1');
});

// Operasi Hapus Destruktif — Hanya Admin
$routes->group('admin', ['filter' => 'auth:admin'], static function ($routes) {
    $routes->post('categories/delete/(:num)', 'Admin\CategoryController::delete/$1');
    $routes->post('products/delete/(:num)', 'Admin\ProductController::delete/$1');
    $routes->post('products/(:num)/images/(:num)/delete', 'Admin\ProductController::deleteImage/$1/$2');
});
