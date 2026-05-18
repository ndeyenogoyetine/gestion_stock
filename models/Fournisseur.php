<?php
require_once ROOT . '/models/Model.php';

class Fournisseur extends Model {

    protected string $table = 'fournisseur';
    protected string $primaryKey = 'id';

    // Ajouter un fournisseur
    public function create(array $data): bool {

        $stmt = $this->db->prepare("
            INSERT INTO fournisseur
            (
                nom,
                email,
                telephone,
                adresse
            )
            VALUES
            (
                :nom,
                :email,
                :telephone,
                :adresse
            )
        ");

        return $stmt->execute($data);
    }

    // Modifier un fournisseur
    public function update(int $id, array $data): bool {

        $stmt = $this->db->prepare("
            UPDATE fournisseur SET
                nom       = :nom,
                email     = :email,
                telephone = :telephone,
                adresse   = :adresse
            WHERE id = :id
        ");

        $data['id'] = $id;

        return $stmt->execute($data);
    }
}