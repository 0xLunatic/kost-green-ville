<?php
require_once 'dbconfig.php';

if (isset($_POST['commentId'])) {
    $commentId = $_POST['commentId'];

    // Prepare the delete statement
    $stmt = $db->prepare("DELETE FROM `comment` WHERE id = ?");
    $stmt->bind_param("i", $commentId);

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
