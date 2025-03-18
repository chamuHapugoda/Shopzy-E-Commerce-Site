<?php 
    include "config.php";

    // Insert Discount
    if (isset($_REQUEST["SubmitInsert"])) {

        $products_id = $_REQUEST["products_id"];
        $discountCode = $_REQUEST["discountCode"];
        $discountPercentage = $_REQUEST["discountPercentage"];
        $DescountDescription = $_REQUEST["DescountDescription"];
        $discountStart = $_REQUEST["discountStartDate"];
        $discountEnd = $_REQUEST["discountEndDate"];

        $query = "INSERT INTO discounts (product_id,code,description,discount_percentage,valid_from,valid_until) VALUES ('$products_id', '$discountCode', '$DescountDescription', '$discountPercentage', '$discountStart', '$discountEnd')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            header("Location:../ManageDiscounts.php?statusInsert=inserted");
        }else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn); exit;
        }
    }

    // Update Discount
    if (isset($_REQUEST["SubmitUpdate"])) {

        $discount_id = $_REQUEST["discount_id"];
        $products_id = $_REQUEST["products_id"];
        $discountCode = $_REQUEST["discountCode"];
        $discountPercentage = $_REQUEST["discountPercentage"];
        $DescountDescription = $_REQUEST["discountDescription"];
        $discountStart = $_REQUEST["discountStartDate"];
        $discountEnd = $_REQUEST["discountEndDate"];

        $query = "UPDATE discounts SET product_id='$products_id', code='$discountCode', description='$DescountDescription', discount_percentage='$discountPercentage', valid_from='$discountStart', valid_until='$discountEnd' WHERE discount_id=$discount_id";
        $result = mysqli_query($conn, $query);

        if ($result) {
            header("Location:../ManageDiscounts.php?statusUpdate=Updated");
        }else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn); exit;
        }
    }

    // Delete Discount 
    if (isset($_REQUEST["SubmitDelete"])) {

        $discount_id = $_REQUEST["discount_id"];

        $query = "DELETE FROM discounts WHERE discount_id=$discount_id";
        $result = mysqli_query($conn, $query);

        if ($result) {
            header("Location:../ManageDiscounts.php?statusdelete=deleted");
        }else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn); exit;
        }
    }

    // Get Discount Details
   if (isset($_REQUEST["SubmitStatus"])) {

    $discount_id = $_REQUEST["discount_id"];
    $status = $_REQUEST["status"];

    $query = "UPDATE discounts SET Status=$status WHERE discount_id=$discount_id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        header("Location:../ManageDiscounts.php?statusUpdate=status");
    }else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn); exit;
    }
   }
?>