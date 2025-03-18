<?php 
    if (isset($_REQUEST["Submit"])) {
        include "config.php";
        session_start();

        $email = $_REQUEST["Email"];
        $password = $_REQUEST["password"];
        // $compassword = $_REQUEST["compassword"];


        $query = "SELECT * FROM sellers WHERE email = '$email'";

        $result = mysqli_query($conn, $query);
        if ($result->num_rows > 0) {
         $row = $result->fetch_assoc();
         if ($row['Status']==1) {
             if (password_verify($password, $row['password'])) {
                 echo 'Password is valid!';
                 $_SESSION["seller_id"] = $row['seller_id'];
                 $_SESSION["first_name"] = $row['first_name'];

                 $query2 = "UPDATE sellers  set online = '1' WHERE seller_id = $row[seller_id]";
                 mysqli_query($conn, $query2);
                 
                 header("Location: ../Main.php?Loginsuccess=success");
                 exit();
             } else {
                 header("Location: ../index.php?LoginError=notvalid");
                 // echo 'Invalid password.';
             }
         }else{
             header("Location:../index.php?LoginError=deactive");
         }

     }else {
         header("Location:../index.php?LoginError=nouser");
         // echo 'Username does not exist.';
     }
   }
   
?>