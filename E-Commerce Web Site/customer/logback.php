<?php
session_start();
include_once('connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        header("Location: index.php?error=emptyfields");
        exit();
    }

    $sql = "SELECT * FROM customers WHERE email = '$email'";
    $result = mysqli_query($conn, $sql); 

    if ($result && mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user['password'])) {
            
            $update_sql = "UPDATE customers SET Status = 1, online = 1 WHERE customer_id = " . $user['customer_id'];
            mysqli_query($conn, $update_sql);

            
            $_SESSION['customer_id'] = $user['customer_id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['image'] = $user['image']; 

           
            header("Location: ../index.php?success=loginsuccess");
            exit();
        } else {
           
            header("Location: customer.php?error=incorrectpassword");
            exit();
        }
    } else {
       
        header("Location: customer.php?error=emailnotfound");
        exit();
    }
} else {
   
    header("Location: customer.php");
    exit();
}
?>
