<?php
session_start();

if (!isset($_SESSION['customer_id'])) {
    header("Location: customer/customer.php");
    exit();
}

include 'connection.php';

// Validate customer_id from session
$customer_id = intval($_SESSION['customer_id']);
$check_customer_query = "SELECT * FROM customers WHERE customer_id = $customer_id";
$check_customer_result = mysqli_query($conn, $check_customer_query);

if (mysqli_num_rows($check_customer_result) == 0) {
    die("Error: The customer_id in session does not exist in the customers table.");
}

// Validate product_id from GET request
$product_id = intval($_GET['product_id']);
$check_product_query = "SELECT * FROM products WHERE product_id = $product_id";
$check_product_result = mysqli_query($conn, $check_product_query);

if (mysqli_num_rows($check_product_result) == 0) {
    die("Error: The product_id does not exist in the products table.");
}

// Check if the item is already in favourites
$query = "SELECT * FROM favourite_items WHERE customer_id = $customer_id AND product_id = $product_id";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 0) {
    $insert_query = "INSERT INTO favourite_items (customer_id, product_id, quantity) VALUES ($customer_id, $product_id, 1)";
    if (!mysqli_query($conn, $insert_query)) {
        die("Error: " . mysqli_error($conn));
    }
}

// Redirect back to the previous page
header("Location: " . $_SERVER['HTTP_REFERER']);
exit();
