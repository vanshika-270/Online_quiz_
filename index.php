<?php require_once "db.php"; ?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Online Quiz System</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<link href="assets/style.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark home-nav">
<div class="container"><a class="navbar-brand" href="index.php"><i class="bi bi-mortarboard-fill me-2"></i>Online Quiz System</a>
<button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#nav"><span class="navbar-toggler-icon"></span></button>
<div class="collapse navbar-collapse" id="nav"><ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
<li class="nav-item"><a class="nav-link" href="#home">Home</a></li><li class="nav-item"><a class="nav-link" href="#features">Features</a></li><li class="nav-item"><a class="nav-link" href="#about">About</a></li>
<li><a class="btn btn-light btn-sm" href="login.php">Login</a></li><li><a class="btn btn-warning btn-sm ms-lg-1" href="register.php">Register</a></li>
</ul></div></div></nav>
<section id="home" class="gradient-hero hero"><div class="container"><div class="row align-items-center">
<div class="col-lg-7"><span class="badge bg-warning text-dark mb-3">Smart Online Examination Platform</span>
<h1 class="hero-title">ONLINE <span>QUIZ</span><br>SYSTEM</h1>
<p class="lead">Online examination portal for colleges and universities. Conduct quizzes, manage questions, attempt online tests and view results from one platform.</p>
<a href="login.php" class="btn btn-light me-2"><i class="bi bi-box-arrow-in-right"></i> Login Now</a>
<a href="register.php" class="btn btn-warning"><i class="bi bi-person-plus"></i> Register Now</a></div>
<div class="col-lg-5 text-center hero-art"><i class="bi bi-pc-display"></i></div>
</div></div></section>
<section class="py-4 bg-light"><div class="container"><div class="row g-3">
<?php foreach([["bi-people","Students","Manage student accounts"],["bi-person-workspace","Teachers","Create quizzes and questions"],["bi-journal-check","Published Quizzes","Attempt online tests"],["bi-book","Subjects","Organize learning content"]] as $s): ?>
<div class="col-6 col-lg-3"><div class="card stat-card text-center p-3"><i class="bi <?= $s[0] ?> fs-3 text-primary"></i><strong class="mt-2"><?= $s[1] ?></strong><small class="text-muted"><?= $s[2] ?></small></div></div>
<?php endforeach; ?></div></div></section>
<section id="features" class="py-5"><div class="container"><div class="text-center mb-4"><h2 class="fw-bold">System Features</h2><p class="text-muted">Everything required for an effective online college examination system.</p></div>
<div class="row g-4"><?php
$features=[["bi-pencil-square","Online Quiz","Students can attempt quizzes online from any device."],["bi-stopwatch","Quiz Timer","Complete quizzes within the configured examination time."],["bi-bar-chart-fill","Instant Result","Students can view scores and results after submitting quizzes."],["bi-lock-fill","Secure Login","Separate secure accounts for admin, teachers and students."],["bi-book","Practice Material","Students can use practice questions and study material."],["bi-clock-history","Quiz History","Maintain records of previous quiz attempts and results."],["bi-graph-up-arrow","Performance","Track student performance and examination progress."],["bi-pie-chart-fill","Quiz Analysis","Teachers can analyze quiz performance and student results."]];
foreach($features as $f): ?><div class="col-md-6 col-lg-3"><div class="card feature-card h-100 p-4"><i class="bi <?= $f[0] ?> feature-icon"></i><h5 class="fw-bold mt-3"><?= $f[1] ?></h5><p class="text-muted mb-0"><?= $f[2] ?></p></div></div><?php endforeach; ?></div></div></section>
<section id="about" class="py-5 bg-light"><div class="container"><div class="card panel-card"><div class="card-body p-5"><div class="row"><div class="col-lg-7"><h2 class="fw-bold">About Online Quiz System</h2><p class="text-muted">A web-based online examination platform designed for colleges and universities. It supports secure authentication, quiz management, question management, online attempts, automatic result calculation and performance tracking.</p></div><div class="col-lg-5"><ul class="list-unstyled lh-lg mb-0"><li>🟢 Admin Management</li><li>🟢 Teacher Quiz Management</li><li>🟢 Student Online Examination</li><li>🟢 Automatic Result Calculation</li><li>🟢 Performance Tracking</li></ul></div></div></div></div></div></section>
<section class="gradient-hero py-5 text-center"><h2 class="fw-bold">Ready to Start Your Quiz?</h2><p>Login to your account and start your examination.</p><a href="login.php" class="btn btn-light">Login to System</a></section>
<footer class="bg-dark text-white text-center py-3 small">Online Quiz System &copy; <?= date("Y") ?>. All Rights Reserved.</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script></body></html>
