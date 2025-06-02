<?php
// === profile.php ===
session_start();
include 'koneksi.php';

$id = $_SESSION['user_id'];

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama = $conn->real_escape_string($_POST['nama']);
  $no_telepon = $conn->real_escape_string($_POST['no_telepon']);
  $tanggal_lahir = $conn->real_escape_string($_POST['tanggal_lahir']);
  
  $sql = "UPDATE mahasiswa 
          SET nama='$nama', no_telepon='$no_telepon', tanggal_lahir='$tanggal_lahir' 
          WHERE id=$id";

  if ($conn->query($sql)) {
    $message = "Profil berhasil diperbarui.";
  } else {
    $message = "Terjadi kesalahan: " . $conn->error;
  }
}

$data = $conn->query("SELECT * FROM mahasiswa WHERE id=$id")->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Profil - EDUTRACKER</title>
  <link rel="stylesheet" href="style-profile.css" />
</head>
<body>
  <div class="container">
    <h1>👤 Profil Pengguna</h1>

    <?php if ($message): ?>
      <div class="message"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <div class="card">
      <form method="POST" class="profile-form">
        <label for="nama">Nama</label>
        <input id="nama" name="nama" value="<?= htmlspecialchars($data['nama']) ?>" required />

        <label for="no_telepon">No Telepon</label>
        <input id="no_telepon" name="no_telepon" value="<?= htmlspecialchars($data['no_telepon']) ?>" required />

        <label for="tanggal_lahir">Tanggal Lahir</label>
        <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="<?= $data['tanggal_lahir'] ?>" required />

        <button type="submit">Simpan</button>
      </form>

      <hr />

      <div class="profile-info">
        <p><strong>Nama:</strong> <?= htmlspecialchars($data['nama']) ?></p>
        <p><strong>No Telepon:</strong> <?= htmlspecialchars($data['no_telepon']) ?></p>
        <p><strong>Tanggal Lahir:</strong> <?= htmlspecialchars($data['tanggal_lahir']) ?></p>
        <p><strong>Status:</strong> Mahasiswa</p>
      </div>
    </div>
  </div>
</body>
</html>