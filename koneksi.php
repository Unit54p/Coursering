<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "coursering";
$port = 3308; // Tambahkan port ini

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Periksa koneksi
if ($conn->connect_error) {
   die("Koneksi gagal: " . $conn->connect_error);
}

// echo "Koneksi berhasil";

?>