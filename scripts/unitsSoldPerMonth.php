<?php

$kpi_select = "SELECT  MERCHANDISING_PERIOD as month, 
MERCHANDISING_YEAR as year, 
SUM(SALESU) as sales FROM KPI 
group by MERCHANDISING_YEAR, MERCHANDISING_PERIOD 
order by MERCHANDISING_YEAR, MERCHANDISING_PERIOD;";
$kpi_result = mysqli_query($conn, $kpi_select);
$kpis = mysqli_fetch_all($kpi_result, MYSQLI_ASSOC);
mysqli_free_result($kpi_result);

// Array to store the data
$data = array();

// Loop through the rows in $kpis
foreach ($kpis as $kpi) {
    $month = $kpi['month'];
    $year = $kpi['year'];
    $date = sprintf("%04d-%02d", $year, $month);
    $count = intval($kpi['sales']);
    $data[] = array(
        'date' => $date,
        'value' => $count  // Convert value to integer
    );
}
$data_json = json_encode($data);
?>

<!-- D3 package -->
<script src="https://d3js.org/d3.v6.min.js"></script>

<!-- styles for the visualizations -->
<style>
    /* Style the line */
    .line {
        fill: none;
        stroke: steelblue;
        stroke-width: 2px;
    }

    /* Style the axis */
    .axis {
        font-family: var(--bs-body-font-family);
        font-size: 10px;
    }

    /* Style the axis lines */
    .axis path,
    .axis line {
        fill: none;
        shape-rendering: optimizeSpeed;
    }
</style>



<!-- Code for visualization -->
<script type="text/javascript">
    const data = <?php echo $data_json; ?>;

    // Parse the date/time
    const parseDate = d3.timeParse('%Y-%m');

    // Set up the kpi
    const kpi = d3.select(".kpi-1"),
        margin = {
            top: 20,
            right: 20,
            bottom: 30,
            left: 80
        },
        width = +kpi.attr("width") - margin.left - margin.right,
        height = +kpi.attr("height") - margin.top - margin.bottom,
        g = kpi.append("g").attr("transform", "translate(" + margin.left + "," + margin.top + ")");

    // Set up the scales
    const x = d3.scaleTime()
        .rangeRound([0, width])
        .domain(d3.extent(data, d => parseDate(d.date)));

    const y = d3.scaleLinear()
        .rangeRound([height, 0])
        .domain([d3.min(data, d => d.value), d3.max(data, d => d.value)]);

    // Define the line
    const line = d3.line()
        .x(d => x(parseDate(d.date)))
        .y(d => y(d.value));

    // Draw the line
    g.append("path")
        .datum(data)
        .attr("class", "line")
        .attr("d", line);

    // Draw the x-axis
    g.append("g")
        .attr("class", "axis")
        .attr("transform", "translate(0," + height + ")")
        .call(d3.axisBottom(x));

    // Draw the y-axis
    g.append("g")
        .attr("class", "axis")
        .call(d3.axisLeft(y).ticks(5));
</script>