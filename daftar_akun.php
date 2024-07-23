<?php
session_start(); // Memulai session


// echo $userid;
// echo $username;
include 'koneksi.php';

function generateUniqueRandomNumber($conn)
{
   $randomNumber = mt_rand(1, 255); // Generate random number from 1 to 255

   // Query untuk memeriksa apakah angka random sudah ada di database
   $check_query = "SELECT COUNT(*) AS count FROM user WHERE id = $randomNumber";
   $check_result = $conn->query($check_query);

   if ($check_result) {
      $row = $check_result->fetch_assoc();
      $count = $row['count'];

      // Jika angka random sudah digunakan, rekursif panggil fungsi lagi untuk menghasilkan angka baru
      if ($count > 0) {
         return generateUniqueRandomNumber($conn);
      } else {
         // Jika angka random belum digunakan, kembalikan angka tersebut
         return $randomNumber;
      }
   } else {
      return $randomNumber;
   }
}

// membuat id user secara random
$generate_random_id_user = generateUniqueRandomNumber($conn);

// Generate CSRF token
if (empty($_SESSION['csrf_token'])) {
   $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if (isset($_POST['btn_daftar'])) {
   // Validate CSRF token
   if (hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
      $username = $_POST['username'];
      $pass = $_POST['pass'];
      $email = $_POST['email'];
      $no_telp = $_POST['no_telp'];

      $sql = "INSERT INTO user (id, username, password, email, no_telp)
                VALUES ('$generate_random_id_user', '$username', '$pass', '$email', '$no_telp')";

      if ($conn->query($sql) === TRUE) {
         unset($_SESSION['csrf_token']); // Unset the CSRF token to prevent re-submission
         header('Location: user_sukses_terdaftar.php'); // Redirect to thank you page
         exit();
      } else {
         echo "Gagal: " . $conn->error;
      }
   } else {
      echo "Invalid CSRF token";
   }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Home page</title>
   <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   <script src="nav_handler.js"></script>

   <style>
      .inpt {
         width: 20rem;
      }
   </style>
</head>

<body>
   <!-- Nav tabs -->
   <header class="p-3">
      <h1>Coursering</h1>
   </header>

   <ul class="nav nav-tabs mb-3" id="navId" role="tablist">
      <li class="nav-item">
         <a href="index.php" class="nav-link" data-bs-toggle="tab">Home Page</a>
      </li>
   </ul>

   <div class="alert alert-danger">
      Jangan pernah memasukkan data sensitiv atau pribadi
   </div>

   <div class="d-flex justify-content-center align-item-center">
      <div class="border p-4 d-flex justify-content-center align-item-center flex-column text-center">
         <h2 class="mb-4">Registrasi</h2>
         <div>
            <form action="" method="post">
               <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
               <input class="form-control inpt" type="text" name="username" id="" placeholder="Username"><br>
               <input class="form-control inpt" type="password" name="pass" id="" placeholder="Password"><br>
               <input class="form-control inpt" type="email" name="email" id="" placeholder="Email"><br>
               <input class="form-control inpt" type="number" name="no_telp" id="" placeholder="No Telephone"><br>
               <input type="submit" name="btn_daftar" value="Daftar Akun" class="btn btn-primary">
            </form>
         </div>
      </div>
   </div>
</body>

</html>