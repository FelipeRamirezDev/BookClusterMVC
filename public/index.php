<?php

include __DIR__ . "/../includes/app.php";

use App\Router;
use Controller\LoginController;
use Controller\PublicController;
use Controller\UserController;

$router = new Router();
//pagina de inicio
$router->get('/', [LoginController::class, 'home']);

//public routes
$router->get('/explore', [PublicController::class, 'explore']);

//auth routes
$router->get('/login', [LoginController::class, 'login']);
$router->post('/login', [LoginController::class, 'login']);
$router->get('/signup', [LoginController::class, 'signup']);
$router->post('/signup', [LoginController::class, 'signup']);
$router->get('/signup', [LoginController::class, 'signup']);
$router->post('/signup', [LoginController::class, 'signup']);
$router->get('/forget-password', [LoginController::class, 'forgetPassword']);
$router->post('/forget-password', [LoginController::class, 'forgetPassword']);
$router->get('/logout', [LoginController::class, 'logout']);

//user routes
$router->get('/index', [UserController::class, 'index']);
$router->get('/profile', [UserController::class, 'profile']);

$router->checkRoutes();