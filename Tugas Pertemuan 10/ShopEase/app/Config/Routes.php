<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->setAutoRoute(false);

$routes->get('/', 'HomeController::index', ['as' => 'home']);
$routes->get('about', 'HomeController::about', ['as' => 'about']);
$routes->get('contact', 'HomeController::contact', ['as' => 'contact']);
$routes->post('contact', 'HomeController::submitContact');

$routes->get('products', 'ProductController::index', ['as' => 'products.index']);
$routes->get('products/(:segment)', 'ProductController::detail/$1', ['as' => 'products.detail']);
$routes->get('category/(:segment)', 'ProductController::category/$1', ['as' => 'category.show']);
