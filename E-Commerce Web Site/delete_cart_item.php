<?php
session_start();

if (!isset($_SESSION['customer_id'])) {
    die("Please login to view the cart.");
}

if (!isset($_GET['product_id']) || !is_numeric($_GET['product_id']) || (int)$_GET['product_id'] <= 0) {
    die("Error: Invalid product_id in the request.");
}

$customer_id = (int)$_SESSION['customer_id'];
$product_id = (int)$_GET['product_id'];

include 'connection.php';

$customer_id = mysqli_real_escape_string($conn, $customer_id);
$product_id = mysqli_real_escape_string($conn, $product_id);

$sql = "DELETE FROM cart_items WHERE customer_id = $customer_id AND product_id = $product_id";

if ($conn->query($sql) === TRUE) {
    header('Location: page-catagory.php');
    exit;
} else {
    echo "Error deleting item: " . $conn->error;
}

$conn->close();
?>
