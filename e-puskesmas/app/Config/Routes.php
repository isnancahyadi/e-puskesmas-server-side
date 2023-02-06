<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/home', 'Home::index');

$routes->addRedirect('/', 'home');

$routes->resource('restapi/akun');
$routes->resource('restapi/pasien');
$routes->resource('restapi/dokter');
$routes->resource('restapi/jadwaldokter');
$routes->resource('restapi/bpjs');
$routes->resource('restapi/pemeriksaan');

$routes->post('restapi/auth/loginprocess', 'Restapi\Auth::loginProcess');
$routes->get('restapi/auth/logoutprocess', 'Restapi\Auth::logoutProcess');

$routes->get('restapi/poliumum/counter/(:num)', 'Restapi\PoliUmum::counter/$1');
$routes->get('restapi/poliumum/showcounter', 'Restapi\PoliUmum::showCounter');

$routes->get('restapi/polikb/counter/(:num)', 'Restapi\PoliKb::counter/$1');
$routes->get('restapi/polikb/showcounter', 'Restapi\PoliKb::showCounter');

$routes->get('restapi/polikia/counter/(:num)', 'Restapi\PoliKia::counter/$1');
$routes->get('restapi/polikia/showcounter', 'Restapi\PoliKia::showCounter');

$routes->get('restapi/polianak/counter/(:num)', 'Restapi\PoliAnak::counter/$1');
$routes->get('restapi/polianak/showcounter', 'Restapi\PoliAnak::showCounter');

$routes->post('restapi/antrian/create', 'Restapi\Antrian::create');
$routes->get('restapi/antrian/show/(:alpha)', 'Restapi\Antrian::show/$1');
$routes->get('restapi/antrian/showspecifiedpatient/(:num)', 'Restapi\Antrian::showSpecifiedPatient/$1');
$routes->get('restapi/antrian/updatestatus/(:num)', 'Restapi\Antrian::updateStatus/$1');

$routes->get('dokter/tampil', 'Dokter::tampil');
$routes->get('dokter/add', 'Dokter::add');
$routes->post('dokter/store', 'Dokter::store');

$routes->get('pasien/tampil', 'Pasien::tampil');
$routes->get('pasien/add', 'Pasien::add');
$routes->post('pasien/store', 'Pasien::store');
$routes->get('pasien/pemeriksaan', 'Pasien::pemeriksaan');

$routes->get('jadwaldokter/tampil', 'JadwalDokter::tampil');
$routes->get('jadwaldokter/add', 'JadwalDokter::add');
$routes->post('jadwaldokter/store', 'JadwalDokter::store');

$routes->post('pemeriksaan/store', 'Pemeriksaan::store');
$routes->get('pemeriksaan/riwayat', 'Pemeriksaan::riwayat');

$routes->get('antrian/(:alpha)', 'Antrian::tampil/$1');
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
