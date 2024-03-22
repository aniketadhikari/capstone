<?php

$highRevenueStores_select = 'SELECT 
MERCHANDISING_YEAR as year,
LOCATION_SKEY as location, 
SUM(SALESR) as revenue, 
SUM(SALESC) as cost,
(SUM(SALESR) - SUM(SALESC)) AS profit
FROM KPI 
group by location, year
order by profit DESC
LIMIT 5;';

$highRevenueStores_result = mysqli_query($conn, $highRevenueStores_select);

$highRevenueStores = mysqli_fetch_all($highRevenueStores_result, MYSQLI_ASSOC);

mysqli_free_result($highRevenueStores_result);


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
        <?php foreach ($highRevenueStores as $highRevenueStore) { ?>
            <tr>
                <td><?php echo $highRevenueStore['location'] ?></td>
                <td><?php echo "$" . number_format($highRevenueStore['profit'], 2, '.', ',') ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>