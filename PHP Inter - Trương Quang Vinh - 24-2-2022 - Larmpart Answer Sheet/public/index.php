<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\controllers\CategoryController;
use App\controllers\ProductController;
use App\core\Application;

$config = [
    'db' => [
        'dsn' => 'mysql:host=localhost;dbname=test',
        'user' => 'root',
        'password' => ''

    ]
];

$app = new Application(dirname(__DIR__), $config);

$app->router->get('/', [ProductController::class, 'index']);
$app->router->get('/products', [ProductController::class, 'index']);
$app->router->get('/products/create', [ProductController::class, 'create']);
$app->router->post('/products', [ProductController::class, 'store']);

$app->router->get('/products/{productId}', [ProductController::class, 'show']);
$app->router->get('/products/{productId}/edit', [ProductController::class, 'edit']);
$app->router->post('/products/{productId}', [ProductController::class, 'update']);
$app->router->post('/products/{productId}/delete', [ProductController::class, 'delete']);

$app->router->get('/categories', [CategoryController::class, 'index']);
$app->router->get('/categories/create', [CategoryController::class, 'create']);
$app->router->post('/categories', [CategoryController::class, 'store']);
$app->router->get('/categories/{categoryId}', [CategoryController::class, 'show']);
$app->router->get('/categories/{categoryId}/edit', [CategoryController::class, 'edit']);
$app->router->post('/categories/{categoryId}', [CategoryController::class, 'update']);
$app->router->post('/categories/{categoryId}/delete', [CategoryController::class, 'delete']);


$app->run();
