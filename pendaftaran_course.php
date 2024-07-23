<?php
session_start();
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
include 'koneksi.php';
$userid = $_SESSION['id'];
$username = $_SESSION['username'];

function perhitunganHargaCourse($conn)
{
   $totalPrice = 0;
   if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['course'])) {
      $selectedCourse = $_POST['course'];
      $query = "SELECT harga FROM course WHERE id_course = '$selectedCourse'";
      $result = $conn->query($query);

      if ($result->num_rows > 0) {
         $row = $result->fetch_assoc();
         $totalPrice = $row['harga'];
      }
   }
   return $totalPrice;
}

// untuk btn melihat harga
$totalPrice = perhitunganHargaCourse($conn);
$nominalPembayaran = 0;
$keteranganPembayaran = "";

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
   <script>
      function confirmLogout() {
         var userConfirmed = confirm("Apakah Anda yakin ingin keluar?");
         if (userConfirmed) {
            window.location.href = 'logout.php';
         }
      }
   </script>
   <script src="nav_handler.js"></script>

</head>

<body>
   <!-- Bagian header dengan judul situs -->

   <!-- Navbar menggunakan Bootstrap untuk navigasi tab -->
   <?php
   include 'navigasi.php';
   ?>

   <!-- Bagian utama konten halaman -->
   <div class="my-4 mx-5">
      <div>
         <h2>Daftar course</h2>
         <p>Pilih course yang anda minati, untuk setiap pembelian di atas Rp. 200.000,00 akan mendapatkan diskon 5%</p>
      </div>

      <!-- Form untuk memilih course menggunakan radio button -->
      <div class="ml-4 mt-5 d-flex align-items-center border p-4">
         <form action="" method="post" class="w-100">

            <?php
            if (isset($_POST['btn_daftar'])) {
               $discount = 0.05;
               // Ambil nilai dari form
               $nominalPembayaran = $_POST['inpt_nominalPembayaran'];
               $selectedMetode = $_POST['metode_pembayaran'];
               $selectedCourse = $_POST['course'];

               // Periksa apakah metode pembayaran sudah dipilih
               if (empty($selectedMetode)) {
                  echo "<div class='alert alert-danger mt-4' role='alert'>";
                  echo "Silakan pilih metode pembayaran terlebih dahulu.";
                  echo "</div>";
               } else {
                  // Lakukan proses lanjutan jika metode pembayaran telah dipilih
                  $totalPrice = perhitunganHargaCourse($conn);

                  // Validasi jumlah pembayaran cukup atau tidak
                  if ($nominalPembayaran >= $totalPrice) {
                     // Query untuk mengecek apakah user sudah memiliki course tersebut
                     $query_check = "SELECT * FROM course_terdaftar WHERE user_id = '$userid' AND course_id = '$selectedCourse'";
                     $result_check = $conn->query($query_check);

                     if ($result_check->num_rows > 0) {
                        // Jika user sudah terdaftar di course tersebut
                        echo "<div class='card mt-4'>";
                        echo "<div class='card-body'>";
                        echo "<h5 class='card-title'>Pendaftaran Gagal</h5>";
                        echo "<p class='card-text'>Anda sudah terdaftar di course ini.</p>";
                        echo "</div>";
                        echo "</div>";
                     } else {
                        // Query untuk mendapatkan informasi course dari tabel course
                        $query_course = "SELECT id_course, course_name, deskripsi, harga, link_pembelajaran FROM course WHERE id_course = '$selectedCourse'";
                        $result_course = $conn->query($query_course);

                        if ($result_course->num_rows > 0) {
                           // Diskon logic
                           if ($totalPrice >= 200000) {
                              $totalPrice = $totalPrice - ($totalPrice * $discount);
                           }
                           // Ambil data course
                           $row_course = $result_course->fetch_assoc();
                           $course_name = $row_course['course_name'];
                           $course_description = $row_course['deskripsi'];
                           $link_pembelajaran = $row_course['link_pembelajaran'];

                           // Query untuk memasukkan data ke dalam tabel course_terdaftar
                           $insert_sql = "INSERT INTO course_terdaftar (username, user_id, course_id, course_name, course_description, harga_course, metode_pembayaran, nominal_pembayaran, link_pembelajaran)
                    VALUES ('$username','$userid', '$selectedCourse', '$course_name', '$course_description', '$totalPrice', '$selectedMetode', '$nominalPembayaran', '$link_pembelajaran')";

                           if ($conn->query($insert_sql) === TRUE) {
                              // Jika query berhasil dijalankan
                              $kembalian = $nominalPembayaran - $totalPrice;
                              $keteranganPembayaran = "Pendaftaran berhasil. Kembalian: Rp " . number_format($kembalian, 0, ',', '.');
                              echo "<div class='alert alert-success mt-4' role='alert'>";
                              echo $keteranganPembayaran;
                              echo "</div>";
                           } else {
                              // Jika terjadi kesalahan saat menjalankan query
                              echo "<div class='alert alert-danger mt-4' role='alert'>";
                              echo "Error: " . $insert_sql . "<br>" . $conn->error;
                              echo "</div>";
                           }
                        } else {
                           // Jika tidak ada data course ditemukan
                           echo "<div class='alert alert-danger mt-4' role='alert'>";
                           echo "Course dengan ID $selectedCourse tidak ditemukan.";
                           echo "</div>";
                        }
                     }
                  } else {
                     // Jika nominal pembayaran kurang dari total harga kursus
                     $keteranganPembayaran = "Pembayaran gagal. Uang tidak mencukupi.";
                     echo "<div class='alert alert-danger mt-4' role='alert'>";
                     echo $keteranganPembayaran;
                     echo "</div>";
                  }
               }
            }
            ?>
            <h3>Isi Form</h3>

            <div class="ml-3 w-auto d-flex flex-column align-items-start">
               <label>Pilih Course:</label>

               <div class="ml-3 w-auto d-flex flex-column align-items-start">
                  <!-- course tersedia dari database -->
                  <?php
                  $query_loop_course = "SELECT course_name, id_course FROM course";
                  $result_loop_course = $conn->query($query_loop_course);

                  if ($result_loop_course->num_rows > 0) {
                     while ($row_course = $result_loop_course->fetch_assoc()) {
                        $course_id = $row_course['id_course'];
                        $course_name = $row_course['course_name'];
                        echo "<div class='form-check'>";
                        echo "<input class='form-check-input' type='radio' name='course' id='$course_name' value='$course_id'"
                           . (isset($_POST['course']) && $_POST['course'] == $course_id ? 'checked' : '') . ">";
                        echo "<label class='form-check-label' for='$course_name'>$course_name</label>";
                        echo "</div>";
                     }
                  } else {
                     echo "<p>No courses available</p>";
                  }
                  ?>
               </div>

               <!-- Tombol submit untuk memilih -->
               <input type="submit" class="btn btn-primary mt-3" value="Lihat harga">
            </div>

            <!-- Bagian untuk menampilkan harga course -->
            <div class="py-2 my-2">
               Harga course:
               <div class="input-group">
                  <span class="input-group-text">Rp</span>
                  <div class="form-control">
                     <?php
                     if ($totalPrice > 0) {
                        echo "Rp " . number_format($totalPrice, 0, ',', '.');
                     } else {
                        echo "Pilih course untuk melihat harga.";
                     }
                     ?>
                  </div>
                  <span class="input-group-text">.00</span>
               </div>
            </div>
            <br>
            <div>
               <div class="mb-1">
                  Metode pembayaran:
               </div>

               <select name="metode_pembayaran" id="metode_pembayaran">
                  <option value="">Pilih metode pembayaran</option>
                  <option value="bank_digital" <?php echo isset($_POST['metode_pembayaran']) && $_POST['metode_pembayaran'] == 'bank_digital' ? 'selected' : ''; ?>>Bank Digital</option>
                  <option value="dompet_digital" <?php echo isset($_POST['metode_pembayaran']) && $_POST['metode_pembayaran'] == 'dompet_digital' ? 'selected' : ''; ?>>Dompet Digital</option>
               </select>

               <div class="mb-1 mt-1">Masukkan nominal uang pembayaran:</div>
               <div class="input-group mb-3">
                  <span class="input-group-text">Rp</span>
                  <input type="text" class="form-control" name="inpt_nominalPembayaran"
                     value="<?php echo isset($_POST['inpt_nominalPembayaran']) ? htmlspecialchars($_POST['inpt_nominalPembayaran']) : ''; ?>"
                     aria-label="Amount (to the nearest dollar)">
                  <span class="input-group-text">.00</span>
               </div>

               <input type="submit" class="btn btn-primary mt-2" value="Daftar" name="btn_daftar">
            </div>
            <div>

            </div>
         </form>

      </div>
   </div>

   <!-- Script untuk menampilkan tab secara default menggunakan Bootstrap JS -->
   <!-- <script>
      $(Document).ready(
         function () {
            $('.nav-link').click(
               function () {
                  $('.nav-link').removeClass('active');
                  $(this).addClass('active');
               });
         });
   </script> -->
</body>

</html>