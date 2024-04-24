<?php

@include 'config.php';

session_start();

if (!isset($_SESSION['id'])) {
   header('location:index.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <title>Welcome Screen</title>

   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <link rel="stylesheet" type="text/css" href="styles/welcome-screen.css?1">
   <!-- custom css file link  -->
</head>


<body>
   <div class="container mt-5">
      <div class="row justify-content-center">
         <div class="card shadow-lg navigation-card">
            <div class="card-header mt-3 mb-3">
               <h1 class="text-center">Welcome
                  <span id="username"><?php echo $_SESSION['username'] ?></span>
                  <img src="https://emojiisland.com/cdn/shop/products/Waving_Hand_Sign_Emoji_Icon_ios10_grande.png?v=1571606113" width="56px" height="56px" alt="" style="padding: 3%;">
               </h1>
            </div>
            <div class="card-body">
               <div class="content text-center">
                  <a href="dashboard.php" class="btn ">Dashboard <img src="images/sf-icons/dashboard.png" width="20px" height="20px" alt="Dashboard"></a>
                  <a href="ratings.php" class="btn">Vendor Rating <img src="images/sf-icons/ratings.png" width="20px" height="20px" alt="Vendor Ratings"></a>
                  <a href="stores.php" class="btn">Stores <img src="images/sf-icons/store.png" width="20px" height="20px" alt="Stores"></a>
                  <a href="code-visualizations/index.html" class="btn ">Code for Visuals<img src="images/sf-icons/code-folder.png" width="20px" height="20px" alt="Code for Visualizations"></a>
                  <a href="logout.php" class="btn">Logout <img src="images/sf-icons/logout.png" width="20px" height="20px" alt="Dashboard"> </a>
               </div>
            </div>
         </div>
      </div>
   </div>
</body>

</html>