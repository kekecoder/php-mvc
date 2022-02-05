<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\controllers\siteController;
use app\core\Application;
use app\controllers\AuthController;


$app = new Application(dirname(__DIR__));

$app->router->get('/', [new siteController, 'home']);
$app->router->get('/contact', [new siteController, 'contact']);
$app->router->post('/contact', [new siteController, 'handleContact']);
$app->router->get('/about', "about");
$app->router->get('/login', [new AuthController, 'login']);
$app->router->post('/login', [new AuthController, 'login']);
$app->router->get('/register', [new AuthController, 'register']);
$app->router->post('/register', [new AuthController, 'register']);

$app->run();