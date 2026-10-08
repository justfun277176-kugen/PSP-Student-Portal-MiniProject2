<?php $pageTitle='Login'; require __DIR__ . '/../layouts/header.php'; ?>
<div class="row justify-content-center my-4">
    <div class="col-md-6 col-lg-5">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4 p-sm-5">
                <div class="text-center mb-4">
                    <h2 class="fw-bold text-primary mb-1">PSP Student Portal</h2>
                    <p class="text-muted">Sign in with your NRIC or Administrator ID</p>
                </div>

                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong class="d-block mb-1">Authentication Error:</strong>
                        <ul class="mb-0 ps-3">
                            <?php foreach ($errors as $error): ?>
                                <li><?= e($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form method="post" action="<?= BASE_URL ?>/index.php?action=login" class="needs-validation" novalidate>
                    <input type="hidden" name="csrf_token" value="<?= e(csrfToken()) ?>">
                    
                    <div class="form-floating mb-3">
                        <input type="text" name="username" id="usernameInput" class="form-control" placeholder="NRIC / Username" required maxlength="50" value="<?= e($_POST['username'] ?? '') ?>">
                        <label for="usernameInput">NRIC / Username</label>
                        <div class="invalid-feedback">Please enter your NRIC or username.</div>
                    </div>

                    <div class="form-floating mb-4">
                        <input type="password" name="password" id="passwordInput" class="form-control" placeholder="Password" required>
                        <label for="passwordInput">Password</label>
                        <div class="invalid-feedback">Please enter your password.</div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold shadow-sm">Sign In</button>
                </form>

                <div class="card bg-light border-0 mt-4">
                    <div class="card-body p-3">
                        <h6 class="fw-bold text-secondary mb-2">Demonstration Credentials</h6>
                        <div class="small">
                            <div class="d-flex justify-content-between mb-1">
                                <span>Student NRIC:</span>
                                <code>010101-01-0101</code>
                            </div>
                            <div class="d-flex justify-content-between mb-1">
                                <span>Student Password:</span>
                                <code>Student@123</code>
                            </div>
                            <hr class="my-2">
                            <div class="d-flex justify-content-between mb-1">
                                <span>Admin Username:</span>
                                <code>admin</code>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span>Admin Password:</span>
                                <code>Admin@123</code>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>

