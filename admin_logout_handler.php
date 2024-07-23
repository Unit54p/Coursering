<?php
// session_start(); // Memulai session
// // Mengakses variabel session
// $userid = $_SESSION['id'];
// $username = $_SESSION['username'];
// // echo $userid;
// // echo $username;
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
   <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
   <!-- Memuat jQuery Slim dan Popper.js dari CDN -->
   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
   <!-- Memuat Bootstrap JS dari CDN -->
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   <script>
      function confirmLogout() {
         var userConfirmed = confirm("Apakah Anda yakin ingin keluar?");
         if (userConfirmed) {
            window.location.href = 'logout.php';
         }
      }
   </script>
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
   include 'admin_navigasi.php';
   ?>

   <div class="container d-flex justify-content-center align-items-center ">
      <div class="border text-center p-3">
         <div>
            <p>Apakah Anda yakin untuk keluar?</p>
            <div class="  d-flex justify-content-center align-items-center p-3">

               <form action="" method="post">
                  <input type="submit" value="ya" name="ya" class="btn btn-danger inpt">
               </form>
            </div>
         </div>
      </div>

      <?php
      session_start();

      if (isset($_POST['ya'])) {
         session_destroy();
         header('Location: index.php');
         exit; // Pastikan untuk keluar dari skrip setelah mengarahkan ke halaman lain
      }
      ?>
</body>

</html>