<?php
session_start(); // Memulai session

// Mengakses variabel session
$userid = $_SESSION['id'];
$username = $_SESSION['username'];
// echo $userid;
// echo $username;
include 'koneksi.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Home page</title>
 <!-- Menggunakan Bootstrap CSS dari CDN untuk styling -->
 <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
 <!-- Memuat jQuery Slim dan Popper.js dari CDN -->
 <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
 <!-- Memuat Bootstrap JS dari CDN -->
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

 <script src="nav_handler.js"></script>
 <style>
  .txt_area_costum {
   height: 1500px;
   overflow-y: auto;
  }

  .scrollable-textarea {
   height: 150px;
   overflow-y: auto;
   resize: none;
  }
 </style>

</head>

<body>
 <!-- navgiasi -->
 <?php
 include 'admin_navigasi.php';
 ?>
 <!-- end of navigasi -->
 <div>

  <div class=" mx-3 p-3">

   <h3 class="text-center mb-3 flex-grow-1">Kelas Course Handler</h3>
   <a href="admin_tambah_course_handler.php" class="btn btn-primary mb-2">
    Buat kelas course baru</a>

   <?php

   ?>
  </div>
 </div>
</body>

</html>