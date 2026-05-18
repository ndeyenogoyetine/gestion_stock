<?php
abstract class Controller {

    // Afficher une vue
    protected function render(string $view, array $data = []): void {
        extract($data);
        $viewFile = ROOT . '/views/' . $view . '.php';
        if (!file_exists($viewFile)) {
            die("Vue introuvable : $viewFile");
        }
        require $viewFile;
    }

    // Rediriger vers une URL
    protected function redirect(string $url): void {
        header("Location: $url");
        exit;
    }

    // Vérifier si admin
    protected function isAdmin(): bool {
        return isset($_SESSION['user']['role']) 
               && $_SESSION['user']['role'] === 'admin';
    }

    // Exiger le rôle admin
    protected function requireAdmin(): void {
        if (!$this->isAdmin()) {
            $this->redirect('index.php?controller=dashboard&action=index');
        }
    }

    // Nettoyer les données venant de l'utilisateur
    protected function sanitize(string $str): string {
        return htmlspecialchars(trim($str), ENT_QUOTES, 'UTF-8');
    }

    // Message flash
    protected function setFlash(string $type, string $message): void {
        $_SESSION['flash'] = [
            'type'    => $type,
            'message' => $message
        ];
    }
}