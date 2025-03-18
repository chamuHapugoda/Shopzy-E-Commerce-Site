<?php
session_start();

if (!isset($_SESSION['customer_id'])) {
    die("Please login to add items to the cart.");
}

$customer_id = $_SESSION['customer_id'];

if (!isset($_GET['product_id'])) {
    die("Product ID is missing.");
}

$product_id = $_GET['product_id'];

include 'connection.php';

// Step 1: Check the product's stock
$sql_check_stock = "SELECT stock FROM products WHERE product_id = ?";
if ($stmt_stock = $conn->prepare($sql_check_stock)) {
    $stmt_stock->bind_param("i", $product_id);
    $stmt_stock->execute();
    $result_stock = $stmt_stock->get_result();

    if ($row_stock = $result_stock->fetch_assoc()) {
        $current_stock = $row_stock['stock'];

        if ($current_stock <= 0) {
            // die("This product is out of stock and cannot be added to the cart.");
            header("Location: page-catagory.php?error=stockout");
            exit();
        }
    } else {
        die("Invalid product ID.");
    }

    $stmt_stock->close();
} else {
    die("Error checking stock: " . $conn->error);
}

// Step 2: Check if the product is already in the cart
$sql_check_cart = "SELECT cart_item_id, quantity FROM cart_items 
                   WHERE product_id = ? AND customer_id = ?";
if ($stmt_check = $conn->prepare($sql_check_cart)) {
    $stmt_check->bind_param("ii", $product_id, $customer_id);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($row = $result_check->fetch_assoc()) {
        // Product already in cart, update the quantity
        $new_quantity = $row['quantity'] + 1;

        if ($current_stock < $new_quantity) {
            // die("Insufficient stock available.");
            header("Location: page-catagory.php?error=Insufficientstock");
            exit();
        }

        $update_cart_sql = "UPDATE cart_items SET quantity = ? WHERE cart_item_id = ?";
        if ($stmt_update = $conn->prepare($update_cart_sql)) {
            $stmt_update->bind_param("ii", $new_quantity, $row['cart_item_id']);
            $stmt_update->execute();
            $stmt_update->close();
        }
    } else {
        // Product not in cart, add to cart
        $insert_cart_sql = "INSERT INTO cart_items (customer_id, product_id, quantity) VALUES (?, ?, 1)";
        if ($stmt_insert = $conn->prepare($insert_cart_sql)) {
            $stmt_insert->bind_param("ii", $customer_id, $product_id);
            $stmt_insert->execute();
            $stmt_insert->close();
            header("Location: page-catagory.php?success=addtocartSucess");
            exit();
        }
    }

    $stmt_check->close();
} else {
    die("Error checking cart: " . $conn->error);
}

// Step 3: Reduce stock in the products table
$update_stock_sql = "UPDATE products SET stock = stock - 1 WHERE product_id = ?";
if ($stmt_stock_update = $conn->prepare($update_stock_sql)) {
    $stmt_stock_update->bind_param("i", $product_id);
    $stmt_stock_update->execute();
    $stmt_stock_update->close();
} else {
    die("Error updating stock: " . $conn->error);
}

$conn->close();

// Redirect back to the category page
header('Location: page-catagory.php');
exit();
?>