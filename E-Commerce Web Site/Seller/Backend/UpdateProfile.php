<?php
include "config.php";

if (isset($_REQUEST["submit"])) {

    $id = $_REQUEST["id"];
    $name = $_REQUEST["FristName"];
    $lastName = $_REQUEST["LastName"];
    $business_name = $_REQUEST["business_name"];
    $address = $_REQUEST["Address"];
    $phone = $_REQUEST["MobileNumber"];
   


    $image = $_FILES['ProfileImage']['name'];
    $img_size = $_FILES['ProfileImage']['size'];
    $img_tmp_name = $_FILES['ProfileImage']['tmp_name'];
    $img_type = $_FILES['ProfileImage']['type'];
    $folder = "../SellerImage/" . $image; 


    if (!empty($image)) {
        move_uploaded_file($img_tmp_name, $folder);
    }else{
        $sql2 = "SELECT * FROM sellers WHERE seller_id =$id";
        $result2 = mysqli_query($conn, $sql2);
       if($row = mysqli_fetch_assoc($result2)){ 
            $image = $row['image'];
        }
    }

    $sql = "UPDATE sellers SET first_name='$name', last_name='$lastName',business_name='$business_name' , address='$address', phone='$phone',image='$image'  WHERE seller_id =$id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Location:../Profile.php?editSuccess=Insertsub");
    } else {
        echo "Error: ". mysqli_error($conn);
    }
}

if (isset($_REQUEST["submitPassword"])) {
    $id = $_REQUEST["id"];
    $email = $_REQUEST["Email"];
    $password = $_REQUEST["Password"];
    $compassword = $_REQUEST["ComPassword"];

    $hashed_password = password_hash($compassword, PASSWORD_DEFAULT);

    $sql = "UPDATE sellers SET email ='$email', password='$hashed_password' WHERE seller_id =$id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Location:../Profile.php?editPasswordSuccess=passwardsub");
    } else {
        echo "Error: ". mysqli_error($conn);
    }

}
?>