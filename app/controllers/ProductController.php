<?php

namespace app\controllers;
use app\core\Database;
use app\core\Middleware;
use PDO;
use app\models\Product;
class ProductController extends Controller{
    public function index() {
        Middleware::auth();
        Middleware::isManager();
        $product = new Product();
        $products = $product->getAll();
        return $this->render('products', $products);
    }

    public function store() {
        Middleware::auth();
        Middleware::isManager();
        $data = $_POST;
        $product = new Product();
        $product->create($data);
        $this->redirect('/');
    }

    public function delete() {
        Middleware::auth();
        Middleware::isManager();
        $id = $_POST['id'];
        $product = new Product();
        $product->delete($id);
        $this->redirect('/');
    }
}
