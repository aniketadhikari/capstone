<?php

@include 'config.php';
session_start();

if (!isset($_SESSION['id'])) {
    header('index.php');
}

$store_select = "SELECT * FROM Stores";
$store_result = mysqli_query($conn, $store_select);
$stores = mysqli_fetch_all($store_result, MYSQLI_ASSOC);
mysqli_free_result($store_result);

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/pages.css?1">
    <link rel="stylesheet" href="styles/navigation.css?1">
</head>

<body>
    <?php
    @include 'navigation.php';
    ?>

    <div class="container">
        <div class="row row-cols-4 row-cols-md-3 g-4">
            <?php foreach ($stores as $store) : ?>
                <div class="col-md-4 ">
                    <div id="store" class="card text-white">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $store['site_ID']; ?></h5>
                            <p class="card-text"><?php echo $store['store_name']; ?></p>
                            <div class="d-flex justify-content-center">
                                <select class="form-select">
                                    <option value="1">1 star</option>
                                    <option value="2">2 stars</option>
                                    <option value="3">3 stars</option>
                                    <option value="4">4 stars</option>
                                    <option value="5">5 stars</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>