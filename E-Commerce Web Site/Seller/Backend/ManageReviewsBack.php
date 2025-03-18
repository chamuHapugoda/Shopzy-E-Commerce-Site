<?php
include "config.php";

// Check if delete request is submitted
if (isset($_REQUEST['SubmitDelete'])) {
    $review_id = $_REQUEST['review_id'];

    // Delete query
    $query = "DELETE FROM product_reviews WHERE review_id = $review_id";

    if (mysqli_query($conn, $query)) {
        // Redirect back with success message
        header("Location: ../ManageReviews.php?statusdelete=deleted");
        exit();
    } else {
        // Redirect with error message
        $error_message = mysqli_error($conn);
        header("Location: ../ManageReviews.php?statusdelete=error&message=" . urlencode($error_message));
        exit();
    }
}

// Check if Stustas Update request is submitted
if (isset($_REQUEST['SubmitStatus'])) {
    $review_id = $_REQUEST['review_id'];

    $status = $_REQUEST['status'];

    $query = "UPDATE product_reviews SET 	Status = '$status' WHERE review_id = $review_id";

    if (mysqli_query($conn, $query)) {
        // Redirect back with success message
        header("Location:../ManageReviews.php?statusUpdate=status");
        exit();
    } else {
        // Redirect with error message
        $error_message = mysqli_error($conn);
        header("Location:../ManageReviews.php?statusUpdate=error&message=". urlencode($error_message));
        exit();
    }
}
?>