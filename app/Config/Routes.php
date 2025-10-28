<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// --- RUTE YANG WAJIB LOGIN (Dijaga oleh 'auth') ---
$routes->group('', ['filter' => 'auth'], function ($routes) {

    // Rute utama aplikasi
    $routes->get('/', 'Home::index');
    $routes->addRedirect('home', '/'); // Alihkan 'home' ke '/'

    // Rute untuk halaman Akun
    $routes->get('akun', 'Akun::index');
    $routes->post('akun/update_profil', 'Akun::updateProfil');
    $routes->post('akun/update_sandi', 'Akun::updateSandi');

    // Rute Dataset
    $routes->get('/dataset', 'Dataset::index');
    $routes->post('/dataset/save', 'Dataset::save');
    $routes->post('/dataset/upload', 'Dataset::upload');
    $routes->delete('/dataset/hapusSemua', 'Dataset::hapusSemua');
    $routes->post('/dataset/hapusSemua', 'Dataset::hapusSemua'); // Fallback
    $routes->delete('/dataset/delete/(:num)', 'Dataset::delete/$1');
    $routes->post('/dataset/delete/(:num)', 'Dataset::delete/$1'); // Fallback
    $routes->get('/dataset/export', 'Dataset::export');


    // Rute Prediksi
    $routes->get('/prediksi', 'Prediksi::index');
    $routes->post('/prediksi/run', 'Prediksi::run');
    $routes->post('/prediksi/simpan', 'Prediksi::simpan');


    // --- RUTE UNTUK HISTORY (SUDAH DIPERBAIKI) ---
    $routes->get('/history', 'History::index');
    $routes->get('history/delete/(:num)', 'History::delete/$1');
});


// --- RUTE UNTUK TAMU (Dijaga oleh 'guest') ---
$routes->group('', ['filter' => 'guest'], function ($routes) {
    $routes->get('login', 'Auth::index', ['as' => 'login']);
    $routes->get('register', 'Auth::register', ['as' => 'register']);
});


// --- RUTE AKSI PUBLIK (Proses Login, Register, Logout) ---
$routes->post('login', 'Auth::login');
$routes->post('register', 'Auth::processRegister');
$routes->get('logout', 'Auth::logout');
