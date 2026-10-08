<?php
declare(strict_types=1);

class StudentModel
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function all(): array
    {
        $sql = "SELECT id, name, nric, program, marks, profile_picture FROM students ORDER BY id ASC";
        $stmt = $this->pdo->query($sql);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return is_array($rows) ? $rows : [];
    }

    public function find(int $id): ?array
    {
        $stmt = $this->pdo->prepare(
            "SELECT id, name, nric, program, marks, profile_picture
             FROM students
             WHERE id = :id
             LIMIT 1"
        );
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row !== false ? $row : null;
    }

    public function create(string $name, string $nric, string $program, float $marks): bool
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO students (name, nric, program, marks)
             VALUES (:name, :nric, :program, :marks)"
        );

        return $stmt->execute([
            ':name' => $name,
            ':nric' => $nric,
            ':program' => $program,
            ':marks' => $marks
        ]);
    }

    public function update(int $id, string $name, string $nric, string $program, float $marks): bool
    {
        $stmt = $this->pdo->prepare(
            "UPDATE students
             SET name = :name,
                 nric = :nric,
                 program = :program,
                 marks = :marks
             WHERE id = :id"
        );

        return $stmt->execute([
            ':id' => $id,
            ':name' => $name,
            ':nric' => $nric,
            ':program' => $program,
            ':marks' => $marks
        ]);
    }

    public function updateProfilePicture(int $id, ?string $filename): bool
    {
        $stmt = $this->pdo->prepare(
            "UPDATE students SET profile_picture = :profile_picture WHERE id = :id"
        );
        return $stmt->execute([
            ':profile_picture' => $filename,
            ':id' => $id
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare(
            "DELETE FROM students WHERE id = :id"
        );

        return $stmt->execute([':id' => $id]);
    }
}
