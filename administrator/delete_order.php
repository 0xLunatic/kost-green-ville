<?php
// Include the database configuration file
require_once 'dbconfig.php';

// Check if the orderId parameter is set
if (isset($_POST['orderId'])) {
    $orderId = $_POST['orderId'];

    // Prepare the delete statement
    $stmt = $db->prepare("DELETE FROM `order` WHERE id = ?");
    $stmt->bind_param("i", $orderId);

    // Execute the delete statement
    if ($stmt->execute()) {
        // Deletion successful
        echo "Order deleted successfully";
    } else {
        // Failed to delete order
        echo "Error deleting order";
    }

    // Close the statement
    $stmt->close();
} else {
    // Order ID parameter not set
    echo "Invalid request";
}
