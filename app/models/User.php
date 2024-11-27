<?php
namespace app\models;
use PDO;
class User
{
    private $db;

    public function __construct()
    {
        $this->db = \app\core\Database::getInstance();
    }

    public function getAll(): array
    {
        $query = "SELECT * FROM users";
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function create(array $data): bool
    {
        $query = "INSERT INTO users (username, password, role) VALUES (:username, :password, :role)";
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        $stmt = $this->db->prepare($query);

        return $stmt->execute([
            ':username' => $data['username'],
            ':password' => $password,
            ':role' => $data['role']
        ]);
    }


    public function delete(int $id): bool
    {
        $query = "DELETE FROM users WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
