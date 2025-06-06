<?php
session_start();
include 'koneksi.php';

// Cek login admin
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

$mahasiswa_id = $_GET['id'] ?? null;

// Cek parameter
if (!$mahasiswa_id) {
    echo "ID Mahasiswa tidak ditemukan.";
    exit;
}

// Ambil data mahasiswa
$result = $conn->query("SELECT * FROM mahasiswa WHERE id=$mahasiswa_id");
$mahasiswa = $result->fetch_assoc();
if (!$mahasiswa) {
    echo "Data mahasiswa tidak ditemukan.";
    exit;
}

// Ambil semua tugas mahasiswa
$tugas = $conn->query("SELECT * FROM tugas WHERE mahasiswa_id=$mahasiswa_id ORDER BY deadline ASC");

// Ambil notifikasi tugas yang mendekati deadline
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
  <title>Detail Tugas Mahasiswa - EDUTRACKER</title>
  <link rel="stylesheet" href="style-lihat-tugas.css">
  <style>
    .container {
      max-width: 900px;
      margin: 40px auto;
      background: #fff;
      padding: 30px;
      border-radius: 16px;
      box-shadow: 0 8px 24px rgba(0,0,0,0.1);
    }

    h1, h2 {
      color: #333;
    }

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

    .btn {
      text-decoration: none;
      padding: 5px 10px;
      margin-top: 10px;
      display: inline-block;
      background-color: #007bff;
      color: white;
      border-radius: 5px;
    }

    .btn-back {
      background-color: #6c757d;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>📋 Tugas Mahasiswa</h1>
    <h2><?= htmlspecialchars($mahasiswa['nama']) ?> (NIM: <?= htmlspecialchars($mahasiswa['nim']) ?>)</h2>

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
          <h3><?= htmlspecialchars($row['mata_kuliah']) ?> - <?= htmlspecialchars($row['jenis']) ?></h3>
          <p><?= htmlspecialchars($row['deskripsi']) ?></p>
          <p><strong>Deadline:</strong> <?= htmlspecialchars($row['deadline']) ?></p>
          <p><strong>Status:</strong> <?= htmlspecialchars($row['status']) ?></p>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <p>Mahasiswa ini belum memiliki tugas.</p>
    <?php endif; ?>

    <a href="admin_dashboard.php" class="btn btn-back">← Kembali ke Dashboard</a>
  </div>
</body>
</html>
