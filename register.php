<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nim = $_POST['nim'];
  $nama = $_POST['nama'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $no_telepon = $_POST['no_telepon'];
  $tanggal_lahir = $_POST['tanggal_lahir'];
  $password = $_POST['password'];
  $ulangi_password = $_POST['ulangi_password'];

  if ($password !== $ulangi_password) {
    $error = "Password dan Ulangi Password tidak sama!";
  } else {
    // Cek duplikasi NIM, Username, Email
    $cek = $conn->prepare("SELECT * FROM mahasiswa WHERE nim = ? OR username = ? OR email = ?");
    $cek->bind_param("sss", $nim, $username, $email);
    $cek->execute();
    $result = $cek->get_result();

    if ($result->num_rows > 0) {
      $data = $result->fetch_assoc();
      if ($data['nim'] == $nim) {
        $error = "NIM sudah digunakan.";
      } elseif ($data['username'] == $username) {
        $error = "Username sudah digunakan.";
      } elseif ($data['email'] == $email) {
        $error = "Email sudah digunakan.";
      } else {
        $error = "Data sudah terdaftar.";
      }
    } else {
      // Lanjut insert
      $password_hashed = password_hash($password, PASSWORD_DEFAULT);

      $stmt = $conn->prepare("INSERT INTO mahasiswa (nim, username, password, nama, no_telepon, tanggal_lahir, email) VALUES (?, ?, ?, ?, ?, ?, ?)");
      $stmt->bind_param("sssssss", $nim, $username, $password_hashed, $nama, $no_telepon, $tanggal_lahir, $email);

      if ($stmt->execute()) {
        header("Location: login.php");
        exit();
      } else {
        $error = "Gagal mendaftar. Silakan coba lagi.";
      }
    }
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - EduTracker</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(135deg, #6a11cb, #2575fc);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      color: white;
    }
    .register-container {
      background: rgba(255, 255, 255, 0.1);
      padding: 40px;
      border-radius: 16px;
      backdrop-filter: blur(10px);
      box-shadow: 0 0 20px rgba(0,0,0,0.3);
      width: 300px;
    }
    .register-container h2 {
      text-align: center;
      margin-bottom: 20px;
    }
    input[type="text"], input[type="password"], input[type="date"], input[type="email"] {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border: none;
      border-radius: 8px;
    }
    button {
      width: 100%;
      padding: 10px;
      background: #6a11cb;
      border: none;
      color: white;
      border-radius: 8px;
      cursor: pointer;
      transition: 0.3s;
    }
    button:hover {
      background: #2575fc;
    }
    .error {
      color: #ff6b6b;
      background-color: rgba(255, 255, 255, 0.2);
      padding: 10px;
      margin-bottom: 15px;
      border-radius: 8px;
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="register-container">
    <h2>Daftar Akun</h2>
    <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>
    <form method="POST">
      <input type="text" name="nim" placeholder="NIM" required>
      <input type="text" name="nama" placeholder="Nama Lengkap" required>
      <input type="text" name="username" placeholder="Username" required>
      <input type="email" name="email" placeholder="Email" required>
      <input type="text" name="no_telepon" placeholder="No. Telepon" required>
      <input type="date" name="tanggal_lahir" required>
      <input type="password" name="password" placeholder="Password" required>
      <input type="password" name="ulangi_password" placeholder="Ulangi Password" required>
      <button type="submit">Daftar</button>
    </form>
  </div>
</body>
</html>
