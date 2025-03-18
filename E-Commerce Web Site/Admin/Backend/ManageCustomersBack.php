<?php
include "config.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../../vendor/autoload.php';

if (isset($_REQUEST["SubmitInsert"])) {
    $customer_id  = $_REQUEST["customer_id "];
    $first_name = $_REQUEST["first_name"];
    $last_name = $_REQUEST["last_name"];
    $email = $_REQUEST["email"];
    $phone = $_REQUEST["phone"];
    $address = $_REQUEST["address"];
    $password = $_REQUEST["password"];
    $confirm_password = $_REQUEST["confirm_password"];
    $hashed_password = password_hash($confirm_password, PASSWORD_DEFAULT);

    $query = "SELECT * FROM customers where email= '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        echo "Email already exists";
        header("Location:../ManageCustomers.php?statusInsert=Error");
    } else {
        $sql = "INSERT INTO customers (customer_id, first_name, last_name, email,password, phone, address) VALUES ('$customer_id', '$first_name', '$last_name', '$email', '$hashed_password', '$phone', '$address')";
        $result1 = mysqli_query($conn, $sql);
        if ($result1) {
            echo "New record added successfully";
            header("Location:../ManageCustomers.php?statusInsert=inserted");
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}

if (isset($_REQUEST["SubmitUpdate"])) {

    $customer_id  = $_REQUEST["customer_id"];
    $first_name = $_REQUEST["first_name"];
    $last_name = $_REQUEST["last_name"];
    $email = $_REQUEST["email"];
    $phone = $_REQUEST["phone"];
    $address = $_REQUEST["address"];

    // Only update password if provided
    $password = $_REQUEST["password"];
    $confirm_password = $_REQUEST["confirm_password"];

    if (!empty($password) && $password === $confirm_password) {
        $hashed_password = password_hash($confirm_password, PASSWORD_DEFAULT);
        $sql = "UPDATE customers SET first_name='$first_name', last_name='$last_name', email='$email', password='$hashed_password', phone='$phone', address='$address' WHERE customer_id='$customer_id'";
    } else {
        // No password update
        $sql = "UPDATE customers SET first_name='$first_name', last_name='$last_name', email='$email', phone='$phone', address='$address' WHERE customer_id='$customer_id'";
    }
    // Execute the query and check if successful
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "Record updated successfully";
        header("Location:../ManageCustomers.php?statusUpdate=updated");
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}


// Check if delete request is submitted
if (isset($_REQUEST["SubmitDelete"])) {

    $customer_id = $_REQUEST["customer_id"];

    $query2 = "SELECT * FROM customers WHERE customer_id  = $customer_id";
    $result2 = mysqli_query($conn, $query2);
    $row2 = mysqli_fetch_assoc($result2);
    $customer_Fname = $row2['first_name'];
    $customer_Lname = $row2['last_name'];
    $customer_email = $row2['email'];

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
        
            $mail->setFrom('deshan.priyantha@ecyber.com', 'Shopzy');           
            $mail->addAddress($customer_email, $customer_Fname);
        
            $mail->isHTML(true);                                  
            $mail->Subject = "$customer_Fname $customer_Lname, your Shopzy account has been deleted";
            $mail->Body    = "
                <p>Dear $customer_Fname $customer_Lname,</p>
                <p>We hope this message finds you well. We wanted to inform you that your <b>Shopzy Account</b> has been permanently <b>deleted</b> by our administration team.</p>
                <p>If you have any questions or need assistance, please feel free to contact our support team. We're here to help and address any concerns you may have.</p>
                <p>Thank you for being a part of the Shopzy community. We appreciate your association with us.</p>
                <p>Best regards,<br>
                <b>The Shopzy Team</b></p>
            ";                       
                             
            $mail->send();
            echo "Mail has been sent successfully!";
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }

    $sql = "DELETE FROM customers WHERE customer_id=$customer_id";
    $result = mysqli_query($conn, $sql);
    
    if ($result) {
        echo "Record deleted successfully";
        header("Location:../ManageCustomers.php?statusDelete=deleted");
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

// Check if Stustas Update request is submitted
if (isset($_REQUEST["SubmitStatus"])) {

    $customer_id = $_REQUEST["customer_id"];
    $status = $_REQUEST["status"];

    $query2 = "SELECT * FROM customers WHERE customer_id  = $customer_id";
    $result2 = mysqli_query($conn, $query2);
    $row2 = mysqli_fetch_assoc($result2);
    $customer_Fname = $row2['first_name'];
    $customer_Lname = $row2['last_name'];
    $customer_email = $row2['email'];

    if ($status === "0") {

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
        
            $mail->setFrom('deshan.priyantha@ecyber.com', 'Shopzy');           
            $mail->addAddress($customer_email, $customer_Fname);
        
            $mail->isHTML(true);                                  
            $mail->Subject = "$customer_Fname $customer_Lname, your Shopzy account has been deactivated";
            $mail->Body    = "
                <p>Dear $customer_Fname $customer_Lname,</p>
                <p>We wanted to inform you that your <b>Shopzy Account</b> has been marked as <b>deactivated</b> by our administration team.</p>
                <p>If you have any questions or require assistance, please don't hesitate to contact our support team. We're here to help!</p>
                <p>Thank you for being a valued part of the Shopzy community.</p>
                <p>Best regards,<br>
                <b>The Shopzy Team</b></p>
            ";            
                             
            $mail->send();
            echo "Mail has been sent successfully!";
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
    }

    $sql = "UPDATE customers SET status='$status' WHERE customer_id=$customer_id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "Record status updated successfully";
        header("Location:../ManageCustomers.php?statusUpdate=status");
    } else {
        echo "Error updating record status: ". mysqli_error($conn);
    }
}