<?php
session_start(); // Memulai session
include 'koneksi.php'; // Menyertakan koneksi ke database
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Home page</title>
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
   <!-- Bagian header dengan judul situs -->

   <!-- navigasi -->
   <?php include 'admin_navigasi.php'; ?>
   <!-- end of navigasi -->
   <div>
      <div class="mx-3 p-3">
         <h3 class="text-center mb-3">User Handler</h3>
         <?php
         $sql = "SELECT * FROM user";
         $result = $conn->query($sql);

         if ($result->num_rows > 0) {
            echo "<table class='table table-striped table-bordered'>";
            echo "<thead class='thead-dark'><tr><th>Nama User</th><th>ID User</th><th>Email user</th><th>No Telp</th><th>Action</th></tr></thead>";
            echo "<tbody>";
            while ($row = $result->fetch_assoc()) {
               echo "<tr>";
               echo "<td class='p-2'>" . $row['username'] . "</td>";
               echo "<td class='p-2'>" . $row['id'] . "</td>";
               echo "<td class='p-2'>" . $row['email'] . "</td>";
               echo "<td class='p-2'>" . $row['no_telp'] . "</td>";
               // post method
               // <form action='admin_edit_user_handler.php' method='POST'>
               // <input type='hidden' name='id' value='" . $row['id'] . "'>
               // <button type='submit' class='btn btn-link'>Edit</button>
               // </form>
               // Menambahkan link Edit dan mengirimkan ID pengguna melalui URL dengan method GET
               echo "<td class='p-2'>
                     <a href='admin_edit_user_handler.php?id=" . $row['id'] . "'>Edit</a> |
                     <a href='admin_hapus_user_handler.php?id=" . $row['id'] . "'>Hapus</a></td>";
               echo "</tr>";

            }
            echo "</tbody>";
            echo "</table>";
         } else {
            echo "<p>Belum ada pengguna</p>";
         }
         ?>
      </div>
   </div>

</body>

</html>