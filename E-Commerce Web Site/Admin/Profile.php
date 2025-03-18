<?php
include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    
    <!-- Favicon -->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Include Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-p1CmNjaZ7x1Vt3CnbE4XrFvlHjVU1vE50B3x1+5aJr8dTz8+q1K5ZpKk3jOwL4ZPxhAk5gI3KJusq9t0AQnPg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Include Bootstrap -->
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css'>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js'></script>
    <script src="JS/Profile.js"></script>

    <!-- Custom CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f9;
            color: #333;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .card-title u {
            color: #007bff;
            font-weight: bold;
        }

        .profile-image {
            width: 110px;
            height: 110px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #007bff;
        }

        .btn {
            border-radius: 25px;
        }

        .btn-danger {
            background-color: #e3342f;
            border: none;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .form-control {
            border-radius: 5px;
            border: 1px solid #ced4da;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #007bff;
        }

        .alert {
            font-size: 14px;
        }

        .list-group-item {
            border: none;
        }

        .fade-out {
            display: none;
            transition: opacity 0.5s;
        }
    </style>
</head>

<body>

    <?php
    $admin_id = $_SESSION["admin_id"];
    $sql = "SELECT * FROM admins WHERE admin_id = $admin_id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    ?>

    <div class="container py-5">
        <div class="main-body">
            <div class="row">
                <!-- Profile Sidebar -->
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <?php
                            if ($row['Image'] == "") {
                                echo "<img src='https://bootdey.com/img/Content/avatar/avatar6.png' alt='User Profile Image' class='profile-image'>";
                            } else {
                                echo "<img src='AdminImage/" . htmlspecialchars($row['Image']) . "' alt='User Profile Image' class='profile-image'>";
                            }
                            ?>
                            <h4 class="mt-3"><?php echo htmlspecialchars($row['first_name']) . ' ' . htmlspecialchars($row['last_name']); ?></h4>
                            <a href="Backend/logout.php?LogoutId=<?= $id ?>" class="btn btn-danger mt-2">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Profile Content -->
                <div class="col-lg-8">

                    <!-- Personal Information Card -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">
                                <u><i class="fas fa-user"></i> Personal Information</u>
                            </h5>
                            <form action="backend/UpdateProfile.php" method="post" enctype="multipart/form-data" onsubmit="return PersonalInformationValidations()" name="PersonalInformation">
                                <div class="form-group row">
                                    <label for="ProfileImage" class="col-sm-3 col-form-label">
                                        <i class="fas fa-image"></i> Profile Image
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="file" class="form-control-file" id="ProfileImage" name="ProfileImage">
                                    </div>
                                </div>
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($admin_id); ?>">

                                <div class="form-group row">
                                    <label for="FullName" class="col-sm-3 col-form-label">
                                        <i class="fas fa-user"></i> First Name
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="FullName" name="FristName" value="<?php echo htmlspecialchars($row['first_name']); ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="FullName" class="col-sm-3 col-form-label">
                                        <i class="fas fa-user"></i> Last Name
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="FullName" name="LastName" value="<?php echo htmlspecialchars($row['last_name']); ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Email" class="col-sm-3 col-form-label">
                                        <i class="fas fa-envelope"></i> Email
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control" id="Email" name="Email" value="<?php echo htmlspecialchars($row['email']); ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Address" class="col-sm-3 col-form-label">
                                        <i class="fas fa-home"></i> Address
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="Address" name="Address" value="<?php echo htmlspecialchars($row['Address']); ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="MobileNumber" class="col-sm-3 col-form-label">
                                        <i class="fas fa-phone-alt"></i> Mobile
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="MobileNumber" name="MobileNumber" value="<?php echo htmlspecialchars($row['phone']); ?>">
                                    </div>
                                </div>

                                <?php
                                if (isset($_GET['editSuccess'])) {
                                    if ($_GET['editSuccess'] == 'Insertsub') {
                                        echo '<div class="alert alert-success">Profile updated successfully!</div>';
                                    } elseif ($_GET['editSuccess'] == 'error') {
                                        echo '<div class="alert alert-danger">Error: ' . htmlspecialchars($_GET['message']) . '</div>';
                                    }
                                }
                                ?>

                                <p id="ErrorPersonalInformation" class="text-danger font-weight-bold"></p>

                                <div class="form-group row">
                                    <div class="col-sm-9 offset-sm-3">
                                        <input type="submit" name="submit" class="btn btn-primary" value="Save Changes">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Change Password Card -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">
                                <u><i class="fas fa-key"></i> Change Password</u>
                            </h5>
                            <form action="Backend/UpdateProfile.php" method="post" onsubmit="return ChangePasswordValidations()" name="ChangePassword">
                                <div class="form-group row">
                                    <label for="UserName" class="col-sm-3 col-form-label">
                                        <i class="fas fa-user-circle"></i> Username
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="UserName" name="UserName" value="<?php echo htmlspecialchars($row['username']); ?>">
                                    </div>
                                </div>
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($admin_id); ?>">
                                <div class="form-group row">
                                    <label for="Password" class="col-sm-3 col-form-label">
                                        <i class="fas fa-lock"></i> New Password
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" id="Password" name="Password">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="ComPassword" class="col-sm-3 col-form-label">
                                        <i class="fas fa-lock"></i> Confirm Password
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" id="ComPassword" name="ComPassword">
                                    </div>
                                </div>

                                <?php
                                if (isset($_GET['editPasswordSuccess'])) {
                                    if ($_GET['editPasswordSuccess'] == 'passwardsub') {
                                        echo '<div class="alert alert-success">Login password changed successfully!</div>';
                                    } elseif ($_GET['editPasswordSuccess'] == 'error') {
                                        echo '<div class="alert alert-danger">Error: ' . htmlspecialchars($_GET['message']) . '</div>';
                                    }
                                }
                                ?>

                                <p id="ErrorChangePassword" class="text-danger font-weight-bold"></p>

                                <div class="form-group row">
                                    <div class="col-sm-9 offset-sm-3">
                                        <input type="submit" name="submitPassword" class="btn btn-primary" value="Save Changes">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for Alerts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $('.alert').addClass('fade-out');
            }, 3000);
        });
    </script>
</body>

</html>
