<?php

use app\core\Application;
use app\controllers\AuthController;
use app\controllers\SiteController;
use Dotenv\Dotenv;

require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$config = [
    'db' =>[
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD']
    ]
];

$app = new Application(dirname(__DIR__), $config);

$app->router->get('/', [new SiteController, 'home']);
$app->router->get('/contact', [new SiteController, 'contact']);
$app->router->post('/contact', [new SiteController, 'handleContact']);
$app->router->get('/about', "about");
$app->router->get('/login', [new AuthController, 'login']);
$app->router->post('/login', [new AuthController, 'login']);
$app->router->get('/register', [new AuthController, 'register']);
$app->router->post('/register', [new AuthController, 'register']);

$app->run();
