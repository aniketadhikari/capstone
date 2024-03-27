
<!-- 


@include 'config.php';
$stmt = $conn->prepare("INSERT INTO comments (vendor_id, comment, rating) VALUES (?, ?, ?)");
$stmt->bind_param("isi", $vendor_id, $comment_text, $rating);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assuming these values are passed via POST method
    $vendor_id = $_POST['vendor_id'];
    $comment_text = $_POST['comment'];
    $rating = $_POST['rating'];

    $stmt = $conn->prepare("INSERT INTO comments (vendor_id, comment, rating) VALUES (?, ?, ?)");
    $stmt->bind_param("isi", $vendor_id, $comment_text, $rating);

    if ($stmt->execute()) {
        echo "Comment submitted successfully.";
        // Redirect or perform other success operations
    } else {
        echo "Error submitting comment: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?> 

-->

<?php
include 'config.php';

// Check if the form data is posted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ensure all fields are set and not empty using isset() or !empty()
    if (isset($_POST['vendor_id'], $_POST['comment'], $_POST['rating'])) {
        // Assign the POST data to variables
        $vendor_id = $_POST['vendor_id'];
        $comment_text = $_POST['comment'];
        $rating = $_POST['rating'];

        // Prepare an INSERT statement to add the new comment into the database
        $stmt = $conn->prepare("INSERT INTO comments (vendor_id, comment, rating) VALUES (?, ?, ?)");
        
        // 'i' denotes the vendor_id is an integer, 's' denotes the comment_text and rating are strings
        // Note: If rating is stored as a DECIMAL in the database, you might need to cast it accordingly
        $stmt->bind_param("isi", $vendor_id, $comment_text, $rating);
        
        // Execute the statement
        if ($stmt->execute()) {
            // Redirect back to the vendor details page or display a success message
            header("Location: vendor_details.php?vendor_id=$vendor_id");
            exit();
        } else {
            // Handle error
            echo "Error: " . $stmt->error;
        }
        
        // Close statement
        $stmt->close();
    } else {
        // Not all fields were filled in
        echo "Please fill in all fields.";
    }
}

// Close connection
$conn->close();
?>
