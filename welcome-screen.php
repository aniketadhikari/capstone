<?php

@include '../config.php';

session_start();

// if (!isset($_SESSION['professor_name'])) {
//    header('location:../index.php');
// }

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <title>Welcome Screen</title>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <link rel="stylesheet" href="styles/welcome-screen.css">
   <!-- custom css file link  -->

</head>


<body class="professor-body">
   <div class="container mt-5">
      <div class="row justify-content-center">
         <div class="card shadow">
            <div class="card-header">
               <h1 class="text-center">Dashboard Login</h1>
            </div>
            <div class="card-body">
               <div class="content text-center">
                  <a href="dashboard.php" class="btn">Dashboard</a>
                  <a href="account_settings.php" class="btn">Account Settings</a>
                  <a href="vendor_ratings.php" class="btn">Vendor Rating</a>
                  <a href="stores.php" class="btn">Stores</a>
                  <a href="logout.php" class="btn">Logout</a>
               </div>
            </div>
         </div>
      </div>
   </div>
</body>

</html>