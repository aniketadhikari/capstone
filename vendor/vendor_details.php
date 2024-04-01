<?php
 include '../config.php';
include 'functions.php';

$vendor_id = isset($_GET['vendor_id']) ? $_GET['vendor_id'] : die('Vendor ID not specified.');
$vendorQuery = "SELECT * FROM VENDORS WHERE vendor_id = $vendor_id";
$vendor = $conn->query($vendorQuery)->fetch_assoc();

$commentsQuery = "SELECT * FROM COMMENTS WHERE vendor_id = $vendor_id";
$comments = $conn->query($commentsQuery);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Checking if 'text' exists in the POST data
    if (isset($_POST['text'])) {
        $comment = $_POST['text'];
        // Process the comment
    } else {
        // Handle the case where 'text' is not provided
        echo "Comment text is missing.";
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles/main.css">
    <title>Vendor Details</title>
</head>
    <body>

        <div class="vendor-details">
            <h2><?php echo htmlspecialchars($vendor['vendor_name']); ?></h2>
            <p><?php echo htmlspecialchars($vendor['vendor_description']); ?></p>

            <!-- Display comments -->
            <?php while($comment = $comments->fetch_assoc()): ?>
            <div class="comment">
                <p><?php echo displayStarRating($comment['rating']); ?></p>

                <p>Rating: <?php echo $comment['rating']; ?></p>
                <p><?php echo htmlspecialchars($comment['comment']); ?></p>
            </div>
            <?php endwhile; ?>
            
            <!-- This part is for new comments -->
            <form action="submit_comment.php" method="post">
                <input type="hidden" name="vendor_id" value="<?php echo $vendor_id; ?>">
                <textarea name="comment" required></textarea>
                <br>
                <select name="rating" required>
                    <option value="5">5 Stars</option>
                    <option value="4">4 Stars</option>
                    <option value="3">3 Stars</option>
                    <option value="2">2 Stars</option>
                    <option value="1">1 Star</option>
                </select>
                <button type="submit">Submit Comment</button>
            </form>
            <a href="index.php" class="back-button">Back to Main Page</a>

        </div>
    </body>
</html>
