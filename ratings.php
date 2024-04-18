<?php
include 'config.php';
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
    <link rel="stylesheet" href="styles/sidebar.css">
    <link rel="stylesheet" href="styles/pages.css">
    <link rel="stylesheet" href="styles/main.css">

    <title>Vendor Ratings</title>
</head>
<style>
    .button {
        display: inline-flex;
        align-items: center;
        justify-content: space-evenly;
        color: white;
        font-size: 1rem;
        border-radius: 1rem;
        border-width: 2px;
        width: 10rem;
    }
    h1 {
        text-align: center;
    }
</style>

<body>

    <?php
    @include 'sidebar.php';
    ?>
    <h1>Vendor Ratings</h1>
    <div class="vendor-list-container">
        <div>
            <a href="vendor_settings.php" class="button button_vendor_main">Manage Vendors</a>
            <a href="vendor_analysis.php" class="button button_vendor_main">Vendors Analysis</a>
            <a href="submit_comment.php" class="button">Comment<img src="images/sf-icons/comment.png" width="18px" alt=""></a>
        </div>
        <br>
        <?php while ($vendor = $vendors->fetch_assoc()) : ?>
            <div class="vendor mb-3 mt-3">
                <h3><?php echo htmlspecialchars($vendor['vendor_name']); ?></h3>
                <h5><?php echo htmlspecialchars($vendor['vendor_description']); ?></h5>
                <div class="vendor-rating">
                    <p>Average Rating: <?php echo round($vendor['average_rating'], 1); ?> from <?php echo $vendor['total_reviews']; ?> reviews</p>
                    <p><?php echo displayStarRating($vendor['average_rating']); ?></p>
                </div>
                <a href="vendor_details.php?vendor_id=<?php echo $vendor['vendor_id']; ?>" class="details-button button">View Details <img src="images/sf-icons/arrow-forward-circle.png" width="18px"></a>
            </div>
        <?php endwhile; ?>


    </div>

</body>

</html>