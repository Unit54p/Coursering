<?php
session_start(); // Memulai session
$userid = $_SESSION['id'];
$username = $_SESSION['username'];
// echo $userid;
// echo $username;
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
</head>

<body>


   <?php
   include 'admin_navigasi.php';
   ?>

   <!-- Tab panes -->
 

   <!-- body -->
   <div class="mx-3">
      <div class="d-flex align-item-center ">
         <div class="ml-5 w-75">
            <h3 class="mt-4 ">Welcome back
               <?php
               echo $username
                  ?>
            </h3>
               <p>
                  Selamat beraktivitas!
               </p>
            </div>
      </div>


      <!--  course promotion -->
    
      <!-- End of couruse promotion -->
     
   </div>
   </div>



</body>

</html>