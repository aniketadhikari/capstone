<?php

$highRevenueStores_select = 'SELECT 
MERCHANDISING_YEAR as highyear,
LOCATION_SKEY as highlocation,
(SUM(SALESR) - SUM(SALESC)) AS highprofit
FROM KPI 
group by highlocation, highyear
order by highprofit DESC
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
                <td><?php echo $highRevenueStore['highlocation'] ?></td>
                <td><?php echo "$" . number_format($highRevenueStore['highprofit'], 2, '.', ',') ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>