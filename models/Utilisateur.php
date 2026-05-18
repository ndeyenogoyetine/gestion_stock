<?php
require_once ROOT . '/models/Model.php';

class Utilisateur extends Model {

    protected string $table      = 'utilisateur';
    protected string $primaryKey = 'id';

    // Trouver un utilisateur par son login
    public function findByLogin(string $email): array|false {
    $stmt = $this->db->prepare("
        SELECT * FROM utilisateur
        WHERE email = ?
    ");
    $stmt->execute([$email]);
    return $stmt->fetch();
    }

    // Créer un utilisateur
    public function create(array $data): bool {
        $data['mot_de_passe'] = password_hash(
            $data['mot_de_passe'],
            PASSWORD_DEFAULT
        );
        $stmt = $this->db->prepare("
            INSERT INTO utilisateur
            (nom, prenom, email, mot_de_passe, role)
            VALUES
            (:nom, :prenom, :email, :mot_de_passe, :role)
        ");
        return $stmt->execute($data);
    }

    // Vérifier le mot de passe
    public function verifyPassword(string $password, string $hash): bool {
        return password_verify($password, $hash);
    }
}