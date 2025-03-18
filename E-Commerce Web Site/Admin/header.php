<?php
include 'Backend/config.php';
session_start();

// Check if the session admin_id is set
if (!isset($_SESSION['admin_id'])) {
    header('Location: index.php'); // Redirect to login if not logged in
    exit;
}

$id = $_SESSION['admin_id'];

// Fetch admin details securely using prepared statements
$stmt = $conn->prepare("SELECT * FROM admins WHERE admin_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header('Location: index.php'); // Redirect to login if admin not found
    exit;
}

$row = $result->fetch_assoc();
$stmt->close();

// Function to get profile image path
function getProfileImagePath($imageName) {
    $defaultImage = 'https://bootdey.com/img/Content/avatar/avatar6.png';
    return file_exists("AdminImage/" . $imageName) && $imageName ? "AdminImage/" . htmlspecialchars($imageName) : $defaultImage;
}
$imagePath = getProfileImagePath($row['Image']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="icon" href="Image/icon.jfif" type="image/png">

    <!-- Minified Bootstrap CSS -->
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css'>

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
        }

        .navbar {
            background: linear-gradient(90deg, #007bff, #0056b3);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: bold;
            color: white;
            font-size: 1.5rem;
        }

        .navbar-brand:hover,
        .nav-link:hover {
            color: #f8f9fa;
        }

        .nav-link {
            color: white;
            margin-left: 15px;
            font-size: 1.1rem;
        }

        .profile-image {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: 2px solid white;
            transition: transform 0.3s, border-color 0.3s;
        }

        .profile-image:hover {
            transform: scale(1.2);
            border-color: #f8f9fa;
            cursor: pointer;
        }

        .dropdown-menu {
            background-color: #007bff;
        }

        .dropdown-item {
            color: white;
            transition: background-color 0.3s, color 0.3s;
        }

        .dropdown-item:hover {
            background-color: #0056b3;
            color: #f8f9fa;
        }

        footer {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 10px 0;
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="Main.php">
                <img src="Image/icon.jfif" class="rounded-circle p-1 bg-primary" width="80"> Shopzy
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <br>
                        <a class="nav-link" href="Main.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="<?= $imagePath ?>" alt="User Profile Image" class="profile-image" />
                            <?= htmlspecialchars($row['first_name']) ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="profileDropdown">
                            <a class="dropdown-item" href="Profile.php">Profile</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="Backend/logout.php?LogoutId=<?= $id ?>">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Minified Bootstrap JS and dependencies -->
    <script src='https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js'></script>
</body>

</html>
