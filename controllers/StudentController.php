<?php
declare(strict_types=1);

require_once __DIR__ . '/../models/StudentModel.php';

class StudentController
{
    private StudentModel $model;

    public function __construct(PDO $pdo)
    {
        $this->model = new StudentModel($pdo);
    }

    private function validate(array $data): array
    {
        $errors = [];

        $name = trim($data['name'] ?? '');
        $nric = trim($data['nric'] ?? '');
        $program = trim($data['program'] ?? '');
        $marks = trim((string)($data['marks'] ?? ''));

        if ($name === '' || strlen($name) < 2) {
            $errors[] = 'Name must contain at least 2 characters.';
        }

        if ($nric === '') {
            $errors[] = 'IC / NRIC is required.';
        }

        if ($program === '') {
            $errors[] = 'Program is required.';
        }

        if (
            $marks === '' ||
            !is_numeric($marks) ||
            (float)$marks < 0 ||
            (float)$marks > 100
        ) {
            $errors[] = 'Marks must be between 0 and 100.';
        }

        return $errors;
    }

    public function index(): void
    {
        require_once __DIR__ . '/../config/auth.php';
        require_once __DIR__ . '/../config/csrf.php';
        requireAdmin();

        // Always read the complete students table from the same PDO connection
        // used by CREATE / UPDATE / DELETE.
        $students = $this->model->all();
        $studentCount = count($students);

        require __DIR__ . '/../views/students/index.php';
    }

    public function create(): void
    {
        require_once __DIR__ . '/../config/auth.php';
        require_once __DIR__ . '/../config/csrf.php';
        requireAdmin();

        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            verifyCsrf();
            $errors = $this->validate($_POST);

            if (!$errors) {
                try {
                    $this->model->create(
                        trim($_POST['name']),
                        trim($_POST['nric']),
                        trim($_POST['program']),
                        (float)$_POST['marks']
                    );

                    header(
                        'Location: ' .
                        BASE_URL .
                        '/index.php?action=students&msg=created'
                    );
                    exit;
                } catch (PDOException $e) {
                    $errors[] = 'Unable to create record. NRIC may already exist.';
                }
            }
        }

        require __DIR__ . '/../views/students/create.php';
    }

    public function edit(): void
    {
        require_once __DIR__ . '/../config/auth.php';
        require_once __DIR__ . '/../config/csrf.php';
        requireAdmin();

        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if (!$id) {
            exit('Invalid student ID.');
        }

        $student = $this->model->find($id);

        if (!$student) {
            exit('Student record not found.');
        }

        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            verifyCsrf();
            $errors = $this->validate($_POST);

            if (!$errors) {
                try {
                    $this->model->update(
                        $id,
                        trim($_POST['name']),
                        trim($_POST['nric']),
                        trim($_POST['program']),
                        (float)$_POST['marks']
                    );

                    header(
                        'Location: ' .
                        BASE_URL .
                        '/index.php?action=students&msg=updated'
                    );
                    exit;
                } catch (PDOException $e) {
                    $errors[] = 'Unable to update record. NRIC may already exist.';
                }
            }
        }

        require __DIR__ . '/../views/students/edit.php';
    }

    public function delete(): void
    {
        require_once __DIR__ . '/../config/auth.php';
        require_once __DIR__ . '/../config/csrf.php';
        requireAdmin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit('POST required.');
        }

        verifyCsrf();

        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

        if (!$id) {
            exit('Invalid student ID.');
        }

        $this->model->delete($id);

        header(
            'Location: ' .
            BASE_URL .
            '/index.php?action=students&msg=deleted'
        );
        exit;
    }
}
