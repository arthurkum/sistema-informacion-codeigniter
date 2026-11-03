<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Dashboard Principal
$routes->get('/', 'Home::index');

// Documentación de Metodología Scrum
$routes->get('scrum', 'ScrumController::index');

// Módulo: Sexos
$routes->group('sexos', static function ($routes) {
    $routes->get('/', 'SexoController::index');
    $routes->get('new', 'SexoController::new');
    $routes->post('/', 'SexoController::create');
    $routes->get('(:num)/edit', 'SexoController::edit/$1');
    $routes->post('(:num)', 'SexoController::update/$1');
    $routes->get('(:num)/delete', 'SexoController::delete/$1');
});

// Módulo: Estados Civiles
$routes->group('estados-civiles', static function ($routes) {
    $routes->get('/', 'EstadoCivilController::index');
    $routes->get('new', 'EstadoCivilController::new');
    $routes->post('/', 'EstadoCivilController::create');
    $routes->get('(:num)/edit', 'EstadoCivilController::edit/$1');
    $routes->post('(:num)', 'EstadoCivilController::update/$1');
    $routes->get('(:num)/delete', 'EstadoCivilController::delete/$1');
});

// Módulo: Géneros
$routes->group('generos', static function ($routes) {
    $routes->get('/', 'GeneroController::index');
    $routes->get('new', 'GeneroController::new');
    $routes->post('/', 'GeneroController::create');
    $routes->get('(:num)/edit', 'GeneroController::edit/$1');
    $routes->post('(:num)', 'GeneroController::update/$1');
    $routes->get('(:num)/delete', 'GeneroController::delete/$1');
});

// Módulo: Personas
$routes->group('personas', static function ($routes) {
    $routes->get('/', 'PersonaController::index');
    $routes->get('new', 'PersonaController::new');
    $routes->post('/', 'PersonaController::create');
    $routes->get('(:num)', 'PersonaController::show/$1');
    $routes->get('(:num)/edit', 'PersonaController::edit/$1');
    $routes->post('(:num)', 'PersonaController::update/$1');
    $routes->get('(:num)/delete', 'PersonaController::delete/$1');
});

// Módulo: Direcciones
$routes->group('direcciones', static function ($routes) {
    $routes->get('/', 'DireccionController::index');
    $routes->get('new', 'DireccionController::new');
    $routes->post('/', 'DireccionController::create');
    $routes->get('(:num)/edit', 'DireccionController::edit/$1');
    $routes->post('(:num)', 'DireccionController::update/$1');
    $routes->get('(:num)/delete', 'DireccionController::delete/$1');
});

// Módulo: Teléfonos
$routes->group('telefonos', static function ($routes) {
    $routes->get('/', 'TelefonoController::index');
    $routes->get('new', 'TelefonoController::new');
    $routes->post('/', 'TelefonoController::create');
    $routes->get('(:num)/edit', 'TelefonoController::edit/$1');
    $routes->post('(:num)', 'TelefonoController::update/$1');
    $routes->get('(:num)/delete', 'TelefonoController::delete/$1');
});
