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
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Dashboard</title>

   <!-- custom css file link  -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>



<body class="professor-body">
   <div class="container">
      <div class="content text-center">
         <a href="dashboard.php" class="btn">Dashboard</a>
         <a href="account_settings.php" class="btn">Account Settings</a>
         <a href="vendor_ratings.php" class="btn">Vendor Rating</a>
         <a class="navbar-brand" href="#">
      <img src="images/login-button.png" alt="Logo" width="30" height="24">Stores</a>
         <a href="logout.php" class="btn">Logout</a>
      </div>
   </div>
</body>
</html>