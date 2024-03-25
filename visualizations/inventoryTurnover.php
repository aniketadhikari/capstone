<?php
$turnover_select = 'SELECT 
MERCHANDISING_YEAR AS turnover_year,
MERCHANDISING_PERIOD AS turnover_period,
SUM(SALESU) / ((SUM(OPENINVU) + SUM(CLOSEU)) / 2) AS inventory_turnover
FROM 
KPI
GROUP BY 
turnover_year, turnover_period'; 

$turnover_result = mysqli_query($conn, $turnover_select);
$turnover_results = mysqli_fetch_all($turnover_result, MYSQLI_ASSOC);
mysqli_free_result($turnover_result);
?>
<style>
    body {
        background-color: black;
    }
</style>

<body>
    <form action="" method="get">
        <div class="dropdown" style="display: flex; justify-content: space-evenly; margin-top: 5%">
            <select class="form-select" aria-label="Default select example" name="selected_year" style="width: 30%">
                <option value="IS NOT NULL">All</option>
            </select>
            <button class="filter-btn" type="submit" name="submit">
                Filter
            </button>
        </div>
    </form>
</body>