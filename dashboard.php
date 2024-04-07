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

</head>
<style>
    .card-header {
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>


<header class="text-center display-3 mx-auto">
    <p>Dashboard</p>
</header>

<body>
    <?php
    @include 'sidebar.php';
    ?>
    <div>
        <div id="screen" class="container mt-2 mb-2">
            <div class="row row-cols-1 mb-4 mt-3">
                <!-- Units Sold Per Month -->
                <div class="col-9">
                    <div id="widget" class="card text-white h-100">
                        <div class="card-header">
                            <h5 class="card-title">Inventory Turnover</h5>
                        </div>
                        <div class="card-body" style="align-self: center">
                            <svg class="turnover img-fluid" width='1200' height="300" style="height: 300px;"></svg>
                            <?php @include 'visualizations/inventoryTurnover.php'; ?>
                        </div>
                    </div>
                </div>
                <div class="row col-3">
                    <div id="widget" class="card text-white h-50">
                        <div class="card-header">Most profitable stores <img src="images/sf-icons/up-arrow.png" width="12px" style="margin-left: 2%"></div>
                        <div class="card-body">
                            <?php @include 'visualizations/highProfitStores.php'; ?>
                        </div>
                    </div>
                    <div id="widget" class="card text-white h-50">
                        <div class="card-header">Least profitable stores <img src="images/sf-icons/down-arrow.png" width="12px" style="margin-left: 2%"></div>
                        <div class="card-body">
                            <?php @include 'visualizations/lowProfitStores.php'; ?>
                        </div>
                    </div>

                </div>
            </div>
            <hr>
            <div id="widget" class="card text-white h-100">
                <div class="card-header">
                    <h5 class="card-title">Revenue and Costs Per Month (2022 - 2024)</h5>
                </div>
                <div class="card-body">
                    <svg class="rvc img-fluid" width='1200' height="300" style="height: 300px;"></svg>
                    <?php @include 'visualizations/revenueVsCost.php'; ?>

                </div>
            </div>
            <?php @include 'visualizations/shrinkage.php' ?>
            <div class="row row-cols-1 mb-4 mt-3">
                <!-- Units Sold Per Month -->
                <div class="col">
                    <div id="widget" class="card text-white h-100">
                        <div class="card-header">
                            <h5 class="card-title">Units Sold Per Month (2022 - 2024)</h5>
                        </div>
                        <div class="card-body" style="align-self: center">
                            <svg class="unitsSold img-fluid" width='1100' height="350"></svg>
                            <?php @include 'visualizations/unitsSoldPerMonth.php'; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>