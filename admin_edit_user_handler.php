<?php
session_start(); // Memulai session
include 'koneksi.php'; // Menyertakan koneksi ke database

// Mendapatkan ID pengguna dari URL
$userid = $_GET['id'];

// Mengambil data pengguna berdasarkan ID
$sql = "SELECT * FROM user WHERE id = '$userid'";
// $stmt = $conn->prepare($sql);
// $stmt->bind_param("i", $userid);
// $stmt->execute();
// $result = $stmt->get_result();
// $user = $result->fetch_assoc();
$result = $conn->query($sql);
$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   // Mendapatkan data dari form
   $id_user = $_POST['id_form'];
   $pass = $_POST['password_form'];
   $username = $_POST['username_form'];
   $email = $_POST['email_form'];
   $no_telp = $_POST['no_telp_form'];

   // Update data pengguna
   $sql_update = "UPDATE user SET id = '$id_user', username = '$username', password = '$pass', email = '$email', no_telp = '$no_telp' WHERE id = '$userid'";
   $result_update = $conn->query($sql_update);

   if ($result_update) {
      echo "Data pengguna berhasil diperbarui.";
   } else {
      echo "Terjadi kesalahan saat memperbarui data pengguna.";
   }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Edit User</title>
   <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
   <style>

   </style>
</head>

<body>
   <?php include 'admin_navigasi.php'; ?>

   <div class="container mt-5">
      <h2>Edit User</h2>
      <form method="POST">
         <div class="mt-3">

            <label for="username">ID User</label>
            <input type="text" class="form-control" name="id_form" value="<?php echo $user['id']; ?>" required>
         </div>

         <div class="mt-3">
            <label for="username">Nama User</label>
            <input type="text" class="form-control" name="username_form" value="<?php echo $user['username']; ?>"
               required>
         </div>

         <div class="mt-3">
            <label for="username">Password User</label>
            <input type="text" class="form-control" name="password_form" value="<?php echo $user['password']; ?>"
               required>
         </div>

         <div class="mt-3">
            <label for="email">Email User</label>
            <input type="email" class="form-control" name="email_form" value="<?php echo $user['email']; ?>" required>
         </div>

         <div class="mt-3">
            <label for="no_telp">No Telp</label>
            <input type="text" class="form-control" name="no_telp_form" value="<?php echo $user['no_telp']; ?>"
               required>

            <div class="mt-3">
               <button type="submit" class="btn btn-primary">Update</button>
            </div>

      </form>
   </div>
</body>

</html>