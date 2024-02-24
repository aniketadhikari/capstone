<?php

@include '../config.php';

session_start();

if (!isset($_SESSION['student_name'])) {
    header('location:../index.php'); // if not logged in, redirect and go back to home page
}

// query for all of the courses in the Courses table 
$select = "SELECT * FROM Course";
$result = mysqli_query($conn, $select);


$courses = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/pages.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="shortcut icon" href="https://res.cloudinary.com/crunchbase-production/image/upload/c_lpad,h_256,w_256,f_auto,q_auto:eco,dpr_1/v1408402010/bxqs0rvkbgqwgnnfnhu0.jpg">
    <title>SMU Courses</title>
</head>

<body class="student-body">
    <?php include '../templates/student_nav.php' ?>
    <div class="title" style="margin: 0px 0px 20px 0px">
        <h4 class="center" style="margin: 0px">Courses</h4>
    </div>
    <div class="container">
        <div class="row center">

            <?php foreach ($courses as $course) { ?>
                <!-- create a card for each course -->
                <div class="col s6 md3">
                    <div class="card">
                        <div class="card-panel center" style="background-color: #151c55; color: white;">
                            <div class="card-title">
                                <h6><?php echo htmlspecialchars($course['CourseName']); ?></h6>
                            </div>
                            <div class="card-content">
                                <p><?php echo htmlspecialchars($course['Program']); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <br>

    </div>
    <div>
        <?php include '../templates/footer.php' ?>
    </div>
</body>

</html>