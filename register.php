<?php

@include 'config.php';

session_start();

if (isset($_POST['submit'])) {


    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $role = isset($_POST['user_type']) ? $_POST['user_type'] : '';

    $duplicates = "SELECT * FROM dbmaster.Users WHERE email = '$email'";
    $duplicates_q = mysqli_query($conn, $duplicates);

    if (mysqli_num_rows($duplicates_q) > 0) {
        $error[] = 'user already exist!';
    } else {
        $insert = "INSERT INTO dbmaster.Users(username, password, role, email) VALUES('$username','$password','$role','$email')";
        mysqli_query($conn, $insert);
        header('location:index.php');
    }
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MCCS Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="styles/index.css">
    <!-- JavaScript -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

</head>

<style>
    /* Style for the overlay */
    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        /* Semi-transparent black */
        z-index: 2;
        /* Ensure it's on top of other elements */
        display: none;
        /* Initially hidden */
    }
</style>
    <body>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card shadow">
                        <img src="images/MCCS-logo-white.png" id="MCCS-logo" alt="MCCS logo" width="250" class="mt-3 p-5 MCCS-logo">
                        <div class="card-header">
                            <h1 class="text-center">Registration</h1>
                        </div>
                        <div class="card-body">
                            <form action="" method="post">
                                <div class="row g-3">
                                    <div class="mb-4 mt-4 shadow-sm col">
                                        <label for="fold" class="form-label">Role</label>
                                        <div class="dropdown">
                                            <select class="form-select" aria-label="Default select example" name="user_type" style="display: inline;">
                                                <option value="marketing">Marketing</option>
                                                <option value="loss prevention">Loss Prevention</option>
                                                <option value="store manager">Store Manager</option>
                                                <option value="human resources">Human Resources (HR)</option>
                                                <option value="general manager">General Manager</option>
                                                <option value="data researcher">Data Researcher</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-4 mt-4 shadow-sm col">
                                        <label for="email" class="form-label">Email</label>
                                        <input name="email" type="email" id="email" class="form-control" placeholder="Enter your email address" required>
                                    </div>
                                </div>
                                <div class="mb-4 shadow-sm">
                                    <label for="username" class="form-label">Username</label>
                                    <input name="username" type="text" id="username" class="form-control" placeholder="Enter your username" required>
                                </div>
                                <div class="mb-4 mt-4 shadow-sm">
                                    <label for="password" class="form-label">Password</label>
                                    <input name="password" type="password" id="password" class="form-control form-control" placeholder="Enter your password" required>
                                </div>
                                <div class="d-grid gap-2 col-6 mx-auto">
                                    <button class="btn-lg shadow login-button" type="submit" name="submit">Register <i class="bi bi-arrow-right-circle h4"></i></button>
                                    <?php
                                    if (isset($error)) {
                                        foreach ($error as $error) {
                                            echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
                                        };
                                    }
                                    ?>
                                </div>
                                <hr class="hr mt-4" />
                                <p class="text-center">Click here to <a href="index.php">login</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

</html>