<?php
include 'koneksi.php';

session_start();
$admin_id = $_SESSION['id'];

// Memeriksa apakah id_course telah diterima
if (isset($_GET['id_course'])) {
   $id_course = $_GET['id_course'];

   // Menghapus course berdasarkan id_course

}
if (isset($_POST['btn_hapus'])) {
   $inp_admin_id = $_POST['inp_admin_id'];
   if ($inp_admin_id == $admin_id) {
      $sql = "DELETE FROM course WHERE id_course='$id_course'";

      if ($conn->query($sql) === TRUE) {
         $pesan_dihapus = "Data berhasil dihapus";
      } else {
         echo "Error deleting record: " . $conn->error;
      }
   } else {
      $pesan_id_salah = "Id anda salah coba lagi.";
   }

}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
   <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<?php include 'admin_navigasi.php'; ?>

<div class="container d-flex justify-content-center align-items-center ">
   <div class="border text-center p-3">
      <div>

         <h3 class="font-weight-normal">Apakah anda yakin ingin menghapus course?</h3>
         <div class="  d-flex justify-content-center align-items-center pt-2 mb-2">
            <form action="" method="post">

               <div class="mb-2">masukkan id anda sebagai syarat dan validasi</div>

               <input placeholder="Admin ID" type="number" name="inp_admin_id" class="form-control"> <br>

               <input class="btn btn-danger" type="submit" value="Hapus" name="btn_hapus">

               <div class="mt-3">
                  <?php if (isset($pesan_dihapus)) {
                     echo "<div class='alert alert-success'>";
                     echo $pesan_dihapus;
                     echo "</div>";
                  }

                  if (isset($pesan_id_salah)) {
                     echo "<div class='alert alert-danger'>";
                     echo $pesan_id_salah;
                     echo "</div>";
                  }
                  ?>
               </div>
         </div>

         </form>
      </div>
   </div>
</div>
</div>

<body>

</body>

</html>