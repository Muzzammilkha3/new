<?php
class Auth
{
    public static function check(): bool
    {
        return isset($_SESSION['user']);
    }

    public static function user(): ?array
    {
        return $_SESSION['user'] ?? null;
    }

    public static function login(array $user): void
    {
        $_SESSION['user'] = $user;
    }

    public static function logout(): void
    {
        unset($_SESSION['user']);
    }

    public static function requireLogin(): void
    {
        if (!self::check()) {
            header('Location: /?route=login');
            exit;
        }
    }

    public static function hasRole(string $role): bool
    {
        return self::check() && ($_SESSION['user']['role'] ?? '') === $role;
    }

    public static function requireRole(string $role): void
    {
        self::requireLogin();
        if (!self::hasRole($role)) {
            http_response_code(403);
            echo 'Access denied';
            exit;
        }
    }
}
