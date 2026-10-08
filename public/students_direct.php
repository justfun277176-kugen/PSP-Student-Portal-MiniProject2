<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../controllers/StudentController.php';

$controller = new StudentController($pdo);
$controller->index();
