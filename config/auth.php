<?php
declare(strict_types=1);
require_once __DIR__ . '/config.php';

function requireLogin(): void {
    if (empty($_SESSION['user_id'])) {
        header('Location: ' . BASE_URL . '/index.php?action=login');
        exit;
    }
}

function requireAdmin(): void {
    requireLogin();
    if (($_SESSION['role'] ?? '') !== 'admin') {
        http_response_code(403);
        exit('403 Forbidden: Admin access required.');
    }
}

function requireStudent(): void {
    requireLogin();
    if (($_SESSION['role'] ?? '') !== 'student') {
        http_response_code(403);
        exit('403 Forbidden: Student profile access required.');
    }
}


function currentUserId(): int {
    return (int)($_SESSION['user_id'] ?? 0);
}

function e(string $value): string {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
