<?php
// Include your database connection file
include('connection.php'); 

// Check if the favourite_item_id is passed via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['favourite_item_id'])) {
    $favourite_item_id = intval($_POST['favourite_item_id']); // Sanitize input

    // Prepare and execute SQL query to delete the item
    $sql_delete = "DELETE FROM favourite_items WHERE favourite_item_id = ?";
    $stmt = $conn->prepare($sql_delete);

    if ($stmt) {
        $stmt->bind_param("i", $favourite_item_id);

        if ($stmt->execute()) {
            // Return success response
            echo json_encode(['success' => true]);
        } else {
            // Return error response for failed execution
            echo json_encode(['success' => false, 'error' => 'Execution failed.']);
        }

        $stmt->close();
    } else {
        // Return error response for failed preparation
        echo json_encode(['success' => false, 'error' => 'Failed to prepare statement.']);
    }
} else {
    // Return error response for invalid request
    echo json_encode(['success' => false, 'error' => 'Invalid request.']);
}

$conn->close();
?>
