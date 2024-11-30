<?php

namespace app\core;

class Middleware
{
    public static function auth()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit;
        }
        return true;
    }

    public static function isAdmin()
    {
        self::auth();
        if ($_SESSION['user']['role'] !== 'admin') {
            http_response_code(403);
            echo "403 Forbidden: Access Denied";
            exit;
        }
        return true;
    }

    public static function isManager()
    {
        self::auth();
        if (!in_array($_SESSION['user']['role'], ['admin', 'manager'])) {
            http_response_code(403);
            echo "403 Forbidden: Access Denied";
            exit;
        }
        return true;
    }
}

