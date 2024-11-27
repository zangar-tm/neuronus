<?php

namespace app\core;
use PDO;
class Database {
    private static $instance = null;
    private $pdo;

    private function __construct() {
        $dsn = sprintf('pgsql:host=%s;dbname=%s', 'db', 'app');
        $username = 'admin';
        $password = 'password';

        $this->pdo = new PDO($dsn, $username, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance->pdo;
    }
}
