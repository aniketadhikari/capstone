<?php

// High Shrinkage
$highShrinkage_select = 'SELECT
LOCATION_SKEY as highShrinklocation,
SUM(SHRINKPA) as highShrinkProfit
FROM KPI
group by highShrinklocation
having highShrinkProfit != 0
order by highShrinkProfit DESC
LIMIT 5;';

$highShrinkage_result = mysqli_query($conn, $highShrinkage_select);

$highShrinkage_stores = mysqli_fetch_all($highShrinkage_result, MYSQLI_ASSOC);

mysqli_free_result($highShrinkage_result);

// Low Shrinkage
$lowShrinkage_select = 'SELECT
LOCATION_SKEY as lowShrinklocation,
SUM(SHRINKPA) as lowShrinkProfit
FROM KPI
group by lowShrinklocation
having lowShrinkProfit != 0
order by lowShrinkProfit
LIMIT 5;';

$lowShrinkage_result = mysqli_query($conn, $lowShrinkage_select);

$lowShrinkage_stores = mysqli_fetch_all($lowShrinkage_result, MYSQLI_ASSOC);

mysqli_free_result($lowShrinkage_result);

?>

<div class="row md-4 mt-4">
    <div class="col">
        <div id="widget" class="card text-white mb-3">
            <div class="card-header">Top 5 Stores Best Managing Shrinkage</div>
            <div class="card-body">
                <table>
                    <thead>
                        <tr>
                            <th>Store ID</th>
                            <th>$ Saved from Shrink</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($highShrinkage_stores as $highShrinkage_store) { ?>
                            <tr>
                                <td><?php echo $highShrinkage_store['highShrinklocation'] ?></td>
                                <td><?php echo "$" . number_format($highShrinkage_store['highShrinkProfit'], 2, '.', ',') ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col">
        <div id="widget" class="card text-white mb-3">
            <div class="card-header">Top 5 Stores Poorly Managing Shrinkage</div>
            <div class="card-body">
                <table>
                    <thead>
                        <tr>
                            <th>Store ID</th>
                            <th>$ Lost to Shrink</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lowShrinkage_stores as $lowShrinkage_store) { ?>
                            <tr>
                                <td><?php echo $lowShrinkage_store['lowShrinklocation'] ?></td>
                                <td><?php echo "$" . number_format(abs($lowShrinkage_store['lowShrinkProfit']), 2, '.', ',') ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>