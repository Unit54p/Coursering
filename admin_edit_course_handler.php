<?php
session_start();
include 'koneksi.php';

// Memeriksa apakah id_course telah diterima
if (isset($_GET['id_course'])) {
   $id_course = $_GET['id_course'];

   // Mengambil data course berdasarkan id_course untuk di tampilkan di input form
   $sql = "SELECT * FROM course WHERE id_course='$id_course'";
   $result = $conn->query($sql);

   if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      // mengambil dari database dengan nama dari $row['nama kolom table'] 
      $course_name = $row['course_name'];
      $harga = $row['harga'];
      $deskripsi = $row['deskripsi'];
      $link_pembelajaran = $row['link_pembelajaran'];
   }
}

// Memproses form edit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   // mengambil nilai di form
   $id_course = $_POST['id_course'];
   $course_name = $_POST['course_name'];
   $harga = $_POST['harga'];
   $deskripsi = $_POST['deskripsi'];
   $link_pembelajaran = $_POST['link_pembelajaran'];

   // Update data course
   $sql = "UPDATE course 
            SET 
            course_name='$course_name', 
            harga='$harga', 
            deskripsi='$deskripsi', 
            link_pembelajaran='$link_pembelajaran' 
            WHERE id_course='$id_course'";

   if ($conn->query($sql) === TRUE) {
      echo "Record updated successfully";
      header("Location: admin_course_handler.php");
      exit();
   } else {
      echo "Error updating record: " . $conn->error;
   }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Edit Course</title>
   <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
   <?php
   include 'admin_navigasi.php';
   ?>
   <div class="container">
      <h2>Edit Course</h2>
      <form method="POST">
         <input type="hidden" name="id_course" value="<?php echo $id_course; ?>">

         <div class="form-group">
            <label for="course_name">Course Name</label>
            <input type="text" class="form-control" id="course_name" name="course_name"
               value="<?php echo $course_name; ?>" required>
         </div>

         <div class="form-group">
            <label for="harga">Price</label>
            <input type="text" class="form-control" id="harga" name="harga" value="<?php echo $harga; ?>" required>
         </div>

         <div class="form-group">
            <label for="deskripsi">Description</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" required>
               <?php echo $deskripsi; ?>
            </textarea>
         </div>

         <div class="form-group">
            <label for="link_pembelajaran">Study Link</label>
            <textarea class="form-control" id="link_pembelajaran" name="link_pembelajaran"
               required><?php echo $link_pembelajaran; ?></textarea>
         </div>

         <button type="submit" class="btn btn-primary">Update</button>
      </form>
   </div>
</body>

</html>