<?php
session_start(); // Memulai session


// Mengakses variabel session
// $userid = $_SESSION['id'];
// $username = $_SESSION['username'];
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
   <!-- acative navbar handler -->
   <script src="nav_handler.js"></script>
</head>

<body>
   <!-- navgiasi -->
   <?php
   include 'admin_navigasi.php';
   ?>
   <!-- end of navigasi -->
   <div>
      <div class="mx-3 p-3">
         <h3 class="text-center mb-3">View User Course</h3>

         <div class="my-3 ">
            <form action="" method="post">
               Cari :
               <select name="search_option"  >
                  <option value="nama">Nama</option>
                  <option value="ID">ID user</option>
               </select>

               <input type="text" name="inp_cari" id="" placeholder="Input disini">

               <input type="submit" value="Cari" name="btn_cari">
            </form>
         </div>

         <?php
         if (isset($_POST['btn_cari'])) {
            $inpt_cari = 'user_name';
            $sql_search_type = 'username';

            $inpt_cari = $_POST['inp_cari'];
            $inpt_select_option = $_POST['search_option'];
            // penetapan tipe pencarian
            if ($inpt_select_option == 'nama') {
               $sql_search_type = 'username';
            } elseif ($inpt_select_option == 'ID') {
               $sql_search_type = 'user_id';
            }
            // kondisional sql search
            $sql_cari_nama = "SELECT * FROM course_terdaftar WHERE $sql_search_type = '$inpt_cari' ORDER BY user_id ASC";
            $result_cari_nama = $conn->query($sql_cari_nama);

            // default sql search
         
            // kondisional  search
         
            if ($result_cari_nama->num_rows > 0) {
               echo "<table class='table table-striped table-bordered'>";
               echo "<thead  class='thead-dark'><tr><th>User ID</th><th>Username</th><th>Course ID</th> <th>Course name</th> <th>Course Price</th> <th>Payment Method</th> <th>Nominal Paymetn</th> </tr></thead>";
               echo "<tbody>";
               while ($row = $result_cari_nama->fetch_assoc()) {
                  echo "<tr >";
                  echo "<td class='p-4'>" . $row['user_id'] . "</td>";
                  echo "<td class='p-4'>" . $row['username'] . "</td>";
                  echo "<td class='p-4'>" . $row['course_id'] . "</td>";
                  echo "<td>" . $row['course_name'] . "</td>";
                  echo "<td>Rp " . number_format($row['harga_course'], 0, ',', '.') . "</td>";
                  echo "<td>" . $row['metode_pembayaran'] . "</td>";
                  echo "<td>Rp " . number_format($row['nominal_pembayaran'], 0, ',', '.') . "</td>";

                  echo "</tr>";
               }
               echo "</tbody>";
               echo "</table>";
            }
            // default search
         

         } else {
            $sql_default = "SELECT * FROM course_terdaftar  ORDER BY user_id ASC";
            $result_default = $conn->query($sql_default);

            echo "<table class='table table-striped table-bordered'>";
            echo "<thead  class='thead-dark'><tr><th>User ID</th><th>Username</th><th>Course ID</th> <th>Course name</th> <th>Course Price</th> <th>Payment Method</th> <th>Nominal Paymetn</th> </tr></thead>";
            echo "<tbody>";
            while ($row = $result_default->fetch_assoc()) {
               echo "<tr >";
               echo "<td class='p-4'>" . $row['user_id'] . "</td>";
               echo "<td class='p-4'>" . $row['username'] . "</td>";
               echo "<td class='p-4'>" . $row['course_id'] . "</td>";
               echo "<td>" . $row['course_name'] . "</td>";
               echo "<td>Rp " . number_format($row['harga_course'], 0, ',', '.') . "</td>";
               echo "<td>" . $row['metode_pembayaran'] . "</td>";
               echo "<td>Rp " . number_format($row['nominal_pembayaran'], 0, ',', '.') . "</td>";

               echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
         }

         ?>
      </div>
   </div>


</body>

</html>