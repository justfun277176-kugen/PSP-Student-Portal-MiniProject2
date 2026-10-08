<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/auth.php';
require_once __DIR__ . '/../config/csrf.php';

require_once __DIR__ . '/../controllers/AuthController.php';
require_once __DIR__ . '/../controllers/ProfileController.php';
require_once __DIR__ . '/../controllers/StudentController.php';

$authController = new AuthController($pdo);
$profileController = new ProfileController($pdo);
$studentController = new StudentController($pdo);

$action = $_GET['action'] ?? 'login';

switch ($action) {
    case 'login':
        $authController->login();
        break;

    case 'logout':
        $authController->logout();
        break;

    case 'dashboard':
        require_once __DIR__ . '/../config/auth.php';
        requireLogin();
        require __DIR__ . '/../views/dashboard.php';
        break;

    case 'profile':
        $profileController->index();
        break;

    case 'upload_profile_picture':
        $profileController->uploadProfilePicture();
        break;

    case 'password':
        $authController->changePassword();
        break;

    case 'students':
        $studentController->index();
        break;

    case 'student_create':
        $studentController->create();
        break;

    case 'student_edit':
        $studentController->edit();
        break;

    case 'student_delete':
        $studentController->delete();
        break;

    case 'students_direct':
        require __DIR__ . '/students_direct.php';
        break;

    default:
        http_response_code(404);
        echo '404 Not Found';
        break;
}
