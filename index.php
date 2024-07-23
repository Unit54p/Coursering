<?php
session_start();
include 'koneksi.php';

// pemeriksaan kondisi SESSION
// apakah masih ada atau tidak

// --------------------------------------
// TESTING SESI
// --------------------------------------

// if (isset($_SESSION['id'])) {
//    echo "Sesi masih ada. User ID: " . $_SESSION['id'] . $_SESSION['username'];
// } else {
//    echo "Sesi tidak ada.";
// }
// --------------------------------------
// END TESTING SESI
// --------------------------------------

// --------------------------------------
// COOKIES set up
// --------------------------------------
// LOGIN COOKIES (OTOMATIS)

// Periksa apakah cookies ada
if (isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
   $username = $_COOKIE['username'];
   $pass = $_COOKIE['password'];

   // Gunakan prepared statement untuk keamanan
   $stmt_admin = $conn->prepare("SELECT * FROM administrator WHERE username = ? AND password = ?");
   $stmt_admin->bind_param("ss", $username, $pass);
   $stmt_admin->execute();
   $result_admin = $stmt_admin->get_result();

   $stmt_user = $conn->prepare("SELECT * FROM user WHERE username = ? AND password = ?");
   $stmt_user->bind_param("ss", $username, $pass);
   $stmt_user->execute();
   $result_user = $stmt_user->get_result();

   // Jika admin
   if ($result_admin->num_rows > 0) {
      $row = $result_admin->fetch_assoc();
      $_SESSION['id'] = $row['user_id'];
      $_SESSION['username'] = $row['username'];
      header("Location: admin_dashboard.php");
      exit();
   }
   // Jika user
   elseif ($result_user->num_rows > 0) {
      $row = $result_user->fetch_assoc();
      $_SESSION['id'] = $row['id'];
      $_SESSION['username'] = $row['username'];
      header('Location: dashboard.php');
      exit();
   } else {
      $error_message = "Username atau password salah.";
   }

   // Tutup prepared statements
   $stmt_admin->close();
   $stmt_user->close();
}

// --------------------------------------
// END COOKIES set up
// --------------------------------------

// --------------------------------------
// LOGIN MANUAL
// --------------------------------------
if (isset($_POST['btn_masuk'])) {
   $username = $_POST['username'];
   $pass = $_POST['pass'];
   $tetapLogin = isset($_POST['btn_tetapLogin']);

   // Gunakan prepared statement untuk keamanan
   $stmt_admin = $conn->prepare("SELECT * FROM administrator WHERE username = ? AND password = ?");
   $stmt_admin->bind_param("ss", $username, $pass);
   $stmt_admin->execute();
   $result_admin = $stmt_admin->get_result();

   $stmt_user = $conn->prepare("SELECT * FROM user WHERE username = ? AND password = ?");
   $stmt_user->bind_param("ss", $username, $pass);
   $stmt_user->execute();
   $result_user = $stmt_user->get_result();

   // jika admin
   if ($result_admin->num_rows > 0) {
      $row = $result_admin->fetch_assoc();
      $_SESSION['id'] = $row['user_id']; // Menyimpan ID pengguna ke session
      $_SESSION['username'] = $row['username'];

      if ($tetapLogin) {
         setcookie('username', $username, time() + (1 * 60), '/'); // Sesuaikan dengan 30 hari di live environment
         setcookie('password', $pass, time() + (1 * 60), '/');
      }

      header("Location: admin_dashboard.php");
      exit();
      // jika user
   } elseif ($result_user->num_rows > 0) {
      // session
      $row = $result_user->fetch_assoc();
      $_SESSION['id'] = $row['id']; // Menyimpan ID pengguna ke session
      $_SESSION['username'] = $row['username']; // Menyimpan username ke session

      // Mengatur cookie jika tetap login dipilih
      if ($tetapLogin) {
         setcookie('username', $username, time() + (1 * 60), '/'); // Sesuaikan dengan 30 hari di live environment
         setcookie('password', $pass, time() + (1 * 60), '/');
      }

      header('Location: dashboard.php');
      exit();

   } else {
      $error_message = "Username atau password salah.";
   }

   // --------------------------------------
   // END LOGIN MANUAL
   // --------------------------------------

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login - Coursering</title>

   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

   <?php
   include 'bootstrap_file.php';
   ?>
   <style>
      .header-title {
         text-align: center;
         margin-bottom: 20px;
      }

      .nav-pills .nav-link {
         color: #495057;
         border-radius: .25rem;
      }

      .nav-pills .nav-link.active {
         background-color: #007bff;
      }

      .container-info {
         margin-top: 30px;
      }

      .form-container {
         max-width: 500px;
         margin: auto;
      }

      .login-form {
         border: 1px solid #e0e0e0;
         padding: 20px;
         border-radius: 8px;
         background: #fff;
      }

      .card-costum-yellow {
         padding: 3px 6px 3px 6px;
         border-left: 4px solid lightblue;
         background-color: #FEF7DA;
      }

      .card-costum-blue {
         padding: 3px 6px 3px 6px;
         border-left: 4px solid lightyellow;
         background-color: #77B4FF;
      }

      .border-costum-1 {
         /* border: solid 1px black; */
         border-radius: 5px;
      }
   </style>
</head>

<body>

   <!-- Header -->
   <div class="mx-4 ">
      <header class="p-3">
         <h1 class="">Coursering</h1>
      </header>


      <!-- nav -->
      <ul class="nav nav-pills mb-3 mx-4" id="pills-tab" role="tablist">
         <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
               type="button" role="tab" aria-controls="pills-home" aria-selected="true">Home</button>
         </li>
         <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#informasi"
               type="button" role="tab" aria-controls="pills-profile" aria-selected="false">
               <a href="#informasi" style="color: inherit; text-decoration: none; /* Remove underline */
" ;> Informasi</a></button>
         </li>
         <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact"
               type="button" role="tab" aria-controls="pills-contact" aria-selected="false">
               <a href="#informasi" style="color: inherit; text-decoration: none; /* Remove underline */
" ;> Sign up</a>
            </button>
         </li>
         <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact"
               type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Login</button>
         </li>

      </ul>

      <!-- <div class="tab-content" id="pills-tabContent">
      <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"
         tabindex="0">...</div>
      <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">...
      </div>
      <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">...
      </div>
      <div class="tab-pane fade" id="pills-disabled" role="tabpanel" aria-labelledby="pills-disabled-tab" tabindex="0">
         ...</div>
   </div> -->


      <!-- Main content -->
      <div class="mx-4">
         <div class=" row display-flex justify-content-center align-items-center ">
            <!-- content -->
            <div class=" col-lg-5 border-costum-1 ">
               <h3 class="mt-3">Coursering: belajar, praktik, bisa</h3>
               <p style="font-size: 18px;">Coursering adalah platform belajar online yang dirancang untuk membantu Anda
                  menguasai berbagai
                  keterampilan baru melalui pendekatan belajar yang terstruktur dan efektif. Di Coursering, kami percaya
                  bahwa proses belajar harus menyenangkan dan interaktif. Dengan beragam materi pelajaran yang mudah
                  diakses, mulai dari sains dan teknologi hingga seni dan bahasa, Coursering menawarkan pengalaman
                  belajar yang kaya dan mendalam. Setiap kursus dirancang oleh para ahli di bidangnya, memastikan bahwa
                  Anda mendapatkan pengetahuan yang tepat dan up-to-date.</p>
            </div>
            <!-- login form -->
            <div class="form-container col-lg-7 my-5 ">
               <form action="" method="post" class="login-form">
                  <h4 class="text-center mb-3">Login atau Daftarkan akun mu</h4>
                  <?php if (isset($error_message)): ?>
                     <div class="alert alert-danger" role="alert">
                        <?php
                        echo $error_message;
                        ?>
                     </div>
                  <?php endif; ?>
                  <div class="mb-3 form-floating">
                     <input type="text" class="form-control" name="username" id="inpt_nama" placeholder="Username"
                        required>
                     <label for="inpt_nama">Username</label>

                  </div>
                  <div class="form-floating mb-3">
                     <input type="password" class="form-control" id="floatingPassword" placeholder="Password"
                        name="pass">
                     <label for="floatingPassword">Password</label>
                  </div>
                  <div class="mb-3 form-check ">
                     <input type="checkbox" class="form-check-input" name="btn_tetapLogin" id="exampleCheck1">
                     <label class="form-check-label" for="exampleCheck1">Tetap login selama 30 hari</label>
                  </div>
                  <div class="d-grid">
                     <input type="submit" name="btn_masuk" value="Submit" class="btn btn-primary "><br>
                     <span>belum punya akun? <a href="daftar_akun.php">Daftar disini</a></span>
                  </div>
                  <div class="d-grid">
                     <span>Lupa password? <a href="lupa_password.php">Reset disini</a></span>
                  </div>
               </form>
            </div>

         </div>
         <!-- informasi -->
         <div class=" border-costum-1" id="informasi">
            <h1>Informasi</h1>
            <p class="card-costum-yellow">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quo blanditiis amet
               iusto fugiat ut repellat
               voluptatibus deleniti hic impedit corrupti dolores temporibus, quidem cupiditate omnis saepe incidunt
               dolore
               quaerat explicabo. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolore fugiat accusantium,
               blanditiis dignissimos praesentium quia officia perspiciatis magni corporis ratione minima, dolorum odit
               expedita dicta unde! Ad adipisci sit modi.
               Lorem ipsum dolor sit amet consectetur, adipisicing elit. Beatae error corrupti quasi tenetur explicabo
               eius, perspiciatis maiores magni, officiis expedita odit veritatis repellat. Qui reprehenderit inventore
               quod illo aperiam velit!
               Lorem ipsum, dolor sit amet consectetur adipisicing elit. Maxime corporis in quos quaerat culpa illum,
               expedita natus. Amet mollitia deleniti ipsum eius commodi voluptatem, architecto at officia alias
               doloribus perspiciatis! Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla quis animi ipsum
               commodi nihil placeat aperiam libero temporibus pariatur, debitis sunt id expedita, reiciendis veniam vel
               autem fugiat distinctio officiis! Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ad iure fuga
               necessitatibus, deleniti excepturi corrupti. Vero earum voluptas odit alias fuga, vel assumenda at.
               Quaerat a officia laudantium inventore cupiditate! Lorem ipsum dolor sit amet consectetur adipisicing
               elit. Natus corrupti veniam illo eligendi, sit quo ad perspiciatis quaerat quis debitis voluptas
               exercitationem deleniti ipsam tenetur accusantium doloribus dignissimos, asperiores alias.</p>
            <p class="card-costum-yellow">
               Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ipsam adipisci consequuntur quae modi deleniti
               impedit ut animi laboriosam fugit nam voluptate quaerat ducimus autem, voluptatum minima, error eum
               assumenda commodi. Lorem ipsum dolor sit, amet consectetur adipisicing elit. Odio nemo repudiandae
               voluptatibus inventore tempore ipsam soluta sit consequatur quisquam explicabo. Corrupti itaque qui
               molestiae veniam. Dolorum fuga magni dignissimos accusamus? </p>
         </div>

      </div>
   </div>
   <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
      integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
      crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
      integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V"
      crossorigin="anonymous"></script> -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
      crossorigin="anonymous"></script>

</body>

</html>