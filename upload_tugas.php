<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = $_POST['judul'];

    $result = mysqli_query($conn, "SELECT tugas FROM mahasiswa WHERE id = $user_id");
    $row = mysqli_fetch_assoc($result);
    $tugas = json_decode($row['tugas'], true) ?? [];

    $tugas[] = ['judul' => $judul];
    $tugasJson = json_encode($tugas);

    $update = mysqli_query($conn, "UPDATE mahasiswa SET tugas = '$tugasJson' WHERE id = $user_id");

    if ($update) {
        $sukses = "Tugas berhasil ditambahkan!";
    } else {
        $error = "Gagal menambahkan tugas.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Upload Tugas</title>
</head>
<body>
    <h2>Upload Tugas Mahasiswa</h2>
    <?php if (!empty($sukses)) echo "<p style='color:green;'>$sukses</p>"; ?>
    <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>

    <form method="POST">
        <label>Judul Tugas:</label><br>
        <input type="text" name="judul" required><br><br>
        <button type="submit">Upload</button>
    </form>
</body>
</html>
