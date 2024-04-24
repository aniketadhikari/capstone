   <title>Login</title>
   <link rel="shortcut icon" href="https://res.cloudinary.com/crunchbase-production/image/upload/c_lpad,h_256,w_256,f_auto,q_auto:eco,dpr_1/v1408402010/bxqs0rvkbgqwgnnfnhu0.jpg">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
   <!-- Bootstrap -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
   <link rel="stylesheet" href="styles/sidebar.css">
   <link rel="icon" type="image/x-icon" href="images/sf-icons/dashboard.png">
   </head>

   <style>
       #overlay {
           position: fixed;
           top: 0;
           left: 0;
           width: 100%;
           height: 100%;
           background-color: rgba(0, 0, 0, 0.75);
           z-index: 1;
           display: none;
       }
   </style>

   <body>
       <div class="bigbox">
           <input type="checkbox" id="checkbox" />
           <label for="checkbox">
               <img width="25px" src="images/sf-icons/sidebar.png" alt="">
           </label>
           <ul class="list-group" id="nav-bar">
               <a href="welcome.php">
                   <li class="pt-5 pb-5" id="mccs-logo">
                       <img src="images/MCCS-logo-white.png" />
                   </li>
               </a>
               <li class="nav-item">
                   <a href="welcome.php">
                       <img src="images/sf-icons/house.png" alt="1">
                       <span>Home</span>
                   </a>
               </li>
               <li class="nav-item">
                   <a href="dashboard.php">
                       <img src="images/sf-icons/dashboard.png" alt="3">
                       <span>Dashboard</span>
                   </a>
               </li>
               <li class="nav-item">
                   <a href="stores.php">
                       <img src="images/sf-icons/store.png" alt="4">
                       <span>Stores</span>
                   </a>
               </li>

               <li class="nav-item">
                   <a href="ratings.php">
                       <img src="images/sf-icons/ratings.png" alt="5">
                       <span>Vendor Ratings</span>
                   </a>
               </li>
               <li class="nav-item">
                   <a href="code-visualizations/index.html">
                       <img src="images/sf-icons/code-folder.png" alt="5">
                       <span>Code for Visuals</span>
                   </a>
               </li>
               <div class="icon-bar row">
                   <div class="col-6 option" <a href="settings.php">
                       <img class="image-options d-block mx-auto" src="images/sf-icons/profile.png" width="24px" alt="">
                       </a>
                   </div>
                   <div class="col-6 option">
                       <a href="logout.php">
                           <img class="image-options d-block mx-auto" src="images/sf-icons/logout.png" width="25px" alt="">
                       </a>
                   </div>
               </div>


           </ul>


       </div>

       </div>

       </html>