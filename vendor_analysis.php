<?php
include 'config.php';  // Include your DB connection settings

$labels = [];
$data = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $vendor_id = $_POST['vendor_id'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'] . ' 23:59:59'; // Include time for end date

    // Fetch individual ratings from comments
    $ratingQuery = "SELECT DATE(created_at) AS date, rating FROM COMMENTS 
                    WHERE vendor_id = ? AND created_at BETWEEN ? AND ?
                    ORDER BY created_at ASC";
    $stmt = $conn->prepare($ratingQuery);
    $stmt->bind_param("iss", $vendor_id, $start_date, $end_date);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $labels[] = $row['date'];
        $data[] = $row['rating'];
    }
}

// Fetch vendors for the dropdown
$vendorQuery = "SELECT vendor_id, vendor_name FROM VENDORS";
$vendors = $conn->query($vendorQuery);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vendor Analysis</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/main.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
</head>
<body>
    <form action="vendor_analysis.php" method="post">
        <label for="vendor">Choose a vendor:</label>
        <select name="vendor_id" id="vendor" class="form-control-lg form-select" required> 
            <?php while($vendor = $vendors->fetch_assoc()): ?>
                <option value="<?php echo $vendor['vendor_id']; ?>">
                    <?php echo htmlspecialchars($vendor['vendor_name']); ?>
                </option>
            <?php endwhile; ?>
        </select>
        <br>
        
        <label for="start_date">Start Date:</label>
        <input class="form-control form-control-lg"  type="date" name="start_date" id="start_date" required>
        <br>
        
        <label for="end_date">End Date:</label>
        <input class="form-control form-control-lg" type="date" name="end_date" id="end_date" required>
        <br>
        
        <button type="submit" class="button">Analyze</button>
    </form>

    <?php if (!empty($labels) && !empty($data)): ?>
        <canvas id="ratingChart" width="800" height="250"></canvas>
        <script>
            var ctx = document.getElementById('ratingChart').getContext('2d');
            var labels = <?php echo json_encode($labels); ?>;
            var data = <?php echo json_encode($data); ?>;
            
            var ratingChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Individual Ratings',
                        data: data,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: false,
                            max: 5,
                            min: 0
                        }
                    }
                }
            });
        </script>
    <?php endif; ?>
</body>
</html>
