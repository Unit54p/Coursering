<?php
session_start();
include 'koneksi.php';

// Memproses form penambahan course
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $ID_course = $_POST['ID_course'];
   $course_name = $_POST['course_name'];
   $harga = $_POST['harga'];
   $deskripsi = $_POST['deskripsi'];
   $link_pembelajaran = $_POST['link_pembelajaran'];

   // Menambahkan data course baru ke database
   $sql = "INSERT INTO course (id_course, course_name, harga, deskripsi, link_pembelajaran) VALUES ('$ID_course','$course_name', '$harga', '$deskripsi', '$link_pembelajaran')";
   if ($conn->query($sql) === TRUE) {
      echo "New course created successfully";
      header("Location: admin_course_handler.php");
      exit();
   } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
   }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Add New Course</title>
   <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<?php
include "admin_navigasi.php";

?>

<body>
   <div class="container">
      <h2>Add New Course</h2>
      <form method="POST">

         <div class=" form-group">
            <label for="course_name">ID Course</label>
            <input type="number" class="form-control" id="course_name" name="ID_course" required>
         </div>

         <div class=" form-group">
            <label for="course_name">Course Name</label>
            <input type="text" class="form-control" id="course_name" name="course_name" required>
         </div>
         <div class="form-group">
            <label for="harga">Price</label>
            <input type="text" class="form-control" id="harga" name="harga" required>
         </div>
         <div class="form-group">
            <label for="deskripsi">Description</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" required></textarea>
         </div>
         <div class="form-group">
            <label for="link_pembelajaran">Study Link</label>
            <textarea class="form-control" id="link_pembelajaran" name="link_pembelajaran" required></textarea>
         </div>
         <button type="submit" class="btn btn-primary">Add Course</button>
      </form>
   </div>
</body>

</html>