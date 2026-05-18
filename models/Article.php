<?php
require_once ROOT . '/models/Model.php';

class Article extends Model {

    protected string $table = 'article';
    protected string $primaryKey = 'id';

    // Ajouter un article
    public function create(array $data): bool {

        $stmt = $this->db->prepare("
            INSERT INTO article
            (
                nom_article,
                categorie,
                quantite,
                prix_unitaire,
                date_expiration,
                date_fabrication
            )
            VALUES
            (
                :nom_article,
                :categorie,
                :quantite,
                :prix_unitaire,
                :date_expiration,
                :date_fabrication
            )
        ");

        return $stmt->execute($data);
    }

    // Modifier un article
    public function update(int $id, array $data): bool {

        $stmt = $this->db->prepare("
            UPDATE article SET
                nom_article      = :nom_article,
                categorie        = :categorie,
                quantite         = :quantite,
                prix_unitaire    = :prix_unitaire,
                date_expiration  = :date_expiration,
                date_fabrication = :date_fabrication
            WHERE id = :id
        ");

        $data['id'] = $id;

        return $stmt->execute($data);
    }

    // Afficher tous les articles
    public function getAllArticles(): array {

        return $this->db->query("
            SELECT * FROM article
            ORDER BY nom_article
        ")->fetchAll();
    }
}