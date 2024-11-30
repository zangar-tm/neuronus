<?php

namespace app\controllers;
use app\core\Database;
use PDO;
use app\models\Product;
class DashboardController extends Controller{
    public function getProductStats() {
        $product = new Product();
        $products = $product->getAll();
        return $this->render('dashboard',$products);
    }
}
