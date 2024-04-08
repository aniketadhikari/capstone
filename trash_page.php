<?php
include 'config.php';

// Function to fetch trashed vendors
function fetchTrashedVendors($conn)
{
    $sql = "SELECT * FROM TRASH";
    $result = $conn->query($sql);
    return $result;
}

// Check if a restore action is requested
if (isset($_GET['restore_vendor_id'])) {
    $vendor_id = $_GET['restore_vendor_id'];
    // Call a function to handle the restoration
    restoreVendor($vendor_id, $conn);
    // Redirect to avoid re-posting on refresh\
    header("Location: trash_page.php");
    exit();
}

// Function to restore a vendor from trash
function restoreVendor($vendor_id, $conn)
{
    // Fetch vendor's details from trash
    $vendorQuery = "SELECT * FROM TRASH WHERE vendor_id = ?";
    $stmt = $conn->prepare($vendorQuery);
    $stmt->bind_param("i", $vendor_id);
    $stmt->execute();
    $vendor = $stmt->get_result()->fetch_assoc();

    if ($vendor) {
        // Insert back into vendors
        $insertVendor = "INSERT INTO VENDORS (vendor_id, vendor_name, vendor_description, vendor_contact_info) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($insertVendor);
        $stmt->bind_param("isss", $vendor['vendor_id'], $vendor['vendor_name'], $vendor['vendor_description'], $vendor['vendor_contact_info']);
        $stmt->execute();

        // Remove from trash
        $deleteTrash = "DELETE FROM TRASH WHERE vendor_id = ?";
        $stmt = $conn->prepare($deleteTrash);
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
    <title>Trash Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/main.css"> <!-- Make sure to style your page accordingly -->
</head>

<body>
    <h1>Trashed Vendors</h1>
    <div class="vendor-list">
        <?php
        $trashedVendors = fetchTrashedVendors($conn);
        if ($trashedVendors->num_rows > 0) {
            while ($vendor = $trashedVendors->fetch_assoc()) {
        ?>
                <div class="vendor">
                    <h1><?php echo htmlspecialchars($vendor['vendor_name']) ?></h1>
                    <a href=<?php echo 'trash_page.php?restore_vendor_id=' . $vendor['vendor_id']  ?> class='restore-button'>Restore</a>
                </div>
        <?php
            }
        } else {
            echo "<p>No trashed vendors found.</p>";
        }
        ?>
    </div>
    <a href="vendor_settings.php" class="back-button">Back</a>

</body>

</html>