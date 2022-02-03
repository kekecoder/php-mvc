<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\controllers\siteController;
use app\core\Application;


$app = new Application(dirname(__DIR__));

$app->router->get('/', [new siteController, 'home']);
$app->router->get('/contact', [new siteController, 'contact']);
$app->router->post('/contact', [new siteController, 'handleContact']);
$app->router->get('/about', "about");

$app->run();