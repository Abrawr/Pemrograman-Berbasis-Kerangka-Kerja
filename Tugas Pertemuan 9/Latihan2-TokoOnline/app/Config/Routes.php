<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->setAutoRoute(false);

$routes->get('/', 'StoreController::index', ['as' => 'store.home']);
$routes->get('produk/(:segment)', 'StoreController::detail/$1', ['as' => 'store.detail']);

$routes->get('cart', 'CartController::index', ['as' => 'cart.index']);
$routes->post('cart/add', 'CartController::add');
$routes->post('cart/update', 'CartController::update');
$routes->post('cart/remove/(:num)', 'CartController::remove/$1');

$routes->get('checkout', 'CartController::checkout', ['as' => 'checkout']);
$routes->post('checkout', 'CartController::processCheckout');
$routes->get('orders', 'CartController::orders', ['as' => 'orders']);

$routes->get('admin/products', 'AdminProductController::index', ['as' => 'admin.products']);
$routes->get('admin/products/create', 'AdminProductController::create');
$routes->post('admin/products/store', 'AdminProductController::store');
$routes->get('admin/products/edit/(:num)', 'AdminProductController::edit/$1');
$routes->post('admin/products/update/(:num)', 'AdminProductController::update/$1');
$routes->post('admin/products/delete/(:num)', 'AdminProductController::delete/$1');
