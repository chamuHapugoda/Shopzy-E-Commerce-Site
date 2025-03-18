<?php
include "config.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../../vendor/autoload.php';

if (isset($_REQUEST["SubmitInsert"])) {

    $First_Name = $_REQUEST["first_name"];
    $Last_Name = $_REQUEST["last_name"];
    $Email = $_REQUEST["email"];
    $Phone = $_REQUEST["phone"];
    $Address = $_REQUEST["address"];
    $business_name = $_REQUEST["business_name"];
    $Password = $_REQUEST["Password"];
    $Confirm_Password = $_REQUEST["confirm_password"];
    $hashed_password = password_hash($Confirm_Password, PASSWORD_DEFAULT);

    // $product_image = $_FILES['product_image']['name'];
    // $img_size = $_FILES['product_image']['size'];
    // $img_tmp = $_FILES['product_image']['tmp_name'];
    // $img_type = $_FILES['product_image']['type'];
    // $folder = "../Product Image/". $product_image; // Correct concatenation for folder path
    // move_uploaded_file($img_tmp, $folder);

    $query = "SELECT * FROM sellers where email= '$Email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        echo "Email already exists";
        header("Location:../ManageSeller.php?statusInsert=Error");
    } else {
        $sql = "INSERT INTO sellers (first_name,last_name,email,password,phone,business_name,address) VALUES ('$First_Name', '$Last_Name', '$Email', '$hashed_password', '$Phone', '$business_name','$Address')";
        $result1 = mysqli_query($conn, $sql);
        if ($result1) {
            echo "New record Add successfully";
            header("Location:../ManageSeller.php?statusInsert=inserted");
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}



if (isset($_REQUEST['SubmitUpdate'])) {
    $seller_id = $_REQUEST['seller_id'];
    $first_name = $_REQUEST['first_name'];
    $last_name = $_REQUEST['last_name'];
    $email = $_REQUEST['email'];
    $phone = $_REQUEST['phone'];
    $address = $_REQUEST['address'];
    $business_name = $_REQUEST['business_name'];

    // Only update password if provided
    $password = $_REQUEST['password'];
    $confirm_password = $_REQUEST['confirm_password'];

    // $query = "SELECT * FROM sellers where email= '$Email'";
    // $result = mysqli_query($conn, $query);

    // if (mysqli_num_rows($result) > 0) {
    //     echo "Email already exists";
    //     header("Location:../ManageSeller.php?statusInsert=Error");
    // } else {

        if (!empty($password) && $password === $confirm_password) {
            $password_hashed = password_hash($password, PASSWORD_DEFAULT);
            $query = "UPDATE sellers SET first_name='$first_name', last_name='$last_name', email='$email', phone='$phone', address='$address', business_name='$business_name', password='$password_hashed' WHERE seller_id=$seller_id";
        } else {
            // No password update
            $query = "UPDATE sellers SET first_name='$first_name', last_name='$last_name', email='$email', phone='$phone', address='$address', business_name='$business_name' WHERE seller_id=$seller_id";
        }

        // Execute the query and check if successful
        if (mysqli_query($conn, $query)) {
            echo "Record updated successfully";
            header("Location: ../ManageSeller.php?statusUpdate=Updated");
            exit(); // Make sure the script stops executing after the redirect
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        // }
    }
}



// Check if delete request is submitted
if (isset($_REQUEST['SubmitDelete'])) {
    $seller_id = $_REQUEST['seller_id'];

    $query2 = "SELECT * FROM sellers WHERE seller_id  = $seller_id";
    $result2 = mysqli_query($conn, $query2);
    $row2 = mysqli_fetch_assoc($result2);
    $seller_Fname = $row2['first_name'];
    $seller_Lname = $row2['last_name'];
    $seller_email = $row2['email'];

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
        $mail->addAddress($seller_email, $seller_Fname);
    
        $mail->isHTML(true);                                  
        $mail->Subject = "$seller_Fname $seller_Lname, your Shopzy Seller Account has been deleted";
        $mail->Body    = "
            <p>Dear $seller_Fname $seller_Lname,</p>
            <p>We hope this message finds you well. We wanted to inform you that your <b>Shopzy Seller Account</b> has been permanently <b>deleted</b> by our administration team.</p>
            <p>If you have any questions or require assistance, please don’t hesitate to contact our support team. We’re here to help you with any concerns.</p>
            <p>Thank you for being a part of the Shopzy seller community. We appreciate your time and efforts with us.</p>
            <p>Best regards,<br>
            <b>The Shopzy Team</b></p>
        ";        
                         
        $mail->send();
        echo "Mail has been sent successfully!";
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

    // Delete query
    $query = "DELETE FROM sellers WHERE seller_id = $seller_id";

    if (mysqli_query($conn, $query)) {
        // Redirect back with success message
        header("Location: ../ManageSeller.php?statusdelete=deleted");
        exit();
    } else {
        // Redirect with error message
        $error_message = mysqli_error($conn);
        header("Location: ../ManageSeller.php?statusdelete=error&message=" . urlencode($error_message));
        exit();
    }
}


// Check if Stustas Update request is submitted
if (isset($_REQUEST['SubmitStatus'])) {
    $seller_id = $_REQUEST['seller_id'];

    $status = $_REQUEST['status'];

    $query2 = "SELECT * FROM sellers WHERE seller_id  = $seller_id";
    $result2 = mysqli_query($conn, $query2);
    $row2 = mysqli_fetch_assoc($result2);
    $seller_Fname = $row2['first_name'];
    $seller_Lname = $row2['last_name'];
    $seller_email = $row2['email'];

    if ($status === "0") {

        $query3 = "UPDATE sellers SET 	online = '0' WHERE seller_id = $seller_id";
        $result3 = mysqli_query($conn, $query3);

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
            $mail->addAddress($seller_email, $seller_Fname);
        
            $mail->isHTML(true);                                  
            $mail->Subject = "$seller_Fname $seller_Lname, your account has been deactivated";
            $mail->Body    = "
                            <p>Hello $seller_Fname $seller_Lname,</p>
                            <p>Your <b>Shopzy Seller Account</b> has been marked as <b>deactivated</b> by the admin.</p>
                            <p>If you have any questions or need assistance, please contact our support team.</p>
                            <p><br>
                            Best regards,<br>
                            The Shopzy Team</p>";
                             
            $mail->send();
            echo "Mail has been sent successfully!";
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
    }


    $query = "UPDATE sellers SET 	Status = '$status' WHERE seller_id = $seller_id";

    if (mysqli_query($conn, $query)) {
        // Redirect back with success message
        header("Location:../ManageSeller.php?statusUpdate=status");
        exit();
    } else {
        // Redirect with error message
        $error_message = mysqli_error($conn);
        header("Location:../ManageSeller.php?statusUpdate=error&message=". urlencode($error_message));
        exit();
    }
}
?>
