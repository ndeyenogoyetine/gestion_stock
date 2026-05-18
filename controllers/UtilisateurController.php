<?php
require_once ROOT . '/controllers/Controller.php';
require_once ROOT . '/models/Utilisateur.php';

class UtilisateurController extends Controller {

    private Utilisateur $model;

    public function __construct() {
        $this->model = new Utilisateur();
    }

    // Lister tous les utilisateurs
    public function index(): void {
        $this->requireAdmin();
        $utilisateurs = $this->model->findAll('nom');
        $this->render('utilisateurs/index', compact('utilisateurs'));
    }

    // Formulaire ajout + traitement
    public function create(): void {
        $this->requireAdmin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nom'          => $this->sanitize($_POST['nom']),
                'prenom'       => $this->sanitize($_POST['prenom']),
                'email'        => $this->sanitize($_POST['email']),
                'mot_de_passe' => $_POST['mot_de_passe'],
                'role'         => $_POST['role'] === 'admin' ? 'admin' : 'user',
            ];
            if ($this->model->create($data)) {
                $this->setFlash('success', 'Utilisateur créé avec succès !');
                $this->redirect('index.php?controller=utilisateur&action=index');
            } else {
                $error = "Erreur : login déjà utilisé !";
                $this->render('utilisateurs/create', compact('error'));
                return;
            }
        }
        $this->render('utilisateurs/create', []);
    }

    // Supprimer un utilisateur
    public function delete(): void {
        $this->requireAdmin();
        $id = (int)($_GET['id'] ?? 0);

        // On ne peut pas supprimer son propre compte !
        if ($id === (int)$_SESSION['user']['id']) {
            $this->setFlash('error', 'Vous ne pouvez pas supprimer votre propre compte !');
            $this->redirect('index.php?controller=utilisateur&action=index');
        }

        $this->model->delete($id);
        $this->setFlash('success', 'Utilisateur supprimé !');
        $this->redirect('index.php?controller=utilisateur&action=index');
    }
}