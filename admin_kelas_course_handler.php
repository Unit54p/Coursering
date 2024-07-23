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
         <a href="admin_tambah_kelas_course.php" class="btn btn-primary mb-2">
            Buat kelas course baru</a>

         <?php

         if (isset($_GET['id_course'])) {
            $id_course = $_GET['id_course'];
            $sql = "SELECT * FROM kelas_course WHERE course_id = $id_course  ORDER BY course_name ASC";
            $result = $conn->query($sql);
            print_tabel($result);
         } else {
            $sql = "SELECT * FROM kelas_course ORDER BY course_name ASC";
            $result = $conn->query($sql);
            print_tabel($result);
         }
         function print_tabel($result)
         {
            if ($result->num_rows > 0) {
               echo "<table class='table table-striped table-bordered'>";
               echo "<thead class='thead-dark' ><tr><th  class='p-3'>Course Name</th><th>Course ID</th><th>Nama pelajaran</th><th>Deskripsi pelajaran</th><th>Video pembelajaran</th><th>Modul pembelajaran</th><th>tugas pembelajaran</th><th>Aksi</th></tr></thead>";
               echo "<tbody>";
               while ($row = $result->fetch_assoc()) {
                  echo "<tr >";
                  echo "<td class='p-2 '>" . $row['course_name'] . "</td>";
                  echo "<td class='p-2 '>" . $row['course_id'] . "</td>";
                  echo "<td class='p-2 '>" . $row['nama_pelajaran'] . "</td>";
                  echo "<td class='p-2 '>
                     <textarea class=' txt_area_costum form-control  ' 
                      readonly>"
                     . $row['deskripsi_pelajaran'] . "</textarea></td>";
                  echo "<td class='p-2 '>" . $row['video_pembelajaran'] . "</td>";
                  echo "<td class='p-2 '>" . $row['modul_pembelajaran'] . "</td>";
                  echo "<td class='p-2 '>" . $row['tugas_pembelajaran'] . "</td>";
                  echo "<td class='p-2 '>
                     <a href='admin_edit_course_handler.php?id_course=" . $row['course_id'] . "'> Edit </a> |
                     <a href='admin_kelas_course_handler.php?id_course=" . $row['course_id'] . "'> Kelas </a> |
                     <a href='admin_hapus_course.php?id_course=" . $row['course_id'] . "'> Hapus </a>
                     </td>";
                  echo "</tr>";
               }
               echo "</tbody>";
               echo "</table>";
            } else {
               echo "<p>Belum ada kelas untuk course tersebut</p>";
            }
         }


         ?>
      </div>
   </div>
</body>

</html>