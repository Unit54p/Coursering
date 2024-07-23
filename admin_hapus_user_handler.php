<?php
$userid = $_GET['id'];
session_start(); // Memulai session

$admin_id = $_SESSION['id'];
include 'koneksi.php';
// Mengambil data pengguna berdasarkan ID

?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Home page</title>
   <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

   <?php include 'admin_navigasi.php'; ?>

   <div class="container d-flex justify-content-center align-items-center ">
      <div class="border text-center p-3">
         <div>

            <h3 class="font-weight-normal">Apakah anda yakin ingin menghapus?</h3>
            <div class="  d-flex justify-content-center align-items-center pt-2 mb-2">
               <form action="" method="post">

                  <div class="mb-2">masukkan id anda sebagai syarat dan validasi</div>

                  <input placeholder="Admin ID" type="number" name="inp_admin_id" class="form-control"> <br>

                  <input class="btn btn-danger" type="submit" value="Hapus" name="btn_hapus">

               </form>
            </div>
         </div>
      </div>
   </div>

   <?php
   if (isset($_POST['btn_hapus'])) {
      $inp_admin_id = $_POST['inp_admin_id'];

      if ($admin_id == $inp_admin_id) {

         $sql_delete = "DELETE FROM user WHERE id = '$userid'";
         $result_delete = $conn->query($sql_delete);

         if ($result_delete === true) {
            echo "penghapusan berhasil";
         } else {
            echo "penghapusan gagal";

         }
      } else {
         echo "Id anda salah";
      }
   }
   ?>
</body>

</html>