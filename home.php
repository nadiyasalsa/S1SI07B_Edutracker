<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'koneksi.php';

// Periksa apakah session 'nim' tersedia
$nim = isset($_SESSION['nim']) ? $_SESSION['nim'] : '';
$today = date("Y-m-d");

// Pastikan koneksi database tersedia dan nim tidak kosong
$jumlah = 0;
if ($conn && $nim !== '') {  // Ganti $koneksi menjadi $conn
    $query = "SELECT * FROM tugas WHERE deadline = '$today' AND id NOT IN 
              (SELECT id_tugas FROM tugas_selesai WHERE nim = '$nim')";
    $result = mysqli_query($conn, $query);  // Ganti $koneksi menjadi $conn
    $jumlah = mysqli_num_rows($result);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Beranda - EDUTRACKER</title>
  <link rel="stylesheet" href="style-home.css">
  <style>
    .message {
      background: linear-gradient(90deg, #e91e63, #8e24aa);
      color: white;
      padding: 15px;
      margin: 20px auto;
      border-radius: 12px;
      width: 80%;
      font-weight: bold;
      text-align: center;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }
    .modal {
      display: none;
      position: fixed;
      z-index: 999;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background: rgba(0, 0, 0, 0.4);
      justify-content: center;
      align-items: center;
    }
    .modal-card {
      background: #fff;
      padding: 30px;
      border-radius: 20px;
      text-align: center;
      max-width: 300px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    }
    .modal-card h2 {
      margin-bottom: 20px;
      color: #333;
    }
    .btn-confirm {
      background: #6a11cb;
      color: white;
      border: none;
      border-radius: 8px;
      padding: 10px 20px;
      margin: 10px;
      cursor: pointer;
    }
    .btn-cancel {
      background: #ccc;
      color: black;
      border: none;
      border-radius: 8px;
      padding: 10px 20px;
      margin: 10px;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <nav>
    <h1>EDUTRACKER</h1>
    <div class="menu">
      <a href="tambah_tugas.php">Tambah Tugas</a>
      <a href="lihat_tugas.php">Lihat Tugas</a>
      <a href="notifikasi.php">Notifikasi</a>
      <a href="profile.php">Profile</a>
      <a href="#" onclick="showModal()">Logout</a>
    </div>
  </nav>

  <?php if ($jumlah > 0): ?>
  <div class="message">
    Anda memiliki <strong><?= $jumlah ?></strong> tugas yang harus diselesaikan hari ini. Segera kerjakan!
  </div>
  <?php endif; ?>

  <main>
    <div class="intro">
      <h2>Selamat Datang di <span>EDUTRACKER</span>!</h2>
      <p>EDUTRACKER adalah platform manajemen tugas kuliah yang dirancang khusus untuk membantumu menjadi mahasiswa yang lebih terorganisir dan produktif. Dengan EDUTRACKER, kamu bisa:</p>
      <ul>
        <li>📌 Menambahkan dan memantau semua tugas kuliahmu dengan mudah</li>
        <li>📅 Melihat deadline berdasarkan tanggal secara rapi</li>
        <li>🔔 Mendapatkan notifikasi pengingat tugas yang belum selesai</li>
        <li>🗂 Mengelola profil dan datamu sendiri kapan saja</li>
      </ul>
      <p>Cukup login, dan semua tugas pentingmu ada dalam satu tempat. Tak ada lagi yang terlewat atau terlambat!</p>
      <p>Yuk, mulai produktif bareng <strong>EDUTRACKER</strong> dan capai kesuksesan akademikmu!</p>
    </div>
    <div class="image">
      <img src="logoedutracker.png" alt="Ilustrasi EDUTRACKER">
    </div>
  </main>

  <!-- Modal Konfirmasi Logout -->
  <div id="logoutModal" class="modal">
    <div class="modal-card">
      <h2>Yakin ingin keluar?</h2>
      <button class="btn-confirm" onclick="window.location.href='logout.php'">Ya</button>
      <button class="btn-cancel" onclick="closeModal()">Batal</button>
    </div>
  </div>

  <script>
    function showModal() {
      document.getElementById('logoutModal').style.display = 'flex';
    }
    function closeModal() {
      document.getElementById('logoutModal').style.display = 'none';
    }
  </script>
</body>
</html>
