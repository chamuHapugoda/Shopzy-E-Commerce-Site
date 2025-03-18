<?php
include "config.php";

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

    $sql = "INSERT INTO products (seller_id,name,description,price,stock,category,Status,image_url,image2_url) VALUES ('$seller_id','$product_name', '$product_description', '$product_price', '$product_quantity', '$product_category','1', '$product_image','$product_image2')";
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