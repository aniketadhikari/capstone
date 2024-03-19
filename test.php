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
                <div class="col-6">
                    <div id="widget" class="card text-white h-100">
                        <div class="card-header">
                            <h5 class="card-title">Units Sold Per Month (2022 - 2024)</h5>
                        </div>
                        <div class="card-body">
                            <svg class="unitsSold img-fluid" width='550' height="250"></svg>
                            <?php @include 'scripts/unitsSoldPerMonth.php'; ?>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div id="widget" class="card text-white h-100">
                        <div class="card-header">
                            <h5 class="card-title">Revenue and Costs Per Month (2022 - 2024)</h5>
                        </div>
                        <div class="card-body">
                            <svg class="rvc img-fluid" width='550' height="250"></svg>
                            <?php @include 'scripts/revenueVsCost.php'; ?>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>