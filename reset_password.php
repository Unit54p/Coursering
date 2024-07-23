<?php
include 'koneksi.php';
if (isset($_GET['token'])) {
 $token = $_GET['token'];

 // Periksa token di database
 $sql = "SELECT * FROM user WHERE reset_token = '$token' AND token_expiration > NOW()";
 $result = $conn->query($sql);

 if ($result->num_rows > 0) {
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   $newPassword = $_POST['password'];
   // $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

   // Update password di database
   $sql = "UPDATE user SET password = '$newPassword', reset_token = NULL, token_expiration = NULL WHERE reset_token = '$token'";
   $conn->query($sql);

   echo "Password berhasil direset.";
  }
 } else {
  echo "Token tidak valid atau telah kedaluwarsa.";
 }
}
?>
<form method="POST" action="">
 <input type="password" name="password" placeholder="Password Baru" required>
 <input type="submit" value="Update Password">
</form>