<?php
require_once __DIR__ . '/config.php';

session_start();

function require_login(): void
{
    if (empty($_SESSION['user'])) {
        header('Location: index.php');
        exit;
    }
}

function is_admin(): bool
{
    return !empty($_SESSION['user']) && $_SESSION['user']['role'] === 'admin';
}

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
