<?php 
    include "config.php";
    if (isset($_REQUEST["LogoutId"])) {
        $id = $_REQUEST["LogoutId"];
        $query = "UPDATE sellers  set online = '0' WHERE seller_id = '$id'";
        mysqli_query($conn, $query);
    }
    

    session_start();
    session_unset();
    session_destroy();
    header("Location: ../index.php");

?>