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
    }

    public static function isAdmin()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            http_response_code(403);
            echo "403 Forbidden: Access Denied";
            exit;
        }
    }

    public static function isManager()
    {
        if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], ['admin', 'manager'])) {
            http_response_code(403);
            echo "403 Forbidden: Access Denied";
            exit;
        }
    }
}

