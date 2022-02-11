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
	// pdf lib 
	$routes->get('pdflib', 'PdfLibController::show');
	 $routes->add('newpdflib', 'PdfLibController::new');
    $routes->add('updatepdflib', 'PdfLibController::update');
    $routes->add('deletepdflib/(:any)', 'PdfLibController::delete/$1');
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
    $routes->get('deleteUser/(:any)', 'userListController::delete/$1');
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
	 $routes->get('couponwallet', 'Coupon::show_coupon_wallet');
	
	//media settings
	$routes->add('settings/media', 'Settings::media');
	
	//CMS settings
	$routes->add('settings/cms/edit/(:any)', 'Settings::cms_edit/$1');
	$routes->add('settings/cms/add', 'Settings::cms_add');
	$routes->add('settings/cms', 'Settings::cms');
	$routes->add('settings/social', 'Settings::social');
	// Participation 
	$routes->add('send_credential/(:any)/(:any)', 'Participation::send_credential/$1/$2');
	$routes->add('participation/(:any)', 'Participation::index/$1');
	
	// Cart 
	$routes->add('cart', 'Cart::index');
	
	// luoghi & alberhhghi
	
	$routes->add('luoghi', 'Luoghi::index'); 
	$routes->add('alberghi/get_data', 'Alberghi::get_data'); 
	$routes->add('alberghi', 'Alberghi::index'); 
	
	// remember emails
	$routes->add('remember_emails/edit/(:any)', 'Settings::remember_emails_edit/$1');
	$routes->add('remember_emails/add', 'Settings::remember_emails_add');
	$routes->get('remember_emails/add', 'Settings::remember_emails_add');
	$routes->add('remember_emails/remember_emails_send_test', 'Settings::remember_emails_send_test');
	$routes->add('remember_emails', 'Settings::remember_emails');
	//report & extraction
	$routes->add('report/list_participanti', 'Report::list_participanti');
});

$routes->group("admin", ["filter" => "auth:ente"], function ($routes) {
    $routes->get('dashboard', 'DashboardController::show');
	$routes->add('loginAs/(:num)', 'Users::loginAs/$1');
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
$routes->add('/admin/loginBack', 'Users::loginBack');
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
	
	// template emails
	$routes->add('emails/edit/(:any)', 'Settings::emails_edit/$1');
	$routes->add('emails', 'Settings::emails');
	
	//CMS settings
	$routes->add('settings/cms/edit/(:any)', 'Settings::cms_edit/$1');
	$routes->add('settings/cms', 'Settings::cms');
	
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

$routes->get('/confirm_participation_by_mail/(:num)/(:num)', 'Home::confirm_participation_by_mail/$1/$2');

$routes->group("order", ["filter" => "auth:participant"], function ($routes) {
    $routes->get('checkout', 'front\CartController::getCheckout');
    $routes->post('checkout', 'front\CartController::pay');

    // paypal 
    $routes->get('confirm', 'front\CartController::confirm');
    $routes->get('cancel', 'front\CartController::cancel');

    // stripe 
    $routes->get('stripe/confirm', 'front\CartController::stripeConfirm');
    $routes->get('stripe/cancel', 'front\CartController::stripeCancel');
    $routes->post('coupon', 'front\CartController::coupon');
});

$routes->group("user", ["filter" => "auth:participant"], function ($routes) {
	$routes->add('profile/valid_user', 'front\UserController::valid_user');
	$routes->add('profile/setting_submit', 'front\UserController::setting_submit');
	$routes->add('profile', 'front\UserController::profile');
	$routes->add('settings', 'front\UserController::settings');
	$routes->add('participation/(:any)', 'front\UserController::participation_detail/$1');
	$routes->add('participation', 'front\UserController::participation');
	$routes->add('cart', 'front\UserController::cart');
    $routes->post('setting_submit', 'front\UserController::setting_submit');
    $routes->post('valid_user', 'front\UserController::valid_user');
    $routes->post('postShared', 'front\CartController::postShared');

    $routes->post('preshare', 'front\CartController::preshare');

	$routes->add('wallet', 'front\UserController::wallet');

	$routes->get('quizz/(:any)/(:num)', 'front\QuizzController::index/$1/$2');
	$routes->post('submitQuizz', 'front\QuizzController::submitQuizz');
	

});
$routes->get('/user/getFile/(:any)', 'Ajax::downloads3/$1', ['filter' => 'auth:participant,admin,ente']);
$routes->add('/contact', 'Home::contact_page'); 
$routes->add('/page/(:any)', 'Home::page/$1'); 
$routes->add('/page-ce', 'Home::pagece'); 

$routes->get('invoice', 'front\CartController::invoice');

$routes->add('getInvoiceFattureCloud/(:any)','Home::getInvoiceFattureCloud/$1');
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
