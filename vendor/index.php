<?php
include '../config.php';
include 'functions.php';

$vendorQuery = "SELECT 
v.vendor_id, v.vendor_name, v.vendor_description, 
AVG(c.rating) AS average_rating, 
COUNT(c.comment_id) AS total_reviews 
FROM VENDORS v 
LEFT JOIN 
COMMENTS c 
ON v.vendor_id = c.vendor_id 
GROUP BY v.vendor_id";

$vendors = $conn->query($vendorQuery);
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/sidebar.css?1">
    <link rel="stylesheet" href="styles/pages.css?1">

    <link rel="stylesheet" href="styles/main.css">
    <title>Vendor Ratings</title>
</head>
    <body>

        <?php
            @include './sidebar.php';
        ?>
        <div class="vendor-list-container">
            <a href="setting_page.php" class="button_vendor_main">Manage Vendors</a>
            <br>
            <?php while($vendor = $vendors->fetch_assoc()): ?>
                <div class="vendor">
                    <h3><?php echo htmlspecialchars($vendor['vendor_name']); ?></h3>
                    <p><?php echo htmlspecialchars($vendor['vendor_description']); ?></p>
                    <div class="vendor-rating">
                        <p>Average Rating: <?php echo round($vendor['average_rating'], 1); ?> from <?php echo $vendor['total_reviews']; ?> reviews</p>
                        <p><?php echo displayStarRating($vendor['average_rating']); ?></p>
                    </div>
                    <a href="vendor_details.php?vendor_id=<?php echo $vendor['vendor_id']; ?>" class="details-button">View Details</a>
                </div>
            <?php endwhile; ?>


        </div>

    </body>
</html>
