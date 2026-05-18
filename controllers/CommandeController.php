<?php
require_once ROOT . '/controllers/Controller.php';
require_once ROOT . '/models/Commande.php';
require_once ROOT . '/models/Article.php';
require_once ROOT . '/models/Fournisseur.php';

class CommandeController extends Controller {

    private Commande $model;

    public function __construct() {
        $this->model = new Commande();
    }

    // Lister toutes les commandes
    public function index(): void {
        $commandes = $this->model->getAllWithDetails();
        $this->render('commandes/index', compact('commandes'));
    }

    // Formulaire ajout + traitement
    public function create(): void {

        // On a besoin des articles et fournisseurs
        // pour les listes déroulantes
        $articles     = (new Article())->getAllArticles();
        $fournisseurs = (new Fournisseur())->findAll('nom');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'id_article'     => (int)$_POST['id_article'],
                'id_fournisseur' => (int)$_POST['id_fournisseur'],
                'quantite'       => (int)$_POST['quantite'],
                'prix'           => (float)$_POST['prix'],
                'date_commande'  => $_POST['date_commande'],
            ];
            if ($this->model->create($data)) {
                $this->setFlash('success', 'Commande créée avec succès !');
                $this->redirect('index.php?controller=commande&action=index');
            } else {
                $error = "Erreur lors de la création !";
                $this->render(
                    'commandes/create',
                    compact('articles', 'fournisseurs', 'error')
                );
                return;
            }
        }
        $this->render('commandes/create', compact('articles', 'fournisseurs'));
    }

    // Supprimer une commande
    public function delete(): void {
        $this->requireAdmin();
        $id = (int)($_GET['id'] ?? 0);
        $this->model->delete($id);
        $this->setFlash('success', 'Commande supprimée !');
        $this->redirect('index.php?controller=commande&action=index');
    }
}