<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
// $routes->get('/', 'Home::index', ['filter' => 'auth']);
$routes->get('/', 'Home::index');


$routes->group('home', ['namespace' => 'App\Controllers', 'filter' => 'auth'], function($routes) {
    // Semua rute yang dimulai dengan '/home' akan terfilter
    $routes->get('dashboard', 'Home::dashboard');
    $routes->get('aduan', 'Home::aduan');
    $routes->get('aduanSaya', 'Home::aduanSaya');
    $routes->get('profile', 'Home::profile');
    // $routes->get('/', 'Home::index');
    // Tambahkan rute-rute lainnya yang Anda inginkan di sini
});

$routes->group('admin', ['namespace' => 'App\Controllers', 'filter' => 'authAdmin'], function($routes) {
    // Semua rute yang dimulai dengan '/home' akan terfilter
    $routes->get('/', 'Admin::index');
    $routes->get('laporanMasuk', 'Admin::laporanMasuk');
    $routes->get('detail', 'Admin::detail');
    $routes->get('laporanDiproses', 'Admin::laporanDiproses');
    $routes->get('laporanSelsai', 'Admin::laporanSelsai');
    $routes->get('laporanTidakValid', 'Admin::laporanTidakValid');
    $routes->get('kelolaAkun', 'Admin::kelolaAkun');
});