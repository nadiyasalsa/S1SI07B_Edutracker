<?php
$conn = mysqli_connect("localhost", "root", "", "edutracker");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
