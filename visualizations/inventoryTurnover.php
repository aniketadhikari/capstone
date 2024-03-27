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

foreach ($turnover_results as $tr) {
    $month = $tr['turnover_period'];
    $year = $tr['turnover_year'];
    $date = sprintf("%04d-%02d", $year, $month);
    $turnover_amount = intval($tr['inventory_turnover']);
    $turnover_data[] = array(
        'date' => $date,
        'turnover' => $turnover_amount
    );
}
$turnover_data_json = json_encode($turnover_data);
?>
<style>
    body {
        background-color: black;
    }
</style>
<script src="https://d3js.org/d3.v6.min.js"></script>
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

    const turnover_x = d3.scaleBand()
        .rangeRound([0, turnover_width])
        .domain(turnover_data.map(d => turnover_parseDate(d.date)))
        .padding(0.2);

    const turnover_y = d3.scaleLinear()
        .rangeRound([turnover_height, 0])
        .domain([0, d3.max(turnover_data, d => Math.max(d.turnover)) * 1.1]);

    turnover_g.append("g")
        .attr("class", "grid")
        .call(d3.axisLeft(turnover_y)
            .ticks(15)
            .tickSize(-turnover_width)
            .tickFormat("")
        );

    // Horizontal gridlines
    turnover_g.append("g")
        .attr("class", "grid")
        .attr("transform", "translate(0," + turnover_height + ")")
        .call(d3.axisBottom(turnover_x)
            .tickSize(-turnover_height)
            .tickFormat("")
        );

    const turnover_line = d3.line()
        .x(d => turnover_x(turnover_parseDate(d.date)))
        .y(d => turnover_y(d.turnover));

    turnover_g.append("path")
        .datum(turnover_data)
        .attr("class", "line")
        .attr("d", turnover_line);
</script>
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