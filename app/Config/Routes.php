<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes(true);

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

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->get('/', 'Home::index');
$routes->get('/', 'Home::index');
$routes->get('loginfacebook', 'Users::loginfacebook');
$routes->get('logingoogle', 'Users::logingoogle');
$routes->get('logout', 'Users::logout');
$routes->get('login', 'Users::index' , ['filter' => 'noauth']);
$routes->get('registration', 'Users::registration' , ['filter' => 'noauth']);
$routes->get('dashboard', 'Dashboard::index',['filter' => 'auth']);
$routes->get('setting-meta', 'Dashboard::setting_meta',['filter' => 'auth']);
$routes->get('setting-header', 'Dashboard::setting_header',['filter' => 'auth']);
$routes->get('setting-info', 'Dashboard::setting_info',['filter' => 'auth']);
$routes->get('write-post', 'Dashboard::write_post',['filter' => 'auth']);
$routes->get('category', 'Dashboard::category',['filter' => 'auth']);
$routes->get('sub_category', 'Dashboard::sub_category',['filter' => 'auth']);
// $routes->match(['get','post'],'setting-meta', 'Dashboard::setting_meta',['filter' => 'auth']);




/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
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