<?php
session_start(); // Memulai session
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
$userid = $_SESSION['id'];
$username = $_SESSION['username'];
include 'koneksi.php';
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
      .course-card {
         margin-bottom: 20px;
      }
   </style>
</head>

<body>

   <?php include 'navigasi.php'; ?>
   <!-- kontainer semua objek -->
   <div>
      <!-- judul -->
      <div class="d-flex align-item-center">
         <div class="ml-5 w-75">
            <h3 class="mt-4">Course tersedia</h3>
         </div>
      </div>
      <!-- end judul -->

      <div class="my-3 d-flex align-item-center justify-content-center flex-wrap">

         <?php
         $query_loop_course = "SELECT course_name, deskripsi FROM course";
         $result_loop_course = $conn->query($query_loop_course);

         if ($result_loop_course->num_rows > 0) {
            while ($row_course = $result_loop_course->fetch_assoc()) {
               $course_name = $row_course['course_name'];
               $deskripsi = $row_course['deskripsi'];

               echo '<div class="border course-card rounded mx-3 col-xl-5 col-lg-6 col-sm-11  py-3 px-3 ">';

               echo "<div class='d-flex align-items-center'>";  // Menggunakan align-items-center untuk mengatur vertical alignment
               echo '<img class="rounded" src="img/frontEnd.png" style="width: 150px; height: 150px;" alt="">';
               echo '<div class="ml-3 " style="font-size: 30px;">' . $course_name . '</div>';
               echo "</div>";


               echo "<p class='my-3 ml-3'>$deskripsi</p>";
               echo "<a href='pendaftaran_course.php' class='btn btn-primary mt-3'>Daftar</a>";
               echo '</div>';

               // Menutup baris setiap kali mencapai 3 course
               //    if ($count % 3 == 2 || $count == $result_loop_course->num_rows - 1) {
               //       echo '</div>'; // Menutup tag div row
               //    }
         
               //    $count++;
            }
         } else {
            echo "<p>No courses available</p>";
         }
         ?>

      </div>
   </div>
</body>

</html>