<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <?php
   include 'bootstrap_file.php';
   ?>
</head>

<body>
   <header class="p-3">
      <h1>Coursering</h1>
   </header>
   <!-- Navbar menggunakan Bootstrap untuk navigasi tab -->
   <nav class="navbar navbar-expand-md border">

      <div class="container-fluid">
         <div class="navbar-brand ">
            <img src="img/15.png" alt="Logo" width="30" height="30" style="border-radius:50%;" class="d-inline-block align-text-top">
            <?php
            // Menampilkan teks navigasi berdasarkan halaman
            // if (isset($_GET['page'])) {
            //    $page = $_GET['page'];
            //    switch ($page) {
            //       case 'dashboard':
            //          echo '<span>Dashboard</span>';
            //          break;
            //       case 'course':
            //          echo '<span>Course</span>';
            //          break;
            //       case 'informasi':
            //          echo '<span>Informasi</span>';
            //          break;
            //       case 'course_terdaftar':
            //          echo '<span>Course terdaftar</span>';
            //          break;
            //       case 'logout_handler':
            //          echo '<span>Log out</span>';
            //          break;
            //       default:
            //          echo '<span>Halaman tidak ditemukan</span>';
            //          break;
            //    }
            // }
            ?>
         </div>

         <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse display-flex flex-column" id="navbarNav">
            <ul class="nav nav-pills flex-column flex-md-row me-auto" id="navId" role="tablist">
               <li class="nav-item">
                  <a href="dashboard.php?page=dashboard" class="nav-link">Dashboard</a>
               </li>
               <li class="nav-item">
                  <a href="course.php?page=course" class="nav-link">Course</a>
               </li>
               <li class="nav-item">
                  <a href="informasi.php?page=informasi" class="nav-link ">Informasi</a>
               </li>
               <li class="nav-item">
                  <a href="course_terdaftar.php?page=course_terdaftar" class="nav-link ">Course terdaftar</a>
               </li>
               <li class="nav-item">
                  <a href="logout_handler.php?page=logout_handler" class="nav-link">Keluar</a>
               </li>
            </ul>
         </div>
      </div>


   </nav>



   <!-- <header class="p-3">
      <h1>Coursering</h1>
   </header> -->
   <!-- Navbar menggunakan Bootstrap untuk navigasi tab -->
   <!-- <ul class="nav nav-tabs mb-3" id="navId" role="tablist">
      <li class="nav-item">
         <a href="dashboard.php" class="nav-link" >Dashboard</a>
      </li>
      <li class="nav-item">
         <a href="course.php" class="nav-link" >Course</a>
      </li>
      <li class="nav-item">
         <a href="informasi.php" class="nav-link " >Informasi</a>
      </li>
      <li class="nav-item" role="presentation ">
         <a href="course_terdaftar.php" class="nav-link " >Course terdaftar</a>
      </li>
      <li class="nav-item">
         <a href="logout_handler.php" class="nav-link" >Keluar</a>
      </li>
   </ul> -->

</body>

</html>