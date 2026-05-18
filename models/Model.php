<?php
require_once ROOT . '/config/database.php';

abstract class Model {

    protected PDO $db;
    protected string $table;
    protected string $primaryKey = 'id';

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function findAll(string $orderBy = ''): array {
        $sql = "SELECT * FROM `{$this->table}`";
        if ($orderBy) {
            $sql .= " ORDER BY $orderBy";
        }
        return $this->db->query($sql)->fetchAll();
    }

    public function findById(int $id): array|false {
        $stmt = $this->db->prepare(
            "SELECT * FROM `{$this->table}` WHERE `{$this->primaryKey}` = ?"
        );
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function delete(int $id): bool {
        $stmt = $this->db->prepare(
            "DELETE FROM `{$this->table}` WHERE `{$this->primaryKey}` = ?"
        );
        return $stmt->execute([$id]);
    }

    public function count(): int {
        return (int) $this->db->query(
            "SELECT COUNT(*) FROM `{$this->table}`"
        )->fetchColumn();
    }
}