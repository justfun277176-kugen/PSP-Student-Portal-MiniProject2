<?php $pageTitle='Change Password'; require __DIR__ . '/../layouts/header.php'; ?>
<div class="row justify-content-center">
    <div class="col-md-7 col-lg-6">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4 p-sm-5">
                <h3 class="fw-bold mb-1">Password Exchange Module</h3>
                <p class="text-muted mb-4">Update your account password securely (Part 1.2)</p>

                <?php if ($success): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success:</strong> <?= e($success) ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong class="d-block mb-1">Validation Errors:</strong>
                        <ul class="mb-0 ps-3">
                            <?php foreach ($errors as $error): ?>
                                <li><?= e($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form method="post" action="<?= BASE_URL ?>/index.php?action=password" id="passwordForm" class="needs-validation" novalidate>
                    <input type="hidden" name="csrf_token" value="<?= e(csrfToken()) ?>">
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Old Password</label>
                        <input type="password" name="old_password" class="form-control" required placeholder="Enter current password">
                        <div class="invalid-feedback">Old password is required.</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">New Password</label>
                        <input type="password" name="new_password" id="newPassword" class="form-control" minlength="8" required placeholder="Enter new password (min 8 chars)">
                        <div class="form-text">Password must contain at least 8 characters.</div>
                        <div class="invalid-feedback">New password must contain at least 8 characters.</div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Confirm Password</label>
                        <input type="password" name="confirm_password" id="confirmPassword" class="form-control" minlength="8" required placeholder="Re-enter new password">
                        <div class="invalid-feedback" id="confirmPasswordFeedback">Confirmation password must match new password.</div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold shadow-sm">Update Password</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>

