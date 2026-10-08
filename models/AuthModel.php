<?php
declare(strict_types=1);
require_once __DIR__ . '/../config/database.php';

class AuthModel {
    public function __construct(private PDO $pdo) {}

    public function findByLogin(string $username): ?array {
        $sql = "SELECT u.id AS user_id, u.student_id, u.username, u.password_hash, u.role,
                       s.name, s.nric, s.program, s.marks, s.profile_picture
                FROM users u
                LEFT JOIN students s ON s.id = u.student_id
                WHERE u.username = :username LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['username' => $username]);
        return $stmt->fetch() ?: null;
    }

    public function findUserById(int $id): ?array {
        $sql = "SELECT u.id AS user_id, u.student_id, u.username, u.password_hash, u.role,
                       s.name, s.nric, s.program, s.marks, s.profile_picture
                FROM users u
                LEFT JOIN students s ON s.id = u.student_id
                WHERE u.id = :id LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch() ?: null;
    }

    public function updatePassword(int $id, string $hash): bool {
        $stmt = $this->pdo->prepare(
            "UPDATE users SET password_hash = :password_hash WHERE id = :id"
        );
        return $stmt->execute(['password_hash' => $hash, 'id' => $id]);
    }

    public function updateProfilePicture(int $studentId, ?string $filename): bool {
        $stmt = $this->pdo->prepare(
            "UPDATE students SET profile_picture = :profile_picture WHERE id = :id"
        );
        return $stmt->execute([
            'profile_picture' => $filename,
            'id' => $studentId
        ]);
    }
}
