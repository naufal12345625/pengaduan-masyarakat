<?php
$hostname = "localhost";
$username = "root";
$password = ""; // Pastikan sesuai dengan password root Anda
$database = "pengaduan_masyarakat";

// Membuat koneksi
$connection = mysqli_connect($hostname, $username, $password, $database);

// Cek koneksi
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
} else
?>
