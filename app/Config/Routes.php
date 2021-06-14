<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();
$session = Services::session();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

$routes->get('/', 'Auth::index');
$routes->get('/auth', 'Auth::index');
$routes->post('/', 'Auth::auth');
$routes->post('/auth', 'Auth::auth');
$routes->get('/logout', 'Auth::logout');

if ($session->role == 'admin') :

	$routes->get('/home', 'Home::index');
	$routes->get('/anggota', 'Anggota::index');
	$routes->get('/anggota/tambah', 'Anggota::tambah');
	$routes->post('/anggota', 'Anggota::save');
	$routes->delete('/anggota/(:num)', 'Anggota::delete/$1');
	$routes->get('/anggota/(:num)/edit', 'Anggota::edit/$1');
	$routes->put('/anggota', 'Anggota::update');

	$routes->get('/kas', 'Kas::index');
	$routes->get('/kas/(:num)', 'Kas::index/$1');
	$routes->get('/kas/tambah', 'Kas::tambah');
	$routes->post('/kas', 'Kas::save');
	$routes->delete('/kas/(:num)', 'Kas::delete/$1');
	$routes->get('/kas/(:num)/edit', 'Kas::edit/$1');
	$routes->put('/kas', 'Kas::update');

	$routes->get('/simpanan', 'Simpanan::index');
	$routes->get('/simpanan/tambah', 'Simpanan::tambah');
	$routes->post('/simpanan', 'Simpanan::save');
	$routes->delete('/simpanan/(:num)', 'Simpanan::delete/$1');
	$routes->get('/simpanan/(:num)/edit', 'Simpanan::edit/$1');
	$routes->put('/simpanan', 'Simpanan::update');
	
	$routes->get('/pinjaman', 'Pinjaman::index');
	$routes->put('/pinjaman/(:num)/konfir', 'Pinjaman::konfir/$1');
	$routes->put('/pinjaman/(:num)/lunas', 'Pinjaman::lunas/$1');
	$routes->put('/pinjaman/(:num)/tolak', 'Pinjaman::tolak/$1');
	
	$routes->get('/totsimpan', 'Anggota::totsimpan');
	
	$routes->get('/saldokas', 'SaldoKas::index');
	$routes->get('/saldokas/tambah', 'SaldoKas::tambah');
	$routes->post('/saldokas', 'SaldoKas::save');
	$routes->delete('/saldokas/(:num)', 'SaldoKas::delete/$1');
	$routes->get('/saldokas/(:num)/edit', 'SaldoKas::edit/$1');
	$routes->put('/saldokas', 'SaldoKas::update');
	
	$routes->get('/penarikan', 'Simpanan::penarikan');
	$routes->get('/penarikan/tambah', 'Simpanan::tambahPenarikan');
	$routes->post('/penarikan', 'Simpanan::savePenarikan');

	$routes->get('/angsuran', 'Angsuran::index');
	$routes->get('/angsuran/tambah', 'Angsuran::tambah');
	$routes->post('/angsuran', 'Angsuran::save');
	$routes->post('/apiangsur', 'Angsuran::angsuran_api');
	
elseif ($session->role == 'anggota') :

	$routes->get('/home', 'User::index');
	$routes->get('/kas', 'User::kas');
	$routes->get('/kas/(:num)', 'User::kas/$1');
	$routes->get('/saldo', 'User::saldokas');
	$routes->get('/pinjaman', 'User::pinjaman');
	$routes->get('/pinjam', 'User::pinjam');
	$routes->post('/pinjam', 'User::ajukanPinjaman');
	$routes->delete('/pinjaman/(:num)/batal', 'User::dropPinjaman/$1');

endif;


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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
