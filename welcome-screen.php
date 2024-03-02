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

   <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <link rel="stylesheet" type="text/css" href="styles/welcome-screen.css">
   <!-- custom css file link  -->

</head>


<body>
   <div class="container mt-5">
      <div class="row justify-content-center">
         <div class="card shadow-lg navigation-card">
            <div class="card-header">
               <h1 class="text-center">Welcome!<img src="https://emojiisland.com/cdn/shop/products/Waving_Hand_Sign_Emoji_Icon_ios10_grande.png?v=1571606113" width="40px" height="40px" alt="" style="padding: 3%;"></h1> 
            </div>
            <div class="card-body">
               <div class="content text-center">
                  <a href="dashboard.php" class="btn btn-dark">Dashboard <img src="images/sf-icons/dashboard.png" width="20px" height="20px" alt="Dashboard"></a>
                  <a href="account_settings.php" class="btn btn-dark">Account Settings <img src="images/sf-icons/settings.png" width="20px" height="20px" alt="Account Settings"></a>
                  <a href="vendor_ratings.php" class="btn btn-dark">Vendor Rating <img src="images/sf-icons/ratings.png" width="20px" height="20px" alt="Vendor Ratings"></a>
                  <a href="stores.php" class="btn btn-dark">Stores <img src="images/sf-icons/store.png" width="20px" height="20px" alt="Stores"></a>
                  <a href="index.php" class="btn btn-dark">Logout <img src="images/sf-icons/logout.png" width="20px" height="20px" alt="Dashboard"> </a>
               </div>
            </div>
         </div>
      </div>
   </div>
</body>

</html>