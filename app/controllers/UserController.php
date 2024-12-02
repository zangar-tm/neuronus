<?php

namespace app\controllers;
use app\core\Database;
use app\core\Middleware;
use app\models\User;
use PDO;
class UserController extends Controller{
    public function index() {
        $user = new User();
        $users = $user->getAll();
        return $this->render('users', $users);
    }

    public function store() {
        $data = $_POST;
        $user = new User();
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        $user->create([
            'username' => $data['username'],
            'password' => $password,
            'role' => $data['role']
        ]);
        $this->redirect('/users');    
    }

    public function delete() {
        $id = $_POST['id'];
        $user = new User();
        $user->delete($id);
        $this->redirect('/users');  
    }
}
