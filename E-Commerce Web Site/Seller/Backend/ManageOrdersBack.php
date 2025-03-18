<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../../vendor/autoload.php';

include "config.php";

// Check if Stustas Update request is submitted
if (isset($_REQUEST['SubmitStatus'])) {
    $order_id = intval($_REQUEST['order_id']);
    $status = mysqli_real_escape_string($conn, $_REQUEST['status']);

    $qurry2 ="SELECT * FROM orders WHERE order_id = $order_id";
    $result2 = mysqli_query($conn, $qurry2);
    $row2 = mysqli_fetch_assoc($result2);
    $product_id = $row2['product_id'];
    $customer_id = $row2['customer_id'];
    $shipping_address = $row2['shipping_address'];
    $quantity = $row2['quntity']; // Fixed variable name
    $total_price = $row2['total_price'];
    $payment_method = $row2['payment_method'];

    $qurry3 ="SELECT * FROM customers WHERE customer_id = $customer_id";
    $result3 = mysqli_query($conn, $qurry3);
    $row3 = mysqli_fetch_assoc($result3);
    $customer_email = $row3['email'];
    $customer_name = $row3['first_name'];

    $qurry4 ="SELECT * FROM products WHERE product_id = $product_id";
    $result4 = mysqli_query($conn, $qurry4);
    $row4 = mysqli_fetch_assoc($result4);
    $product_name = $row4['name'];

    if ($status === "shipped") {    

        $mail = new PHPMailer(true);
        
        try {
            $mail->SMTPDebug = 0;                                       
            $mail->isSMTP();                                            
            $mail->Host       = 'smtp.gmail.com';                    
            $mail->SMTPAuth   = true;                             
            $mail->Username   = 'deshan.priyantha@ecyber.com';                 
            $mail->Password   = 'axevushaktsguxqb';                        
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;                              
            $mail->Port       = 587;  
        
            $mail->setFrom('deshanjagoda33@gmail.com', 'Shopzy');           
            $mail->addAddress($customer_email, $customer_name);
        
            $mail->isHTML(true);                                  
            $mail->Subject = $customer_name . ' your ' . $product_name . ' Order Shipped';
            $mail->Body    = "
                            <p>Hello $customer_name,</p>
                            <p>Thank you for your order:</p>
                            <ul>
                                <li><strong>Product:</strong> $product_name</li>
                                <li><strong>Quantity:</strong> $quantity</li>
                                <li><strong>Total Price:</strong> $total_price</li>
                                <li><strong>Payment Method:</strong> $payment_method</li>
                                <li><strong>Shipping Address:</strong> $shipping_address</li>
                            </ul>
                          <p>Your order has been shipped and is on its way to you. Your order will be delivered within 1 week.</p>
                          <p>Thank you for shopping with us!</p>
                          <p>Best regards,<br>
                          Shopzy Team</p>";
                             
            $mail->send();
            echo "Mail has been sent successfully!";
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
    }

    if ($status === "cancelled") {

        $mail = new PHPMailer(true);
    
        try {
            $mail->SMTPDebug = 0;                                       
            $mail->isSMTP();                                            
            $mail->Host       = 'smtp.gmail.com';                    
            $mail->SMTPAuth   = true;                             
            $mail->Username   = 'deshan.priyantha@ecyber.com';                 
            $mail->Password   = 'axevushaktsguxqb';                        
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;                              
            $mail->Port       = 587;  
        
            $mail->setFrom('deshanjagoda33@gmail.com', 'Shopzy');           
            $mail->addAddress($customer_email, $customer_name);
        
            $mail->isHTML(true);                                  
            $mail->Subject = $customer_name . ' your ' . $product_name . ' Order Cancelled';
            $mail->Body    = "
                            <p>Hello $customer_name,</p>
                            <p>We regret to inform you that your order has been cancelled. Below are the details of your cancelled order:</p>
                            <ul>
                                <li><strong>Product:</strong> $product_name</li>
                                <li><strong>Quantity:</strong> $quantity</li>
                                <li><strong>Total Price:</strong> $total_price</li>
                                <li><strong>Payment Method:</strong> $payment_method</li>
                                <li><strong>Shipping Address:</strong> $shipping_address</li>
                            </ul>
                          <p>If you have any questions or need assistance, please contact our support team.</p>
                          <p>We apologize for any inconvenience caused.</p>
                          <p>Best regards,<br>
                          Shopzy Team</p>";
            $mail->send();
            echo "Mail has been sent successfully!";
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
    }

    $query = "UPDATE orders SET Status = '$status' WHERE order_id = $order_id";

    if (mysqli_query($conn, $query)) {
        // Redirect back with success message
        header("Location:../ManageOrders.php?statusUpdate=status");
        exit();
    } else {
        // Redirect with error message
        $error_message = mysqli_error($conn);
        header("Location:../ManageOrders.php?statusUpdate=error&message=" . urlencode($error_message));
        exit();
    }
}

?>
