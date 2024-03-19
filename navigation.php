   <title>Login</title>
   <link rel="shortcut icon" href="https://res.cloudinary.com/crunchbase-production/image/upload/c_lpad,h_256,w_256,f_auto,q_auto:eco,dpr_1/v1408402010/bxqs0rvkbgqwgnnfnhu0.jpg">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
   <link rel="stylesheet" href="styles/navigation.css">
   <!-- <link rel="stylesheet" href="styles/navigation.css"> -->
   <link rel="stylesheet" href="styles/sidebar.css">

</head>
<!-- custom css file link  -->

<!-- 
<div class="position-fixed top-0 sidebar">
   <img src="images/MCCS-logo-white.png" alt="MCCS logo" class="MCCS-logo mx-auto mt-4 d-block">
   <div class="mt-5">


@@ -50,7 +52,61 @@
         </a>
      </div>
   </div>
   <div class="col-1 option"></div>
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