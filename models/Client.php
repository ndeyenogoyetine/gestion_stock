<?php
require_once ROOT . '/models/Model.php';

class Client extends Model {

    protected string $table = 'client';
    protected string $primaryKey = 'id';

    // Ajouter un client
    public function create(array $data): bool {

        $stmt = $this->db->prepare("
            INSERT INTO client
            (
                nom,
                prenom,
                telephone,
                adresse
            )
            VALUES
            (
                :nom,
                :prenom,
                :telephone,
                :adresse
            )
        ");

        return $stmt->execute($data);
    }

    // Modifier un client
    public function update(int $id, array $data): bool {

        $stmt = $this->db->prepare("
            UPDATE client SET
                nom       = :nom,
                prenom    = :prenom,
                telephone = :telephone,
                adresse   = :adresse
            WHERE id = :id
        ");

        $data['id'] = $id;

        return $stmt->execute($data);
    }

    // Liste des clients
    public function getAllClients(): array {

        return $this->db->query("
            SELECT * FROM client
            ORDER BY nom
        ")->fetchAll();
    }
}