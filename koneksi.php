<?php
// Konfigurasi database
$host = "localhost"; // Host database (biasanya 'localhost' jika menggunakan server lokal)
$username = "root"; // Username database
$password = ""; // Password database
$database = "db_laundry"; // Nama database

// Membuat koneksi ke database
$conn = mysqli_connect($host, $username, $password, $database);

// Memeriksa koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
