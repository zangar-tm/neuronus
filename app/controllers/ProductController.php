<?php

namespace app\controllers;
use app\core\Database;
use app\core\Middleware;
use PDO;
use app\models\Product;
class ProductController extends Controller{
    public function index() {
        $product = new Product();
        $products = $product->getAll();
        return $this->render('products', $products);
    }

    public function store() {
        $data = $_POST;
        $product = new Product();
        $product->create([
            'name'=>$data['name'],
            'price'=>$data['price'],
        ]);
        $this->redirect('/');
    }

    public function update($id){
        $data = $_POST;
        $user = new Product();
        $user->update($id, [
            'name' => $data['name'],
            'price' => $data['price']
        ]);
        $this->redirect('/');
    }

    public function edit($id){
        $product = new Product();
        $productData = $product->getById($id);
        $this->render('product-update', [$productData]);
    }

    public function delete($id) {
        $product = new Product();
        $product->delete($id);
        $this->redirect('/');
    }
}
