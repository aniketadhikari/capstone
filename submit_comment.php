<?php
@include 'config.php';

if (isset($_POST['submit_comment'])) {

    $vendor_id = (int)$_POST['vendorSelect'];
    $vendor_comment = mysqli_real_escape_string($conn, $_POST['comment']);
    $rating = (float)$_POST['ratingSelect'];

    $comment_insert = "INSERT INTO dbmaster.COMMENTS(`vendor_id`, `comment`, `rating`) VALUES($vendor_id, '$vendor_comment', $rating)";
    mysqli_query($conn, $comment_insert);
    echo "INSERT INTO dbmaster.COMMENTS(`vendor_id`, `comment`, `rating`) VALUES($vendor_id, '$vendor_comment', $rating)";
    // header('location: ratings.php');
}

function fetchVendors($conn)
{
    $sql = "SELECT * FROM VENDORS";
    $result = $conn->query($sql);
    return $result;
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
    <form action="" method="post">
        <div class="form-group">
            <!-- <input class="form-control-lg" type="text" name="name" placeholder="Vendor Name" required> -->
            <label for="vendorSelect" class="form-label">Select vendor</label>
            <select name="vendorSelect" id="vendorSelect" class="form-select">
                <?php
                $vendors = fetchVendors($conn);
                if ($vendors->num_rows > 0) {
                    while ($vendor = $vendors->fetch_assoc()) {
                ?>
                        <option value=<?php echo $vendor['vendor_id']; ?>><?php echo htmlspecialchars($vendor['vendor_name']); ?></option>
                <?php
                    }
                } else {
                    echo "<p>No vendors found.</p>";
                }
                ?>
            </select>
        </div>
        <br>
        <div class="form-group">
            <input name="comment" type="text" id="comment" class="form-control form-control" placeholder="Write your comment here" required>
        </div>
        <br>
        <div class="form-group">
            <select name="ratingSelect" id="ratingSelect" class="form-select">
                <option value="1.0">1 Star</option>
                <option value="2.0">2 Star</option>
                <option value="3.0">3 Star</option>
                <option value="4.0">4 Star</option>
                <option value="5.0">5 Star</option>
            </select>
        </div>
        <br>
        <div class="mt-3">
            <a href="ratings.php" class="back-button button">Go Back <img src="images/sf-icons/go-back.png" width="18px" alt=""></a>
            <button class="submit-comment button" name="submit_comment" type="submit">Submit comment<img src="images/sf-icons/comment.png" alt="" width="18px"></button>
        </div>
    </form>

    <div class="vendor-details">
        <h1><?php echo htmlspecialchars($vendor['vendor_name']); ?></h1>
        <p><?php echo htmlspecialchars($vendor['vendor_description']); ?></p>
    </div>
</body>

</html>