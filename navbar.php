<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <img src="logoedutracker.png" alt="EduTracker Logo" width="40" class="me-2">
            EduTracker
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarContent">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link <?= ($current_page == 'index.php') ? 'active' : '' ?>" href="index.php">
                    <i class="bi bi-house-door-fill me-1"></i>Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($current_page == 'form_tambahtugas.php') ? 'active' : '' ?>" href="form_tambahtugas.php">
                        <i class="bi bi-plus-circle me-1"></i>Tambah Tugas
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($current_page == 'form_daftartugas.php') ? 'active' : '' ?>" href="form_daftartugas.php">
                        <i class="bi bi-list-task me-1"></i>Lihat Tugas
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>