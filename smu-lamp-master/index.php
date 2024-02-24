<?php

@include 'config.php';

session_start();
// if logged in, redirect and go immediately to professor welcome page
if(isset($_SESSION['professor_name'])){
   header('location:professor_pages/professor_welcome.php'); 
}

// if logged in, redirect and go immediately to student welcome page
if(isset($_SESSION['student_name'])){
   header('location:student_pages/student_welcome.php'); 
}

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);

   $select = " SELECT * FROM Users WHERE EmailAddress = '$email' && Password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $row = mysqli_fetch_array($result);

      if($row['UserType'] == 'professor'){

         $_SESSION['professor_name'] = $row['FirstName'];
         $professorid_q = " SELECT * FROM Professor WHERE EmailAddress = '$email'";
         $professorid_q_result = mysqli_query($conn, $professorid_q);
         $professorid_q_row = mysqli_fetch_array($professorid_q_result);
         // store professor id 
         $_SESSION['professor_id'] = $professorid_q_row['ProfessorID'];
         header('location:professor_pages/professor_welcome.php');

      }elseif($row['UserType'] == 'student'){

         $_SESSION['student_name'] = $row['FirstName'];
         $studentid_q = " SELECT * FROM Student WHERE EmailAddress = '$email'";
         $studentid_q_result = mysqli_query($conn, $studentid_q);
         $studentid_q_row = mysqli_fetch_array($studentid_q_result);
         $_SESSION['student_id'] = $studentid_q_row['StudentID'];
         header('location:student_pages/student_welcome.php');

      }
     
   }else{
      $error[] = 'incorrect email or password!';
   }

};
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/styles.css">
   <link rel="shortcut icon" href="https://res.cloudinary.com/crunchbase-production/image/upload/c_lpad,h_256,w_256,f_auto,q_auto:eco,dpr_1/v1408402010/bxqs0rvkbgqwgnnfnhu0.jpg">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
   <style>
      .form-container {
         background-image: url('images/blurred_smu_morning.jpg');
         background-size: cover;
      }
      body {
         background-color: #151c55;
      }
   </style>

</head>
<header>
    <div class="t-header">
        <div class="logo">
            <img src="https://www.smu.edu.sg/themes/smubase_4g/svg/logo-d-smu.svg" alt="SMU Logo" width="100px" style="background-color: white;">
            <img src="https://www.smu.edu.sg/themes/smubase_4g/svg/oblique.svg" alt="oblique" height="100px">
        </div>
        <div class="navbar">
            <nav style="background-color:#151c55; display:flex">
                <a href="index.php">Home</a>
                <div class="dd">
                    <button class="ddbtn">Departments</button>
                    <div class="dd-content">
                        <a href="https://cis.smu.edu.sg/">Bachelor of Integrative Studies</a>
                        <a href="https://admissions.smu.edu.sg/programmes/school-accountancy/school-accountancy">School of Accountancy</a>
                        <a href="https://admissions.smu.edu.sg/programmes/lee-kong-chian-school-business/bachelor-business-management">Bachelor of Business Administration</a>
                    </div>
                </div>
            </nav>
        </div>
        <div class="logo" style="transform: scaleX(-1);">
            <img src="https://haironearthnorthoaks.com/wp-content/uploads/2018/05/white-square-png-98-images-in-collection-page-2-white-square-png-585_585.png" alt="SMU Logo" width="100px" style="background-color: white;">
            <img src="https://www.smu.edu.sg/themes/smubase_4g/svg/oblique.svg" alt="oblique" height="100px">
        </div>
    </div>
</header>
<body>
<div class="form-container">
   <form action="" method="post">
      
         <h3>Login Now</h3>
         <?php
         if(isset($error)){
            foreach($error as $error){
               echo '<span class="error-msg">'.$error.'</span>';
            };
         };
         ?>
         <input type="email" name="email" required placeholder="enter your email">
         <input type="password" name="password" required placeholder="enter your password">
         <input type="submit" name="submit" value="login now" class="form-btn">
         <p>Don't have an account? <a href="register.php">register now</a></p>
   </form>
</div>
</body>
</html>