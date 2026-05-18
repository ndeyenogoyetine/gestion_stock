<?php
require_once ROOT . '/models/Model.php';

class Vente extends Model {

    protected string $table      = 'vente';
    protected string $primaryKey = 'id';

    // Enregistrer une vente
    public function create(array $data): bool {
        $stmt = $this->db->prepare("
            INSERT INTO vente
            (
                id_article,
                id_client,
                quantite,
                prix,
                date_vente
            )
            VALUES
            (
                :id_article,
                :id_client,
                :quantite,
                :prix,
                :date_vente
            )
        ");
        return $stmt->execute($data);
    }

    // Toutes les ventes avec détails
    public function getAllWithDetails(): array {
        return $this->db->query("
            SELECT v.*,
                   a.nom_article,
                   c.nom        AS client_nom,
                   c.prenom     AS client_prenom
            FROM vente v
            LEFT JOIN article a ON v.id_article = a.id
            LEFT JOIN client  c ON v.id_client  = c.id
            ORDER BY v.date_vente DESC
        ")->fetchAll();
    }

    // Chiffre d'affaires du mois
    public function getChiffreAffaireMois(): float {
        $result = $this->db->query("
            SELECT SUM(prix * quantite) AS ca
            FROM vente
            WHERE MONTH(date_vente) = MONTH(NOW())
            AND   YEAR(date_vente)  = YEAR(NOW())
        ")->fetch();
        return (float)($result['ca'] ?? 0);
    }

    // Ventes par mois pour le graphique
    public function getVentesParMois(): array {
        return $this->db->query("
            SELECT MONTH(date_vente) AS mois,
                   SUM(prix * quantite) AS total
            FROM vente
            WHERE YEAR(date_vente) = YEAR(NOW())
            GROUP BY MONTH(date_vente)
            ORDER BY mois
        ")->fetchAll();
    }

        // Dernières ventes
    public function getRecentes(int $limit = 8): array {
        $stmt = $this->db->prepare("
            SELECT v.*,
                a.nom_article,
                c.nom    AS client_nom,
                c.prenom AS client_prenom
            FROM vente v
            LEFT JOIN article a ON v.id_article = a.id
            LEFT JOIN client  c ON v.id_client  = c.id
            ORDER BY v.date_vente DESC
            LIMIT :limit
        ");
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}