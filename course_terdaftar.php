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
   <!-- konfirmasi jika mau keluar -->

   <script src="nav_handler.js"></script>


</head>

<body>
   <!-- navgiasi -->
   <?php
   include 'navigasi.php';
   ?>
   <!-- end of navigasi -->
   <div>
      <div class="d-flex justify-content-center align-items-center flex-column ">

         <div class="d-flex justify-content-center align-items-center flex-column mx-3 p-3 w-100">
            <h2>Course Tedaftar</h2>
            <?php
            $sql = "SELECT * FROM course_terdaftar where user_id = $userid";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
               echo "<table class='table table-striped table-bordered'>";
               echo "<thead class='thead-dark'><tr><th>Nama Course</th><th>Aktivitas</th><th>Link Pembelajaran</th></tr></thead>";
               echo "<tbody>";
               while ($row = $result->fetch_assoc()) {
                  echo "<tr >";
                  echo "<td>" . $row['course_name'] . "</td>";
                  echo "<td> <a href='kelas_course.php?id_course=" . $row['course_id'] . "'>Masuk </a></td>";
                  echo "<td><a href='" . $row['link_pembelajaran'] . "' class='btn btn-primary' target='_blank'>Download</a></td>";
                  echo "</tr>";
               }
               echo "</tbody>";
               echo "</table>";
            } else {
               echo "<p>Belum ada Course</p>";
            }
            ?>
            <iframe src="https://www.youtube.com/embed/uMxQI5DuGGk?si=TTEYkl5WVSC6sdmQ" frameborder="0" allowfullscreen
               width="560" height="315"></iframe>
            <!-- 
            <iframe width="560" height="315" src="https://www.youtube.com/embed/dQw4w9WgXcQ" frameborder="0"
               allowfullscreen></iframe> -->

         </div>
      </div>

   </div>
</body>

</html>