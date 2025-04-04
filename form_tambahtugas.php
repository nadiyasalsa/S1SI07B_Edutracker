<?php
$activePage = 'add';
include 'navbar.php';
include 'config.php';

if (isset($_POST['submit'])) {
    $mata_kuliah = mysqli_real_escape_string($conn, $_POST['mata_kuliah']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $deadline = $_POST['deadline'];
    $jenis = $_POST['jenis'];
    $status = $_POST['status'];

    $query = "INSERT INTO daftartugas (mata_kuliah, deskripsi, deadline, jenis, status) 
              VALUES ('$mata_kuliah', '$deskripsi', '$deadline', '$jenis', '$status')";
    
    if (mysqli_query($conn, $query)) {
        header("Location: index.php");
        exit();
    } else {
        echo "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Tugas Baru</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-8">
                <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">📝 Tambah Tugas</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Mata Kuliah</label>
                                <input type="text" 
                                       class="form-control" 
                                       name="mata_kuliah" 
                                       placeholder="Contoh: Pemrograman Web" 
                                       required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Deskripsi Tugas</label>
                                <textarea class="form-control" 
                                          name="deskripsi" 
                                          rows="3" 
                                          placeholder="Deskripsikan tugas secara detail"
                                          required></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Deadline</label>
                                <input type="date" 
                                       class="form-control" 
                                       name="deadline" 
                                       required>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Jenis Tugas</label>
                                    <select class="form-select" name="jenis" required>
                                        <option value="" disabled selected>Pilih Jenis</option>
                                        <option value="Tugas Harian">Tugas Harian</option>
                                        <option value="Proyek">Proyek</option>
                                        <option value="Ujian">Ujian</option>
                                        <option value="Quis">Quis</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Status</label>
                                    <select class="form-select" name="status" required>
                                        <option value="Belum Selesai" selected>Belum Selesai</option>
                                        <option value="Selesai">Selesai</option>
                                    </select>
                                </div>
                            </div>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="submit" name="submit" class="btn btn-primary px-4">
                                    <i class="bi bi-save me-2"></i>Simpan
                                </button>
                                <a href="index.php" class="btn btn-secondary px-4">
                                    <i class="bi bi-arrow-left me-2"></i>Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>