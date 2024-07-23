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
if (isset($_GET['id_course'])) {
    $id_course = $_GET['id_course'];
}

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
</head>

<body>


    <?php
    include 'navigasi.php';
    ?>

    <?php
    $sql = "SELECT * FROM kelas_course WHERE course_id='$id_course'";
    $judul_course = "SELECT course_name FROM kelas_course WHERE course_id='$id_course'";
    $result = $conn->query($sql);
    $resultJudul = $conn->query($judul_course);

    if ($result->num_rows > 0) {
        if ($resultJudul->num_rows > 0) {
            $rowJudul = $resultJudul->fetch_assoc();
            echo "<h2 class='pl-5 py-4 bg-success text-white'>" . $rowJudul['course_name'] . " </h2>";

            echo " <div class='mx-5'>";
        }
        $nomor = 1;
        while ($row = $result->fetch_assoc()) {


            echo "<div class='mx-3 border mb-3 p-3'>";
            echo "Pembelajaran ke-" . $nomor;
            $nomor++;
            echo "<div class='d-flex justify-content-between  ml-2 py-3'>";

            echo "<h4 class=''>" . $row['nama_pelajaran'] . " </h4>";

            echo "<a class='btn btn-primary' href='kelas_pembelajaran.php?kelas_id=" . $row['kelas_id'] . "'>Masuk kelas</a> ";

            echo "</div>";
            echo "</div>";



        }
        echo "</div>";

    }
  
    ?>
    </div>


</body>

</html>