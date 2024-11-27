<?php
namespace app\models;
use PDO;
use app\core\Database;
class Product
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function getAll(): array
    {
        $query = "SELECT * FROM products";
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById(int $id): ?array
    {
        $query = "SELECT * FROM products WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $product = $stmt->fetch();

        return $product ?: null;
    }

    public function create(array $data): bool
    {
        $query = "INSERT INTO products (name, price) VALUES (:name, :price)";
        $stmt = $this->db->prepare($query);

        return $stmt->execute([
            ':name' => $data['name'],
            ':price' => $data['price']
        ]);
    }

    public function delete(int $id): bool
    {
        $query = "DELETE FROM products WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
