<?php
session_start(); // Memulai session

if (!isset($_SESSION['id'])) {
   header("Location: index.php");
   exit();

}

$userid = $_SESSION['id'];
$username = $_SESSION['username'];

// echo $userid;
// echo $username;

// --------------------------------------
// TESTING SESSION
// --------------------------------------
// if (isset($_SESSION['id'])) {
//    echo "Sesi masih ada. User ID: " . $_SESSION['id'] ;
// } else {
//    echo "Sesi tidak ada.";
// }
// --------------------------------------
// END TESTING SESSION
// --------------------------------------
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

   <!-- body -->
   <div>
      <div class="ml-5 w-75">
         <h3 class="mt-4 ">Welcome back
            <?php
            echo $username
               ?>
         </h3>
         <p>Kembangkan pengalaman belajarmu dengan Coursering dan perluas wawasan serta keterampilanmu dengan
            akses
            ke ilmu, pengalaman, dan mentor profesional. Di Coursering, kami menawarkan platform yang menyediakan
            kursus-kursus berkualitas dari berbagai bidang, disusun oleh ahli industri dan akademisi terkemuka.
            Dengan kurikulum yang dapat disesuaikan dengan kebutuhanmu, kamu dapat memilih dari berbagai topik
            seperti teknologi, bisnis, sains, dan masih banyak lagi. Jelajahi berbagai peluang untuk meningkatkan
            kemampuanmu dan siapkan dirimu untuk masa depan yang sukses. </p>
      </div>

      <!--  course promotion -->

      <div class="container-lg d-flex justify-content-center">

         <div class="row">
            <div class="col-12 col-md-4">
               <div class="my-3 d-flex flex-column align-items-center justify-content-center border rounded p-4">
                  <img class="rounded mb-3" src="img/frontEnd.png" style="width: 200px;" alt="">
                  <div class="text-center">
                     <div style="font-size: 40px;" class="my-2 fs-2">Front end</div>
                     <span>Belajar mulai dari 0 seputar design, user interface dan lainnya</span>
                  </div>
                  <a href="pendaftaran_course.php" class="btn btn-primary mt-3">Daftar</a>
               </div>
            </div>

            <div class="col-12 col-md-4">
               <div class="my-3 d-flex flex-column align-items-center justify-content-center border rounded p-4">
                  <img class="rounded mb-3" src="img/backEnd.png" style="width: 200px;" alt="">
                  <div class="text-center">
                     <div style="font-size: 40px;" class="my-2 fs-2">Back end</div>
                     <span>Belajar mulai dari 0 seputar design, user interface dan lainnya</span>
                  </div>
                  <a href="pendaftaran_course.php" class="btn btn-primary mt-3">Daftar</a>
               </div>
            </div>

            <div class="col-12 col-md-4">
               <div class="my-3 d-flex flex-column align-items-center justify-content-center border rounded p-4">
                  <img class="rounded mb-3" src="img/fullstack.png" style="width: 200px;" alt="">
                  <div class="text-center">
                     <div style="font-size: 40px;" class="my-2 fs-2">Full Stack</div>
                     <span>Belajar mulai dari 0 seputar design, user interface dan lainnya</span>
                  </div>
                  <a href="pendaftaran_course.php" class="btn btn-primary mt-3">Daftar</a>
               </div>
            </div>
         </div>
      </div>

   </div>

   <script>
      var triggerEl = document.querySelector("#navId a");
      bootstrap.Tab.getInstance(triggerEl).show(); 
   </script>

</body>

</html>