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
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->resource('userapi');
$routes->resource('gameapi');
$routes->resource('scoreapi');
$routes->resource('adminapi');
$routes->resource('sessionapi');

$routes->get('/', 'Home::index');
$routes->post("/auth", "Home::index");
$routes->post("/feedback", "Feedback");
$routes->get("/games/(:any)", "Games::game/$1");
$routes->post("/games", "Scores::index");
$routes->get("/create", "Create");
$routes->post("/create", "Create");
$routes->get("/friends", "Friends");
$routes->post("/friends", "Friends::friendRequests");
$routes->get("/account", "Account");
$routes->post("/account", "Account::updateSetting");
$routes->get("/tables/(:any)", "Scores::game/$1");
$routes->post("/admin", "Admin::auth");
$routes->get("/admin", "Admin::index");
$routes->put("/admin", "Admin::adminMisc");
$routes->post("/reset/(:num)", "Reset::index/$1");
$routes->get("/reset/(:num)", "Reset::index/$1");
$routes->get("/resetmail", "Reset::mail");
$routes->post("/resetmail", "Reset::mail");

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
