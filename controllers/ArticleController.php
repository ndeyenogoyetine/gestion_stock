<?php
require_once ROOT . '/controllers/Controller.php';
require_once ROOT . '/models/Article.php';

class ArticleController extends Controller {

    private Article $model;

    public function __construct() {
        $this->model = new Article();
    }

    // Lister tous les articles
    public function index(): void {
        $articles = $this->model->getAllArticles();
        $this->render('articles/index', compact('articles'));
    }

    // Formulaire ajout + traitement
    public function create(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nom_article'      => $this->sanitize($_POST['nom_article']),
                'categorie'        => $this->sanitize($_POST['categorie']),
                'quantite'         => (int)$_POST['quantite'],
                'prix_unitaire'    => (float)$_POST['prix_unitaire'],
                'date_expiration'  => $_POST['date_expiration'],
                'date_fabrication' => $_POST['date_fabrication'],
            ];
            if ($this->model->create($data)) {
                $this->setFlash('success', 'Article ajouté avec succès !');
                $this->redirect('index.php?controller=article&action=index');
            } else {
                $error = "Erreur lors de l'ajout !";
                $this->render('articles/create', compact('error'));
                return;
            }
        }
        $this->render('articles/create', []);
    }

    // Formulaire modification + traitement
    public function edit(): void {
        $id      = (int)($_GET['id'] ?? 0);
        $article = $this->model->findById($id);

        if (!$article) {
            $this->redirect('index.php?controller=article&action=index');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nom_article'      => $this->sanitize($_POST['nom_article']),
                'categorie'        => $this->sanitize($_POST['categorie']),
                'quantite'         => (int)$_POST['quantite'],
                'prix_unitaire'    => (float)$_POST['prix_unitaire'],
                'date_expiration'  => $_POST['date_expiration'],
                'date_fabrication' => $_POST['date_fabrication'],
            ];
            if ($this->model->update($id, $data)) {
                $this->setFlash('success', 'Article modifié avec succès !');
                $this->redirect('index.php?controller=article&action=index');
            }
        }
        $this->render('articles/edit', compact('article'));
    }

    // Supprimer un article
    public function delete(): void {
        $this->requireAdmin();
        $id = (int)($_GET['id'] ?? 0);
        $this->model->delete($id);
        $this->setFlash('success', 'Article supprimé !');
        $this->redirect('index.php?controller=article&action=index');
    }
}