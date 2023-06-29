<?php
// Include the database configuration file
require_once 'dbconfig.php';

// Check if the accountId parameter is set
if (isset($_POST['accountId'])) {
    $accountId = $_POST['accountId'];

    // Prepare the delete statement
    $stmt = $db->prepare("DELETE FROM account WHERE id = ?");
    $stmt->bind_param("i", $accountId);

    // Execute the delete statement
    if ($stmt->execute()) {
        // Deletion successful
        echo "Account deleted successfully";
    } else {
        // Failed to delete account
        echo "Error deleting account";
    }

    // Close the statement
    $stmt->close();
} else {
    // Account ID parameter not set
    echo "Invalid request";
}
