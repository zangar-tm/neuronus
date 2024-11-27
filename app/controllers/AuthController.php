<?php
namespace app\controllers;
use app\core\Auth;
use PDO;
class AuthController extends Controller{
    public function login() {
        $username = $_POST['username'];
        $password = $_POST['password'];
        if (Auth::login($username, $password)) {
            $this->redirect('/dashboard');
        }
        $this->redirect('/login');
    }

    public function loginPage(){
        return $this->render('login');
    } 

    public function logout() {
        Auth::logout();
        $this->redirect('/login');
    }
}
