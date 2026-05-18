<?php
require_once ROOT . '/controllers/Controller.php';
require_once ROOT . '/models/Client.php';

class ClientController extends Controller {

    private Client $model;

    public function __construct() {
        $this->model = new Client();
    }

    // Lister tous les clients
    public function index(): void {
        $clients = $this->model->getAllClients();
        $this->render('clients/index', compact('clients'));
    }

    // Formulaire ajout + traitement
    public function create(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nom'       => $this->sanitize($_POST['nom']),
                'prenom'    => $this->sanitize($_POST['prenom']),
                'telephone' => $this->sanitize($_POST['telephone']),
                'adresse'   => $this->sanitize($_POST['adresse']),
            ];
            if ($this->model->create($data)) {
                $this->setFlash('success', 'Client ajouté avec succès !');
                $this->redirect('index.php?controller=client&action=index');
            } else {
                $error = "Erreur lors de l'ajout !";
                $this->render('clients/create', compact('error'));
                return;
            }
        }
        $this->render('clients/create', []);
    }

    // Formulaire modification + traitement
    public function edit(): void {
        $id     = (int)($_GET['id'] ?? 0);
        $client = $this->model->findById($id);

        if (!$client) {
            $this->redirect('index.php?controller=client&action=index');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nom'       => $this->sanitize($_POST['nom']),
                'prenom'    => $this->sanitize($_POST['prenom']),
                'telephone' => $this->sanitize($_POST['telephone']),
                'adresse'   => $this->sanitize($_POST['adresse']),
            ];
            if ($this->model->update($id, $data)) {
                $this->setFlash('success', 'Client modifié avec succès !');
                $this->redirect('index.php?controller=client&action=index');
            }
        }
        $this->render('clients/edit', compact('client'));
    }

    // Supprimer un client
    public function delete(): void {
        $this->requireAdmin();
        $id = (int)($_GET['id'] ?? 0);
        $this->model->delete($id);
        $this->setFlash('success', 'Client supprimé !');
        $this->redirect('index.php?controller=client&action=index');
    }
}