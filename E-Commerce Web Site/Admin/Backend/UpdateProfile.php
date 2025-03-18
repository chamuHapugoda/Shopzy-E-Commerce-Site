<?php
include "config.php";

if (isset($_REQUEST["submit"])) {

    $id = $_REQUEST["id"];
    $name = $_REQUEST["FristName"];
    $lastName = $_REQUEST["LastName"];
    $email = $_REQUEST["Email"];
    $address = $_REQUEST["Address"];
    $phone = $_REQUEST["MobileNumber"];
   
    $image = $_FILES['ProfileImage']['name'];
    $img_size = $_FILES['ProfileImage']['size'];
    $img_tmp_name = $_FILES['ProfileImage']['tmp_name'];
    $img_type = $_FILES['ProfileImage']['type'];
    $folder = "../AdminImage/" . $image; // Correct concatenation for folder path
   

    if (!empty($image)) {
        move_uploaded_file($img_tmp_name, $folder);
    }else{
        $sql2 = "SELECT * FROM admins WHERE admin_id =$id";
        $result2 = mysqli_query($conn, $sql2);
       if($row = mysqli_fetch_assoc($result2)){ 
            $image = $row['Image'];
        }
    }

    $sql = "UPDATE admins SET first_name='$name', last_name='$lastName', Email='$email' , Address='$address', phone='$phone',Image='$image'  WHERE admin_id=$id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Location:../Profile.php?editSuccess=Insertsub");
    } else {
        echo "Error: ". mysqli_error($conn);
    }
}

if (isset($_REQUEST["submitPassword"])) {
    $id = $_REQUEST["id"];
    $username = $_REQUEST["UserName"];
    $password = $_REQUEST["Password"];
    $compassword = $_REQUEST["ComPassword"];

    $hashed_password = password_hash($compassword, PASSWORD_DEFAULT);

    $sql = "UPDATE admins SET username='$username', password='$hashed_password' WHERE admin_id=$id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Location:../Profile.php?editPasswordSuccess=passwardsub");
    } else {
        echo "Error: ". mysqli_error($conn);
    }


}
?>