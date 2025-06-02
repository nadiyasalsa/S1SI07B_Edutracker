<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Cek Mahasiswa dari DB
  $stmt = $conn->prepare("SELECT * FROM mahasiswa WHERE username = ?");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();
  if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
      $_SESSION['user_id'] = $user['id'];
      header('Location: home.php');
      exit();
    }
  }

  // Cek Admin dari DB
  $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ?");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();
  if ($result->num_rows === 1) {
    $admin = $result->fetch_assoc();
    if (password_verify($password, $admin['password'])) {
      $_SESSION['id_admin'] = $admin['id'];
      $_SESSION['username'] = $admin['username'];
      header('Location: admin_dashboard.php');
      exit();
    }
  }

  // Cek admin hardcoded
  if ($username === 'admincantik' && $password === '12345') {
    $_SESSION['id_admin'] = 1; 
    $_SESSION['username'] = 'admincantik';
    header('Location: admin_dashboard.php');
    exit();
  }

  $error = "Login gagal. Username atau password salah.";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Login - EduTracker</title>
  <style>
    body {
      margin: 0; padding: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #6a11cb, #2575fc);
      height: 100vh;
      display: flex; justify-content: center; align-items: center;
      color: white;
    }
    .login-box {
      background: rgba(255, 255, 255, 0.1);
      padding: 40px 30px;
      border-radius: 20px;
      box-shadow: 0 0 25px rgba(0, 0, 0, 0.3);
      width: 320px;
      backdrop-filter: blur(12px);
      text-align: center;
    }
    .login-box img {
      width: 90px;
      margin-bottom: 20px;
    }
    .login-box h2 {
      margin-bottom: 25px;
      font-weight: 700;
      text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.4);
    }
    input[type="text"], input[type="password"] {
      width: 100%;
      padding: 12px 15px;
      margin: 12px 0;
      border: none;
      border-radius: 12px;
      background: rgba(255, 255, 255, 0.2);
      color: white;
      font-size: 16px;
      outline: none;
      transition: background 0.3s;
    }
    input::placeholder {
      color: #ddd;
    }
    input[type="text"]:focus, input[type="password"]:focus {
      background: rgba(255, 255, 255, 0.35);
    }
    button {
      width: 100%;
      padding: 14px 0;
      margin-top: 15px;
      border: none;
      border-radius: 12px;
      background: linear-gradient(45deg, #6a11cb, #2575fc);
      font-weight: 700;
      font-size: 18px;
      color: white;
      cursor: pointer;
      box-shadow: 0 5px 10px rgba(38, 44, 113, 0.7);
      transition: background 0.3s ease;
    }
    button:hover {
      background: linear-gradient(45deg, #2575fc, #6a11cb);
    }
    .error {
      background: #ff6b6b;
      color: white;
      padding: 10px;
      border-radius: 10px;
      margin-bottom: 15px;
      font-weight: 600;
      box-shadow: 0 0 8px #ff6b6b;
    }
    .admin-btn {
      display: inline-block;
      margin-top: 20px;
      padding: 12px 20px;
      background: rgba(255, 255, 255, 0.15);
      border-radius: 10px;
      color: #fff;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.3s ease;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
    }
    .admin-btn:hover {
      background: rgba(255, 255, 255, 0.3);
      transform: translateY(-2px);
      color: #fff;
    }
  </style>
</head>
<body>
  <div class="login-box">
    <img src="logoedutracker.png" alt="Logo EduTracker" />
    <h2>Login EduTracker</h2>
    <?php if (!empty($error)) echo "<div class='error'>" . htmlspecialchars($error) . "</div>"; ?>
    <form method="POST" autocomplete="off" spellcheck="false">
      <input type="text" name="username" placeholder="Username" required autofocus />
      <input type="password" name="password" placeholder="Password" required />
      <button type="submit">Login</button>
    </form>
    <a href="admin_dashboard.php" class="admin-btn">🔑 Masuk sebagai Admin</a>
  </div>
</body>
</html>
