<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->get('signup', 'Home::signup');
$routes->get('dashboard', 'Home::dashboard');
$routes->get('slot', 'Home::slot');
$routes->get('history', 'Home::history');
$routes->get('profil', 'Home::profil');
