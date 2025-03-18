<?php
include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profiles</title>

    <!-- Include Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- Include Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- custom css -->
    <link rel="stylesheet" href="css/pagestyle.css">
    

</head>

<body>
<div class="custom-container my-5 mx-5">
        <!-- Back Button with Icon -->
        <a href="main.php" class="btn btn-primary back">
            <i class="bi bi-arrow-left me-2"></i> Back to Dashboard
        </a>


        <!-- Header -->
        <h1 class="header-title text-center mb-5">Admin Profiles</h1>

        <!-- Add Admin Button -->
        <div class="row mb-4">
            <div class="col-12 text-center">
                <button type="button" class="btn btn-primary btn-lg shadow-lg rounded-pill px-5 py-3" 
                        data-bs-toggle="modal" data-bs-target="#addAdminModal"
                        style="background-color: #0d6efd; border-color: #0a58ca;" >
                    <i class="bi bi-plus-circle me-2"></i>Add New Admin
                </button>
            </div>
        </div>

        <!-- Add Admin Modal -->
        <div class="modal fade" id="addAdminModal" tabindex="-1" aria-labelledby="addAdminModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addAdminModalLabel"><i class="bi bi-plus-circle me-2"></i>Add New
                            Admin</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="Backend/AdminProfileBack.php" method="post" enctype="multipart/form-data"
                            onsubmit="return validateForm()">
                            <!-- Form Fields -->
                            <input type="hidden" name="Position" value="Admin">
                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="bi bi-person"></i></span>
                                <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name">
                            </div>
                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="bi bi-person"></i></span>
                                <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name">
                            </div>
                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                            </div>
                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="bi bi-house"></i></span>
                                <input type="text" class="form-control" name="address" id="address" placeholder="Address">
                            </div>
                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="bi bi-phone"></i></span>
                                <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone">
                            </div>
                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                <input type="text" class="form-control" name="username" id="username" placeholder="Username">
                            </div>
                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="bi bi-key"></i></span>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                            </div>
                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="bi bi-key"></i></span>
                                <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm Password">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="Submitinsert">Add Admin</button>
                            </div>
                            <div id="formFeedback" class="mt-3 text-center"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search Bar -->
        <div class="row my-4">
            <div class="col-md-8 offset-md-2">
                <div class="input-group shadow rounded-pill">
                    <input type="text" id="searchInput" class="form-control rounded-pill border-0" 
                        placeholder="Search Products..." 
                        aria-label="Search Products">
                    <button class="btn btn-primary rounded-pill px-4" type="button" id="searchButton">
                        <i class="bi bi-search"></i> Search
                    </button>
                    <div >
                        <dropdown class="dropdown">
                            <button class="btn btn-primary dropdown-toggle rounded-pill px-4" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-funnel-fill"></i> Filter
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="AdminProfile.php?Fillter=All">All</a></li>
                                <li><a class="dropdown-item" href="AdminProfile.php?Fillter=Active">Active</a></li>
                                <li><a class="dropdown-item" href="AdminProfile.php?Fillter=Inactive">Inactive</a></li>
                            </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- animation success -->
        <?php
            if (isset($_GET['statusInsert'])) {
                if ($_GET['statusInsert'] == 'inserted') {
                    echo '<div class="alert alert-success animate__animated animate__fadeInDown animate__faster"><i class="bi bi-check-circle me-2"></i>
                    New Admin Add successfully!</div>';
                }
                if ($_GET['statusInsert'] == 'Error') {
                    echo '<div class="alert alert-danger animate__animated animate__fadeInDown animate__faster"><i class="bi bi-exclamation-circle me-2"></i>
                    Email already exists, please try again!</div>';
                }
            }
            if (isset($_GET['statusdelete'])) {
                if ($_GET['statusdelete'] == 'deleted') {
                    echo '<div class="alert alert-success animate__animated animate__fadeInDown animate__faster"><i class="bi bi-check-circle me-2"></i>
                    Admin deleted successfully!</div>';
                }
            }
    
            if (isset($_GET['statusUpdate'])) {
                if ($_GET['statusUpdate'] == 'updated') {
                    echo '<div class="alert alert-success animate__animated animate__fadeInDown animate__faster"><i class="bi bi-check-circle me-2"></i>
                    Admin details Update successfully!</div>';
                }
                if ($_GET['statusUpdate'] == 'status') {
                    echo '<div class="alert alert-success animate__animated animate__fadeInDown animate__faster">
                    <i class="bi bi-check-circle me-2"></i>Admin access updated successfully!!
                    </div>';
                }
            }
        
        ?>

        <!-- Admin Table -->
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Username</th>
                                <th scope="col">Image</th>
                                <th scope="col">Status</th>
                                <th scope="col">Position</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                             if(isset($_REQUEST['Fillter'])){
                                if($_REQUEST['Fillter'] == 'Active'){
                                    $query = "SELECT * FROM admins WHERE Status = '1'";
                                    $result = mysqli_query($conn, $query);
                                }
                                if($_REQUEST['Fillter'] == 'Inactive'){
                                    $query = "SELECT * FROM admins WHERE Status = '0'";
                                    $result = mysqli_query($conn, $query);
                                }
                                if($_REQUEST['Fillter'] == 'All'){
                                    $query = "SELECT * FROM admins";
                                    $result = mysqli_query($conn, $query);
                                }
                            } else {
                                $query = "SELECT * FROM admins";
                                $result = mysqli_query($conn, $query);
                            }

                            if (!$result) {
                                die('Query Failed: ' . mysqli_error($conn)); // Error handling
                            }

                            $rowCount = mysqli_num_rows($result);
                            if ($rowCount > 0) {
                                while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td>
                                    <?php echo htmlspecialchars($row['admin_id']); ?>
                                </td>
                                <td>
                                    <?php echo htmlspecialchars($row['first_name']); ?>
                                </td>
                                <td>
                                    <?php echo htmlspecialchars($row['email']); ?>
                                </td>
                                <td>
                                    <?php echo htmlspecialchars($row['phone']); ?>
                                </td>
                                <td>
                                    <?php echo htmlspecialchars($row['username']); ?>
                                </td>
                                <td>
                                <?php
                                if ($row['Image'] == "") {
                                    echo "<img src='https://bootdey.com/img/Content/avatar/avatar6.png' alt='User Profile Image' class='rounded-circle p-1 bg-primary' width='70'>";
                                } else {
                                    echo "<img src='AdminImage/" . htmlspecialchars($row['Image']) . "' alt='User Profile Image' class='rounded-circle p-1 bg-primary' width='70'>";
                                }
                                ?>
                                </td>
                                <td>
                                    <?php
                                            if ($row['Status'] == 1) {
                                                echo '<span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>Active</span>';
                                            } else {
                                                echo '<span class="badge bg-secondary"><i class="bi bi-x-circle me-1"></i>Inactive</span>';
                                            }
                                            ?>
                                </td>
                                <td>
                                    <?php
                                    if ($row['Position'] == "MainAdmin") {
                                        echo '<span class="badge bg-info"><i class="bi bi-person-circle me-1"></i>Main Admin</span>';
                                    } else {
                                        echo '<span class="badge bg-secondary"><i class="bi bi-person-circle me-1"></i>Admin</span>';
                                    }
                                    ?>
                                </td>

                                <td>
                                    <!-- Edit Button -->
                                    <button type="button" class="btn btn-sm btn-info me-1" data-bs-toggle="modal" data-bs-target="#editAdminModal<?php echo $row['admin_id']; ?>">
                                        <i class="bi bi-pencil-square"></i> View/Edit
                                    </button>
                                    <!-- Delete Button -->
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAdminModal<?php echo htmlspecialchars($row['admin_id']); ?>">
                                        <i class="bi bi-trash"></i>Delete
                                    </button>
                                    <!-- Status Button -->
                                    <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#changeStatusModal<?php echo $row['admin_id']; ?>">
                                        <i class="bi bi-arrow-clockwise"></i> Change Status
                                    </button>
                                </td>
                            </tr>

                            <!-- Edit Admin Modal -->
                            <div class="modal fade" id="editAdminModal<?php echo $row['admin_id'];?>" tabindex="-1" aria-labelledby="editAdminModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editAdminModalLabel"><i class="bi bi-pencil-square me-2"></i>Edit Admin</h5>
                                            <button type="button" class="last_namebtn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="Backend/AdminProfileBack.php" method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="admin_id" value="<?php echo htmlspecialchars($row['admin_id']);?>">
                                                <input type="hidden" name="Position" value="Admin">
                                                    <div class="mb-3 input-group">
                                                        <img src="AdminImage/<?php echo htmlspecialchars($row['Image']); ?>" alt="Admin Image" class="rounded-circle p-1 bg-primary" width="70">
                                                    </div>
                                                <div class="mb-3 input-group">
                                                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                                                    <input type="text" class="form-control" name="first_name" id="edit_first_name" value="<?php echo htmlspecialchars($row['first_name']);?>" required>
                                                </div>
                                                <div class="mb-3 input-group">
                                                     <span class="input-group-text"><i class="bi bi-person"></i></span>
                                                    <input type="text" class="form-control" name="last_name" id="edit_last_name" value="<?php echo htmlspecialchars($row['last_name']);?>" required">
                                                </div>
                                                <div class="mb-3 input-group">
                                                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                                    <input type="email" class="form-control" name="email" id="edit_email" value="<?php echo htmlspecialchars ($row['email']);?>" required>
                                                </div>
                                                <div class="mb-3 input-group">
                                                    <span class="input-group-text"><i class="bi bi-phone"></i></span>
                                                    <input type="text" class="form-control" name="phone" id="edit_phone" value="<?php echo htmlspecialchars($row['phone']);?>" required>
                                                </div>
                                                <div class="mb-3 input-group">
                                                     <span class="input-group-text"><i class="bi bi-building"></i></span>
                                                    <input type="text" class="form-control" name="address" id="edit_address" value="<?php echo htmlspecialchars($row['Address']);?>">
                                                </div>
                                                <div class="mb-3 input-group">
                                                     <span class="input-group-text"><i class="bi bi-at"></i></span>
                                                    <input type="text" class="form-control" name="username" id="edit_username" value="<?php echo htmlspecialchars($row['username']);?>" required>
                                                </div>
                                                <div class="mb-3 input-group">
                                                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                                    <input type="password" class="form-control" name="password" id="edit_password" placeholder="Leave blank to keep unchanged">
                                                </div>
                                                <div class="mb-3 input-group">
                                                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                                    <input type="password" class="form-control" name="confirm_password" id="edit_confirm_password" placeholder="Leave blank to keep unchanged">
                                                </div>
                                                <div id="formFeedback" class="text-danger"></div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary" name="SubmitUpdate">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Delete Product Modal -->
                            <div class="modal fade" id="deleteAdminModal<?php echo htmlspecialchars($row['admin_id']); ?>" tabindex="-1" aria-labelledby="deleteAdminModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteAdminModalLabel"><i class="bi bi-trash me-2"></i>Delete Admin</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3 input-group">
                                                <img src="AdminImage/<?php echo htmlspecialchars($row['Image']); ?>" alt="Admin Image" class="rounded-circle p-1 bg-primary" width="70">
                                            </div>
                                            Are you sure you want to delete this admin? <strong> <?php echo htmlspecialchars($row['first_name']); ?> </strong>?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <form action="Backend/AdminProfileBack.php" method="post" class="d-inline">
                                                <input type="hidden" name="admin_id" value="<?php echo htmlspecialchars($row['admin_id']); ?>">
                                                <button type="submit" class="btn btn-danger" name="SubmitDelete"><i class="bi bi-trash me-1"></i>Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Change Status Modal -->
                            <div class="modal fade" id="changeStatusModal<?php echo $row['admin_id']; ?>"
                                tabindex="-1" aria-labelledby="changeStatusModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="Backend/AdminProfileBack.php" method="POST">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="changeStatusModalLabel"><i class="bi bi-arrow-clockwise me-2"></i>Change Admin Access Status</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" name="admin_id" value="<?php echo htmlspecialchars($row['admin_id']); ?>">
                                                <div class="mb-3">
                                                    <label for="status" class="form-label mb-3"><i class="bi bi-info-circle me-2"></i>Status</label>
                                                    <select class="form-select" id="status" name="Status" required>
                                                        <option value="" disabled selected>Select Status</option>
                                                        <option value="1" <?php if ($row['Status']==1) echo 'selected' ; ?>>Active</option>
                                                        <option value="0" <?php if ($row['Status']==0) echo 'selected' ; ?>>Inactive</option>
                                                    </select>
                                                </div>
                                                <div id="formFeedback"></div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary" name="SubmitStatus"><i class="bi bi-arrow-right-circle me-1"></i>Change Status</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <?php }
                            } else {
                                echo '<tr><td colspan="10" class="text-center">No products found.</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>

    <!-- JavaScript 3 seconds before fading out -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function () {
            setTimeout(function () {
                $('.alert').fadeOut('slow');
            }, 3000); // 3 seconds before fading out
        });

        // Simple search function
        $(document).ready(function () {
            $("#searchInput").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("table tbody tr").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
        });

        function validateForm() {
            // Add any additional validation if necessary
            return true;
        }
    </script>

</body>

</html>