<?php
session_start();
include_once('connection.php');


if (isset($_SESSION['customer_id'])) {
    $customer_id = $_SESSION['customer_id'];

    
    $update_sql = "UPDATE customers SET online = '0' WHERE customer_id = $customer_id";
    mysqli_query($conn, $update_sql);

  
    session_unset();
    session_destroy();
}


header("Location: ../index.php?logout=success");
exit();
?>
