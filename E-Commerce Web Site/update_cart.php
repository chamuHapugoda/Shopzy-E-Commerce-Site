<?php
session_start();

if (!isset($_SESSION['customer_id'])) {
    die("Please login to update your cart.");
}

$customer_id = $_SESSION['customer_id'];
$cart_item_id = $_POST['cart_item_id']; // Cart item ID
$new_quantity = $_POST['quantity']; // New quantity to update

if ($new_quantity < 1) {
    die("Quantity must be at least 1.");
}

// Include the connection file to establish a connection
include 'connection.php';

// Prevent SQL injection by preparing the statement
$stmt = $conn->prepare("UPDATE cart_items SET quantity = ? WHERE cart_item_id = ? AND customer_id = ?");
$stmt->bind_param("iii", $new_quantity, $cart_item_id, $customer_id);

if ($stmt->execute()) {
    // Fetch updated cart items and total
    $sql = "SELECT ci.cart_item_id, ci.product_id, ci.quantity, p.name, p.price, p.image_url, p.category, p.sub_catagory, p.description 
            FROM cart_items ci 
            INNER JOIN products p ON ci.product_id = p.product_id 
            WHERE ci.customer_id = $customer_id";

    $result = $conn->query($sql);
    $cart_items = [];
    $total = 0;

    while ($row = $result->fetch_assoc()) {
        $row['subtotal'] = $row['quantity'] * $row['price'];
        $total += $row['subtotal'];
        $cart_items[] = $row;
    }

    $conn->close();

    // Send the updated cart items and total as JSON response
    echo json_encode([
        'cart_items' => $cart_items,
        'total' => $total
    ]);
} else {
    echo json_encode(['error' => 'Error updating quantity: ' . $conn->error]);
}

$conn->close();
?>
