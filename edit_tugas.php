<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mata_kuliah = $_POST['mata_kuliah'];
    $deskripsi = $_POST['deskripsi'];
    $jenis = $_POST['jenis'];
    $deadline = $_POST['deadline'];
    $status = $_POST['status'];

    $sql = "UPDATE tugas SET mata_kuliah='$mata_kuliah', deskripsi='$deskripsi', jenis='$jenis', deadline='$deadline', status='$status'
            WHERE id=$id AND mahasiswa_id=$user_id";

    if ($conn->query($sql)) {
        header("Location: lihat_tugas.php");
        exit;
    } else {
        echo "Gagal mengupdate tugas: " . $conn->error;
    }
} else {
    $result = $conn->query("SELECT * FROM tugas WHERE id=$id AND mahasiswa_id=$user_id");
    if ($result->num_rows == 0) {
        echo "Tugas tidak ditemukan.";
        exit;
    }
    $row = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Tugas - EduTracker</title>
    <link rel="stylesheet" href="style-edit.css">
</head>
<body>
    <div class="container">
        <a href="index.php" class="btn-back">← Kembali ke Home</a>
        <h2>Edit Tugas</h2>
        <form method="POST">
            <input type="text" name="mata_kuliah" placeholder="Mata Kuliah" value="<?= htmlspecialchars($row['mata_kuliah']) ?>" required />
            
            <textarea name="deskripsi" placeholder="Deskripsi"><?= htmlspecialchars($row['deskripsi']) ?></textarea>
            
            <select name="jenis" required>
                <option value="Tugas Harian" <?= $row['jenis'] == 'Tugas Harian' ? 'selected' : '' ?>>Tugas Harian</option>
                <option value="Kuis" <?= $row['jenis'] == 'Kuis' ? 'selected' : '' ?>>Kuis</option>
                <option value="Tugas Besar" <?= $row['jenis'] == 'Tugas Besar' ? 'selected' : '' ?>>Tugas Besar</option>
                <option value="Project" <?= $row['jenis'] == 'Project' ? 'selected' : '' ?>>Project</option>
            </select>
            
            <input type="date" name="deadline" value="<?= $row['deadline'] ?>" required />
            
            <select name="status" required>
                <option value="Belum Selesai" <?= $row['status'] == 'Belum Selesai' ? 'selected' : '' ?>>Belum Selesai</option>
                <option value="Selesai" <?= $row['status'] == 'Selesai' ? 'selected' : '' ?>>Selesai</option>
            </select>
            
            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>
