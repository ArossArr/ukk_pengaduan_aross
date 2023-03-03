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
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/','Home::index');
$routes->get('/dashboard','Home::dashv');
// Login
$routes->get('/login','LoginC::loginview');
$routes->get('/logout','LoginC::logout');
$routes->post('/plogin','LoginC::plogin');
$routes->get('/register','LoginC::registerview');
$routes->post('/sregister','LoginC::svreg');
// Masyarakat
$routes->get('/masyarakat','MasyarakatC::view');
$routes->post('/smasyarakat','MasyarakatC::sv');
$routes->get('/masyarakat/delete/(:segment)','MasyarakatC::deleted/$1');
$routes->post('/masyarakat/edit/(:segment)','MasyarakatC::edit/$1');
// Petugas
$routes->get('/petugas','PetugasC::view');
$routes->post('/spetugas','PetugasC::sv');
$routes->get('/petugas/delete/(:segment)','PetugasC::deleted/$1');
$routes->post('/petugas/edit/(:segment)','PetugasC::edit/$1');
// pengaduan
$routes->get('/pengaduan','PengaduanC::view');
$routes->post('/spengaduan','PengaduanC::svp');
$routes->get('/pengaduan/delete/(:segment)','PengaduanC::deleted/$1');
// tanggapan
$routes->get('/tanggapan','TanggapanC::view');
$routes->post('/stanggapan','TanggapanC::svt');
// profil
$routes->get('/profil','LoginC::lihatprofil');
$routes->post('/editp','LoginC::editp');


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
