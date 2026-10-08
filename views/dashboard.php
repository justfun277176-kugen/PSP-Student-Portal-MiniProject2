<?php $pageTitle='Dashboard'; require __DIR__ . '/layouts/header.php'; ?>
<div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
    <div>
        <h1 class="fw-bold mb-1">Welcome back, <?= e($_SESSION['name'] ?? 'User') ?></h1>
        <p class="text-muted mb-0">PSP Student Portal Dashboard &mdash; Role: <span class="badge bg-primary text-uppercase"><?= e($_SESSION['role'] ?? 'Guest') ?></span></p>
    </div>
</div>

<div class="row g-4">
<?php if (($_SESSION['role'] ?? '') === 'student'): ?>
    <div class="col-md-6">
        <div class="card h-100 border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-primary text-white p-3 rounded-3 me-3 fw-bold">PROFILE</div>
                    <div>
                        <h4 class="fw-bold mb-0">My Student Profile</h4>
                        <small class="text-muted">Part 1.1 Profile Management</small>
                    </div>
                </div>
                <p class="text-secondary">View your official student profile details including Full Name, NRIC, Program, and Marks. Profile access is bound strictly to your authenticated session ID.</p>
                <a class="btn btn-primary fw-bold shadow-sm" href="<?= BASE_URL ?>/index.php?action=profile">View My Profile &rarr;</a>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card h-100 border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-warning text-dark p-3 rounded-3 me-3 fw-bold">SECURITY</div>
                    <div>
                        <h4 class="fw-bold mb-0">Password Security</h4>
                        <small class="text-muted">Part 1.2 Account Security</small>
                    </div>
                </div>
                <p class="text-secondary">Update your account password securely. Old password verification uses <code>password_verify()</code> and new passwords are encrypted using <code>password_hash()</code>.</p>
                <a class="btn btn-outline-primary fw-bold" href="<?= BASE_URL ?>/index.php?action=password">Change Password &rarr;</a>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="col-md-8 col-lg-7">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-success text-white p-3 rounded-3 me-3 fw-bold">CRUD</div>
                    <div>
                        <h4 class="fw-bold mb-0">Student Grade CRUD System</h4>
                        <small class="text-muted">Part 2 Grade Management System Revamp</small>
                    </div>
                </div>
                <p class="text-secondary">Manage dynamic MySQL student records with complete Create, Read, Update, and Delete capabilities powered strictly by PDO Prepared Statements.</p>
                <a class="btn btn-success fw-bold shadow-sm me-2" href="<?= BASE_URL ?>/index.php?action=students">Manage Student CRUD &rarr;</a>
                <a class="btn btn-outline-success fw-bold" href="<?= BASE_URL ?>/index.php?action=student_create">+ Add New Student</a>
            </div>
        </div>
    </div>
    
    <div class="col-md-4 col-lg-5">
        <div class="card border-0 shadow-sm rounded-4 bg-primary text-white">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-3">Administrator Privileges</h5>
                <ul class="mb-0 ps-3">
                    <li class="mb-2">Full CRUD access on student records</li>
                    <li class="mb-2">Direct MySQL database synchronization</li>
                    <li class="mb-2">Strict CSRF & SQL Injection protection</li>
                    <li>Role-based authorization checks</li>
                </ul>
            </div>
        </div>
    </div>
<?php endif; ?>
</div>
<?php require __DIR__ . '/layouts/footer.php'; ?>

