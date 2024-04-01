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
    <link rel="stylesheet" href="styles/main.css">
    <title>Vendor Ratings</title>
</head>
    <body>
        <br>
        <div class="vendor-list-container">
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

            <a href="setting_page.php" class="button_vendor_main">Manage Vendors</a>

        </div>

    </body>
</html>
