<?php
declare(strict_types=1);
require_once __DIR__ . '/../models/AuthModel.php';

class ProfileController {
    public function __construct(private PDO $pdo) {}

    public function index(): void {
        require_once __DIR__ . '/../config/auth.php';
        requireStudent();


        // Strict session-based access: any URL parameter (e.g. $_GET['id']) or POST parameter is completely ignored.
        $model = new AuthModel($this->pdo);
        $user = $model->findUserById(currentUserId());

        if (!$user) {
            http_response_code(404);
            exit('Profile record not found.');
        }

        $profile = [
            'user_id' => $user['user_id'],
            'username' => $user['username'],
            'role' => ucfirst($user['role']),
            'name' => $user['name'] ?? 'System Administrator',
            'nric' => $user['nric'] ?? $user['username'],
            'program' => $user['program'] ?? 'Administrator Access (All Programs)',
            'marks' => $user['marks'] !== null ? (string)$user['marks'] : 'N/A',
            'profile_picture' => $user['profile_picture'] ?? null
        ];

        require __DIR__ . '/../views/profile/index.php';
    }

    public function uploadProfilePicture(): void {
        require_once __DIR__ . '/../config/auth.php';
        require_once __DIR__ . '/../config/csrf.php';
        requireStudent();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit('Method Not Allowed. POST request required.');
        }

        verifyCsrf();

        $model = new AuthModel($this->pdo);
        $user = $model->findUserById(currentUserId());

        if (!$user || empty($user['student_id'])) {
            http_response_code(403);
            exit('403 Forbidden: Student record not associated with active user session.');
        }

        $studentId = (int)$user['student_id'];

        if (!isset($_FILES['profile_picture']) || $_FILES['profile_picture']['error'] === UPLOAD_ERR_NO_FILE) {
            header('Location: ' . BASE_URL . '/index.php?action=profile&error=' . urlencode('No file selected for upload.'));
            exit;
        }

        if ($_FILES['profile_picture']['error'] !== UPLOAD_ERR_OK) {
            header('Location: ' . BASE_URL . '/index.php?action=profile&error=' . urlencode('File upload failed. Error code: ' . $_FILES['profile_picture']['error']));
            exit;
        }

        $maxSize = 2 * 1024 * 1024; // 2MB limit
        if ($_FILES['profile_picture']['size'] > $maxSize) {
            header('Location: ' . BASE_URL . '/index.php?action=profile&error=' . urlencode('File size exceeds the maximum allowed limit of 2MB.'));
            exit;
        }

        $originalName = $_FILES['profile_picture']['name'];
        $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
        $allowedExts = ['jpg', 'jpeg', 'png'];

        if (!in_array($ext, $allowedExts, true)) {
            header('Location: ' . BASE_URL . '/index.php?action=profile&error=' . urlencode('Invalid file extension. Only JPG, JPEG, and PNG files are allowed.'));
            exit;
        }

        $tmpPath = $_FILES['profile_picture']['tmp_name'];
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $tmpPath);
        finfo_close($finfo);

        $allowedMimes = ['image/jpeg', 'image/png'];
        if (!in_array($mimeType, $allowedMimes, true)) {
            header('Location: ' . BASE_URL . '/index.php?action=profile&error=' . urlencode('Invalid file type (' . $mimeType . '). Only JPG, JPEG, and PNG images are allowed.'));
            exit;
        }

        $newFilename = uniqid('avatar_', true) . '.' . $ext;
        $uploadDir = __DIR__ . '/../public/uploads/profile/';

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $targetPath = $uploadDir . $newFilename;

        if (!move_uploaded_file($tmpPath, $targetPath)) {
            header('Location: ' . BASE_URL . '/index.php?action=profile&error=' . urlencode('Failed to save uploaded file to server storage.'));
            exit;
        }

        // Delete old profile picture if present
        if (!empty($user['profile_picture'])) {
            $oldFileName = basename($user['profile_picture']);
            $oldFilePath = $uploadDir . $oldFileName;
            if (is_file($oldFilePath)) {
                @unlink($oldFilePath);
            }
        }

        // Update database with new filename using prepared statement
        $model->updateProfilePicture($studentId, $newFilename);

        header('Location: ' . BASE_URL . '/index.php?action=profile&msg=uploaded');
        exit;
    }
}

