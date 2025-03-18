<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Include the database connection file
    include('connection.php');
    session_start();

    // Ensure the user is logged in
    if (!isset($_SESSION['customer_id'])) {
        header("Location: login.php");
        exit();
    }

    $customer_id = $_SESSION['customer_id'];
    $shipping_address = $_POST['shipping_address'];
    // $payment_method = $_POST['payment_method'];

    // Fetch the cart items for the logged-in user
    $query = "
        SELECT c.cart_item_id, c.quantity, p.product_id, p.price
        FROM cart_items c
        JOIN products p ON c.product_id = p.product_id
        WHERE c.customer_id = ?
    ";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $customer_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($item = $result->fetch_assoc()) {
            $product_id = $item['product_id'];
            $quantity = $item['quantity'];
            $total_price = $item['price'] * $quantity;

            // Fetch the seller_id for the product
            $seller_query = "SELECT seller_id FROM products WHERE product_id = ?";
            $seller_stmt = $conn->prepare($seller_query);
            $seller_stmt->bind_param("i", $product_id);
            $seller_stmt->execute();
            $seller_result = $seller_stmt->get_result();
            $seller = $seller_result->fetch_assoc();
            $seller_id = $seller['seller_id'];

            // Insert the order into the orders table
            $insert_query = "
                INSERT INTO orders (customer_id, product_id, seller_id, status, quntity, total_price, shipping_address, payment_method)
                VALUES (?, ?, ?, 'pending', ?, ?, ?, ?)
            ";
            $insert_stmt = $conn->prepare($insert_query);
            $insert_stmt->bind_param("iiidsss", $customer_id, $product_id, $seller_id, $quantity, $total_price, $shipping_address, $payment_method);
            $insert_stmt->execute();

            // Update the stock in the products table
            $update_stock_query = "UPDATE products SET stock = stock - ? WHERE product_id = ?";
            $update_stock_stmt = $conn->prepare($update_stock_query);
            $update_stock_stmt->bind_param("ii", $quantity, $product_id);
            $update_stock_stmt->execute();
        }

        // Clear the user's cart
        $delete_cart_query = "DELETE FROM cart_items WHERE customer_id = ?";
        $delete_cart_stmt = $conn->prepare($delete_cart_query);
        $delete_cart_stmt->bind_param("i", $customer_id);
        $delete_cart_stmt->execute();

        // Redirect to a confirmation page
        header("Location: index.php");
        exit();
    } else {
        echo "No items in the cart to checkout.";
    }
} else {
    echo "Invalid request method.";
}
?>
