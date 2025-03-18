<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecommerce";
// $port = "3377";


// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// $conn = mysqli_connect($servername, $username, $password, $dbname,$port);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
} else {
//   echo "Connected successfully"."<br>";
}


?>