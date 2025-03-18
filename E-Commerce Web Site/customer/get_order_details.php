<?php
include_once('connection.php');

if (!isset($_SESSION['customer_id'])) {
    die("Unauthorized access.");
}

$order_id = (int)$_GET['order_id'];
$customer_id = $_SESSION['customer_id'];

$sql = "SELECT o.order_id, o.status, o.quntity, o.total_price, o.order_date, o.shipping_address, p.name AS product_name 
        FROM orders o 
        JOIN products p ON o.product_id = p.product_id 
        WHERE o.order_id = ? AND o.customer_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ii', $order_id, $customer_id);
$stmt->execute();
$result = $stmt->get_result();
$order = $result->fetch_assoc();

$stmt->close();
$conn->close();

echo json_encode($order);
?>
