<?php
require_once ROOT . '/models/Model.php';

class Commande extends Model {

    protected string $table      = 'commande';
    protected string $primaryKey = 'id';

    // Créer une commande
    public function create(array $data): bool {
        $stmt = $this->db->prepare("
            INSERT INTO commande
            (
                id_article,
                id_fournisseur,
                quantite,
                prix,
                date_commande
            )
            VALUES
            (
                :id_article,
                :id_fournisseur,
                :quantite,
                :prix,
                :date_commande
            )
        ");
        return $stmt->execute($data);
    }

    // Toutes les commandes avec détails
    public function getAllWithDetails(): array {
        return $this->db->query("
            SELECT c.*,
                   a.nom_article,
                   f.nom AS fournisseur_nom
            FROM commande c
            LEFT JOIN article     a ON c.id_article     = a.id
            LEFT JOIN fournisseur f ON c.id_fournisseur = f.id
            ORDER BY c.date_commande DESC
        ")->fetchAll();
    }

    // Total commandes du mois
    public function getTotalCommandesMois(): float {
        $result = $this->db->query("
            SELECT SUM(prix * quantite) AS total
            FROM commande
            WHERE MONTH(date_commande) = MONTH(NOW())
            AND   YEAR(date_commande)  = YEAR(NOW())
        ")->fetch();
        return (float)($result['total'] ?? 0);
    }
}