<?php
require_once ROOT . '/controllers/Controller.php';
require_once ROOT . '/models/Fournisseur.php';

class FournisseurController extends Controller {

    private Fournisseur $model;

    public function __construct() {
        $this->model = new Fournisseur();
    }

    // Lister tous les fournisseurs
    public function index(): void {
        $fournisseurs = $this->model->findAll('nom');
        $this->render('fournisseurs/index', compact('fournisseurs'));
    }

    // Formulaire ajout + traitement
    public function create(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nom'       => $this->sanitize($_POST['nom']),
                'email'     => $this->sanitize($_POST['email']),
                'telephone' => $this->sanitize($_POST['telephone']),
                'adresse'   => $this->sanitize($_POST['adresse']),
            ];
            if ($this->model->create($data)) {
                $this->setFlash('success', 'Fournisseur ajouté avec succès !');
                $this->redirect('index.php?controller=fournisseur&action=index');
            } else {
                $error = "Erreur lors de l'ajout !";
                $this->render('fournisseurs/create', compact('error'));
                return;
            }
        }
        $this->render('fournisseurs/create', []);
    }

    // Formulaire modification + traitement
    public function edit(): void {
        $id          = (int)($_GET['id'] ?? 0);
        $fournisseur = $this->model->findById($id);

        if (!$fournisseur) {
            $this->redirect('index.php?controller=fournisseur&action=index');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nom'       => $this->sanitize($_POST['nom']),
                'email'     => $this->sanitize($_POST['email']),
                'telephone' => $this->sanitize($_POST['telephone']),
                'adresse'   => $this->sanitize($_POST['adresse']),
            ];
            if ($this->model->update($id, $data)) {
                $this->setFlash('success', 'Fournisseur modifié avec succès !');
                $this->redirect('index.php?controller=fournisseur&action=index');
            }
        }
        $this->render('fournisseurs/edit', compact('fournisseur'));
    }

    // Supprimer un fournisseur
    public function delete(): void {
        $this->requireAdmin();
        $id = (int)($_GET['id'] ?? 0);
        $this->model->delete($id);
        $this->setFlash('success', 'Fournisseur supprimé !');
        $this->redirect('index.php?controller=fournisseur&action=index');
    }
}