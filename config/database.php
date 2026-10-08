<?php
declare(strict_types=1);
require_once __DIR__ . '/config.php';

$host = 'localhost';
$db = 'psp_student_portal';
$user = 'root';
$pass = '';
$dsn = "mysql:host={$host};dbname={$db};charset=utf8mb4";

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    exit('Database connection failed. Check XAMPP/MySQL and config/database.php.');
}
