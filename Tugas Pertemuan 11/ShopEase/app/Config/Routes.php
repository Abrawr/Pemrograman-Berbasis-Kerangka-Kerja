<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->setAutoRoute(false);

// Storefront Publik (dari Pertemuan 10)
$routes->get('/', 'HomeController::index', ['as' => 'home']);
$routes->get('about', 'HomeController::about', ['as' => 'about']);
$routes->get('contact', 'HomeController::contact', ['as' => 'contact']);
$routes->post('contact', 'HomeController::submitContact');
$routes->get('products', 'ProductController::index', ['as' => 'products.index']);
$routes->get('products/(:segment)', 'ProductController::detail/$1', ['as' => 'products.detail']);
$routes->get('category/(:segment)', 'ProductController::category/$1', ['as' => 'category.show']);

// Autentikasi (Pertemuan 11)
$routes->group('', ['filter' => 'guest'], static function ($routes) {
    $routes->get('login', 'AuthController::login', ['as' => 'login']);
    $routes->post('login', 'AuthController::attemptLogin');
    $routes->get('register', 'AuthController::register', ['as' => 'register']);
    $routes->post('register', 'AuthController::attemptRegister');
});

$routes->post('logout', 'AuthController::logout', ['as' => 'logout', 'filter' => 'auth']);

// Halaman Terproteksi berdasarkan Role (RBAC)
$routes->get('account', 'AccountController::index', ['as' => 'account', 'filter' => 'auth:customer,admin,operator']);

$routes->group('operator', ['filter' => 'auth:admin,operator'], static function ($routes) {
    $routes->get('dashboard', 'Operator\DashboardController::index', ['as' => 'operator.dashboard']);
});

$routes->group('admin', ['filter' => 'auth:admin'], static function ($routes) {
    $routes->get('dashboard', 'Admin\DashboardController::index', ['as' => 'admin.dashboard']);
});
