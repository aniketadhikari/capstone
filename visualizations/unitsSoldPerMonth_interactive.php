<?php
@include 'config.php';

$kpi_select = "SELECT MERCHANDISING_PERIOD as month, 
MERCHANDISING_YEAR as year, 
SUM(SALESU) as sales FROM KPI
group by MERCHANDISING_YEAR, MERCHANDISING_PERIOD 
order by MERCHANDISING_YEAR, MERCHANDISING_PERIOD;";
$kpi_result = mysqli_query($conn, $kpi_select);
$kpis = mysqli_fetch_all($kpi_result, MYSQLI_ASSOC);
mysqli_free_result($kpi_result);



?>
<!DOCTYPE html>
<meta charset="utf-8">

<!-- Load d3.js -->
<script src="https://d3js.org/d3.v6.js"></script>

<!-- Initialize a select button -->
<select id="selectButton"></select>

<!-- Create a div where the graph will take place -->
<div class="my_dataviz"></div>

<script>
    // set the dimensions and margins of the graph
    const margin = {
            top: 10,
            right: 30,
            bottom: 30,
            left: 60
        },
        width = 460 - margin.left - margin.right,
        height = 400 - margin.top - margin.bottom;

    // append the svg object to the body of the page
    const svg = d3.select(".my_dataviz")
        .append("svg")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
        .append("g")
        .attr("transform", `translate(${margin.left}, ${margin.top})`);

    //Read the data
    d3.csv("https://raw.githubusercontent.com/holtzy/data_to_viz/master/Example_dataset/5_OneCatSevNumOrdered.csv").then(function(data) {

        // List of groups (here I have one group per column)
        const allGroup = new Set(data.map(d => d.name))


        // add the options to the button
        d3.select("#selectButton")
            .selectAll('myOptions')
            .data(allGroup)
            .enter()
            .append('option')
            .text(function(d) {
                return d;
            }) // text showed in the menu
            .attr("value", function(d) {
                return d;
            }) // corresponding value returned by the button

        // A color scale: one color for each group
        const myColor = d3.scaleOrdinal()
            .domain(allGroup)
            .range(d3.schemeSet2);

        // Add X axis --> it is a date format
        const x = d3.scaleLinear()
            .domain(d3.extent(data, function(d) {
                return d.year;
            }))
            .range([0, width]);
        svg.append("g")
            .attr("transform", `translate(0, ${height})`)
            .call(d3.axisBottom(x).ticks(7));

        // Add Y axis
        const y = d3.scaleLinear()
            .domain([0, d3.max(data, function(d) {
                return +d.n;
            })])
            .range([height, 0]);
        svg.append("g")
            .call(d3.axisLeft(y));

        // Initialize line with first group of the list
        const line = svg
            .append('g')
            .append("path")
            .datum(data.filter(function(d) {
                return d.name == "Helen"
            }))
            .attr("d", d3.line()
                .x(function(d) {
                    return x(d.year)
                })
                .y(function(d) {
                    return y(+d.n)
                })
            )
            .attr("stroke", function(d) {
                return myColor("valueA")
            })
            .style("stroke-width", 4)
            .style("fill", "none")

        // A function that update the chart
        function update(selectedGroup) {

            // Create new data with the selection?
            const dataFilter = data.filter(function(d) {
                return d.name == selectedGroup
            })

            // Give these new data to update line
            line
                .datum(dataFilter)
                .transition()
                .duration(1000)
                .attr("d", d3.line()
                    .x(function(d) {
                        return x(d.year)
                    })
                    .y(function(d) {
                        return y(+d.n)
                    })
                )
                .attr("stroke", function(d) {
                    return myColor(selectedGroup)
                })
        }

        // When the button is changed, run the updateChart function
        d3.select("#selectButton").on("change", function(event, d) {
            // recover the option that has been chosen
            const selectedOption = d3.select(this).property("value")
            // run the updateChart function with this selected option
            update(selectedOption)
        })

    })
</script>