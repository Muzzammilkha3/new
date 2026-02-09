<?php
class Controller
{
    protected function view(string $template, array $data = []): void
    {
        extract($data);
        $viewPath = __DIR__ . '/../Views/' . $template . '.php';
        if (!file_exists($viewPath)) {
            http_response_code(404);
            echo 'View not found';
            return;
        }
        require __DIR__ . '/../Views/partials/header.php';
        require $viewPath;
        require __DIR__ . '/../Views/partials/footer.php';
    }

    protected function redirect(string $route): void
    {
        header('Location: ' . $route);
        exit;
    }
}
