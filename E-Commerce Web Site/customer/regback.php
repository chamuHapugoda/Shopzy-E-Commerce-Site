<?php
include_once('connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];

    // Check if passwords match
    if ($password !== $confirmPassword) {
        header("Location: customer.php?error=passwordmismatch");
        exit();
    }

    // Encrypt the password
    $encryptedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Check if the email already exists
    $checkQuery = "SELECT * FROM customers WHERE email='$email'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        header("Location: customer.php?error=emailalreadyexists");
        exit();
    } else {
        // Default values for optional fields
        $status = 1; 
        $online = 0;

        // Insert data into the database
        $query = "INSERT INTO customers (first_name, last_name, email, password, phone, address, Status, online) 
                  VALUES ('$firstName', '$lastName', '$email', '$encryptedPassword', '$contact', '$address', '$status', '$online')";
        if (mysqli_query($conn, $query)) {
            header("Location: customer.php?success=registered");
        } else {
            header("Location: customer.php?error=registrationfailed");
        }
        exit();
    }
}
?>
