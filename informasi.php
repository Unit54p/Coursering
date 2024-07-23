<?php
session_start(); // Memulai session
$userid = $_SESSION['id'];
$username = $_SESSION['username'];
// echo $userid;
// echo $username;
$berita = array(
   "isi" => "Coursering adalah platform pembelajaran online yang menyediakan berbagai macam kursus dari berbagai bidang, 
   memungkinkan pengguna untuk belajar di waktu mereka sendiri dan mengakses materi dari instruktur ahli.",
   "judul" => "Information",
   "email" => "coursering@email.com"
);

?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Home page</title>
<?php
include 'bootstrap_file.php';
?>
   <script src="nav_handler.js"></script>
</head>

<body>
   <!-- Nav tabs -->
   <div class="">
      <?php
      include 'navigasi.php';
      ?>
   </div>

   <div class="m-3 card">

      <div class="card-body">
         <h3 class="card-title">
            <?php
            echo $berita['judul'];
            ?>
         </h3>

         <div class="card-body">
            <p>
               <?php
               echo $berita['isi'];
               ?>
            </p>
            <p>
               hubungi email kami:
               
               <?php
               echo $berita['email'];
               ?>
            </p>
         </div>
      </div>
   </div>
</body>

</html>