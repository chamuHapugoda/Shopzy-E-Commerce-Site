<?php
include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Customers</title>
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
        <h1 class="header-title text-center mb-5">Manage Customers</h1>

        <!-- Add New customers Button -->
        <div class="row mb-4">
            <div class="col-12 text-center">
                <button type="button" class="btn btn-primary btn-lg shadow-lg rounded-pill px-5 py-3" 
                data-bs-toggle="modal"  data-bs-toggle="modal" data-bs-target="#addCustomersModal" 
                style="background-color: #0d6efd; border-color: #0a58ca;">
                    <i class="bi bi-plus-circle me-2"></i>Add New Customers
                </button>
            </div>
        </div>

        <!-- Add Customers Modal -->
        <div class="modal fade" id="addCustomersModal" tabindex="-1" aria-labelledby="addCustomersModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="Backend/ManageCustomersBack.php" method="POST" onsubmit="return validateForm()">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addCustomersModalLabel"><i class="bi bi-person-plus me-2"></i>Add New Customer</h5>
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
                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                            </div>
                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm Password">
                            </div>
                            <div id="formFeedback" class="error"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-primary" name="SubmitInsert" value="Add Customer">
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
                                <li><a class="dropdown-item" href="ManageCustomers.php?Fillter=All">All</a></li>
                                <li><a class="dropdown-item" href="ManageCustomers.php?Fillter=Active">Active</a></li>
                                <li><a class="dropdown-item" href="ManageCustomers.php?Fillter=Inactive">Inactive</a></li>
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
                <i class="bi bi-check-circle me-2"></i>New Customer added successfully!
              </div>';
            }
            if ($_GET['statusInsert'] == 'Error') {
                echo '<div class="alert alert-danger animate__animated animate__fadeInDown animate__faster">
                <i class="bi bi-x-circle me-2"></i>Email already exists
              </div>';
            }
        }
        if (isset($_GET['statusUpdate'])) {
            if ($_GET['statusUpdate'] == 'updated') {
                echo '<div class="alert alert-success animate__animated animate__fadeInDown animate__faster">
                <i class="bi bi-check-circle me-2"></i>Customer updated successfully!
              </div>';
            }
            if ($_GET['statusUpdate'] == 'status') {
                echo '<div class="alert alert-success animate__animated animate__fadeInDown animate__faster">
                <i class="bi bi-check-circle me-2"></i>Customer access updated successfully!
              </div>';
            }
        }
        if (isset($_GET['statusDelete'])) {
            if ($_GET['statusDelete'] == 'deleted') {
                echo '<div class="alert alert-success animate__animated animate__fadeInDown animate__faster">
                <i class="bi bi-check-circle me-2"></i>Customer deleted successfully!
              </div>';
            }
        }
        ?>


        <!-- Sellers Table -->
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Address</th>
                                <th scope="col">Current Status</th>
                                <th scope="col">Account Status</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Populate sellers table with data from backend -->
                            <?php
                              if(isset($_REQUEST['Fillter'])){
                                if($_REQUEST['Fillter'] == 'Active'){
                                    $query = "SELECT * FROM customers WHERE Status='1'";
                                    $result = mysqli_query($conn, $query);
                                }
                                if($_REQUEST['Fillter'] == 'Inactive'){
                                    $query = "SELECT * FROM customers WHERE Status = '0'";
                                    $result = mysqli_query($conn, $query);
                                }
                                if($_REQUEST['Fillter'] == 'All'){
                                    $query = "SELECT * FROM customers";
                                    $result = mysqli_query($conn, $query);
                                }
                            } else {
                                $query = "SELECT * FROM customers";
                                $result = mysqli_query($conn, $query);
                            } 
                            
                            if (!$result) {
                                die('Query Failed: ' . mysqli_error($conn)); // Error handling
                            }

                            $rowCount = mysqli_num_rows($result);
                            if ($rowCount > 0) {
                                while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <tr>
                                        <td><?php echo $row['customer_id']; ?></td>
                                        <td><?php echo $row['first_name']; ?></td>
                                        <td><?php echo $row['last_name']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td><?php echo $row['phone']; ?></td>
                                        <td><?php echo $row['address']; ?></td>
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
                                                        <img src="../customer/customerImage/' . htmlspecialchars($row['image']) . '" alt="Customer Image" style="width: 50px; height: 50px; border-radius: 50%; border: 2px solid green;">
                                                    </td>';
                                            }

                                        } else{
                                            if (empty($row['image'])) {
                                                echo '<td>
                                                        <span style="color: red; font-weight: bold;">🔴 Offline</span><br>
                                                        <span style="color: gray;">No Image Available</span>
                                                    </td>';
                                            } else {
                                                echo '<td>
                                                        <span style="color: red; font-weight: bold;">🔴 Offline</span><br>
                                                        <img src="../customer/customerImage/' . htmlspecialchars($row['image']) . '" alt="Customer Image" style="width: 50px; height: 50px; border-radius: 50%; border: 2px solid red;">
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
                                            <button type="button" class="btn btn-sm btn-info me-1" data-bs-toggle="modal" data-bs-target="#editCustomerModal<?php echo $row['customer_id']; ?>">
                                                <i class="bi bi-pencil-square"></i> View/Edit
                                            </button>
                                            <!-- Delete Button -->
                                            <button type="button" class="btn btn-sm btn-danger me-1" data-bs-toggle="modal" data-bs-target="#deleteCustomerModal<?php echo $row['customer_id']; ?>">
                                                <i class="bi bi-trash"></i> Delete
                                            </button>
                                            <!-- Status Button -->
                                            <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#changeCustomerModal<?php echo $row['customer_id']; ?>">
                                                <i class="bi bi-arrow-clockwise"></i> Change Status
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Edit Customer Modal -->
                                    <div class="modal fade" id="editCustomerModal<?php echo htmlspecialchars($row['customer_id']); ?>" tabindex="-1" aria-labelledby="editCustomerModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="Backend/ManageCustomersBack.php" method="POST" onsubmit="return validatePasswords();">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editCustomerModalLabel"><i class="bi bi-pencil-square me-2"></i>Edit Customer Details</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="hidden" name="customer_id" value="<?php echo htmlspecialchars($row['customer_id']); ?>">

                                                        <div class="mb-3 input-group">
                                                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                                                            <input type="text" class="form-control" name="first_name" id="edit_first_name" value="<?php echo htmlspecialchars($row['first_name']); ?>" required>
                                                        </div>

                                                        <div class="mb-3 input-group">
                                                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                                                            <input type="text" class="form-control" name="last_name" id="edit_last_name" value="<?php echo htmlspecialchars($row['last_name']); ?>" required>
                                                        </div>

                                                        <div class="mb-3 input-group">
                                                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                                            <input type="email" class="form-control" name="email" id="edit_email" value="<?php echo htmlspecialchars($row['email']); ?>" required>
                                                        </div>

                                                        <div class="mb-3 input-group">
                                                            <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                                            <input type="text" class="form-control" name="phone" id="edit_phone" value="<?php echo htmlspecialchars($row['phone']); ?>" required>
                                                        </div>

                                                        <div class="mb-3 input-group">
                                                            <span class="input-group-text"><i class="bi bi-house-fill"></i></span>
                                                            <textarea class="form-control" name="address" id="edit_address" required><?php echo htmlspecialchars($row['address']); ?></textarea>
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
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <input type="submit" class="btn btn-primary" name="SubmitUpdate" value="Update Customer">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Delete Customer Modal -->
                                    <div class="modal fade" id="deleteCustomerModal<?php echo $row['customer_id']; ?>" tabindex="-1" aria-labelledby="deleteCustomerModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="Backend/ManageCustomersBack.php" method="POST">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteCustomerModalLabel"><i class="bi bi-trash me-2"></i>Delete Customer</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="hidden" name="customer_id" value="<?php echo htmlspecialchars($row['customer_id']); ?>">
                                                        Are you sure you want to delete this customer
                                                        <strong><?php echo htmlspecialchars($row['first_name']) . ' ' . htmlspecialchars($row['last_name']); ?></strong>?
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-danger" name="SubmitDelete">
                                                            <i class="bi bi-trash me-1"></i>Delete Customer
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Change Status Modal -->
                                    <div class="modal fade" id="changeCustomerModal<?php echo $row['customer_id']; ?>" tabindex="-1" aria-labelledby="changeCustomerModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="Backend/ManageCustomersBack.php" method="POST">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="changeCustomerModalLabel"><i class="bi bi-arrow-clockwise me-2"></i>Change Customer Access Status</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="hidden" name="customer_id" value="<?php echo htmlspecialchars($row['customer_id']); ?>">
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


                            <?php }
                            } else {
                                echo '<tr><td colspan="10" class="text-center">No Customers found.</td></tr>';
                            }
                            ?>
                        </tbody>


                        <!-- JavaScript 3 seconds before fading out -->
                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

                        <script>
                            // Timeout for alert fadeout
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

                            // Form Validation
                            function validateForm() {
                                var firstName = document.getElementById('first_name').value.trim();
                                var lastName = document.getElementById('last_name').value.trim();
                                var email = document.getElementById('email').value.trim();
                                var phone = document.getElementById('phone').value.trim();
                                var address = document.getElementById('address').value.trim();
                                var password = document.getElementById('password').value.trim();
                                var confirmPassword = document.getElementById('confirm_password').value.trim();
                                var feedback = document.getElementById('formFeedback');

                                // Reset previous errors
                                feedback.innerHTML = '';

                                // Validate fields
                                if (!firstName || !lastName || !email || !phone || !address || !password || !confirmPassword) {
                                    feedback.innerHTML = "All fields are required.";
                                    return false;
                                }

                                // First name and last name validation
                                var namePattern = /^[a-zA-Z]+$/;
                                if (!namePattern.test(firstName) || !namePattern.test(lastName)) {
                                    feedback.innerHTML = "First name and last name can only contain alphabetic characters.";
                                    return false;
                                }

                                // Address validation
                                var addressPattern = /^[a-zA-Z0-9\s,.-]+$/;
                                if (!addressPattern.test(address)) {
                                    feedback.innerHTML = "Please enter a valid address.";
                                    return false;
                                }

                                // Email validation
                                var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                                if (!emailPattern.test(email)) {
                                    feedback.innerHTML = "Please enter a valid email address.";
                                    return false;
                                }

                                // Phone validation (e.g., only digits, min length of 10)
                                var phonePattern = /^\d{10}$/;
                                if (!phonePattern.test(phone)) {
                                    feedback.innerHTML = "Please enter a valid 10-digit phone number.";
                                    return false;
                                }

                                // Password and confirm password match
                                if (password !== confirmPassword) {
                                    feedback.innerHTML = "Passwords do not match.";
                                    return false;
                                }

                                return true;
                            }

                            // Password Validation Script 
                            function validatePasswords() {
                                const password = document.getElementById('edit_password').value;
                                const confirmPassword = document.getElementById('edit_confirm_password').value;

                                if (password !== confirmPassword) {
                                    document.getElementById('formFeedback').textContent = "Passwords do not match!";
                                    return false; // Prevent form submission
                                }
                                return true; // Allow form submission
                            }
                        </script>
</body>

</html>