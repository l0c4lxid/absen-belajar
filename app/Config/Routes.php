<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

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
$routes->get('login', 'Auth::login');
$routes->get('/', 'Auth::login');
$routes->post('auth/login', 'Auth::login');
$routes->get('dashboard', 'Dashboard::index', ['filter' => 'auth']);
$routes->get('logout', 'Auth::logout');

$routes->get('profile/admin', 'Profile::admin', ['filter' => 'auth']);
$routes->post('profile/save_admin', 'Profile::save_admin', ['filter' => 'auth']);
$routes->get('profile/user', 'Profile::user', ['filter' => 'auth']);
$routes->post('profile/save_user', 'Profile::save_user', ['filter' => 'auth']);

$routes->get('admin', 'Admin::index', ['filter' => 'auth']);
$routes->get('admin/add_user', 'Admin::addUser', ['filter' => 'auth']);
$routes->post('admin/saveUser', 'Admin::saveUser', ['filter' => 'auth']);

$routes->get('admin/listDevisi', 'Admin::listDevisi', ['filter' => 'auth']);

$routes->get('admin/edit_user/(:num)', 'Admin::editUser/$1', ['filter' => 'auth']);
$routes->post('admin/updateUser/(:num)', 'Admin::updateUser/$1', ['filter' => 'auth']);

$routes->get('admin/delete_user/(:num)', 'Admin::deleteUser/$1', ['filter' => 'auth']);

$routes->get('admin/add_division', 'Admin::addDivision', ['filter' => 'auth']);
$routes->post('admin/save_division', 'Admin::saveDivision', ['filter' => 'auth']);
$routes->get('admin/list_division', 'Admin::listDivision', ['filter' => 'auth']);
$routes->get('admin/delete_division/(:num)', 'Admin::deleteDivision/$1', ['filter' => 'auth']);


$routes->get('admin/add_user', 'Admin::getDivisions', ['filter' => 'auth']);
$routes->post('admin/save_user', 'Admin::saveUser', ['filter' => 'auth']);

$routes->get('/jadwal', 'Jam::index', ['filter' => 'auth']);
$routes->get('/jadwal/edit/(:num)', 'Jam::edit/$1', ['filter' => 'auth']);
$routes->post('/jadwal/update/(:num)', 'Jam::update/$1', ['filter' => 'auth']);


$routes->get('absensi/absen_masuk', 'Absensi::absen_masuk', ['filter' => 'auth']);
$routes->get('absensi/absen_keluar', 'Absensi::absen_keluar', ['filter' => 'auth']);
$routes->post('absensi/absen_masuk', 'Absensi::absen_masuk', ['filter' => 'auth']);
$routes->post('absensi/absen_keluar', 'Absensi::absen_keluar', ['filter' => 'auth']);

$routes->post('absensi/berita_acara', 'Absensi::berita_acara', ['filter' => 'auth']);

$routes->get('absensi/kehadiran', 'Absensi::absensi_dua', ['filter' => 'auth']);

$routes->get('absensi/absen_masuk_dua', 'Absensi::absen_masuk_dua', ['filter' => 'auth']);
$routes->get('absensi/absen_keluar_dua', 'Absensi::absen_keluar_dua', ['filter' => 'auth']);
$routes->post('absensi/absen_masuk_dua', 'Absensi::absen_masuk_dua', ['filter' => 'auth']);
$routes->post('absensi/absen_keluar_dua', 'Absensi::absen_keluar_dua', ['filter' => 'auth']);

$routes->group('user', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('getUserJamId', 'Dashboard::getUserJamId', ['filter' => 'auth']);
    $routes->get('getJamKeluarAkhir/(:num)', 'Dashboard::getJamKeluarAkhir/$1', ['filter' => 'auth']);
});







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