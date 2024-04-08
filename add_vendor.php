<?php
include 'config.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'config.php'; // Include your DB config file
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
    header("Location: vendor_settings.php");
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/main.css">

    <title>Add Vendor</title>

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
        width: 10rem;
        border-color: #007bff;
    }

    textarea {
        width: 100%;
    }

    h1 {
        text-align: center;
    }
</style>

<body>
    <h1>Add Vendor</h1>
    <form method="post" action="add_vendor.php">
        <div class="form-group">
            <input class="form-control-lg" type="text" name="name" placeholder="Vendor Name" required>
        </div>
        <br>
        <div class="form-group">
            <textarea class="form-control-lg" name="description" placeholder="Vendor Description" rows="3"></textarea>
        </div>
        <br>
        <div class="form-group">
            <input class="form-control-lg" type="text" name="contact_info" placeholder="Contact Info">
        </div>
        <br>
        <div>
            <a href="vendor_settings.php" class="back button">Back <img src="images/sf-icons/go-back.png" alt="" width="18px"></a>
            <button class="button" type="submit">Add Vendor <img src="images/sf-icons/plus-sign.png" alt="" width="18px"></button>
        </div>

    </form>


</body>

</html>