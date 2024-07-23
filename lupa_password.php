<?php
include 'koneksi.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 $email = $_POST['email'];

 // Periksa apakah email ada di database
 $sql = "SELECT * FROM user WHERE email = '$email'";
 $result = $conn->query($sql);

 if ($result->num_rows > 0) {
  // Buat token unik
  $token = bin2hex(random_bytes(8));

  // Simpan token ke database
  $sql = "UPDATE user SET reset_token = '$token', token_expiration = DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE email = '$email'";
  $conn->query($sql);

  // Kirim email ke pengguna
  $resetLink = "http://coursering.test:81/reset_password.php?token=$token";
  $subject = "Reset Password";
  $message = "Klik link berikut untuk mereset password: $resetLink";
  mail($email, $subject, $message);

  echo "Email reset password telah dikirim.";
 } else {
  echo "Email tidak ditemukan.";
 }
}
?>

<form method="POST" action="">
 <input type="email" name="email" placeholder="Email" required>
 <input type="submit" value="Reset Password">
</form>