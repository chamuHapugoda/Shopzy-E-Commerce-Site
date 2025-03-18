<?php
include "config.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../../vendor/autoload.php';

if (isset($_REQUEST["Submit"])) {

    $seller_id = $_REQUEST["seller_id"];
    $product_name = $_REQUEST["product_name"];
    $product_description = $_REQUEST["product_description"];
    $product_price = $_REQUEST["product_price"];
    $product_quantity = $_REQUEST["product_quantity"];
    $product_category = $_REQUEST["product_category"];

    $product_image = $_FILES['product_image']['name'];
    $img_size = $_FILES['product_image']['size'];
    $img_tmp = $_FILES['product_image']['tmp_name'];
    $img_type = $_FILES['product_image']['type'];
    $folder = "../../Product Image/" . $product_image; 
    move_uploaded_file($img_tmp, $folder);

    $product_image2 = $_FILES['product_image2']['name'];
    $img_size2 = $_FILES['product_image2']['size'];
    $img_tmp2 = $_FILES['product_image2']['tmp_name'];
    $img_type2 = $_FILES['product_image2']['type'];
    $folder2 = "../../Product Image/" . $product_image2; 
    move_uploaded_file($img_tmp2, $folder2);

    $sql = "INSERT INTO products (seller_id,name,description,price,stock,category,image_url,image2_url) VALUES ('$seller_id','$product_name', '$product_description', '$product_price', '$product_quantity', '$product_category', '$product_image','$product_image2')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "New record Add successfully";
        header("Location:../ManageProduct.php?statusInsert=insert");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}


// Check if Update request is submitted
if (isset($_REQUEST["Update"])) {

    $product_id = $_REQUEST["product_id"];
    $product_name = $_REQUEST["product_name"];
    $product_description = $_REQUEST["product_description"];
    $product_price = $_REQUEST["product_price"];
    $product_quantity = $_REQUEST["product_quantity"];
    $product_category = $_REQUEST["product_category"];

    $product_image = $_FILES['product_image']['name'];
    $img_size = $_FILES['product_image']['size'];
    $img_tmp = $_FILES['product_image']['tmp_name'];
    $img_type = $_FILES['product_image']['type'];
    $folder = "../../Product Image/". $product_image; 
   
    if (!empty($product_image)) {
        move_uploaded_file($img_tmp, $folder);
    }else {
        $query2 = "SELECT * FROM products WHERE product_id  =$product_id";
        $result2 = mysqli_query($conn, $query2);
        $row = mysqli_fetch_assoc($result2);
        $product_image = $row['image_url'];
    }


    $product_image2 = $_FILES['product_image2']['name'];
    $img_size2 = $_FILES['product_image2']['size'];
    $img_tmp2 = $_FILES['product_image2']['tmp_name'];
    $img_type2 = $_FILES['product_image2']['type'];
    $folder2 = "../../Product Image/" . $product_image2; 

    if (!empty($product_image2)) {
        move_uploaded_file($img_tmp2, $folder2);
    }else {
        $query3 = "SELECT * FROM products WHERE product_id  =$product_id";
        $result3 = mysqli_query($conn, $query3);
        $row = mysqli_fetch_assoc($result3);
        $product_image2 = $row['image2_url'];
    }
    
    $sql = "UPDATE products SET name='$product_name', description='$product_description', price='$product_price', stock='$product_quantity', category='$product_category', image_url='$product_image', image2_url='$product_image2' WHERE product_id=$product_id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "Record updated successfully";
        header("Location:../ManageProduct.php?statusUpdate=updated");
    } else {
        echo "Error updating record: ". mysqli_error($conn);
    }
  
}

// Check if delete request is submitted
if (isset($_REQUEST['SubmitDelete'])) {
    $product_id = $_REQUEST['product_id'];

    $query3 = "SELECT * FROM products WHERE product_id  = $product_id";
    $result3 = mysqli_query($conn, $query3);
    $row3 = mysqli_fetch_assoc($result3);
    $product_name = $row3['name'];
    $seller_id = $row3['seller_id'];

    $query2 = "SELECT * FROM sellers WHERE seller_id  = $seller_id";
    $result2 = mysqli_query($conn, $query2);
    $row2 = mysqli_fetch_assoc($result2);
    $seller_Fname = $row2['first_name'];
    $seller_Lname = $row2['last_name'];
    $seller_email = $row2['email'];

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
        $mail->addAddress($seller_email, $seller_name);
    
        $mail->isHTML(true);                                  
        $mail->Subject = $seller_Fname . ', your ' . $product_name . ' product has been deleted';
        $mail->Body    = "
            <p>Dear $seller_Fname $seller_Lname,</p>
            <p>We wanted to inform you that your product <b>$product_name</b> (Product ID: <b>$product_id</b>) has been permanently <b>deleted</b> by our administration team.</p>
            <p>If you have any questions or require assistance, please don’t hesitate to contact our support team. We’re here to help you with any concerns.</p>
            <p>Thank you for being a part of the Shopzy seller community. We value your contributions and are here to support you.</p>
            <p>Best regards,<br>
            <b>The Shopzy Team</b></p>
        ";        
                         
        $mail->send();
        echo "Mail has been sent successfully!";
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

    // Delete query
    $query = "DELETE FROM products WHERE product_id = $product_id";

    if (mysqli_query($conn, $query)) {
        // Redirect back with success message
        header("Location: ../ManageProduct.php?statusdelete=deleted");
        exit();
    } else {
        // Redirect with error message
        $error_message = mysqli_error($conn);
        header("Location: ../ManageProduct.php?statusdelete=error&message=" . urlencode($error_message));
        exit();
    }
}




// Check if Stustas Update request is submitted
if (isset($_REQUEST['SubmitStatus'])) {
    $product_id = $_REQUEST['product_id'];

    $status = $_REQUEST['status'];

    $query3 = "SELECT * FROM products WHERE product_id  = $product_id";
    $result3 = mysqli_query($conn, $query3);
    $row3 = mysqli_fetch_assoc($result3);
    $product_name = $row3['name'];
    $seller_id = $row3['seller_id'];

    $query2 = "SELECT * FROM sellers WHERE seller_id  = $seller_id";
    $result2 = mysqli_query($conn, $query2);
    $row2 = mysqli_fetch_assoc($result2);
    $seller_Fname = $row2['first_name'];
    $seller_Lname = $row2['last_name'];
    $seller_email = $row2['email'];


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
            $mail->addAddress($seller_email, $seller_name);
        
            $mail->isHTML(true);                                  
            $mail->Subject = $seller_Fname . ' your ' . $product_name . ' Product has been deactivated';
            $mail->Body    = "
                            <p>Hello $seller_Fname $seller_Lname ,</p>
                            <p>Your <b>$product_name (Product ID- $product_id)</b> product has been marked as <b>deactivated</b> by the admin.</p>
                            <p>If you have any questions or need assistance, please contact our support team.</p>
                            <p><br>
                            Best regards,<br>
                            Shopzy Team</p>";
                             
            $mail->send();
            echo "Mail has been sent successfully!";
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
    }


    $query = "UPDATE  products SET 	Status = '$status' WHERE product_id = $product_id";

    if (mysqli_query($conn, $query)) {
        // Redirect back with success message
        header("Location:../ManageProduct.php?statusUpdate=status");
        exit();
    } else {
        // Redirect with error message
        $error_message = mysqli_error($conn);
        header("Location:../ManageProduct.php?statusUpdate=error&message=" . urlencode($error_message));
        exit();
    }
}

?>