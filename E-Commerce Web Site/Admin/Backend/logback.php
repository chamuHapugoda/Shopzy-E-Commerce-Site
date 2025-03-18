<?php 
    if (isset($_REQUEST["Submit"])) {
        include "config.php";
        session_start();

        $username = $_REQUEST["username"];
        $password = $_REQUEST["password"];
        // $compassword = $_REQUEST["compassword"];


        $sql = "SELECT * FROM admins where username='$username' ";

        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($row['Status']==1) {
                if (password_verify($password, $row['password'])) {
                    echo 'Password is valid!';
                    $_SESSION["admin_id"] = $row['admin_id'];
                    $_SESSION["Position"] = $row['Position'];
                    $_SESSION["first_name"] = $row['first_name'];

                    $query2 = "UPDATE admins  set online = '1' WHERE admin_id  = $row[admin_id]";
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
    else {
        header("Location:../index.php");
        // echo 'No data submitted.';
        mysqli_close($conn);
        exit();
    }
   
?>