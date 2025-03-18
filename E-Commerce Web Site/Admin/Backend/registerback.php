<?php
include "config.php";

if (isset($_REQUEST["Submit"])) {

    $Name = $_REQUEST["name"];
    $Email = $_REQUEST["email"];
    $Phone = $_REQUEST["phone"];
    $username = $_REQUEST["username"];
    $Position = $_REQUEST["Position"];
    // $password = $_REQUEST["password"]
    $compassword = $_REQUEST["compassword"];
    $hashed_password = password_hash($compassword, PASSWORD_DEFAULT);
    // echo $hashed_password;

    $sql = "SELECT * FROM admins where username='$username' ";

    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        echo "Error: Duplicate entry. Please choose a different username.";
        header("Location:../register.php?RegisterError");
        exit();
    } else {

        $sql2 = "INSERT INTO admins (first_name,email,username,password,phone,Position) VALUES ('$Name','$Email','$username','$hashed_password','$Phone','$Position')";

        $result1 = mysqli_query($conn, $sql2);
        if ($result1) {
            echo "New record created successfully";
            header("Location: ../index.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}
