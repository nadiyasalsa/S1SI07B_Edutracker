<?php
// === notifikasi.php ===
session_start();
include 'koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$id = $_SESSION['user_id'];

$notif_query = $conn->query("
    SELECT * FROM tugas 
    WHERE mahasiswa_id = $id 
      AND status != 'Selesai'
      AND (
          DATEDIFF(deadline, CURDATE()) BETWEEN 0 AND 1
          OR deadline < CURDATE()
      )
    ORDER BY deadline ASC
");

// Simpan hasil ke array supaya bisa digunakan dua kali
$notifikasi = [];
while ($row = $notif_query->fetch_assoc()) {
    $notifikasi[] = $row;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Notifikasi - EDUTRACKER</title>
  <link rel="stylesheet" href="style-lihat-tugas.css">
  <style>
    .card {
      background: #fff3cd;
      border-left: 5px solid #ffc107;
      color: #856404;
      padding: 15px;
      margin-bottom: 15px;
      border-radius: 8px;
    }
    .card.overdue {
      background: #f8d7da;
      border-left: 5px solid #dc3545;
      color: #721c24;
    }
  </style>
</head>
<body>
<div class="container">
  <h1>🔔 Notifikasi Tugas</h1>

  <?php if (count($notifikasi) > 0): ?>
    <?php foreach ($notifikasi as $row): 
        $is_overdue = strtotime($row['deadline']) < strtotime(date('Y-m-d'));
    ?>
      <div class="card <?= $is_overdue ? 'overdue' : '' ?>">
        <h2><?= htmlspecialchars($row['mata_kuliah']) ?> - <?= htmlspecialchars($row['jenis']) ?></h2>
        <p><?= htmlspecialchars($row['deskripsi']) ?></p>
        <p><strong>Deadline:</strong> <?= htmlspecialchars($row['deadline']) ?></p>
        <p><strong>Status:</strong> <?= htmlspecialchars($row['status']) ?></p>
        <?php if ($is_overdue): ?>
          <p><span>⚠️ Tugas sudah melewati deadline!</span></p>
        <?php else: ?>
          <p><span>⏰ Deadline segera datang!</span></p>
        <?php endif; ?>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <p>Tidak ada tugas mendesak atau melewati deadline 🎉</p>
  <?php endif; ?>
</div>
</body>
</html>
