<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

define('ROOT', __DIR__);

$controller = isset($_GET['controller']) ? $_GET['controller'] : 'dashboard';
$action     = isset($_GET['action'])     ? $_GET['action']     : 'index';

$allowed = ['dashboard','article','client','commande','fournisseur','utilisateur','vente','auth'];
if (!in_array($controller, $allowed)) {
    $controller = 'dashboard';
    $action = 'index';
}

if ($controller !== 'auth' && !isset($_SESSION['user'])) {
    header('Location: index.php?controller=auth&action=login');
    exit;
}

$controllerClass = ucfirst($controller) . 'Controller';
$controllerFile  = ROOT . '/controllers/' . $controllerClass . '.php';

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $ctrl = new $controllerClass();
    if (method_exists($ctrl, $action)) {
        $ctrl->$action();
    } else {
        $ctrl->index();
    }
} else {
    die("Controller introuvable : $controllerClass");
}