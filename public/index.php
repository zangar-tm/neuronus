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
$router->get('/products/{id}', [ProductController::class, 'edit'],'isManager');
$router->post('/products/{id}/update', [ProductController::class, 'update'],'isManager');
$router->post('/products/{id}/delete', [ProductController::class, 'delete'],'isManager');

$router->get('/users', [UserController::class, 'index'],'isAdmin');
$router->post('/users', [UserController::class, 'store'],'isAdmin');
$router->get('/users/{id}', [UserController::class, 'edit'],'isAdmin');
$router->post('/users/{id}/update', [UserController::class, 'update'],'isAdmin');
$router->post('/users/{id}/delete', [UserController::class, 'delete'],'isAdmin');

$router->get('/login', [AuthController::class, 'loginPage']);
$router->post('/login', [AuthController::class, 'login']);
$router->get('/logout', [AuthController::class, 'logout'],'auth');
$router->dispatch();