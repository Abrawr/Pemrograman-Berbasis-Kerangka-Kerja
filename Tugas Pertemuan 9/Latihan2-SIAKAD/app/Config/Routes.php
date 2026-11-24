<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->setAutoRoute(false);

$routes->get('/', 'DashboardController::index', ['as' => 'dashboard']);

$routes->get('mahasiswa', 'MahasiswaController::index');
$routes->get('mahasiswa/create', 'MahasiswaController::create');
$routes->post('mahasiswa/store', 'MahasiswaController::store');
$routes->get('mahasiswa/edit/(:num)', 'MahasiswaController::edit/$1');
$routes->post('mahasiswa/update/(:num)', 'MahasiswaController::update/$1');
$routes->post('mahasiswa/delete/(:num)', 'MahasiswaController::delete/$1');

$routes->get('dosen', 'DosenController::index');
$routes->get('dosen/create', 'DosenController::create');
$routes->post('dosen/store', 'DosenController::store');
$routes->get('dosen/edit/(:num)', 'DosenController::edit/$1');
$routes->post('dosen/update/(:num)', 'DosenController::update/$1');
$routes->post('dosen/delete/(:num)', 'DosenController::delete/$1');

$routes->get('matakuliah', 'MataKuliahController::index');
$routes->get('matakuliah/create', 'MataKuliahController::create');
$routes->post('matakuliah/store', 'MataKuliahController::store');
$routes->get('matakuliah/edit/(:num)', 'MataKuliahController::edit/$1');
$routes->post('matakuliah/update/(:num)', 'MataKuliahController::update/$1');
$routes->post('matakuliah/delete/(:num)', 'MataKuliahController::delete/$1');

$routes->get('krs', 'KrsController::index');
$routes->get('krs/create', 'KrsController::create');
$routes->post('krs/store', 'KrsController::store');
$routes->get('krs/edit/(:num)', 'KrsController::edit/$1');
$routes->post('krs/update/(:num)', 'KrsController::update/$1');
$routes->post('krs/delete/(:num)', 'KrsController::delete/$1');
