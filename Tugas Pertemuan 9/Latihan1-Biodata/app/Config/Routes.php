<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->setAutoRoute(false);

$routes->get('/', 'HomeController::index', ['as' => 'home']);
$routes->get('about', 'HomeController::about', ['as' => 'about']);
$routes->get('contact', 'HomeController::contact', ['as' => 'contact']);
$routes->post('contact', 'HomeController::submitContact');

$routes->get('login', 'AuthController::login', ['as' => 'login']);
$routes->post('login', 'AuthController::attemptLogin');
$routes->post('logout', 'AuthController::logout', ['as' => 'logout']);

$routes->get('catatan', 'CatatanController::index', ['as' => 'catatan.index']);
$routes->group('catatan', ['filter' => 'auth'], static function ($routes) {
    $routes->get('create', 'CatatanController::create', ['as' => 'catatan.create']);
    $routes->post('store', 'CatatanController::store');
    $routes->get('edit/(:num)', 'CatatanController::edit/$1', ['as' => 'catatan.edit']);
    $routes->post('update/(:num)', 'CatatanController::update/$1');
    $routes->post('delete/(:num)', 'CatatanController::delete/$1');
});

$routes->get('upload', 'UploadController::index', ['as' => 'upload.index']);
$routes->post('upload', 'UploadController::store', ['filter' => 'auth']);
$routes->post('upload/delete/(:num)', 'UploadController::delete/$1', ['filter' => 'auth']);
