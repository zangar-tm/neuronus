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
session_start();
$router = new Router();

$router->get('/dashboard', [DashboardController::class, 'getProductStats'],'auth');
$router->get('/', [ProductController::class, 'index'],'isManager');
$router->post('/products', [ProductController::class, 'store'],'isManager');
$router->post('/products/delete', [ProductController::class, 'delete'],'isManager'); //TODO: сделать удаление по id products/{id}

$router->get('/users', [UserController::class, 'index'],'isAdmin');
$router->post('/users', [UserController::class, 'store'],'isAdmin');
$router->post('/users/delete', [UserController::class, 'delete'],'isAdmin'); //TODO: сделать удаление по id users/{id}

$router->get('/login', [AuthController::class, 'loginPage']);
$router->post('/login', [AuthController::class, 'login']);
$router->get('/logout', [AuthController::class, 'logout'],'auth');
$router->dispatch();