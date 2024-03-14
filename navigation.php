<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>
   <link rel="shortcut icon" href="https://res.cloudinary.com/crunchbase-production/image/upload/c_lpad,h_256,w_256,f_auto,q_auto:eco,dpr_1/v1408402010/bxqs0rvkbgqwgnnfnhu0.jpg">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
   <!-- <link rel="stylesheet" href="styles/navigation.css"> -->
   <link rel="stylesheet" href="styles/sidebar.css">

</head>
<!-- custom css file link  -->
<!-- 
<div class="position-fixed top-0 sidebar">
   <img src="images/MCCS-logo-white.png" alt="MCCS logo" class="MCCS-logo mx-auto mt-4 d-block">
   <div class="mt-5">
      <div class="d-flex align-items-center pt-3 pb-4 ms-5">
         <img src="images/sf-icons/house.png" width="24px" alt="">
         <a href="welcome.php" class="nav-btn fs-3">Home</a>
      </div>
      <div class="d-flex align-items-center pt-3 pb-4 ms-5">
         <img src="images/sf-icons/dashboard.png" width="24px" alt="">
         <a href="dashboard.php" class="active nav-btn fs-3">Dashboard</a>
      </div>
      <div class="d-flex align-items-center pt-3 pb-4 ms-5">
         <img src="images/sf-icons/ratings.png" width="24px" alt="">
         <a href="ratings.php" class="active nav-btn fs-3">Vendor Ratings</a>
      </div>
      <div class="d-flex align-items-center pt-3 pb-4 ms-5">
         <img src="images/sf-icons/store.png" width="24px" alt="">
         <a href="stores.php" class="active nav-btn fs-3">Stores</a>
      </div>
      <div class="d-flex align-items-center pt-3 pb-4 ms-5">
         <img src="images/sf-icons/settings.png" width="24px" alt="">
         <a href="settings.php" class="active nav-btn fs-3">Account Settings</a>
      </div>
   </div>
   <div class="options row position-fixed bottom-0">
      <div class="col-1 option"></div>
      <div class="col-3 option">
         <a href="settings.php">
            <img class="image-options mx-auto d-block" src="images/sf-icons/profile.png" width="24px" alt="">
         </a>
      </div>
      <div class="col-4 option"></div>
      <div class="col-3 option">
         <a href="logout.php">
            <img class="image-options mx-auto d-block" src="images/sf-icons/logout.png" width="25px" alt="">
         </a>
      </div>
   </div>
   <div class="col-1 option"></div> -->

   
<body>
    <div class="bigbox">
        <input type="checkbox" id="checkbox"/>
        <label for="checkbox">
            <h4 id="btn">三</h4>

            <!-- <img src="" alt="Sidebar"> -->
        </label>
        
        <ul>
            <li>
                <img src="sidebar/img/MCCS-logo-white.png" />
                <!-- <span>MCCS-logo-white</span> -->
            </li>
            <li>
                <a href="welcome.php">
                    <img src="images/sf-icons/house.png" alt="1">
                    <span>Home</span>
                </a>
            </li>
            <li>
                <a href="dashboard.php">
                    <img src="images/sf-icons/dashboard.png" alt="3">
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="stores.php">
                    <img src="images/sf-icons/store.png" alt="4">
                    <span>Stores</span>
                </a>
            </li>

            <li>
                <a href="ratings.php">
                    <img src="images/sf-icons/ratings.png" alt="5">
                    <span>Vendor Ratings</span>
                </a>
            </li>



            <div class="icon-bar">
                <a href="settings.php" class="icon-button"><img src="sidebar/img/profile.png" alt="Profile" /></a>
                <a href="settings.php" class="icon-button"><img src="sidebar/img/setting.png" alt="Settings" /></a>
                <a href="logout.php" class="icon-button"><img src="sidebar/img/logout.png" alt="Logout" /></a>
            </div>
        </ul>


    </div>

</div>

</html>