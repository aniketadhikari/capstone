<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://d3js.org/d3.v6.min.js"></script>
</head>
<style>
    /* Style the line */
    .line {
        fill: none;
        stroke: steelblue;
        stroke-width: 2px;
    }

    /* Style the axis */
    .axis {
        font-family: Arial, sans-serif;
        font-size: 12px;
    }

    /* Style the axis lines */
    .axis path,
    .axis line {
        fill: none;
        stroke: #000;
        shape-rendering: optimizeSpeed;
    }
</style>
<script type="text/javascript">
    const data = [{
            date: '2024-03-01',
            value: 10
        },
        {
            date: '2024-03-02',
            value: 20
        },
        {
            date: '2024-03-03',
            value: 15
        },
        {
            date: '2024-03-04',
            value: 25
        },
        {
            date: '2024-03-05',
            value: 30
        }
    ];

    // Parse the date/time
    const parseDate = d3.timeParse('%Y-%m-%d');

    // Set up the SVG
    const svg = d3.select("svg"),
        margin = {
            top: 20,
            right: 20,
            bottom: 30,
            left: 40
        },
        width = +svg.attr("width") - margin.left - margin.right,
        height = +svg.attr("height") - margin.top - margin.bottom,
        g = svg.append("g").attr("transform", "translate(" + margin.left + "," + margin.top + ")");

    // Set up the scales
    const x = d3.scaleTime()
        .rangeRound([0, width])
        .domain(d3.extent(data, d => parseDate(d.date)));

    const y = d3.scaleLinear()
        .rangeRound([height, 0])
        .domain([0, d3.max(data, d => d.value)]);

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

</html>