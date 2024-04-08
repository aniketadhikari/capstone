<?php
include 'config.php';

// Function to fetch vendors
function fetchVendors($conn)
{
    $sql = "SELECT * FROM VENDORS";
    $result = $conn->query($sql);
    return $result;
}

// Check if a delete action is requested
if (isset($_GET['delete_vendor_id'])) {
    $vendor_id = $_GET['delete_vendor_id'];
    // Call a function to handle the deletion
    deleteVendor($vendor_id, $conn);
    // Redirect back to avoid re-deletion on refresh
    header("Location: vendor_settings.php");
    exit();
}

// Function to delete a vendor
function deleteVendor($vendor_id, $conn)
{
    // Fetch vendor's details
    $vendorQuery = "SELECT * FROM VENDORS WHERE vendor_id = ?";
    $stmt = $conn->prepare($vendorQuery);
    $stmt->bind_param("i", $vendor_id);
    $stmt->execute();
    $vendor = $stmt->get_result()->fetch_assoc();

    if ($vendor) {
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/main.css">
</head>
<style>
    h1 {
        color: white;
    }

    p {
        color: white;
    }

    .button {
        display: inline-flex;
        align-items: center;
        justify-content: space-evenly;
        color: white;
        font-size: 1rem;
        border-radius: 1rem;
        border-width: 2px;
        width: 10rem;
    }
    .delete-button {
        background-color: rgb(220 53 69);
        text-transform: uppercase;
    }
    h1 {
        text-align: center;
    }
</style>

<body>

    <?php
    @include 'sidebar.php';
    ?>

    <h1>Manage Vendors</h1>
    <a href="add_vendor.php" class="button">Add Vendor<img src="images/sf-icons/plus-sign.png" alt="" width="18px"></a>
    <a href="trash_page.php" class="button">Manage Trash<img src="images/sf-icons/trash.png" alt="" width="18px"></a>

    <div class="vendor-list">
        <?php
        $vendors = fetchVendors($conn);
        if ($vendors->num_rows > 0) {
            while ($vendor = $vendors->fetch_assoc()) {
        ?>
                <div class="vendor-item vendor mb-3 mt-3">
                    <h3><?php echo htmlspecialchars($vendor['vendor_name']); ?></h3>
                    <h5><?php echo htmlspecialchars($vendor['vendor_description']); ?></h5>
                    <a href="vendor_details.php?vendor_id=<?php echo $vendor['vendor_id']; ?>" class="details-button button">View Details
                        <img src="images/sf-icons/arrow-forward-circle.png" alt="" width="18px">
                    </a>
                    <a href=<?php echo  'vendor_settings.php?delete_vendor_id=' .  $vendor['vendor_id']?>  class='delete-button button'>Delete
                        <img src="images/sf-icons/backspace.png" alt="" width="18px">
                    </a>

                </div>
        <?php
            }
        } else {
            echo "<p>No vendors found.</p>";
        }
        ?>
    </div>
    <a href="ratings.php" class="button">Back<img src="images/sf-icons/go-back.png" alt="" width="18px"></a>

</body>

</html>