<?php

$year_select = "SELECT DISTINCT MERCHANDISING_YEAR as unique_year FROM KPI";
$year_result = mysqli_query($conn, $year_select);
$unique_years = mysqli_fetch_all($year_result, MYSQLI_ASSOC);
mysqli_free_result($year_result);
$uspm_color_mode = $_GET['uspm_color'];
$uspm_color = 'blue';
if (isset($_GET['submit'])) {
    if ($_GET['selected_year'] == 'IS NOT NULL') {
        $selected_year = 'IS NOT NULL';
    } else {
        $selected_year = '=' . '' . $_GET['selected_year'] . '';
    }
    $uspm_color = $uspm_color_mode;
}


$kpi_select = "SELECT  MERCHANDISING_PERIOD as month, 
MERCHANDISING_YEAR as year, 
SUM(SALESU) as sales FROM KPI
where MERCHANDISING_YEAR $selected_year
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
    .filter-btn {
        color: white;
        display: inline-flex;
        align-items: center;
        justify-content: space-evenly;
        border-radius: 1rem;
        background-color: #87192A;
        border: #87192A solid 2px;
        width: 30%;
    }

    /* Style the line */
    .line {
        fill: none;
        /* change this to refer to a php variable */
        stroke: <?php echo $uspm_color ?>;
        stroke-width: 2px;
    }

    .point {
        /* change this to refer to a php variable */
        fill: <?php echo $uspm_color ?>;
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
        color: grey;
    }

    .grid {
        color: grey;
    }

    .point-label {
        position: absolute;
        padding: 5px;
        color: white;
        border-radius: 5px;
        font-size: 6px;
        fill: white;
    }
</style>



<!-- Code for visualization -->
<script type="text/javascript">
    const data = <?php echo $data_json; ?>;

    // Parse the date/time
    const parseDate = d3.timeParse('%Y-%m');

    // Set up the kpi
    const unitsSold = d3.select(".unitsSold"),
        margin = {
            top: 20,
            right: 20,
            bottom: 30,
            left: 80
        },
        width = +unitsSold.attr("width") - margin.left - margin.right,
        height = +unitsSold.attr("height") - margin.top - margin.bottom,
        g = unitsSold.append("g").attr("transform", "translate(" + margin.left + "," + margin.top + ")");

    // Set up the x-scales
    const x = d3.scaleTime()
        .rangeRound([0, width])
        .domain(d3.extent(data, d => parseDate(d.date)));

    // Set up y-scales
    const y = d3.scaleLinear()
        .rangeRound([height, 0])
        .domain([Math.floor(d3.min(data, d => d.value) / 1000000) * 1000000, Math.ceil(d3.max(data, d => d.value) / 1000000) * 1000000]);

    // Vertical gridlines
    g.append("g")
        .attr("class", "grid")
        .call(d3.axisLeft(y)
            .ticks(10)
            .tickSize(-width)
            .tickFormat("")
        );

    // Horizontal gridlines
    g.append("g")
        .attr("class", "grid")
        .attr("transform", "translate(0," + height + ")")
        .call(d3.axisBottom(x)
            .tickSize(-height)
            .tickFormat("")
        );

    // Draw and define the line
    const line = d3.line()
        .x(d => x(parseDate(d.date)))
        .y(d => y(d.value));
    g.append("path")
        .datum(data)
        .attr("class", "line")
        .attr("d", line);

    const points = g.selectAll(".point")
        .data(data)
        .enter().append("circle")
        .attr("class", "point")
        .attr("cx", d => x(parseDate(d.date)))
        .attr("cy", d => y(d.value))
        .attr("r", 5);

    const labels = g.selectAll(".point-label")
        .data(data)
        .enter().append("text")
        .attr("class", "point-label")
        .attr("x", d => x(parseDate(d.date)))
        .attr("y", d => y(d.value) + 1) // Adjust the position to place the text above the point
        .text(d => d.value);



    // Draw the x-axis
    g.append("g")
        .attr("class", "axis")
        .attr("transform", "translate(0," + height + ")")
        .call(d3.axisBottom(x).tickFormat(d3.timeFormat("%-m/%y")));

    // Draw the y-axis
    g.append("g")
        .attr("class", "axis")
        .call(d3.axisLeft(y).ticks(10));
</script>
<form action="" method="get">
    <div class="dropdown" style="display: flex; justify-content: space-evenly; margin-top: 5%">
        <select class="form-select" aria-label="Default select example" name="uspm_color" style="width: 30%">
            <option value="blue">Blue</option>
            <option value="red">Red</option>
            <option value="green">Green</option>
            <option value="white">White</option>
            <option value="maroon">Maroon</option>
            <option value="purple">Purple</option>
            <option value="fuchsia">Fuchsia</option>
            <option value="lime">Lime</option>
            <option value="olive">Olive</option>
            <option value="yellow">Yellow</option>
            <option value="navy">Navy</option>
            <option value="teal">Teal</option>
            <option value="aqua">Aqua</option>
        </select>
        <select class="form-select" aria-label="Default select example" name="selected_year" style="width: 30%">
            <option value="IS NOT NULL">All</option>
            <?php foreach ($unique_years as $u_year) { ?>
                <option value="<?php echo $u_year['unique_year']; ?>"><?php echo $u_year['unique_year']; ?></option>
            <?php } ?>
        </select>
        <button class="filter-btn" type="submit" name="submit">
            Filter and Change Color
        </button>
        
    </div>
</form>
<form action="" method="get">
</form>