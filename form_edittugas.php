<?php
$activePage = 'home';
include 'navbar.php';
include 'config.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID tugas tidak valid.");
}

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM daftartugas WHERE id_tugas = $id");
$row = mysqli_fetch_assoc($result);

if (!$row) {
    die("Tugas tidak ditemukan.");
}

if (isset($_POST['update'])) {
    $mata_kuliah = $_POST['mata_kuliah'];
    $deskripsi = $_POST['deskripsi'];
    $deadline = $_POST['deadline'];
    $jenis = $_POST['jenis'];
    $status = $_POST['status'];

    $query = "UPDATE daftartugas SET mata_kuliah='$mata_kuliah', deskripsi='$deskripsi', deadline='$deadline', jenis='$jenis', status='$status' WHERE id_tugas=$id";
    
    if (mysqli_query($conn, $query)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tugas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center">Edit Tugas</h2>
        <div class="card p-4 shadow">
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Mata Kuliah:</label>
                    <input type="text" class="form-control" name="mata_kuliah" value="<?= htmlspecialchars($row['mata_kuliah']); ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Deskripsi:</label>
                    <textarea class="form-control" name="deskripsi" required><?= htmlspecialchars($row['deskripsi']); ?></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Deadline:</label>
                    <input type="date" class="form-control" name="deadline" value="<?= htmlspecialchars($row['deadline']); ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Jenis:</label>
                    <select class="form-control" name="jenis">
                        <option value="Tugas Harian" <?= $row['jenis'] == 'Tugas Harian' ? 'selected' : ''; ?>>Tugas Harian</option>
                        <option value="Proyek" <?= $row['jenis'] == 'Proyek' ? 'selected' : ''; ?>>Proyek</option>
                        <option value="Ujian" <?= $row['jenis'] == 'Ujian' ? 'selected' : ''; ?>>Ujian</option>
                        <option value="Quis" <?= $row['jenis'] == 'Quis' ? 'selected' : ''; ?>>Quis</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Status:</label>
                    <select class="form-control" name="status">
                        <option value="Belum Selesai" <?= $row['status'] == 'Belum Selesai' ? 'selected' : ''; ?>>Belum Selesai</option>
                        <option value="Selesai" <?= $row['status'] == 'Selesai' ? 'selected' : ''; ?>>Selesai</option>
                    </select>
                </div>
                <button type="submit" name="update" class="btn btn-primary">Simpan Perubahan</button>
                <a href="index.php" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</body>
</html>
