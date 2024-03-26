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

// change color mode for RVC visualization
$rvc_color_mode = $_GET['rvc_color'];
$rev_color = 'green';
$cost_color = 'red';
if (isset($_GET['change_rvc_color'])) {
    if ($rvc_color_mode == 'accessible') {
        $rev_color = '#34cc00';
        $cost_color = '#ad154d';
    }
}
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
        fill: <?php echo $cost_color ?>;
    }

    .bar-revenue {
        fill: <?php echo $rev_color ?>;
    }

    .bar-label-cost {
        fill: white;
        font-size: 12px;
        writing-mode: vertical-rl;
        text-orientation: mixed;
    }

    .bar-label-revenue {
        fill: white;
        font-size: 12px;
        writing-mode: vertical-rl;
        text-orientation: mixed;
    }
</style>



<!-- Code for visualization -->
<script type="text/javascript">
    const rvc_data = <?php echo $rvc_data_json; ?>;

    // Parse the date/time
    const rvc_parseDate = d3.timeParse('%Y-%m');

    // Set up the rvc
    const rvc = d3.select(".rvc"),
        rvc_margin = {
            top: 20,
            right: 20,
            bottom: 30,
            left: 40
        },
        rvc_width = +rvc.attr("width") - rvc_margin.left - rvc_margin.right,
        rvc_height = +rvc.attr("height") - rvc_margin.top - rvc_margin.bottom,
        rvc_g = rvc.append("g").attr("transform", "translate(" + rvc_margin.left + "," + rvc_margin.top + ")");

    const currencyFormatter = d3.format("$,");

    const rvc_x = d3.scaleBand()
        .rangeRound([0, rvc_width])
        .domain(rvc_data.map(d => rvc_parseDate(d.date)))
        .padding(0.2);

    const rvc_y = d3.scaleLinear()
        .rangeRound([rvc_height, 0])
        .domain([0, d3.max(rvc_data, d => Math.max(d.revenue, d.cost)) * 1.1]); // Adjust domain for both revenue and cost

    // Vertical gridlines
    rvc_g.append("g")
        .attr("class", "grid")
        .call(d3.axisLeft(rvc_y)
            .ticks(15)
            .tickSize(-rvc_width)
            .tickFormat("")
        );

    // Horizontal gridlines
    rvc_g.append("g")
        .attr("class", "grid")
        .attr("transform", "translate(0," + rvc_height + ")")
        .call(d3.axisBottom(rvc_x)
            .tickSize(-rvc_height)
            .tickFormat("")
        );

    // Draw the bars for revenue
    rvc_g.selectAll(".bar-revenue")
        .data(rvc_data)
        .enter().append("rect")
        .attr("class", "bar-revenue")
        .attr("x", d => rvc_x(rvc_parseDate(d.date)) + 18) // Ensure x-position is based on parsed date
        .attr("y", d => rvc_y(d.revenue))
        .attr("ry", 15)
        .attr("width", (rvc_x.bandwidth() + 5) / 2)
        .attr("height", d => rvc_height - rvc_y(d.revenue));

    // Draw the bars for cost
    rvc_g.selectAll(".bar-cost")
        .data(rvc_data)
        .enter().append("rect")
        .attr("class", "bar-cost")
        .attr("x", d => rvc_x(rvc_parseDate(d.date)) - 2) // Ensure x-position is based on parsed date
        .attr("y", d => rvc_y(d.cost))
        .attr("ry", 15)
        .attr("width", (rvc_x.bandwidth() + 5) / 2)
        .attr("height", d => rvc_height - rvc_y(d.cost));

    // Append label for the maximum value above the corresponding revenue bar
    rvc_g.selectAll(".bar-label-revenue")
        .data(rvc_data)
        .enter().append("text")
        .attr("class", "bar-label-revenue")
        .attr("x", d => rvc_x(rvc_parseDate(d.date)) + 30) // Ensure x-position is based on parsed date
        .attr("y", d => rvc_y(d.revenue) + 50)
        .attr("text-anchor", "middle")
        .text(d => currencyFormatter(d.revenue)); // Show the cost value as label

    // Append label for the maximum value above the corresponding costbar
    rvc_g.selectAll(".bar-label-cost")
        .data(rvc_data)
        .enter().append("text")
        .attr("class", "bar-label-cost")
        .attr("x", d => rvc_x(rvc_parseDate(d.date)) + 10) // Ensure x-position is based on parsed date
        .attr("y", d => rvc_y(d.cost) + 50)
        .attr("text-anchor", "middle")
        .text(d => currencyFormatter(d.cost)); // Show the cost value as label


    // Draw the x-axis
    rvc_g.append("g")
        .attr("class", "axis")
        .attr("transform", "translate(0," + rvc_height + ")")
        .call(d3.axisBottom(rvc_x).tickFormat(d3.timeFormat("%-m/%y")));


    // creates the format for y-axis
    function customYAxisTickFormat(d) {
        // Keep dividing the number by 10 until it's less than 10
        while (d > 10) {
            d /= 10;
        }
        return "$" + d + "m";
    }


    // Draw the y-axis
    rvc_g.append("g")
        .attr("class", "axis")
        .call(d3.axisLeft(rvc_y).ticks(5).tickFormat(customYAxisTickFormat));
</script>
<form action="" method="get">
    <div class="dropdown" style="display: flex; justify-content: space-evenly; margin-top: 5%">
        <select class="form-select" aria-label="Default select example" name="rvc_color" style="width: 30%">
            <option value="original">Original Colors</option>
            <option value="accessible">Accessible Colors</option>
        </select>
        <button class="filter-btn" type="submit" name="change_rvc_color">
            Change Colors
        </button>
    </div>
</form>