<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Document</title>
</head>

<body>

 <?php
 include "navigasi.php";
 ?>
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
 if (isset($_GET['kelas_id'])) {
  $kelas_id = $_GET['kelas_id'];
 }
 
 $sql = "SELECT * FROM kelas_course WHERE kelas_id='$kelas_id'";
 $judul_course = "SELECT course_name FROM kelas_course WHERE kelas_id='$kelas_id'";
 $result = $conn->query($sql);
 $resultJudul = $conn->query($judul_course);

 if ($result->num_rows > 0) {
  if ($resultJudul->num_rows > 0) {
   $rowJudul = $resultJudul->fetch_assoc();
   echo "<h2 class='pl-5 py-4 bg-success text-white'>" . $rowJudul['course_name'] . " </h2>";

   echo " <div class='mx-5'>";
  }

  if ($result->num_rows > 0) {

   if ($result->num_rows > 0) {
    $nomor = 1;
    $row = $result->fetch_assoc();

    echo "<div class='mx-3 border mb-3 p-3'>";
    echo "Pembelajaran ke-" . $nomor;
    $nomor++;

    echo "<h4 class='ml-2 my-3'>" . $row['nama_pelajaran'] . " </h4>";
    echo "<p>" . $row['deskripsi_pelajaran'] . " </p>";
    echo "<p>Modul pembelajaran:</p>";
    echo "<h4>" . $row['modul_pembelajaran'] . " </h4>";
    echo "<p>Video pembelajaran:</p>";
    echo "<iframe frameborder='0' allow='accelerometer autoplay clipboard-write encrypted-media gyroscope picture-in-picture web-share'referrerpolicy='strict-origin-when-cross-origin' allowfullscreen width='500' height='280' src=" . $row['video_pembelajaran'] . "> </iframe>";
    echo "<p>Tugas pembelajaran:</p>";
    echo "<h4>" . $row['tugas_pembelajaran'] . " </h4>";
    echo "</div>";

   }
  }
 }
 ?>
</body>

</html>