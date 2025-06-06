=<?php
// === lihat_tugas.php ===
session_start();
include 'koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$mahasiswa_id = $_SESSION['user_id'];

// Ambil semua tugas
$tugas = $conn->query("SELECT * FROM tugas WHERE mahasiswa_id=$mahasiswa_id ORDER BY deadline ASC");

// Ambil tugas yang mendekati deadline dan belum selesai
$notif = $conn->query("
    SELECT * FROM tugas 
    WHERE mahasiswa_id=$mahasiswa_id 
      AND status != 'Selesai' 
      AND DATEDIFF(deadline, CURDATE()) BETWEEN 0 AND 1
");

$notifikasi_tugas = [];
if ($notif && $notif->num_rows > 0) {
    while ($row = $notif->fetch_assoc()) {
        $notifikasi_tugas[] = $row;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Lihat Tugas - EDUTRACKER</title>
  <link rel="stylesheet" href="style-lihat-tugas.css">
  <style>
    .notif-box {
      background-color: #fff3cd;
      color: #856404;
      padding: 15px;
      border-left: 5px solid #ffecb5;
      border-radius: 10px;
      margin-bottom: 20px;
    }

    .notif-box ul {
      margin: 10px 0 0 15px;
    }

    .card {
      background: #f8f9fa;
      border-radius: 10px;
      padding: 15px;
      margin-bottom: 15px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .actions {
      margin-top: 10px;
    }

    .btn {
      text-decoration: none;
      padding: 5px 10px;
      margin-right: 10px;
      background-color: #007bff;
      color: white;
      border-radius: 5px;
    }

    .btn-danger {
      background-color: #dc3545;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>📋 Daftar Tugas</h1>

    <?php if (!empty($notifikasi_tugas)): ?>
      <div class="notif-box">
        <strong>⚠ Tugas mendekati deadline (kurang dari 2 hari):</strong>
        <ul>
          <?php foreach ($notifikasi_tugas as $nt): ?>
            <li><strong><?= htmlspecialchars($nt['mata_kuliah']) ?>:</strong> <?= htmlspecialchars($nt['deskripsi']) ?> (Deadline: <?= htmlspecialchars($nt['deadline']) ?>)</li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>

    <?php if ($tugas->num_rows > 0): ?>
      <?php while($row = $tugas->fetch_assoc()): ?>
        <div class="card">
          <h2><?= htmlspecialchars($row['mata_kuliah']) ?> - <?= htmlspecialchars($row['jenis']) ?></h2>
          <p><?= htmlspecialchars($row['deskripsi']) ?></p>
          <p><strong>Deadline:</strong> <?= htmlspecialchars($row['deadline']) ?></p>
          <p><strong>Status:</strong> <?= htmlspecialchars($row['status']) ?></p>
          <div class="actions">
            <a href="edit_tugas.php?id=<?= $row['id'] ?>" class="btn">✏️ Edit</a>
            <a href="hapus_tugas.php?id=<?= $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">🗑️ Hapus</a>
          </div>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <p>Tidak ada tugas yang ditemukan.</p>
    <?php endif; ?>
  </div>
</body>
</html>
