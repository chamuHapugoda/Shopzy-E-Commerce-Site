<?php
include "config.php";

if (isset($_REQUEST["Submitinsert"])) {

    $First_Name = $_REQUEST["first_name"];
    $Last_Name = $_REQUEST["last_name"];
    $Email = $_REQUEST["email"];
    $Address = $_REQUEST["address"];
    $Phone = $_REQUEST["phone"];
    $username = $_REQUEST["username"];
    $Position = $_REQUEST["Position"];

    $Password = $_REQUEST["password"];
    $Confirm_Password = $_REQUEST["confirm_password"];
    $hashed_password = password_hash($Confirm_Password, PASSWORD_DEFAULT);

    $query = "SELECT * FROM admins where email= '$Email'";
    $result = mysqli_query($conn, $query);    

    if (mysqli_num_rows($result) > 0) {
        echo "Email already exists";
        header("Location:../AdminProfile.php?statusInsert=Error");
    } else {
        $sql = "INSERT INTO admins (first_name,last_name,email,Address,username,password,phone,Position) VALUES ('$First_Name', '$Last_Name', '$Email','$Address','$username','$hashed_password','$Phone','$Position')";
        $result1 = mysqli_query($conn, $sql);
        if ($result1) {
            echo "New record Add successfully";
            header("Location:../AdminProfile.php?statusInsert=inserted");
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
    
}

if (isset($_REQUEST['SubmitUpdate'])) {

    $Admin_ID = $_REQUEST["admin_id"];
    $First_Name = $_REQUEST["first_name"];
    $Last_Name = $_REQUEST["last_name"];
    $Email = $_REQUEST["email"];
    $Address = $_REQUEST["address"];
    $Phone = $_REQUEST["phone"];
    $username = $_REQUEST["username"];

    $Password = $_REQUEST["password"];
    $Confirm_Password = $_REQUEST["confirm_password"];

    if (!empty($password) && $password === $confirm_password) {
        $password_hashed = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE admins SET first_name='$First_Name', last_name='$Last_Name', email='$Email',Address='$Address',username='$username', password='$password_hashed', phone='$Phone', username='$username' WHERE admin_id='$Admin_ID'";
    } else {
        // No password update
        $sql = "UPDATE admins SET first_name='$First_Name', last_name='$Last_Name', email='$Email',Address='$Address',username='$username', phone='$Phone' WHERE admin_id='$Admin_ID'";
    }
    // Execute the query and check if successful
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "Record updated successfully";
        header("Location:../AdminProfile.php?statusUpdate=updated");
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

if (isset($_REQUEST['SubmitDelete'])) {

    $Admin_ID = $_REQUEST["admin_id"];

    // Delete query
    $query = "DELETE FROM admins WHERE admin_id = $Admin_ID";

    if (mysqli_query($conn, $query)) {
        // Redirect back with success message
        header("Location: ../AdminProfile.php?statusdelete=deleted");
        exit();
    } else {
        // Redirect with error message
        $error_message = mysqli_error($conn);
        header("Location: ../AdminProfile.php?statusdelete=error&message=" . urlencode($error_message));
        exit();
    }
}

if (isset($_REQUEST['SubmitStatus'])) {

    $Admin_ID = $_REQUEST["admin_id"];

    $status = $_REQUEST['Status'];

    // Update query
    $query = "UPDATE admins SET Status = '$status' WHERE admin_id = $Admin_ID";

    if (mysqli_query($conn, $query)) {
        // Redirect back with success message
        header("Location: ../AdminProfile.php?statusUpdate=status");
        exit();
    } else {
        // Redirect with error message
        $error_message = mysqli_error($conn);
        header("Location: ../AdminProfile.php?statusUpdate=error&message=" . urlencode($error_message));
        exit();
    }
}

?>