<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MCCS Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- JavaScript -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


</head>

<body>
    <!-- <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <img src="images/MCCS-logo-white.png" alt="MCCS logo" width="300" style="align-self: center; padding: 20px">
                    <h1 class="card-header text-center"> Dashboard Login </h1>
                    <div class="card-body">
                        <form action="login_process.php" method="post">
                        <div class="form-group mt-3">
                                <label for="username">Username:</label>
                                <input type="text" name="username" id="username" class="form-control">
                            </div>
                            <div class="form-group mt-3">
                                <label for="password">Password:</label>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <div class="d-grid gap-2 col-6 mx-auto mt-5">
                                <button class="btn btn-primary" type="button">Button</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <img src="images/MCCS-logo-white.png" alt="MCCS logo" width="400" style="align-self: center;" class="mt-3 p-5">
                    <div class="card-header">
                        <h1 class="text-center">Dashboard Login</h3>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="mb-4 mt-4">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" id="username" class="form-control" placeholder="Enter your username" required>
                            </div>
                            <div class="mb-5 mt-4">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" id="password" class="form-control" placeholder="Enter your password" required>
                            </div>
                            <div class="d-grid gap-2 col-6 mx-auto">
                                <button class="btn btn-primary" type="button">Button</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>