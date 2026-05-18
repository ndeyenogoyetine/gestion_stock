<?php
require_once ROOT . '/controllers/Controller.php';
require_once ROOT . '/models/Article.php';
require_once ROOT . '/models/Client.php';
require_once ROOT . '/models/Fournisseur.php';
require_once ROOT . '/models/Vente.php';
require_once ROOT . '/models/Commande.php';

class DashboardController extends Controller {

    public function index(): void {

        $articleModel     = new Article();
        $clientModel      = new Client();
        $fournisseurModel = new Fournisseur();
        $venteModel       = new Vente();
        $commandeModel    = new Commande();

        $stats = [
            'nb_articles'     => $articleModel->count(),
            'nb_clients'      => $clientModel->count(),
            'nb_fournisseurs' => $fournisseurModel->count(),
            'nb_commandes'    => $commandeModel->count(),
            'ca_mois'         => $venteModel->getChiffreAffaireMois(),
        ];

        $ventes_recentes = $venteModel->getRecentes(8);
        $ventes_mois     = $venteModel->getVentesParMois();

        $this->render('dashboard/index', compact(
            'stats',
            'ventes_recentes',
            'ventes_mois'
        ));
    }
}