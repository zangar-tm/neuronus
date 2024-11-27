<?php
spl_autoload_register(function ($class) {
    $file = __DIR__ . '/../' . str_replace('\\', '/', $class) . '.php';

    if (file_exists($file)) {
        require_once $file;
    } else {
        throw new Exception("Файл для класса $class не найден: $file");
    }
});
use app\controllers\AuthController;
use app\core\Router;
use app\controllers\ProductController;
use app\controllers\UserController;
use app\controllers\DashboardController;
use app\core\Auth;
session_start();
$router = new Router();

$router->get('/dashboard', [DashboardController::class, 'getProductStats']);
$router->get('/', [ProductController::class, 'index']);
$router->post('/products', [ProductController::class, 'store']);
$router->post('/products/delete', [ProductController::class, 'delete']); //TODO: сделать удаление по id products/{id}

$router->get('/users', [UserController::class, 'index']);
$router->post('/users', [UserController::class, 'store']);
$router->post('/users/delete', [UserController::class, 'delete']); //TODO: сделать удаление по id users/{id}

$router->get('/login', [AuthController::class, 'loginPage']);
$router->post('/login', [AuthController::class, 'login']);
$router->get('/logout', [AuthController::class, 'logout']);
$router->dispatch();