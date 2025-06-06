<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cek username dan password hardcoded
    if ($username === 'admincantik' && $password === '12345') {
        // Login sukses, set session
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $username;
        header("Location: admin_dashboard.php"); // arahkan ke dashboard admin
        exit;
    } else {
        $error = "Username atau password salah.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Login Admin - EduTracker</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #b721ff, #21d4fd);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .form-box {
            background: rgba(255, 255, 255, 0.15);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.3);
            width: 350px;
            backdrop-filter: blur(10px);
            color: white;
            text-align: center;
        }
        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: none;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.2);
            color: white;
        }
        input::placeholder {
            color: #eee;
        }
        button {
            width: 100%;
            padding: 12px;
            background-color: #7b2ff7;
            color: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        button:hover {
            background-color: #5a00f0;
        }
        .error {
            color: #ff6b6b;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="form-box">
        <h2>Login Admin</h2>
        <?php if (isset($error)) { echo "<div class='error'>$error</div>"; } ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required />
            <input type="password" name="password" placeholder="Password" required />
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
