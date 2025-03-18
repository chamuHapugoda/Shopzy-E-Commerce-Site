<?php
// Only fetch cart items if the user is logged in
if (isset($_SESSION['customer_id'])) {
    $customer_id = $_SESSION['customer_id'];

    // Include the connection file to establish a connection
    include 'connection.php';

    // Query to fetch cart items for the logged-in customer
    $sql = "SELECT ci.cart_item_id, ci.product_id, ci.quantity, p.name, p.price, p.image_url, p.category, p.sub_catagory, p.description 
    FROM cart_items ci 
    INNER JOIN products p ON ci.product_id = p.product_id 
    WHERE ci.customer_id = $customer_id";

    $result = $conn->query($sql);

    $cart_items = [];
 

    // Before assigning $total
global $total;
$total = 0;

while ($row = $result->fetch_assoc()) {
    $row['subtotal'] = $row['quantity'] * $row['price'];
    $total += $row['subtotal'];
    $cart_items[] = $row;
}
    $conn->close();

    // Return the cart items and total amount for logged-in users
    $cart_data = [$cart_items, $total];
} else {
    // If not logged in, return empty cart and total of 0
    $cart_data = [[], 0];
}

// Continue with the rest of the page logic (e.g., displaying products, search, sort)
?>
