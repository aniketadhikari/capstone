<?php

@include 'config.php';

if(isset($_POST['submit'])){

   $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
   $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = $_POST['user_type'];

   $validate_count = 0;
   // Check if the user is allowed to register with the student email
   $validate_students = "SELECT * FROM Student WHERE EmailAddress = '$email'";
   $validate_student_q = mysqli_query($conn, $validate_students);
   $validate_count += mysqli_num_rows($validate_student_q);
   // check if the user is allowed to register with the professor email 
   $validate_professors = "SELECT * FROM Professor WHERE EmailAddress = '$email'";
   $validate_professor_q = mysqli_query($conn, $validate_professors);
   $validate_count += mysqli_num_rows($validate_professor_q);
   // Check if the user has already been registered
   $duplicates = " SELECT * FROM Users WHERE EmailAddress = '$email'";
   $duplicates_q = mysqli_query($conn, $duplicates);
   if($validate_count == 0) {
      $error[] = 'user not cleared to register!';
   }
   elseif(mysqli_num_rows($duplicates_q) > 0){
      $error[] = 'user already exist!';
   }else{
      if($pass != $cpass){
         $error[] = 'password not matched!';
      }else{
         $insert = "INSERT INTO Users(FirstName, LastName, EmailAddress, Password, UserType) VALUES('$first_name','$last_name','$email','$pass','$user_type')";
         mysqli_query($conn, $insert);
         header('location:index.php');
      }
   }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/styles.css">
   <link rel="shortcut icon" href="https://res.cloudinary.com/crunchbase-production/image/upload/c_lpad,h_256,w_256,f_auto,q_auto:eco,dpr_1/v1408402010/bxqs0rvkbgqwgnnfnhu0.jpg">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
   <style>
      .form-container {
         background-image: url("images/blurred-smu-admin.jpg");
         background-size: cover;
      }
      body {
         background-color: #151c55;
      }
   </style>
</head>

<body>
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
<div class="form-container">

   <form action="" method="post">
      <h3>Register Now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="text" name="first_name" required placeholder="enter your first name">
      <input type="text" name="last_name" required placeholder="enter your last name">
      <input type="email" name="email" required placeholder="enter your email">
      <input type="password" name="password" required placeholder="enter your password">
      <input type="password" name="cpassword" required placeholder="confirm your password">
      <select name="user_type" style="display: inline;">
         <option value="student">Student</option>
         <option value="professor">Professor</option>
      </select>
      <input type="submit" name="submit" value="register now" class="form-btn">
      <p>already have an account? <a href="index.php">login now</a></p>
   </form>

</div>
</body>
</html>