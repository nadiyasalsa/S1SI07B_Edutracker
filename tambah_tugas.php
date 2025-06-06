<?php
// === tambah_tugas.php ===
session_start();
include 'koneksi.php';

if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit;
}

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $mata_kuliah = $_POST['mata_kuliah'];
  $deskripsi = $_POST['deskripsi'];
  $jenis = $_POST['jenis'];
  $deadline = $_POST['deadline'];
  $status = $_POST['status'];
  $mahasiswa_id = $_SESSION['user_id'];

  $stmt = $conn->prepare("INSERT INTO tugas (mahasiswa_id, mata_kuliah, deskripsi, jenis, deadline, status) VALUES (?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("isssss", $mahasiswa_id, $mata_kuliah, $deskripsi, $jenis, $deadline, $status);

  if ($stmt->execute()) {
    header('Location: lihat_tugas.php');
    exit;
  } else {
    $message = "Gagal menambahkan tugas: " . $conn->error;
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Tugas - EduTracker</title>
  <link rel="stylesheet" href="style-tambah-tugas.css">
</head>
<body>
  <div class="container">
    <h1>📝 Tambah Tugas</h1>

    <?php if ($message): ?>
      <p class="error"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <form method="POST">
      <input type="text" name="mata_kuliah" placeholder="Nama Mata Kuliah" required />
      
      <textarea name="deskripsi" placeholder="Deskripsi Tugas" rows="4" required></textarea>
      
      <select name="jenis" required>
        <option value="">-- Pilih Jenis Tugas --</option>
        <option value="Tugas Harian">Tugas Harian</option>
        <option value="Kuis">Kuis</option>
        <option value="Tugas Besar">Tugas Besar</option>
        <option value="Project">Project</option>
      </select>

      <input type="date" name="deadline" required />

      <select name="status" required>
        <option value="">-- Pilih Status --</option>
        <option value="Belum Selesai">Belum Selesai</option>
        <option value="Selesai">Selesai</option>
      </select>

      <button type="submit">➕ Tambah</button>
    </form>
  </div>
</body>
</html>