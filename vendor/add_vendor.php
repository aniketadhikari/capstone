<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include '../config.php'; // Include your DB config file
    // Extract and sanitize input
    $name = $_POST['name']; // Add real escaping or prepared statements here
    $description = $_POST['description'];
    $contact_info = $_POST['contact_info'];

    // SQL to insert new vendor
    $sql = "INSERT INTO VENDORS (vendor_name, vendor_description, vendor_contact_info) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $description, $contact_info);
    $stmt->execute();

    // Redirect back to the settings page
    header("Location: setting_page.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles/main.css">
    <title>Add Vendor</title>
</head>
    <body>
        <form method="post" action="add_vendor.php">
            <input type="text" name="name" placeholder="Vendor Name" required>
            <br>

            <textarea name="description" placeholder="Vendor Description"></textarea>
            <br>

            <input type="text" name="contact_info" placeholder="Contact Info">
        </form>
        <div>
            <button class ="button" type="submit">Add Vendor</button>
            <a href="setting_page.php" class="button">Back</a>

        </div>

    </body>
</html>
