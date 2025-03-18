<?php
session_start();
include_once('connection.php');

// Check if the user is logged in
if (!isset($_SESSION['customer_id'])) {
    header("Location: customer.php");
    exit();
}

// Fetch the logged-in user's details from the database
$customer_id = $_SESSION['customer_id'];
$sql = "SELECT * FROM customers WHERE customer_id = $customer_id";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

// Handle form submission for updating account information (profile)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_details'])) {
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    
    // Update profile image if a new one is uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = $_FILES['image']['name'];
        $image_temp = $_FILES['image']['tmp_name'];
        move_uploaded_file($image_temp, 'assets/' . $image);
    } else {
        $image = $user['image']; // Keep the existing image if no new one is uploaded
    }

    // Update the database with the new account details
    $update_sql = "UPDATE customers SET 
        first_name = '$first_name', 
        last_name = '$last_name', 
        email = '$email', 
        phone = '$phone', 
        address = '$address', 
        image = '$image' 
        WHERE customer_id = $customer_id";

    if (mysqli_query($conn, $update_sql)) {
        header("Location: profile.php?update=success");
        exit();
    } else {
        echo "Error updating profile: " . mysqli_error($conn);
    }
}

// Handle form submission for updating password only
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_password'])) {
    // Handle password update if provided
    if (!empty($_POST['new_password']) && !empty($_POST['confirm_password'])) {
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        if ($new_password === $confirm_password) {
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $update_password_sql = "UPDATE customers SET password = '$hashed_password' WHERE customer_id = $customer_id";
            if (mysqli_query($conn, $update_password_sql)) {
                header("Location: customer.php?password=success");
                exit();
            } else {
                echo "Error updating password: " . mysqli_error($conn);
            }
        } else {
            echo "Passwords do not match.";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="styles.css">
    <style>
/* General Styles */
body {
    font-family: Arial, sans-serif;
    background-color: #f5f5f5;
    margin: 0;
    padding: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    gap: 20px;
}

/* Content Styles */
.container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
    align-items: flex-start;
    margin-top: 120px; /* Increased top margin to move content downward */
}

/* Profile Card */
.profile-card {
    background: white;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    padding: 20px;
    text-align: center;
    width: 300px;
}

.profile-image img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    border: 3px solid rgb(63, 125, 119);
}

.profile-card h3 {
    margin: 15px 0;
    font-size: 1.2em;
    color: #333;
}

.logout-btn {
    background-color: rgb(63, 125, 119);
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    font-size: 1em;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.logout-btn:hover {
    background-color: #d8502e;
}

/* Info Cards */
.info-card {
    background: white;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    padding: 20px;
    width: 400px;
}

.section-title {
    font-size: 1.2em;
    margin-bottom: 20px;
    color: rgb(63, 125, 119);
}

/* Form Styling */
form {
    display: flex;
    flex-direction: column;
    gap: 15px; 
}

form label {
    display: flex;
    flex-direction: column; 
    gap: 5px; 
    font-size: 0.9em;
    color: #666;
    margin-bottom: 10px; 
}

form label i {
    color: rgb(63, 125, 119);
    margin-right: 5px;
}

form input {
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 1em;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
}

form input:hover, form input:focus {
    border-color: #c9cacc;
    box-shadow: 0 0 5px rgba(26, 115, 232, 0.5);
    outline: none;
}

/* Buttons */
.save-btn {
    background-color: rgb(63, 125, 119);
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    font-size: 1em;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.save-btn:hover {
    background-color: #78797b;
}

/* Navbar */
.navbar {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 45px;
    background-color: #ffffff;
    color: #000000;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 20px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    z-index: 10;
}

.navbar h1 {
    margin: 0;
    font-size: 1.5em;
    color: rgb(0, 0, 0);
}

.navbar-right a {
    text-decoration:none;
    margin: 0;
    padding-right: 30px;
    color: #000000;
    font-size: 20px;
}
.navbar-right a:hover{
    color: #2bcbba;
    cursor: pointer;
}
    </style>
</head>
<body>
<div class="navbar">
    <div class="navbar-left">
        <h1>Shopzy..</h1>
    </div>
    <div class="navbar-right">
        <a href="../index.php">Your Profile &gt; Home</a>
    </div>
</div>

<div class="container">
    <!-- Profile Section -->
    <div class="profile-card">
        <div class="profile-image">
            <!-- <img src="assets/<?php echo $user['image']; ?>" alt="Profile"> -->
            <img src="profile_pics/people.jpg" alt="Profile">
        </div>
        <h3><?php echo $user['first_name'] . ' ' . $user['last_name']; ?></h3>
        <button class="logout-btn">Logout</button>
    </div>

    <!-- Personal Information Section -->
    <div class="info-card">
        <h3 class="section-title"><i class="fas fa-user"></i> Personal Information</h3>
        <form method="POST" enctype="multipart/form-data">
            <!-- <label>
                <i class="fas fa-image"></i> Profile Image
                <input type="file" name="image">
            </label> -->
            <label>
                <i class="fas fa-user"></i> First Name
                <input type="text" name="first_name" value="<?php echo $user['first_name']; ?>" required>
            </label>
            <label>
                <i class="fas fa-user"></i> Last Name
                <input type="text" name="last_name" value="<?php echo $user['last_name']; ?>" required>
            </label>
            <label>
                <i class="fas fa-envelope"></i> Email
                <input type="email" name="email" value="<?php echo $user['email']; ?>" required>
            </label>
            <label>
                <i class="fas fa-home"></i> Address
                <input type="text" name="address" value="<?php echo $user['address']; ?>">
            </label>
            <label>
                <i class="fas fa-phone"></i> Mobile
                <input type="text" name="phone" value="<?php echo $user['phone']; ?>">
            </label>
            <button class="save-btn" type="submit" name="update_details">Save Changes</button>
        </form>
    </div>

    <!-- Change Password Section -->
    <div class="info-card">
        <h3 class="section-title"><i class="fas fa-key"></i> Change Password</h3>
        <form method="POST">
            <label>
                <i class="fas fa-lock"></i> New Password
                <input type="password" name="new_password" placeholder="New Password">
            </label>
            <label>
                <i class="fas fa-lock"></i> Confirm Password
                <input type="password" name="confirm_password" placeholder="Confirm Password">
            </label>
            <button class="save-btn" type="submit" name="update_password">Save Changes</button>
        </form>
    </div>
</div>
    

    <!-- Font Awesome for icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>
