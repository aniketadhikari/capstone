<?php

@include '../config.php';

session_start();

if (!isset($_SESSION['professor_name'])) {
   header('location:../index.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Professor Dashboard</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/styles.css">
   <link rel="shortcut icon" href="https://res.cloudinary.com/crunchbase-production/image/upload/c_lpad,h_256,w_256,f_auto,q_auto:eco,dpr_1/v1408402010/bxqs0rvkbgqwgnnfnhu0.jpg">
   <style>
      .professor-body {
         background: url('../images/blurred_Singapore_Management_University_School_of_Law_Armeninan_Street.jpg');
         background-size: cover;
         background-repeat: repeat-y;
      }
   </style>
</head>

<body class="professor-body">
   <div class="container">
      <div class="content">
         <h3>Hello, <span>professor</span></h3>
         <h1>Welcome <span><?php echo $_SESSION['professor_name'] ?></span></h1>
         <a href="operational_reporting.php" class="btn">Operational Reporting</a>
         <a href="schedule_eval.php" class="btn">Evaluations</a>
         <a href="groups.php" class="btn">Groups</a>
         <a href="import_students.php" class="btn">Import Students</a>
         <a href="import_courses.php" class="btn">Import Courses</a>
         <a href="../logout.php" class="btn">Logout</a>
      </div>
   </div>
</body>
</html>