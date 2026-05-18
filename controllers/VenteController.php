<?php
require_once ROOT . '/controllers/Controller.php';
require_once ROOT . '/models/Vente.php';
require_once ROOT . '/models/Article.php';
require_once ROOT . '/models/Client.php';

class VenteController extends Controller {

    private Vente $model;

    public function __construct() {
        $this->model = new Vente();
    }

    // Lister toutes les ventes
    public function index(): void {
        $ventes = $this->model->getAllWithDetails();
        $this->render('ventes/index', compact('ventes'));
    }

    // Formulaire ajout + traitement
    public function create(): void {

        // On a besoin des articles et clients pour les listes déroulantes
        $articles = (new Article())->getAllArticles();
        $clients  = (new Client())->getAllClients();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'id_article'  => (int)$_POST['id_article'],
                'id_client'   => (int)$_POST['id_client'],
                'quantite'    => (int)$_POST['quantite'],
                'prix'        => (float)$_POST['prix'],
                'date_vente'  => $_POST['date_vente'],
            ];
            if ($this->model->create($data)) {
                $this->setFlash('success', 'Vente enregistrée avec succès !');
                $this->redirect('index.php?controller=vente&action=index');
            } else {
                $error = "Erreur lors de l'enregistrement !";
                $this->render('ventes/create', compact('articles', 'clients', 'error'));
                return;
            }
        }
        $this->render('ventes/create', compact('articles', 'clients'));
    }

    // Supprimer une vente
    public function delete(): void {
        $this->requireAdmin();
        $id = (int)($_GET['id'] ?? 0);
        $this->model->delete($id);
        $this->setFlash('success', 'Vente supprimée !');
        $this->redirect('index.php?controller=vente&action=index');
    }
}