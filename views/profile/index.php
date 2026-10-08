<?php $pageTitle='My Profile'; require __DIR__ . '/../layouts/header.php'; ?>
<div class="row justify-content-center">
    <div class="col-lg-8">
        <?php if (!empty($_GET['msg']) && $_GET['msg'] === 'uploaded'): ?>
            <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                <strong>Success!</strong> Profile picture updated successfully.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (!empty($_GET['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                <strong>Error:</strong> <?= e($_GET['error']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="card border-0 shadow-sm">
            <div class="card-header bg-primary text-white py-3 d-flex justify-content-between align-items-center">
                <h3 class="mb-0 fw-bold fs-4">My Student Profile</h3>
                <span class="badge bg-light text-primary fw-bold fs-6"><?= e($profile['role']) ?></span>
            </div>
            <div class="card-body p-4">
                <div class="text-center mb-4 pb-3 border-bottom">
                    <?php if (!empty($profile['profile_picture']) && is_file(__DIR__ . '/../../public/uploads/profile/' . $profile['profile_picture'])): ?>
                        <img src="<?= BASE_URL ?>/uploads/profile/<?= e($profile['profile_picture']) ?>" alt="Profile Picture" class="rounded-circle shadow-sm border" style="width: 140px; height: 140px; object-fit: cover;">
                    <?php else: ?>
                        <div class="d-inline-flex justify-content-center align-items-center bg-secondary bg-opacity-10 text-secondary rounded-circle shadow-sm border mb-2" style="width: 140px; height: 140px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                            </svg>
                        </div>
                    <?php endif; ?>
                    <h4 class="fw-bold mt-2 mb-0"><?= e($profile['name']) ?></h4>
                    <span class="text-muted font-monospace small"><?= e($profile['nric']) ?></span>
                </div>

                <div class="row mb-3 pb-3 border-bottom">
                    <div class="col-sm-4 text-muted fw-semibold">Full Name</div>
                    <div class="col-sm-8 fw-bold fs-5 text-dark"><?= e($profile['name']) ?></div>
                </div>
                <div class="row mb-3 pb-3 border-bottom">
                    <div class="col-sm-4 text-muted fw-semibold">NRIC / IC Number</div>
                    <div class="col-sm-8 font-monospace text-dark"><?= e($profile['nric']) ?></div>
                </div>
                <div class="row mb-3 pb-3 border-bottom">
                    <div class="col-sm-4 text-muted fw-semibold">Academic Program</div>
                    <div class="col-sm-8 text-dark"><?= e($profile['program']) ?></div>
                </div>
                <div class="row mb-3 pb-3 border-bottom">
                    <div class="col-sm-4 text-muted fw-semibold">Current Marks</div>
                    <div class="col-sm-8">
                        <span class="badge bg-success fs-6"><?= e($profile['marks']) ?></span>
                    </div>
                </div>

                <!-- Profile Picture Upload Form -->
                <div class="card bg-light border-0 mt-4 mb-4">
                    <div class="card-body p-3">
                        <h5 class="card-title fw-bold fs-6 mb-3 text-dark">Update Profile Picture</h5>
                        <form method="POST" action="<?= BASE_URL ?>/index.php?action=upload_profile_picture" enctype="multipart/form-data">
                            <input type="hidden" name="csrf_token" value="<?= csrfToken() ?>">
                            <div class="mb-3">
                                <label for="profile_picture" class="form-label text-muted small fw-semibold">Choose Image File</label>
                                <input class="form-control" type="file" id="profile_picture" name="profile_picture" accept=".jpg,.jpeg,.png" required>
                                <div class="form-text text-muted small">
                                    Allowed formats: JPG, JPEG, PNG | Maximum size: 2MB
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm px-4">Upload Picture</button>
                        </form>
                    </div>
                </div>

                <div class="alert alert-info mb-0" role="alert">
                    <div>
                        <strong>Security Assertion (Part 1.1):</strong><br>
                        This profile is retrieved strictly using the authenticated session variable (<code>$_SESSION['user_id']</code>). Access control prohibits URL parameter manipulation (e.g. <code>$_GET['id']</code> or <code>$_POST['student_id']</code>).
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>

