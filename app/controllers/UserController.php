<?php

namespace app\controllers;
use app\core\Database;
use app\core\Middleware;
use app\models\User;
use PDO;
class UserController extends Controller{
    public function index() {
        Middleware::auth();
        Middleware::isAdmin();
        $user = new User();
        $users = $user->getAll();
        return $this->render('users', $users);
    }

    public function store() {
        Middleware::auth();
        Middleware::isAdmin();
        $data = $_POST;
        $user = new User();
        $user->create($data);
        $this->redirect('/users');    
    }

    public function delete() {
        Middleware::auth();
        Middleware::isAdmin();
        $id = $_POST['id'];
        $user = new User();
        $user->delete($id);
        $this->redirect('/users');  
    }
}
