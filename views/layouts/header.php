<?php
require_once __DIR__ . '/../../config/auth.php';
$pageTitle = $pageTitle ?? 'PSP Student Portal';
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($pageTitle) ?> | PSP Student Portal</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="<?= BASE_URL ?>/css/style.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
<div class="container">
<a class="navbar-brand fw-bold" href="<?= BASE_URL ?>/index.php?action=dashboard">PSP Student Portal</a>
<?php if (!empty($_SESSION['user_id'])): ?>
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu"><span class="navbar-toggler-icon"></span></button>
<div class="collapse navbar-collapse" id="navMenu">
<ul class="navbar-nav ms-auto align-items-lg-center">
<li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/index.php?action=dashboard">Dashboard</a></li>
<?php if (($_SESSION['role'] ?? '') === 'student'): ?>
<li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/index.php?action=profile">My Profile</a></li>
<li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/index.php?action=password">Change Password</a></li>
<?php endif; ?>
<?php if (($_SESSION['role'] ?? '') === 'admin'): ?>
<li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/index.php?action=students">Student CRUD</a></li>
<?php endif; ?>
<li class="nav-item ms-lg-2"><a class="btn btn-light btn-sm" href="<?= BASE_URL ?>/index.php?action=logout">Logout</a></li>
</ul>
</div>
<?php endif; ?>
</div>
</nav>
<main class="container py-4">
