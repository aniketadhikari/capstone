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
    <title>Add Vendor</title>
</head>
    <body>
        <form method="post" action="add_vendor.php">
            <input type="text" name="name" placeholder="Vendor Name" required>
            <textarea name="description" placeholder="Vendor Description"></textarea>
            <input type="text" name="contact_info" placeholder="Contact Info">
            <button type="submit">Add Vendor</button>
        </form>
        <div>
            <a href="setting_page.php" class="button">Back</a>

        </div>

    </body>
</html>
