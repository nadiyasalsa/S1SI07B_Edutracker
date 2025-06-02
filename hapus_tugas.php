<?php
// === hapus_tugas.php ===
session_start();
include 'koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $user_id = $_SESSION['user_id'];

    // Pastikan hanya tugas milik user sendiri yang bisa dihapus
    $sql = "DELETE FROM tugas WHERE id = $id AND mahasiswa_id = $user_id";

    if ($conn->query($sql) === TRUE) {
        header("Location: lihat_tugas.php");
        exit;
    } else {
        echo "Gagal menghapus tugas: " . $conn->error;
    }
} else {
    echo "ID tugas tidak ditemukan.";
}
?>
