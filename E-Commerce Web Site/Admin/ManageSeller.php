<?php
include 'header.php'; // Contains your common header or navigation
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Sellers</title>

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
        <h1 class="header-title text-center mb-5">Manage Sellers</h1>

        <!-- Add New Seller Button -->
        <div class="row mb-4">
        <div class="col-12 text-center">
                <button type="button" class="btn btn-primary btn-lg shadow-lg rounded-pill px-5 py-3" 
                data-bs-toggle="modal"data-bs-toggle="modal" data-bs-target="#addSellerModal" 
                style="background-color: #0d6efd; border-color: #0a58ca;">
                    <i class="bi bi-plus-circle me-2"></i>Add New Seller
                </button>
            </div>
        </div>

        <!-- Add Seller Modal -->
        <div class="modal fade" id="addSellerModal" tabindex="-1" aria-labelledby="addSellerModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="Backend/ManageSellerBack.php" method="POST" onsubmit="return validateForm()">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addSellerModalLabel"><i class="bi bi-person-plus me-2"></i>Add New Seller</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Form Fields -->
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
                                <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone">
                            </div>
                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="bi bi-house"></i></span>
                                <input type="text" class="form-control" name="address" id="address" placeholder="Address">
                            </div>
                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="bi bi-building"></i></span>
                                <input type="text" class="form-control" name="business_name" id="business_name" placeholder="Business Name">
                            </div>
                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                            </div>
                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm Password">
                            </div>
                            <div id="formFeedback"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-primary" name="SubmitInsert" value="Add Seller">
                        </div>
                    </form>
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
                                <li><a class="dropdown-item" href="ManageSeller.php?Fillter=All">All</a></li>
                                <li><a class="dropdown-item" href="ManageSeller.php?Fillter=Active">Active</a></li>
                                <li><a class="dropdown-item" href="ManageSeller.php?Fillter=Inactive">Inactive</a></li>
                            </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Animation Success Messages -->
        <?php
        if (isset($_GET['statusInsert'])) {
            if ($_GET['statusInsert'] == 'inserted') {
                echo '<div class="alert alert-success animate__animated animate__fadeInDown animate__faster">
                <i class="bi bi-check-circle me-2"></i>Seller added successfully!
              </div>';
            }
            if ($_GET['statusInsert'] == 'Error') {
                echo '<div class="alert alert-danger animate__animated animate__fadeInDown animate__faster">
                <i class="bi bi-x-circle me-2"></i>Email already exists
              </div>';
            }
        }
        if (isset($_GET['statusUpdate'])) {
            if ($_GET['statusUpdate'] == 'Updated') {
                echo '<div class="alert alert-success animate__animated animate__fadeInDown animate__faster">
                <i class="bi bi-check-circle me-2"></i>Seller updated successfully!
              </div>';
            }
            if ($_GET['statusUpdate'] == 'status') {
                echo '<div class="alert alert-success animate__animated animate__fadeInDown animate__faster">
                <i class="bi bi-check-circle me-2"></i>Seller access updated successfully!
              </div>';
            }
        }
        if (isset($_GET['statusdelete'])) {
            if ($_GET['statusdelete'] == 'deleted') {
                echo '<div class="alert alert-success animate__animated animate__fadeInDown animate__faster">
                <i class="bi bi-check-circle me-2"></i>Seller deleted successfully!
              </div>';
            }
        }
        ?>


        <!-- Sellers Table -->
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" >
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Business Name</th>
                                <th scope="col">Image</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                 if(isset($_REQUEST['Fillter'])){
                                    if($_REQUEST['Fillter'] == 'Active'){
                                        $query = "SELECT * FROM sellers WHERE Status ='1'";
                                         $result = mysqli_query($conn, $query);
                                    }
                                    if($_REQUEST['Fillter'] == 'Inactive'){
                                        $query = "SELECT * FROM sellers WHERE Status = '0'";
                                        $result = mysqli_query($conn, $query);
                                    }
                                    if($_REQUEST['Fillter'] == 'All'){
                                        $query = "SELECT * FROM sellers";
                                         $result = mysqli_query($conn, $query);
                                    }
                                } else {
                                    $query = "SELECT * FROM sellers";
                                    $result = mysqli_query($conn, $query);
                                }

                            if (!$result) {
                                die('Query Failed: ' . mysqli_error($conn)); // Error handling
                            }

                            $rowCount = mysqli_num_rows($result);
                            if ($rowCount > 0) {
                                while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($row['seller_id']); ?></td>
                                        <td><?php echo htmlspecialchars($row['first_name']); ?></td>
                                        <td><?php echo htmlspecialchars($row['last_name']); ?></td>
                                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                                        <td><?php echo htmlspecialchars($row['phone']); ?></td>
                                        <td><?php echo htmlspecialchars($row['business_name']); ?></td>
                                        <?php
                                            if ($row['online'] == 1) {
                                                if (empty($row['image'])) {
                                                    echo '<td>
                                                            <span style="color: green; font-weight: bold;">🟢 Online</span><br>
                                                            <span style="color: gray;">No Image Available</span>
                                                        </td>';
                                                } else {
                                                    echo '<td>
                                                            <span style="color: green; font-weight: bold;">🟢 Online</span><br>
                                                            <img src="../Seller/SellerImage/' . htmlspecialchars($row['image']) . '" alt="Seller Image" style="width: 50px; height: 50px; border-radius: 50%; border: 2px solid green;">
                                                        </td>';
                                                }
                                            } else {
                                                if (empty($row['image'])) {
                                                    echo '<td>
                                                            <span style="color: red; font-weight: bold;">🔴 Offline</span><br>
                                                            <span style="color: gray;">No Image Available</span>
                                                        </td>';
                                                } else {
                                                    echo '<td>
                                                            <span style="color: red; font-weight: bold;">🔴 Offline</span><br>
                                                            <img src="../Seller/SellerImage/' . htmlspecialchars($row['image']) . '" alt="Seller Image" style="width: 50px; height: 50px; border-radius: 50%; border: 2px solid red;">
                                                        </td>';
                                                }
                                            }                                     
                                        ?>

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
                                            <!-- Edit Button -->
                                            <button type="button" class="btn btn-sm btn-info me-1" data-bs-toggle="modal" data-bs-target="#editSellerModal<?php echo $row['seller_id']; ?>">
                                                <i class="bi bi-pencil-square"></i> View/Edit
                                            </button>
                                            <!-- Delete Button -->
                                            <button type="button" class="btn btn-sm btn-danger me-1" data-bs-toggle="modal" data-bs-target="#deleteSellerModal<?php echo $row['seller_id']; ?>">
                                                <i class="bi bi-trash"></i> Delete
                                            </button>
                                            <!-- Status Button -->
                                            <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#changeStatusModal<?php echo $row['seller_id']; ?>">
                                                <i class="bi bi-arrow-clockwise"></i> Change Status
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Edit Seller Modal -->
                                    <div class="modal fade" id="editSellerModal<?php echo $row['seller_id']; ?>" tabindex="-1" aria-labelledby="editSellerModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="Backend/ManageSellerBack.php" method="POST">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editSellerModalLabel"><i class="bi bi-pencil-square me-2"></i>Edit Seller Details</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="hidden" name="seller_id" value="<?php echo htmlspecialchars($row['seller_id']); ?>">

                                                        <div class="mb-3 input-group">
                                                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                                                            <input type="text" class="form-control" name="first_name" id="first_name" value="<?php echo htmlspecialchars($row['first_name']); ?>" placeholder="First Name">
                                                        </div>
                                                        <div class="mb-3 input-group">
                                                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                                                            <input type="text" class="form-control" name="last_name" id="last_name" value="<?php echo htmlspecialchars($row['last_name']); ?>" placeholder="Last Name">
                                                        </div>
                                                        <div class="mb-3 input-group">
                                                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                                            <input type="email" class="form-control" name="email" id="email" value="<?php echo htmlspecialchars($row['email']); ?>" placeholder="Email">
                                                        </div>
                                                        <div class="mb-3 input-group">
                                                            <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                                            <input type="text" class="form-control" name="phone" id="phone" value="<?php echo htmlspecialchars($row['phone']); ?>" placeholder="Phone">
                                                        </div>
                                                        <div class="mb-3 input-group">
                                                            <span class="input-group-text"><i class="bi bi-house"></i></span>
                                                            <input type="text" class="form-control" name="address" id="address" value="<?php echo htmlspecialchars($row['address']); ?>" placeholder="Address">
                                                        </div>
                                                        <div class="mb-3 input-group">
                                                            <span class="input-group-text"><i class="bi bi-building"></i></span>
                                                            <input type="text" class="form-control" name="business_name" id="business_name" value="<?php echo htmlspecialchars($row['business_name']); ?>" placeholder="Business Name">
                                                        </div>
                                                        <div class="mb-3 input-group">
                                                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                                            <input type="password" class="form-control" name="password" id="password" placeholder="Password (leave blank to keep unchanged)">
                                                        </div>
                                                        <div class="mb-3 input-group">
                                                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                                            <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm Password (leave blank to keep unchanged)">
                                                        </div>
                                                        <div id="formFeedback"></div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <input type="submit" class="btn btn-primary" name="SubmitUpdate" value="Update Seller">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- Delete Seller Modal -->
                                    <div class="modal fade" id="deleteSellerModal<?php echo $row['seller_id']; ?>" tabindex="-1" aria-labelledby="deleteSellerModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteSellerModalLabel"><i class="bi bi-trash me-2"></i>Confirm Deletion</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete seller <strong><?php echo htmlspecialchars($row['first_name'] . ' ' . $row['last_name']); ?></strong>?
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="Backend/ManageSellerBack.php" method="POST">
                                                        <input type="hidden" name="seller_id" value="<?php echo htmlspecialchars($row['seller_id']); ?>">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-danger" name="SubmitDelete">
                                                            <i class="bi bi-trash me-1"></i>Delete Seller 
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <!--   Modal -->
                                    <div class="modal fade" id="changeStatusModal<?php echo $row['seller_id']; ?>" tabindex="-1" aria-labelledby="changeStatusModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="Backend/ManageSellerBack.php" method="POST">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="changeStatusModalLabel"><i class="bi bi-arrow-clockwise me-2"></i>Change Seller Access Status</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="hidden" name="seller_id" value="<?php echo htmlspecialchars($row['seller_id']); ?>">
                                                        <div class="mb-3">
                                                            <label for="status" class="form-label mb-3">
                                                                <i class="bi bi-info-circle me-2"></i>Status
                                                            </label>
                                                            <select class="form-select" id="status" name="status" required>
                                                                <option value="" disabled selected>Select Status</option>
                                                                <option value="1" <?php if ($row['Status'] == 1) echo 'selected'; ?>>Active</option>
                                                                <option value="0" <?php if ($row['Status'] == 0) echo 'selected'; ?>>Inactive</option>
                                                            </select>
                                                        </div>
                                                        <div id="formFeedback"></div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary" name="SubmitStatus">
                                                            <i class="bi bi-arrow-right-circle me-1"></i>Change Status
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                }
                            } else {
                                echo '<tr><td colspan="10" class="text-center">No sellers found.</td></tr>';
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
        $(document).ready(function() {
            setTimeout(function() {
                $('.alert').fadeOut('slow');
            }, 3000); // 3 seconds before fading out
        });

        // Search Functionality
        $(document).ready(function() {
            $("#searchInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("table tbody tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
        });

        // Form validation
        function validateForm() {
            const firstName = document.getElementById('first_name').value.trim();
            const lastName = document.getElementById('last_name').value.trim();
            const email = document.getElementById('email').value.trim();
            const phone = document.getElementById('phone').value.trim();
            const address = document.getElementById('address').value.trim();
            const businessName = document.getElementById('business_name').value.trim();
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm_password').value;
            const feedback = document.getElementById('formFeedback');

            if (firstName === "") {
                feedback.innerHTML = '<div class="alert alert-danger">First Name is required.</div>';
                return false;
            }
            if (lastName === "") {
                feedback.innerHTML = '<div class="alert alert-danger">Last Name is required.</div>';
                return false;
            }
            if (email === "") {
                feedback.innerHTML = '<div class="alert alert-danger">Email is required.</div>';
                return false;
            }
            if (phone === "") {
                feedback.innerHTML = '<div class="alert alert-danger">Phone is required.</div>';
                return false;
            }
            if (address === "") {
                feedback.innerHTML = '<div class="alert alert-danger">Address is required.</div>';
                return false;
            }
            if (businessName === "") {
                feedback.innerHTML = '<div class="alert alert-danger">Business Name is required.</div>';
                return false;
            }
            if (password === "" || confirmPassword === "") {
                feedback.innerHTML = '<div class="alert alert-danger">Passwords are required.</div>';
                return false;
            }
            if (password !== confirmPassword) {
                feedback.innerHTML = '<div class="alert alert-danger">Passwords do not match.</div>';
                return false;
            }

            feedback.innerHTML = ''; // Clear previous messages
            return true;
        }
    </script>

</body>

</html>