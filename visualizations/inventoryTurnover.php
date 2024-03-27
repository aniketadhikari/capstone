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

$turnover_data = array();

foreach ($kpis as $kpi) {
    $month = $kpi['turnover_period'];
    $year = $kpi['turnover_year'];
    $date = sprintf("%04d-%02d", $year, $month);
    $turnover_amount = intval($kpi['inventory_turnover']);
    $data[] = array(
        'date' => $date,
        'turnover' => $turnover_amount
    );
}
$turnover_data_json = json_encode($data);
?>
<style>
    body {
        background-color: black;
    }
</style>
<script type="text/javascript">
    const turnover_data = <?php echo $turnover_data_json; ?>;
    
    // Parse the date/time
    const turnover_parseDate = d3.timeParse('%Y-%m');

    const turnover = d3.select('.turnover'),
    turnover_margin = {
            top: 20,
            right: 20,
            bottom: 30,
            left: 40
        },
        turnover_width = +turnover.attr("width") - turnover_margin.left - turnover_margin.right,
        turnover_height = +turnover.attr("height") - turnover_margin.top - turnover_margin.bottom,
        turnover_g = turnover.append("g").attr("transform", "translate(" + turnover_margin.left + "," + turnover_margin.top + ")");
</script>

<body>
    <form action="" method="get">
        <div class="dropdown" style="display: flex; justify-content: space-evenly; margin-top: 5%">
            <select class="form-select" aria-label="Default select example" name="turnover_year" style="width: 30%">
                <option value="IS NOT NULL">All</option>
            </select>
            <button class="filter-btn" type="submit" name="turnover_submit">
                Filter
            </button>
        </div>
    </form>
</body>