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
/*$routes->add('/login', 'Users::login');
$routes->get('/login', 'Users::index');*/
$routes->addRedirect('login', 'user/login');
$routes->addRedirect('user', 'user/login');

$routes->group("admin", ["filter" => "auth_expiration:ente"], function ($routes) {
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

    //sottoargomenti
    $routes->get('sottoargomenti/(:any)', 'SottoargomentiController::show/$1');
    $routes->add('newSottoargomenti', 'SottoargomentiController::new');
    $routes->add('updateSottoargomenti', 'SottoargomentiController::update');
    $routes->add('deleteSottoargomenti/(:any)', 'SottoargomentiController::delete/$1');

    //professione
    $routes->get('professione', 'ProfessioneController::show');
    $routes->add('newProfessione', 'ProfessioneController::new');
    $routes->add('updateProfessione', 'ProfessioneController::update');
    $routes->add('deleteProfessione/(:any)', 'ProfessioneController::delete/$1');

    //discipline
    $routes->get('discipline/(:any)', 'DisciplineController::show/$1');
    $routes->add('newDiscipline', 'DisciplineController::new');
    $routes->add('updateDiscipline', 'DisciplineController::update');
    $routes->add('deleteDiscipline/(:any)', 'DisciplineController::delete/$1');

	
    //obiettivi
    $routes->get('obiettivi', 'ObiettiviController::show');
    $routes->add('newObiettivi', 'ObiettiviController::new');
    $routes->add('updateObiettivi', 'ObiettiviController::update');
    $routes->add('deleteObiettivi/(:any)', 'ObiettiviController::delete/$1');	



    //profile
    $routes->get('profile/(:any)', 'ProfileController::show/$1');
	 $routes->get('profile', 'ProfileController::show');
    $routes->post('updateProfile', 'ProfileController::update');

    //user list
    $routes->get('user_list', 'userListController::show');
    $routes->get('edit_user/(:any)', 'userListController::edit/$1');
    $routes->post('updateUser', 'userListController::update');
    $routes->get('new_user', 'userListController::new');
    $routes->post('createUser', 'userListController::create');
    
  //corsi
  	$routes->add('corsi/(:any)/modulo/edit/(:any)', 'Corsi::corsi_modulo_edit/$1/$2');
	$routes->add('corsi/(:any)/modulo/add', 'Corsi::corsi_modulo_add/$1');
	$routes->add('corsi/(:any)/modulo', 'Corsi::corsi_modulo/$1');
	$routes->add('corsi/edit/(:any)', 'Corsi::corsi_edit/$1');
	$routes->add('corsi/add', 'Corsi::corsi_add');
	$routes->add('corsi', 'Corsi::index');
	$routes->add('modulo', 'Corsi::corsi_modulo_all');
 //corsi test
	$routes->add('test', 'Test::index');
	$routes->add('test/edit/(:any)', 'Test::test_edit/$1');
	$routes->add('test/add', 'Test::test_add');
	
	// template emails
	$routes->add('emails/edit/(:any)', 'Settings::emails_edit/$1');
	$routes->add('emails', 'Settings::emails');
	
	// coupon
	 $routes->get('coupon', 'Coupon::show');
    $routes->add('newCoupon', 'Coupon::new');
    $routes->add('updateCoupon', 'Coupon::update');
    $routes->add('deleteCoupon/(:any)', 'Coupon::delete/$1');
	
	//media settings
	$routes->add('settings/media', 'Settings::media');
	
	//CMS settings
	$routes->add('settings/cms/edit/(:any)', 'Settings::cms_edit/$1');
	$routes->add('settings/cms/add', 'Settings::cms_add');
	$routes->add('settings/cms', 'Settings::cms');
	
	// Participation 
	$routes->add('participation/(:any)', 'Participation::index/$1');
	
	// Cart 
	$routes->add('cart', 'Cart::index');
	
	// luoghi & alberhhghi
	
	$routes->add('luoghi', 'Luoghi::index'); 
	$routes->add('alberghi/get_data', 'Alberghi::get_data'); 
	$routes->add('alberghi', 'Alberghi::index'); 
});

$routes->group("admin", ["filter" => "auth:ente"], function ($routes) {
    $routes->get('dashboard', 'DashboardController::show');
});

$routes->get('/getProv', 'Home::getProv');
$routes->get('/getComm', 'Home::getComm');

$routes->add('/logout', 'Users::logout');
$routes->get('/logout', 'Users::logout');


$routes->add('/admin/login', 'Users::login');
$routes->get('/admin/login', 'Users::login');

 
$routes->add('/admin/forgotPassword', 'Users::forgotPassword');
$routes->get('/admin/forgotPassword', 'Users::forgotPassword');
 

$routes->add('/admin/ResetPassword/(:any)/(:any)', 'Users::resetPassword/$1/$2');
$routes->get('/admin/ResetPassword/(:any)/(:any)', 'Users::resetPassword/$1/$2');

$routes->addRedirect('admin', 'admin/login');

###################" SUPERADMIN #########################

$routes->add('/superadmin/login', 'Users::login');
$routes->get('/superadmin/login', 'Users::login');
$routes->add('/superadmin/loginBack', 'Users::loginBack');
$routes->group("superadmin", ["filter" => "auth:admin"], function ($routes) {
    $routes->add('dashboard', 'Superadmin::dashboard');
	$routes->get('dashboard', 'Superadmin::dashboard');
	
	$routes->add('profile', 'Superadmin::profile');
	$routes->get('profile', 'Superadmin::profile');
	
	$routes->add('ente', 'Ente::index');
	$routes->get('ente', 'Ente::index');
		
	$routes->add('ente/new', 'Ente::add');
	$routes->get('ente/new', 'Ente::add');
	
	$routes->add('ente/edit/(:any)', 'Ente::edit/$1');
	$routes->get('ente/edit/(:any)', 'Ente::edit/$1');
	
	$routes->add('loginAs/(:num)', 'Users::loginAs/$1');
	
});





$routes->get('/', 'Home::index');
$routes->get('/corsi', 'front/CorsiController::index');
$routes->get('/corsi/(:any)', 'front\CorsiController::details/$1');
$routes->get('/modulo/(:any)', 'front\CorsiController::detailsModulo/$1');
$routes->get('/getCourses', 'Home::getCourses');
$routes->get('/blog', 'Home::getBlog');
$routes->get('/register', 'front\UserController::register');
$routes->post('/register', 'front\UserController::create_user');
$routes->get('/user/login', 'front\UserController::getLogin');
$routes->post('/user/login', 'front\UserController::login');
$routes->add('/Confirm/(:any)/(:any)', 'front\UserController::confirmRegister/$1/$2');

$routes->add('/forgotPassword', 'front\UserController::forgotPassword');
$routes->get('/forgotPassword', 'front\UserController::forgotPassword');
 

$routes->add('/ResetPassword/(:any)/(:any)', 'front\UserController::resetPassword/$1/$2');
$routes->get('/ResetPassword/(:any)/(:any)', 'front\UserController::resetPassword/$1/$2');
// cart routes
$routes->post('/addToCart', 'front\CartController::addToCart');
$routes->get('/removeFromCart/(:any)', 'front\CartController::remove/$1');



$routes->group("order", ["filter" => "auth:participant"], function ($routes) {
    $routes->get('checkout', 'front\CartController::getCheckout');
    $routes->post('checkout', 'front\CartController::pay');
    $routes->get('confirm', 'front\CartController::confirm');
    $routes->get('cancel', 'front\CartController::cancel');
    $routes->post('coupon', 'front\CartController::coupon');
});

$routes->add('/contact', 'Home::contact_page'); 
$routes->add('/page/(:any)', 'Home::page/$1'); 

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
