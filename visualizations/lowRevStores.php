<?php

$lowRevenueStores_select = 'SELECT 
MERCHANDISING_YEAR AS lowYear,
LOCATION_SKEY AS lowLocation,
(SUM(SALESR) - SUM(SALESC)) AS lowProfit
FROM 
KPI 
GROUP BY 
lowLocation, lowYear
HAVING
SUM(SALESR) != 0 AND SUM(SALESC) != 0
ORDER BY 
lowProfit ASC
LIMIT 
5';

$lowRevenueStores_result = mysqli_query($conn, $lowRevenueStores_select);

$lowRevenueStores = mysqli_fetch_all($lowRevenueStores_result, MYSQLI_ASSOC);

mysqli_free_result($lowRevenueStores_result);


?>

<style>
    td {
        padding: 1%;
    }
</style>

<table>
    <thead>
        <tr>
            <th>Store ID</th>
            <th>Profit</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($lowRevenueStores as $lowRevenueStore) { ?>
            <tr>
                <td><?php echo $lowRevenueStore['lowLocation'] ?></td>
                <td><?php echo "$" . number_format($lowRevenueStore['lowProfit'], 2, '.', ',') ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>