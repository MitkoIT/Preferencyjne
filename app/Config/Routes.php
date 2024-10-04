<?php

use CodeIgniter\Router\RouteCollection;


/**
 * @var RouteCollection $routes
 */
$routes->setDefaultController('Login');
$routes->setDefaultMethod('index');
$routes->get('/', 'Login::index', ['filter' => 'NoAuth']);
$routes->get('/home', 'Home::index',['filter' => 'UserAuth']);
$routes->get('/show/(:num)', 'Home::show/$1',['filter' => 'UserAuth']);

$routes->get('/error', 'Error::index');
