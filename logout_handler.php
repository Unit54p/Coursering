<?php
session_start();
// --------------------------------------
// PENGECEKAN SESSION
// --------------------------------------
if (!isset($_SESSION['id'])) {
   header("Location: index.php");
   exit();
}
// --------------------------------------
// END PENGECEKAN SESSION
// --------------------------------------
if (isset($_POST['btn_ya'])) {
   session_unset();
   session_destroy();

   if (isset($_COOKIE['username'])) {
      setcookie('username', '', time() - 3600, '/'); // Waktu -3600 untuk menghapus cookie
   }
   if (isset($_COOKIE['password'])) {
      setcookie('password', '', time() - 3600, '/'); // Waktu -3600 untuk menghapus cookie
   }
   header('Location: index.php');
   exit; // Pastikan untuk keluar dari skrip setelah mengarahkan ke halaman lain
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
   <?php
   include 'bootstrap_file.php';
   ?>
   <script src="nav_handler.js"></script>
   <style>
      .inpt {
         width: 5rem;
         margin: 0 15px;
      }
   </style>
</head>

<body>

   <?php
   include 'navigasi.php';
   ?>

   <div class="container d-flex justify-content-center align-items-center mt-5 ">
      <div class="border text-center p-3">
         <p>Apakah Anda yakin untuk keluar?</p>

         <div class="  d-flex justify-content-center align-items-center p-3">

            <form action="" method="post">
               <input type="submit" value="ya" name="btn_ya" class="btn btn-danger inpt">
            </form>
         </div>
      </div>
   </div>

   <?php

   ?>
</body>

</html>