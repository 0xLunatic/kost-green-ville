<?php
// Include the database configuration file
require_once 'dbconfig.php';

// Check if the accountId parameter is set
if (isset($_POST['accountId'])) {
    $accountId = $_POST['accountId'];

    // Fetch the current permission value for the account
    $stmt = $db->prepare("SELECT permission FROM account WHERE id = ?");
    $stmt->bind_param("i", $accountId);
    $stmt->execute();
    $stmt->bind_result($currentPermission);
    $stmt->fetch();
    $stmt->close();

    // Determine the new permission value to set
    $newPermission = ($currentPermission == 1) ? 0 : 1;

    // Prepare the update statement
    $stmt = $db->prepare("UPDATE account SET permission = ? WHERE id = ?");
    $stmt->bind_param("ii", $newPermission, $accountId);

    // Execute the update statement
    if ($stmt->execute()) {
        // Update successful
        echo "Permission updated successfully. New value: " . $newPermission;
    } else {
        // Failed to update permission
        echo "Error updating permission";
    }

    // Close the statement
    $stmt->close();
} else {
    // Account ID parameter not set
    echo "Invalid request";
}
