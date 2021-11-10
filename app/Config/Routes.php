<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
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
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->add('/login', 'Users::login');
$routes->get('/login', 'Users::index');

$routes->group("admin", ["filter" => "auth:ente"], function ($routes) {
    //CATEGORIES
    $routes->get('categories', 'CategoriesController::show');
    $routes->add('newCategory', 'CategoriesController::new');
    $routes->add('updateCategory', 'CategoriesController::update');
    $routes->add('deleteCategory/(:any)', 'CategoriesController::delete/$1');

    //argomenti
    $routes->get('argomenti', 'ArgomentiController::show');
    $routes->add('newArgomenti', 'ArgomentiController::new');
    $routes->add('updateArgomenti', 'ArgomentiController::update');
    $routes->add('deleteArgomenti/(:any)', 'ArgomentiController::delete/$1');
});


$routes->add('/logout', 'Users::logout');
$routes->get('/logout', 'Users::logout');


$routes->add('/admin/login', 'Users::login');
$routes->get('/admin/login', 'Users::login');

 
$routes->add('/admin/forgotPassword', 'Users::forgotPassword');
$routes->get('/admin/forgotPassword', 'Users::forgotPassword');
 

$routes->add('/admin/ResetPassword/(:any)/(:any)', 'Users::resetPassword/$1/$2');
$routes->get('/admin/ResetPassword/(:any)/(:any)', 'Users::resetPassword/$1/$2');


###################" SUPERADMIN #########################

$routes->add('/superadmin/login', 'Users::login');
$routes->get('/superadmin/login', 'Users::login');

$routes->group("superadmin", ["filter" => "auth:admin"], function ($routes) {
   $routes->add('dashboard', 'Superadmin::dashboard');
	$routes->get('dashboard', 'Superadmin::dashboard');
	
	 $routes->add('profile', 'Superadmin::profile');
	$routes->get('profile', 'Superadmin::profile');
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
