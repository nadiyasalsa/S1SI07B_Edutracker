<?php include 'navbar.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduTracker - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="text-center mb-5">
            <img src="logoedutracker.png" alt="Logo EduTracker" width="150" class="mb-4">
            <h1 class="display-4 text-primary fw-bold">Selamat datang di Edutracker</h1>
            <p class=" lead mb-5">Atur tugas dengan mudah, Raih prestasi dengan cerdas!</p>
          
        </div>

        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <div class="card action-card mb-4">
                    <a href="form_tambahtugas.php" class="text-decoration-none">
                        <div class="card-body text-center py-4">
                            <div class="d-flex flex-column align-items-center">
                                <img src="logotambahtugas.png" alt="Tambah Tugas" width="80" class="mb-3">
                                <h3 class="text-primary">Tambah Tugas</h3>
                                <p class="text-muted mb-0">Buat tugas baru dan atur deadline</p>
                            </div>
                        </div>
                    </a>
                </div>
                
                <div class="card action-card">
                    <a href="form_daftartugas.php" class="text-decoration-none">
                        <div class="card-body text-center py-4">
                            <div class="d-flex flex-column align-items-center">
                                <img src="logodaftartugas.png" alt="Daftar Tugas" width="80" class="mb-3">
                                <h3 class="text-primary">Daftar Tugas</h3>
                                <p class="text-muted mb-0">Lihat dan kelola semua tugas</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>