<?php 

    include "config.php";
    if (isset($_REQUEST["LogoutId"])) {
        $id = $_REQUEST["LogoutId"];
        $query = "UPDATE admins  set online = '0' WHERE admin_id = '$id'";
        mysqli_query($conn, $query);
    }

    session_start();
    session_unset();
    session_destroy();
    header("Location: ../index.php");

?>