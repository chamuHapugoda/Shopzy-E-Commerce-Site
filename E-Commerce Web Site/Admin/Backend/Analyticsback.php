<?php
   include 'config.php';
 // Query to get product count
 $productCountQuery = "SELECT COUNT(*) AS count FROM products";
 $result = $conn->query($productCountQuery);

 $productCount = 0; 
 if ($result && $row = $result->fetch_assoc()) {
     $productCount = $row['count'];
 }

 // query to get Active product count
 $activeProductCountQuery = "SELECT COUNT(*) AS count FROM products WHERE Status = 1";
 $result = $conn->query($activeProductCountQuery);

 $activeProductCount = 0; 
 if ($result && $row = $result->fetch_assoc()) {
     $activeProductCount = $row['count'];
 }
 
 //query to get seller count
 $sellerCountQuery = "SELECT COUNT(*) AS count FROM sellers";
 $result = $conn->query($sellerCountQuery);

 $sellerCount = 0; 
 if ($result && $row = $result->fetch_assoc()) {
     $sellerCount = $row['count'];
 }

 // query to get Active seller count
 $activeSellerCountQuery = "SELECT COUNT(*) AS count FROM sellers WHERE Status = 1";
 $result = $conn->query($activeSellerCountQuery);

 $activeSellerCount = 0; 
 if ($result && $row = $result->fetch_assoc()) {
     $activeSellerCount = $row['count'];
 }

 // query to get online seller count
 $onlineSellerCountQuery = "SELECT COUNT(*) AS count FROM sellers WHERE online = 1 ";
 $result = $conn->query($onlineSellerCountQuery);
 
 $onlineSellerCount = 0; 
 if ($result && $row = $result->fetch_assoc()) {
     $onlineSellerCount = $row['count'];
 }

 // qurl to get customer count
 $customerCountQuery = "SELECT COUNT(*) AS count FROM customers";
 $result = $conn->query($customerCountQuery);

 $customerCount = 0; 
 if ($result && $row = $result->fetch_assoc()) {
     $customerCount = $row['count'];
 }

 // query to get Active customer count
 $activeCustomerCountQuery = "SELECT COUNT(*) AS count FROM customers WHERE Status = 1";
 $result = $conn->query($activeCustomerCountQuery);

 $activeCustomerCount = 0; 
 if ($result && $row = $result->fetch_assoc()) {
     $activeCustomerCount = $row['count'];
 }
 
 // query to get Online customer count
 $onlineCustomerCountQuery = "SELECT COUNT(*) AS count FROM customers WHERE online = 1";
 $result = $conn->query($onlineCustomerCountQuery);

 $onlineCustomerCount = 0; 
 if ($result && $row = $result->fetch_assoc()) {
     $onlineCustomerCount = $row['count'];
 }

 // query to get order count
 $orderCountQuery = "SELECT COUNT(*) AS count FROM orders";
 $result = $conn->query($orderCountQuery);

 $orderCount = 0; 
 if ($result && $row = $result->fetch_assoc()) {
     $orderCount = $row['count'];
 }

 // query to get pending order count
 $pendingOrderCountQuery = "SELECT COUNT(*) AS count FROM orders WHERE status = 'pending'";
 $result = $conn->query($pendingOrderCountQuery);

 $pendingOrderCount = 0; 
 if ($result && $row = $result->fetch_assoc()) {
     $pendingOrderCount = $row['count'];
 }

 // query to get shipped order count
 $shippedOrderCountQuery = "SELECT COUNT(*) AS count FROM orders WHERE status ='shipped'";
 $result = $conn->query($shippedOrderCountQuery);
 
 $shippedOrderCount = 0; 
 if ($result && $row = $result->fetch_assoc()) {
     $shippedOrderCount = $row['count'];
 }

 // query to get delivered order count
 $deliveredOrderCountQuery = "SELECT COUNT(*) AS count FROM orders WHERE status = 'delivered'";
 $result = $conn->query($deliveredOrderCountQuery);

 $deliveredOrderCount = 0; 
 if ($result && $row = $result->fetch_assoc()) {
     $deliveredOrderCount = $row['count'];
 }

 // query to get cancelled order count
 $cancelledOrderCountQuery = "SELECT COUNT(*) AS count FROM orders WHERE status = 'cancelled'";
 $result = $conn->query($cancelledOrderCountQuery);

 $cancelledOrderCount = 0; 
 if ($result && $row = $result->fetch_assoc()) {
     $cancelledOrderCount = $row['count'];
 }

 // query to get Subcraibles count
 $subcriberCountQuery = "SELECT COUNT(*) AS count FROM newsletters";
 $result = $conn->query($subcriberCountQuery);
 
 $subcriberCount = 0; 
 if ($result && $row = $result->fetch_assoc()) {
     $subcriberCount = $row['count'];
 }

 // query to get product Review count
 $reviewCountQuery = "SELECT COUNT(*) AS count FROM product_reviews";
 $result = $conn->query($reviewCountQuery);

 $reviewCount = 0; 
 if ($result && $row = $result->fetch_assoc()) {
     $reviewCount = $row['count'];
 }

 // query to get Active product Review count
 $activeReviewCountQuery = "SELECT COUNT(*) AS count FROM product_reviews WHERE Status = 1";
 $result = $conn->query($activeReviewCountQuery);

 $activeReviewCount = 0; 
 if ($result && $row = $result->fetch_assoc()) {
     $activeReviewCount = $row['count'];
 }

 // query to get Discount count
 $discountCountQuery = "SELECT COUNT(*) AS count FROM discounts";
 $result = $conn->query($discountCountQuery);

 $discountCount = 0; 
 if ($result && $row = $result->fetch_assoc()) {
     $discountCount = $row['count'];
 }

?>