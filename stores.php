<?php

@include 'config.php';

session_start();

if (!isset($_SESSION['id'])) {
    header('location:index.php');
}

$store_select = "SELECT * FROM LOCATION";
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
    <link rel="stylesheet" href="styles/sidebar.css?1">
    <link rel="stylesheet" href="styles/pages.css?1">
</head>

<body>
    <?php
    @include 'sidebar.php';
    ?>

    <div id="stores" class="container" style="width: 90%">
        <div class="row mt-3 g-4">
            <?php foreach ($stores as $store) : ?>
                <div class="col-md-4 ">
                    <div id="store" class="card store<?php echo $store['SITEID']; ?> text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-center">
                                <img src="images/mccs-drawing.png" width="50px" alt="">
                            </div>
                            <h5 class="card-title"><?php echo $store['SITEID']; ?></h5>
                            <p class="card-text"><?php echo $store['STORENAME']; ?></p>
                            <div class="d-flex justify-content-center">
                                <?php
                                $ratings = intval($store['Average_Ratings']);
                                for ($i = 0; $i < $ratings; $i++) {
                                ?>
                                    <img class="m-2" src="images/sf-icons/star.png" width="24px" alt="">
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>