<?php
namespace app\models;
use PDO;
use app\core\Database;
class Model 
{
    protected $db;
    protected string $table = '';
    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function getAll(): array
    {
        $query = sprintf("SELECT * FROM %s", $this->table);
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById(int $id): ?array
    {
        $query = sprintf("SELECT * FROM %s WHERE id = :id", $this->table);
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $product = $stmt->fetch();

        return $product ?: null;
    }

    public function create(array $data): bool
    {
        if (!$data) {
            throw new \Exception('Your data is empty.');
        }

        $columns = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));

        $query = sprintf("INSERT INTO %s (%s) VALUES (%s)", $this->table, $columns, $placeholders);
        $stmt = $this->db->prepare($query);

        return $stmt->execute($data);
    }

    public function delete(int $id): bool
    {
        $query = sprintf("DELETE FROM %s WHERE id = :id", $this->table);
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}