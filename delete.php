<?php
include 'config.php';


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    mysqli_query($conn, "DELETE FROM daftartugas WHERE id_tugas=$id");
}

header("Location: index.php");
?>
