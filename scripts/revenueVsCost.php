<?php

$kpi_select = "SELECT  MERCHANDISING_PERIOD as month, 
MERCHANDISING_YEAR as year, 
SUM(SALESR) as revenue, SUM(SALESC) as cost FROM KPI 
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
    $revenue = intval($kpi['revenue']);
    $cost = intval($kpi['cost']);
    $data[] = array(
        'date' => $date,
        'cost' => $cost,
        'revenue' => $revenue
    );
}
$rvc_data_json = json_encode($data);
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

    .bar-cost {
        fill: red;
        /* Set the color of cost bars to red */
    }

    .bar-revenue {
        fill: green;
        /* Set the color of revenue bars to green */
    }
</style>



<!-- Code for visualization -->
<script type="text/javascript">
    const rvc_data = <?php echo $rvc_data_json; ?>;

    // Parse the date/time
    const rvc_parseDate = d3.timeParse('%Y-%m');

    // Set up the kpi
    const rvc = d3.select(".rvc"),
        rvc_margin = {
            top: 20,
            right: 20,
            bottom: 30,
            left: 80
        },
        rvc_width = +rvc.attr("width") - rvc_margin.left - rvc_margin.right,
        rvc_height = +rvc.attr("height") - rvc_margin.top - rvc_margin.bottom,
        rvc_g = rvc.append("g").attr("transform", "translate(" + rvc_margin.left + "," + rvc_margin.top + ")");
    // Calculate the range of dates in the dataset
    const dates = rvc_data.map(d => rvc_parseDate(d.date));
    const startDate = d3.min(dates);
    const endDate = d3.max(dates);

    // Calculate the ticks, spaced out by 6 months
    const ticks = [];
    let currentDate = new Date(startDate);
    while (currentDate < endDate) {
        ticks.push(currentDate);
        currentDate = new Date(currentDate.getFullYear(), currentDate.getMonth() + 6, 1);
    }

    const rvc_x = d3.scaleBand()
        .rangeRound([0, rvc_width])
        .domain(ticks.map(d => (d.getMonth() + 1) + '/' + d.getFullYear()))
        .padding(0.2);

    const rvc_y = d3.scaleLinear()
        .rangeRound([rvc_height, 0])
        .domain([0, d3.max(rvc_data, d => Math.max(d.revenue, d.cost))]); // Adjust domain for both revenue and cost

    rvc_g.selectAll(".bar-revenue")
        .data(rvc_data)
        .enter().append("rect")
        .attr("class", "bar-revenue")
        .attr("x", d => rvc_x((rvc_parseDate(d.date).getMonth() + 1) + '/' + rvc_parseDate(d.date).getFullYear()))
        .attr("y", d => rvc_y(d.revenue))
        .attr("width", 20) // Adjust width for bar separation
        .attr("height", d => rvc_height - rvc_y(d.revenue));

    // rvc_g.selectAll(".bar-cost")
    //     .data(rvc_data)
    //     .enter().append("rect")
    //     .attr("class", "bar-cost")
    //     .attr("x", d => rvc_x(rvc_parseDate(d.date))) // Adjust x position for separation
    //     .attr("y", d => rvc_y(d.cost))
    //     .attr("width", rvc_x.bandwidth() / 2) // Adjust width for bar separation
    //     .attr("height", d => rvc_height - rvc_y(d.cost));

    // Draw the x-axis
    rvc_g.append("g")
        .attr("class", "axis")
        .attr("transform", "translate(0," + rvc_height + ")")
        .call(d3.axisBottom(rvc_x));

    // Draw the y-axis
    rvc_g.append("g")
        .attr("class", "axis")
        .call(d3.axisLeft(rvc_y).ticks(5));
</script>