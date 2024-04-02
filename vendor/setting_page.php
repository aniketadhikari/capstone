<?php
 include '../config.php';

// Function to fetch vendors
function fetchVendors($conn) {
    $sql = "SELECT * FROM VENDORS";
    $result = $conn->query($sql);
    return $result;
}

// Check if a delete action is requested
if(isset($_GET['delete_vendor_id'])) {
    $vendor_id = $_GET['delete_vendor_id'];
    // Call a function to handle the deletion
    deleteVendor($vendor_id, $conn);
    // Redirect back to avoid re-deletion on refresh
    header("Location: setting_page.php");
    exit();
}

// Function to delete a vendor
function deleteVendor($vendor_id, $conn) {
    // Fetch vendor's details
    $vendorQuery = "SELECT * FROM VENDORS WHERE vendor_id = ?";
    $stmt = $conn->prepare($vendorQuery);
    $stmt->bind_param("i", $vendor_id);
    $stmt->execute();
    $vendor = $stmt->get_result()->fetch_assoc();

    if($vendor) {
        // Insert into trash
        $insertTrash = "INSERT INTO TRASH (vendor_id, vendor_name, vendor_description, vendor_contact_info) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($insertTrash);
        $stmt->bind_param("isss", $vendor['vendor_id'], $vendor['vendor_name'], $vendor['vendor_description'], $vendor['vendor_contact_info']);
        $stmt->execute();
        
        // Delete from vendors
        $deleteVendor = "DELETE FROM VENDORS WHERE vendor_id = ?";
        $stmt = $conn->prepare($deleteVendor);
        $stmt->bind_param("i", $vendor_id);
        $stmt->execute();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Settings</title>
    <link rel="stylesheet" href="styles/main.css"> <!-- Ensure you have this CSS file -->
</head>
<body>
    <h1>Vendor Settings</h1>
    <a href="add_vendor.php" class="button">+ Add Vendor</a>
    <a href="trash_page.php" class="button">Manage Trash</a>

    <div class="vendor-list">
        <?php
        $vendors = fetchVendors($conn);
        if ($vendors->num_rows > 0) {
            while($vendor = $vendors->fetch_assoc()) {
                echo "<div class='vendor-item'>";
                echo "<p>" . htmlspecialchars($vendor['vendor_name']) . "</p>";
                echo "<a href='setting_page.php?delete_vendor_id=" . $vendor['vendor_id'] . "' class='delete-button'>Delete</a>";
                echo "</div>";
            }
        } else {
            echo "<p>No vendors found.</p>";
        }
        ?>
    </div>
    <a href="../ratings.php" class="button">Back</a>

</body>
</html>
