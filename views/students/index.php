<?php
declare(strict_types=1);

$pageTitle = 'Student CRUD';

require __DIR__ . '/../layouts/header.php';

$studentRows = is_array($students ?? null)
    ? array_values($students)
    : [];
?>

<div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">

    <div>
        <h1 class="fw-bold mb-1">
            Student Grade Management
        </h1>

        <p class="text-muted mb-0">
            Part 2 Grade Management System Revamp —
            Dynamic MySQL Data View
        </p>
    </div>

    <a
        href="<?= BASE_URL ?>/index.php?action=student_create"
        class="btn btn-primary fw-bold"
    >
        + Add New Student
    </a>

</div>

<?php if (isset($_GET['msg'])): ?>
    <?php if ($_GET['msg'] === 'created'): ?>
        <div class="alert alert-success alert-dismissible fade show mb-4 shadow-sm" role="alert">
            <strong>Success!</strong> New student record has been created in MySQL.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php elseif ($_GET['msg'] === 'updated'): ?>
        <div class="alert alert-info alert-dismissible fade show mb-4 shadow-sm" role="alert">
            <strong>Success!</strong> Student record has been updated successfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php elseif ($_GET['msg'] === 'deleted'): ?>
        <div class="alert alert-warning alert-dismissible fade show mb-4 shadow-sm" role="alert">
            <strong>Success!</strong> Student record has been removed from the database.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
<?php endif; ?>

<div class="card shadow-sm border-0">

    <div class="card-header bg-white py-3">

        <h4 class="mb-0 fw-bold text-secondary">

            All Registered Student Records

            <span class="badge bg-primary">
                <?= count($studentRows) ?>
            </span>

        </h4>

    </div>


    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-bordered table-hover mb-0">

                <thead class="table-dark">

                    <tr>
                        <th style="width:70px;">ID</th>
                        <th>Full Name</th>
                        <th>IC / NRIC</th>
                        <th>Academic Program</th>
                        <th style="width:130px;">Marks</th>
                        <th style="width:190px;">Actions</th>
                    </tr>

                </thead>


                <tbody>

                <?php if (empty($studentRows)): ?>

                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <strong>No student records found.</strong>
                        </td>
                    </tr>

                <?php else: ?>

                    <?php foreach ($studentRows as $student): ?>

                        <tr>

                            <td>
                                <?= e((string)$student['id']) ?>
                            </td>


                            <td>
                                <strong>
                                    <?= e((string)$student['name']) ?>
                                </strong>
                            </td>


                            <td>
                                <?= e((string)$student['nric']) ?>
                            </td>


                            <td>
                                <?= e((string)$student['program']) ?>
                            </td>


                            <td>
                                <span class="badge bg-success fs-6">
                                    <?= number_format(
                                        (float)$student['marks'],
                                        2
                                    ) ?>
                                </span>
                            </td>


                            <td>

                                <a
                                    href="<?= BASE_URL ?>/index.php?action=student_edit&id=<?= (int)$student['id'] ?>"
                                    class="btn btn-sm btn-outline-primary"
                                >
                                    Edit
                                </a>


                                <form
                                    method="POST"
                                    action="<?= BASE_URL ?>/index.php?action=student_delete"
                                    style="display:inline;"
                                    onsubmit="return confirm(
                                        'Are you sure you want to delete <?= e((string)$student['name']) ?>?'
                                    );"
                                >

                                    <input
                                        type="hidden"
                                        name="csrf_token"
                                        value="<?= e(csrfToken()) ?>"
                                    >

                                    <input
                                        type="hidden"
                                        name="id"
                                        value="<?= (int)$student['id'] ?>"
                                    >

                                    <button
                                        type="submit"
                                        class="btn btn-sm btn-outline-danger"
                                    >
                                        Delete
                                    </button>

                                </form>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>


<?php require __DIR__ . '/../layouts/footer.php'; ?>