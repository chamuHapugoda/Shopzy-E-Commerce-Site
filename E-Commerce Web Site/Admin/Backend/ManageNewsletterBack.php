<?php 
    include "config.php";

    // Insert Newsletter
    if (isset($_REQUEST["SubmitInsert"])) {

        $email = $_REQUEST["email"];
        $sql = "INSERT INTO newsletters (email) VALUES ('$email')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            header("Location:../ManageNewsletter.php?statusInsert=inserted");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn); exit;
        }
    }

    // Update Newsletter
    if (isset($_REQUEST["SubmitUpdate"])) {

        $newsletter_id = $_REQUEST["newsletter_id"];
        $email = $_REQUEST["email"];
        $sql = "UPDATE newsletters SET email='$email' WHERE newsletter_id=$newsletter_id";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            header("Location:../ManageNewsletter.php?statusUpdate=updated");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn); exit;
        }
    }

    // Delete Discount 
    if (isset($_REQUEST["SubmitDelete"])) {

        $newsletter_id = $_REQUEST["newsletter_id"];

        $query = "DELETE FROM newsletters WHERE newsletter_id=$newsletter_id";
        $result = mysqli_query($conn, $query);

        if ($result) {
            header("Location:../ManageNewsletter.php?statusdelete=deleted");
        }else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn); exit;
        }
    }

    // Get Discount Details
    if (isset($_REQUEST["SubmitStatus"])) {

    $newsletter_id = $_REQUEST["newsletter_id"];
    $status = $_REQUEST["status"];

    $query = "UPDATE newsletters SET Status=$status WHERE newsletter_id=$newsletter_id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        header("Location:../ManageNewsletter.php?statusUpdate=status");
    }else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn); exit;
    }
   }


?>