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
        $insert_stmt = "INSERT INTO COMMENTS(vendor_id, comment, rating) VALUES(?, ?, ?)";
        $insert_stmt_prepared = $conn->prepare($insert_stmt);

        // 'i' denotes the vendor_id is an integer, 's' denotes the comment_text and rating are strings
        // Note: If rating is stored as a DECIMAL in the database, you might need to cast it accordingly
        $insert_stmt_prepared->bind_param("isi", $vendor_id, $comment_text, $rating);
        $insert_stmt_prepared->execute();
        echo "Error: " . $insert_stmt_prepared->error;

        // Close statement
        $insert_stmt_prepared->close();
    }
}
