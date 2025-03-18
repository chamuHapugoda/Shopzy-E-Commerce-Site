<?php
   include 'config.php';
//    session_start();
   $id = $_SESSION['seller_id'];

 // Query to get product count
 $productCountQuery = "SELECT COUNT(*) AS count FROM products WHERE seller_id = $id";
 $result = $conn->query($productCountQuery);

 $productCount = 0; 
 if ($result && $row = $result->fetch_assoc()) {
     $productCount = $row['count'];
 }

 // query to get Active product count
 $activeProductCountQuery = "SELECT COUNT(*) AS count FROM products WHERE Status = 1 AND seller_id = $id";
 $result = $conn->query($activeProductCountQuery);

 $activeProductCount = 0; 
 if ($result && $row = $result->fetch_assoc()) {
     $activeProductCount = $row['count'];
 }
 
 // query to get order count
 $orderCountQuery = "SELECT COUNT(*) AS count FROM orders WHERE seller_id = $id";
 $result = $conn->query($orderCountQuery);

 $orderCount = 0; 
 if ($result && $row = $result->fetch_assoc()) {
     $orderCount = $row['count'];
 }

 // query to get pending order count
 $pendingOrderCountQuery = "SELECT COUNT(*) AS count FROM orders WHERE status = 'pending' AND seller_id = $id";
 $result = $conn->query($pendingOrderCountQuery);

 $pendingOrderCount = 0; 
 if ($result && $row = $result->fetch_assoc()) {
     $pendingOrderCount = $row['count'];
 }

 // query to get shipped order count
 $shippedOrderCountQuery = "SELECT COUNT(*) AS count FROM orders WHERE status ='shipped' AND seller_id = $id";
 $result = $conn->query($shippedOrderCountQuery);
 
 $shippedOrderCount = 0; 
 if ($result && $row = $result->fetch_assoc()) {
     $shippedOrderCount = $row['count'];
 }

 // query to get delivered order count
 $deliveredOrderCountQuery = "SELECT COUNT(*) AS count FROM orders WHERE status = 'delivered' AND seller_id = $id";
 $result = $conn->query($deliveredOrderCountQuery);

 $deliveredOrderCount = 0; 
 if ($result && $row = $result->fetch_assoc()) {
     $deliveredOrderCount = $row['count'];
 }

 // query to get cancelled order count
 $cancelledOrderCountQuery = "SELECT COUNT(*) AS count FROM orders WHERE status = 'cancelled' AND seller_id = $id";
 $result = $conn->query($cancelledOrderCountQuery);

 $cancelledOrderCount = 0; 
 if ($result && $row = $result->fetch_assoc()) {
     $cancelledOrderCount = $row['count'];
 }

 // query to get product Review count
 $reviewCountQuery = "SELECT COUNT(*) AS count FROM product_reviews WHERE seller_id = $id";
 $result = $conn->query($reviewCountQuery);

 $reviewCount = 0; 
 if ($result && $row = $result->fetch_assoc()) {
     $reviewCount = $row['count'];
 }

 // query to get Active product Review count
 $activeReviewCountQuery = "SELECT COUNT(*) AS count FROM product_reviews WHERE Status = 1 AND seller_id = $id";
 $result = $conn->query($activeReviewCountQuery);

 $activeReviewCount = 0; 
 if ($result && $row = $result->fetch_assoc()) {
     $activeReviewCount = $row['count'];
 }

 // query to get Discount count
 $discountCountQuery = "SELECT COUNT(*) AS count FROM discounts WHERE seller_id = $id";
 $result = $conn->query($discountCountQuery);

 $discountCount = 0; 
 if ($result && $row = $result->fetch_assoc()) {
     $discountCount = $row['count'];
 }

?>