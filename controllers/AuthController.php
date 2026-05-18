<?php
require_once ROOT . '/controllers/Controller.php';
require_once ROOT . '/models/Utilisateur.php';

class AuthController extends Controller {

    public function login(): void {

        // Si déjà connecté → aller au dashboard
        if (isset($_SESSION['user'])) {
            $this->redirect('index.php?controller=dashboard&action=index');
        }

        // Si le formulaire est soumis
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $login    = $this->sanitize($_POST['login'] ?? '');
            $password = $_POST['password'] ?? '';

            $userModel = new Utilisateur();
            $user      = $userModel->findByLogin($login);

            if ($user && $userModel->verifyPassword($password, $user['mot_de_passe'])) {

                // Connexion réussie → on stocke dans la session
                $_SESSION['user'] = [
                    'id'     => $user['id'],
                    'nom'    => $user['nom'],
                    'prenom' => $user['prenom'],
                    'login'  => $user['login'],
                    'role'   => $user['role'],
                ];

                $this->redirect('index.php?controller=dashboard&action=index');

            } else {
                // Mauvais login ou mot de passe
                $error = "Login ou mot de passe incorrect !";
                $this->render('auth/login', ['error' => $error]);
                return;
            }
        }

        // Afficher le formulaire de connexion
        $this->render('auth/login', []);
    }

    public function logout(): void {
        session_destroy();
        $this->redirect('index.php?controller=auth&action=login');
    }
}