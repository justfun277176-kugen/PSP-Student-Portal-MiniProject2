<?php $pageTitle='Update Student'; require __DIR__ . '/../layouts/header.php'; ?>
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4 p-sm-5">
                <h2 class="fw-bold mb-1">Update Student Record</h2>
                <p class="text-muted mb-4">Modify existing student details in MySQL (Part 2 UPDATE)</p>

                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong class="d-block mb-1">Validation Errors:</strong>
                        <ul class="mb-0 ps-3">
                            <?php foreach ($errors as $err): ?>
                                <li><?= e($err) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form method="post" action="<?= BASE_URL ?>/index.php?action=student_edit&id=<?= (int)$student['id'] ?>" class="needs-validation" novalidate>
                    <input type="hidden" name="csrf_token" value="<?= e(csrfToken()) ?>">
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Full Name</label>
                        <input type="text" name="name" class="form-control" required minlength="2" maxlength="100" value="<?= e($_POST['name'] ?? $student['name']) ?>">
                        <div class="invalid-feedback">Name is required (minimum 2 characters).</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">IC / NRIC Number</label>
                        <input type="text" name="nric" class="form-control font-monospace" required maxlength="20" value="<?= e($_POST['nric'] ?? $student['nric']) ?>">
                        <div class="invalid-feedback">IC / NRIC number is required.</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Academic Program</label>
                        <input type="text" name="program" class="form-control" required maxlength="150" value="<?= e($_POST['program'] ?? $student['program']) ?>">
                        <div class="invalid-feedback">Academic Program is required.</div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Student Marks (0.00 - 100.00)</label>
                        <input type="number" name="marks" class="form-control" min="0" max="100" step="0.01" required value="<?= e($_POST['marks'] ?? (string)$student['marks']) ?>">
                        <div class="invalid-feedback">Marks must be a number between 0 and 100.</div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg fw-bold shadow-sm me-2">Save Changes</button>
                    <a class="btn btn-light btn-lg fw-semibold" href="<?= BASE_URL ?>/index.php?action=students">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>

