<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../../vendor/autoload.php';

    if (isset($_REQUEST["Submit"])) {
        include "config.php";
        session_start();

        $first_name = $_REQUEST["firstName"];
        $last_name = $_REQUEST["lastName"];
        $email = $_REQUEST["email"];
        $phone = $_REQUEST["phone"];
        $password = $_REQUEST["password"];  
        $compassword = $_REQUEST["confirmPassword"];

        $hashed_password = password_hash($compassword, PASSWORD_DEFAULT);

        $query = "SELECT * FROM sellers WHERE email = '$email'";
        $result = mysqli_query($conn, $query);
        if ($result->num_rows > 0) {
            echo "Error: Duplicate entry. Please choose a different username.";
            header("Location:../register.php?RegisterError");
            exit();
        } else {
            
            $sql2 = "INSERT INTO sellers (first_name,last_name,email,password,phone,Status) VALUES ('$first_name','$last_name','$email','$hashed_password','$phone','1')";
    
            $result1 = mysqli_query($conn, $sql2);
            if ($result1) {
                echo "New record created successfully";

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
                    $mail->addAddress($email, $first_name);
                
                    $mail->isHTML(true);                                  
                    $mail->Subject = "$first_name $last_name, your Shopzy Seller account has been created successfully";
                    $mail->Body    = "
                        <p>Dear $first_name $last_name,</p>
                        <p>We are excited to welcome you to the Shopzy seller community! Your <b>Shopzy Seller Account</b> has been created successfully, and you can now start listing and managing your products.</p>
                        <p>If you have any questions or need assistance setting up your account, please feel free to contact our support team. We’re here to help you every step of the way.</p>
                        <p>Thank you for choosing Shopzy as your trusted marketplace partner. We look forward to your success!</p>
                        <p>Best regards,<br>
                        <b>The Shopzy Team</b></p>
                    ";                                     
                                     
                    $mail->send();
                    echo "Mail has been sent successfully!";
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }

                header("Location: ../index.php");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    }
?>