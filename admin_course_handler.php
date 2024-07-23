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

         <h3 class="text-center mb-3 flex-grow-1">Course Handler</h3>
         <a href="admin_tambah_course_handler.php" class="btn btn-primary mb-2">
            Buat course baru</a>

         <?php
         $sql = "SELECT * FROM course";
         $result = $conn->query($sql);

         if ($result->num_rows > 0) {
            echo "<table class='table table-striped table-bordered'>";
            echo "<thead class='thead-dark' ><tr><th  class='p-3'>Course Name</th><th>Course ID</th><th>Price</th><th>Description</th><th>Study Link</th><th>Action</th></tr></thead>";
            echo "<tbody>";
            while ($row = $result->fetch_assoc()) {
               echo "<tr >";
               echo "<td class='p-2 '>" . $row['course_name'] . "</td>";
               echo "<td class='p-2 '>" . $row['id_course'] . "</td>";
               echo "<td class='p-2 '>Rp. " . number_format($row['harga'],0,',','.') . "</td>";
               echo "<td class='p-2 '>
                     <textarea class=' txt_area_costum form-control  ' 
                      readonly>"
                  . $row['deskripsi'] . "</textarea></td>";

               echo "<td class='p-2 w-md-50'> 
                     <textarea class='txt_area_costum form-control  ' readonly>"
                  . $row['link_pembelajaran'] . "</textarea> </td>";
               echo "<td class='p-2 '>
                     <a href='admin_edit_course_handler.php?id_course=" . $row['id_course'] . "'> Edit </a> |
                     <a href='admin_kelas_course_handler.php?id_course=" . $row['id_course'] . "'> Kelas </a> |
                     <a href='admin_hapus_course.php?id_course=" . $row['id_course'] . "'> Hapus </a>
                     

                     </td>";
               echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
         } else {
            echo "<p>Belum ada Course</p>";
         }
         ?>
      </div>
   </div>
</body>

</html>