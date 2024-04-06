<?php
$invTurn_year_select = "SELECT DISTINCT MERCHANDISING_YEAR as unique_invTurn_year FROM KPI";
$invTurn_year_result = mysqli_query($conn, $invTurn_year_select);
$unique_invTurn_years = mysqli_fetch_all($invTurn_year_result, MYSQLI_ASSOC);
mysqli_free_result($invTurn_year_result);
if (isset($_GET['turnover_submit'])) {
    if ($_GET['turnover_year'] == 'IS NOT NULL') {
        $turnover_year = 'IS NOT NULL';
    } else {
        $turnover_year = '=' . '' . $_GET['turnover_year'] . '';
    }
}


$turnover_select = "SELECT 
MERCHANDISING_YEAR AS turnover_year,
MERCHANDISING_PERIOD AS turnover_period,
SUM(SALESU) / ((SUM(OPENINVU) + SUM(CLOSEU)) / 2) AS inventory_turnover
FROM 
KPI
where MERCHANDISING_YEAR $turnover_year
GROUP BY 
turnover_year, turnover_period";

$turnover_result = mysqli_query($conn, $turnover_select);
$turnover_results = mysqli_fetch_all($turnover_result, MYSQLI_ASSOC);
mysqli_free_result($turnover_result);

$turnover_data = array();

foreach ($turnover_results as $tr) {
    $month = $tr['turnover_period'];
    $year = $tr['turnover_year'];
    $date = sprintf("%04d-%02d", $year, $month);
    $turnover_amount = $tr['inventory_turnover'];
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

    const turnover_x = d3.scaleTime()
        .rangeRound([0, turnover_width * .67])
        .domain(d3.extent(turnover_data, d => turnover_parseDate(d.date)));

    const turnover_y = d3.scaleLinear()
        .rangeRound([turnover_height, 0])
        .domain([0, d3.max(turnover_data, d => Math.max(d.turnover)) * 1.1]);


    // veritcal gridlines
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
    const max = d3.max(turnover_data, function(d) {
        return +d.value;
    })

    // draws the line
    const turnover_line = d3.line()
        .x(d => turnover_x(turnover_parseDate(d.date)))
        .y(d => turnover_y(d.turnover));

    turnover_g.append("path")
        .datum(turnover_data)
        .attr("class", "line")
        .attr("fill", "none")
        .attr("stroke", "url(#line-gradient)")
        .attr("stroke-width", 2)
        .attr("d", turnover_line);

    // Draw the x-axis
    turnover_g.append("g")
        .attr("class", "axis")
        .attr("transform", "translate(0," + turnover_height + ")")
        .call(d3.axisBottom(turnover_x).tickFormat(d3.timeFormat("%-m/%y")));

    // Draw the y-axis
    turnover_g.append("g")
        .attr("class", "axis")
        .call(d3.axisLeft(turnover_y).ticks(10));

    // creates points 
    const turnover_points = turnover_g.selectAll(".point")
        .data(turnover_data)
        .enter().append("circle")
        .attr("class", "point")
        .attr("cx", d => turnover_x(turnover_parseDate(d.date)))
        .attr("cy", d => turnover_y(d.turnover))
        .attr("r", 5);

    // creates labels 
    const turnover_labels = turnover_g.selectAll(".point-label")
        .data(turnover_data)
        .enter().append("text")
        .attr("class", "point-label")
        .attr("x", d => turnover_x(turnover_parseDate(d.date)))
        .attr("y", d => turnover_y(d.turnover) + 1) // Adjust the position to place the text above the point
        .text(d => d.turnover);
</script>
<form action="" method="get">
    <div class="dropdown" style="display: flex; justify-content: space-evenly; margin-top: 5%">
        <select class="form-select" aria-label="Default select example" name="turnover_year" style="width: 30%">
            <option value="IS NOT NULL">All</option>
            <?php foreach ($unique_invTurn_years as $uit_year) { ?>
                <option value="<?php echo $uit_year['unique_invTurn_year']; ?>"><?php echo $uit_year['unique_invTurn_year']; ?></option>
            <?php } ?>
        </select>
        <button class="filter-btn" type="submit" name="turnover_submit">
            Filter
        </button>
    </div>
</form>