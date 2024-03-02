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
                        <form>
                            <div class="row g-3">
                                <div class="mb-4 mt-4 shadow-sm col">
                                    <label for="fold" class="form-label">Role</label>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle form-control role-button" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                                            Role
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                            <li><button class="dropdown-item" type="button">Marketing</button></li>
                                            <li><button class="dropdown-item" type="button">Loss Prevention</button></li>
                                            <li><button class="dropdown-item" type="button">Store Manager</button></li>
                                            <li><button class="dropdown-item" type="button">Human Resources (HR)</button></li>
                                            <li><button class="dropdown-item" type="button">General Manager</button></li>
                                            <li><button class="dropdown-item" type="button">Data Researcher</button></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="mb-4 mt-4 shadow-sm col">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" id="email" class="form-control" placeholder="Enter your email address" required>
                                </div>
                            </div>
                            <div class="mb-4 shadow-sm">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" id="username" class="form-control" placeholder="Enter your username" required>
                            </div>
                            <div class="mb-4 mt-4 shadow-sm">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" id="password" class="form-control form-control" placeholder="Enter your password" required>
                            </div>
                            <div class="d-grid gap-2 col-6 mx-auto">
                                <button class="btn-lg shadow login-button" type="button">Register <i class="bi bi-arrow-right-circle h4"></i></button>
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