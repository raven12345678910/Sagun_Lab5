<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/** @var object $router */

$router->get('/', 'AuthController::login');
$router->get('/login', 'AuthController::login');
$router->post('/login/authenticate', 'AuthController::authenticate');
$router->get('/logout', 'AuthController::logout');

$router->get('/products', 'ProductController::index');
$router->get('/products/create', 'ProductController::create');
$router->post('/products/store', 'ProductController::store');
$router->get('/products/edit/{id}', 'ProductController::edit');
$router->post('/products/update/{id}', 'ProductController::update');
$router->get('/products/delete/{id}', 'ProductController::delete');
