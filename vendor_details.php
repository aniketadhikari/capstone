<?php
@include 'config.php';
include 'functions.php';

$vendor_id = isset($_GET['vendor_id']) ? $_GET['vendor_id'] : die('Vendor ID not specified.');
$vendorQuery = "SELECT * FROM VENDORS WHERE vendor_id = $vendor_id";
$vendor = $conn->query($vendorQuery)->fetch_assoc();

$commentsQuery = "SELECT * FROM dbmaster.COMMENTS WHERE vendor_id = $vendor_id";
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/main.css">

    <title>Vendor Details</title>
</head>
<style>
    .button {
        display: inline-flex;
        align-items: center;
        justify-content: space-evenly;
        color: white;
        font-size: 1rem;
        border-radius: 1rem;
        border-width: 0px;
        width: 14rem;
        border-color: #007bff;
    }

    .submit-comment {
        background-color: #df0000;
    }

    textarea {
        width: 100%;
    }
</style>

<body>

    <div class="vendor-details">
        <h1><?php echo htmlspecialchars($vendor['vendor_name']); ?></h1>
        <p><?php echo htmlspecialchars($vendor['vendor_description']); ?></p>

        <!-- Display comments -->
        <?php while ($comment = $comments->fetch_assoc()) : ?>
            <div class="comment">
                <p><?php echo displayStarRating($comment['rating']); ?></p>

                <p>Rating: <?php echo $comment['rating']; ?></p>
                <p><?php echo htmlspecialchars($comment['comment']); ?></p>
            </div>
        <?php endwhile; ?>

        <!-- This part is for new comments -->
        <form method="post" action="submit_comment.php">
            <input name="vendor_id" hidden value="<?php echo $vendor_id; ?>">
            <textarea class="mb-4 form-control-lg" name="comment" required placeholder="Comments about vendor"></textarea>
            <br>
            <select name="rating" class="form-control-lg" required>
                <option value="5">5 Stars</option>
                <option value="4">4 Stars</option>
                <option value="3">3 Stars</option>
                <option value="2">2 Stars</option>
                <option value="1">1 Star</option>
            </select>
            <div class="mb-4 mt-4">
                <a href="ratings.php" class="back-button button">Back to Main Page <img src="images/sf-icons/go-back.png" width="18px" alt=""></a>
                <button class="button submit-comment" type="submit" name="comment_submit">Submit Comment <img src="images/sf-icons/comment.png" width="18px" alt=""></button>
                <?php
                if (isset($error)) {
                    foreach ($error as $error) {
                        echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
                    };
                }
                ?>
            </div>
        </form>


    </div>
</body>

</html>