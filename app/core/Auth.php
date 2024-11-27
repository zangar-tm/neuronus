<?php

namespace app\core;

use PDO;
class Auth {
    public static function login($username, $password) {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
            return true;
        }
        return false;
    }

    public static function logout() {
        session_destroy();
    }
}
