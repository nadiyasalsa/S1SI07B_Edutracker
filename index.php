<?php
session_start();
if (isset($_SESSION['user_id']) || isset($_SESSION['admin_id'])) {
  header("Location: home.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>EDUTRACKER</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(135deg, #6a11cb, #2575fc);
      color: white;
      text-align: center;
      padding-top: 100px;
    }

    .container {
      max-width: 600px;
      margin: auto;
    }

    img.logo {
      width: 120px;
      margin-bottom: 20px;
    }

    h1 {
      font-size: 3em;
      margin-bottom: 10px;
    }

    p.tagline {
      font-size: 1.3em;
      margin-bottom: 40px;
    }

    a.button, .logout-btn {
      display: inline-block;
      margin: 10px;
      padding: 12px 24px;
      background: white;
      color: #6a11cb;
      border-radius: 30px;
      text-decoration: none;
      font-weight: bold;
      transition: all 0.3s ease;
      cursor: pointer;
      border: none;
    }

    a.button:hover, .logout-btn:hover {
      background: #ddd;
    }

    /* === MODAL === */
    .modal {
      display: none;
      position: fixed;
      z-index: 999;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.4);
      justify-content: center;
      align-items: center;
    }

    .modal-card {
      background: #fff;
      padding: 30px;
      border-radius: 20px;
      max-width: 320px;
      width: 80%;
      text-align: center;
      color: #333;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
      animation: fadeIn 0.3s ease;
    }

    .modal-card h2 {
      margin-bottom: 20px;
      font-size: 1.5em;
    }

    .modal-card .btn-group {
      display: flex;
      justify-content: center;
      gap: 15px;
    }

    .modal-card button {
      padding: 10px 20px;
      font-size: 14px;
      border-radius: 10px;
      border: none;
      cursor: pointer;
      font-weight: bold;
    }

    .btn-confirm {
      background: linear-gradient(to right, #6a11cb, #2575fc);
      color: white;
    }

    .btn-cancel {
      background: #ddd;
      color: #333;
    }

    @keyframes fadeIn {
      from { transform: scale(0.9); opacity: 0; }
      to { transform: scale(1); opacity: 1; }
    }
  </style>
</head>
<body>
  <div class="container">
    <img src="logoedutracker.png" class="logo" alt="Logo EDUTRACKER">
    <h1>EDUTRACKER</h1>
    <p class="tagline">Kelola tugas kuliahmu dengan efisien dan terstruktur.</p>

    <a href="login.php" class="button">Login</a>
    <a href="register.php" class="button">Daftar Akun</a>

  </div>

  <!-- Modal Logout -->
  <div id="logoutModal" class="modal">
    <div class="modal-card">
      <h2>Yakin ingin keluar?</h2>
      <div class="btn-group">
        <button class="btn-confirm" onclick="confirmLogout()">Ya</button>
        <button class="btn-cancel" onclick="closeModal()">Batal</button>
      </div>
    </div>
  </div>

  <script>
    function showModal() {
      document.getElementById("logoutModal").style.display = "flex";
    }

    function closeModal() {
      document.getElementById("logoutModal").style.display = "none";
    }

    function confirmLogout() {
      window.location.href = "logout.php";
    }
  </script>
</body>
</html>