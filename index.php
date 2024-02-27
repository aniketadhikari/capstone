<html lang="en" style="background-color: #000033;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MCCS Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- JavaScript -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

</head>
<body style="color: white; background-color: transparent">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow" style="background-color: #1D1D45;">
                    <img src="images/MCCS-logo-white.png" alt="MCCS logo" width="250" style="align-self: center;" class="mt-3 p-5">
                    <div class="card-header">
                        <h1 class="text-center">Dashboard Login</h3>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="mb-3 mt-4 shadow-sm">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" id="username" class="form-control form-control-lg" placeholder="Enter your username" required>
                            </div>
                            <div class="mb-5 mt-4 shadow-sm">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" id="password" class="form-control form-control-lg" placeholder="Enter your password" required>
                            </div>
                            <div class="d-grid gap-2 col-6 mx-auto">
                                <button class="btn-lg shadow" type="button" style="background-color: #CC0000; border: none; color: white;">Log In <i class="bi bi-arrow-right-circle h4"></i></button>
                            </div>
                            <hr class="hr mt-4" />
                            <p class="text-center">Click here to <a href="register.php">register</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>