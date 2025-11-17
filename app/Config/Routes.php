<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/notepad', 'Notepad::index');
$routes->post('/notepad/save', 'Notepad::save');
$routes->get('/notepad/delete/(:num)', 'Notepad::delete/$1');
$routes->get('/notepad/export/(:num)', 'Notepad::export/$1');
