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

    public function update($id){
        $data = $_POST;
        $user = new User();
        $user->update($id, [
            'username' => $data['username'],
            'role' => $data['role']
        ]);
        $this->redirect('/users');
    }

    public function edit($id){
        $user = new User();
        $userData = $user->getById($id);
        $this->render('user-update', [$userData]);
    }

    public function delete($id) {
        $user = new User();
        $user->delete($id);
        $this->redirect('/users');  
    }
}
