<?php

@include 'config.php';

session_start();

if (!isset($_SESSION['id'])) {
    header('location:index.php');
}

$kpi_select = "SELECT * FROM KPI WHERE MERCHANDISING_YEAR=2008 AND MERCHANDISING_PERIOD=5 LIMIT 0, 100";
$kpi_result = mysqli_query($conn, $kpi_select);
$kpis = mysqli_fetch_all($kpi_result, MYSQLI_ASSOC);
mysqli_free_result($kpi_result);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/pages.css?1">
    <link rel="stylesheet" href="styles/navigation.css?1">
</head>

<header class="text-center display-3 mx-auto">
    <p>Dashboard</p>
</header>

<body>
    <?php
    @include 'navigation.php';
    ?>
    <div>
        <div id="screen" class="container mt-2 mb-2">
            <div class="row row-cols-1 mb-5 mt-5">
                <div class="col-9">
                    <div id="widget" class="card text-white h-100">
                        <div class="card-header">Header</div>
                        <div class="card-body">
                            <h5 class="card-title">Dark card title</h5>
                            <svg width="800" height="200"></svg>
                            <?php @include 'scripts/visualizations.php'; ?>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div id="widget" class="card text-white h-100">
                        <div class="card-header">Header</div>
                        <div class="card-body">
                            <h5 class="card-title">Dark card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row row-cols-1 row-cols-md-4 mt-4">
                <div class="col">
                    <div id="widget" class="card text-white mb-3">
                        <div class="card-header">Header</div>
                        <div class="card-body">
                            <h5 class="card-title">Dark card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div id="widget" class="card text-white mb-3">
                        <div class="card-header">Header</div>
                        <div class="card-body">
                            <h5 class="card-title">Dark card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div id="widget" class="card text-white mb-3">
                        <div class="card-header">Header</div>
                        <div class="card-body">
                            <h5 class="card-title">Dark card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div id="widget" class="card text-white mb-3">
                        <div class="card-header">Header</div>
                        <div class="card-body">
                            <h5 class="card-title">Dark card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="row row-cols-4 row-cols-md-3 g-4">
                    <?php foreach ($kpis as $kpi) : ?>
                        <div class="col-md-4 ">
                            <div id="store" class="card store<?php echo $kpi['LOCATION_SKEY']; ?> text-white" style="width: 250px;">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $kpi['LOCATION_SKEY']; ?></h5>
                                    <p class="card-text"><?php echo $kpi['MERCHANDISING_YEAR']; ?></p>
                                    <p class="card-text"><?php echo $kpi['MERCHANDISING_PERIOD']; ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>