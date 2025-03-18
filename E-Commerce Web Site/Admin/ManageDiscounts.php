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
        <h1 class="header-title text-center mb-5">Manage Discounts</h1>

        <!-- Add New Discount Button -->
        <div class="row mb-3">
            <div class="col-md-12 text-center">
                <button type="button" class="btn btn-primary btn-lg shadow-lg rounded-pill px-5 py-3" 
                        data-bs-toggle="modal" data-bs-target="#addDiscountModal"
                        style="background-color: #0d6efd; border-color: #0a58ca;">
                    <i class="bi bi-plus-circle me-2"></i>Add New Discount
                </button>
            </div>
        </div>

        <!-- Add Discount Modal -->
        <div class="modal fade" id="addDiscountModal" tabindex="-1" aria-labelledby="addDiscountModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addDiscountModalLabel"><i class="bi bi-plus-circle me-2"></i>Add New Discount</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addDiscountForm" action="Backend/ManageDiscountsBack.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">

                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="bi bi-card-list"></i></span>
                                <input type="text" class="form-control" name="products_id" id="products_id" placeholder="Products ID">
                            </div>

                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="bi bi-tag"></i></span>
                                <input type="text" class="form-control" name="discountCode" id="discountCode" placeholder="Discount Code">
                            </div>

                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="bi bi-percent"></i></span>
                                <input type="number" step="0.01" class="form-control" name="discountPercentage" id="discountPercentage" placeholder="Discount Percentage">
                            </div>

                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="bi bi-textarea"></i></span>
                                <textarea class="form-control" name="DescountDescription" id="DescountDescription" rows="3" placeholder="Discount Description"></textarea>
                            </div>                            

                            <div class="mb-3">
                                <label for="discountStartDate" class="form-label"> Discount Start Date</label>
                                <input type="date" class="form-control" name="discountStartDate" id="discountStartDate" placeholder="Discount Start Date">
                            </div>

                            <div class="mb-3">
                                <label for="discountEndDate" class="form-label"> Discount End Date</label>
                                <input type="date" class="form-control" name="discountEndDate" id="discountEndDate" placeholder="Discount End Date">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <input type="submit" class="btn btn-primary" name="SubmitInsert" value="Add Discount">
                            </div>
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
                        placeholder="Search Discounts..." 
                        aria-label="Search Discounts">
                    <button class="btn btn-primary rounded-pill px-4" type="button" id="searchButton">
                        <i class="bi bi-search"></i> Search
                    </button>
                </div>
            </div>
        </div>

        <!-- Animation Success Messages -->
        <?php
            if (isset($_GET['statusInsert'])) {
                if ($_GET['statusInsert'] == 'inserted') {
                    echo '<div class="alert alert-success animate__animated animate__fadeInDown animate__faster">
                    <i class="bi bi-check-circle me-2"></i>Discount added successfully!
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
                    <i class="bi bi-check-circle me-2"></i>Discount updated successfully!
                </div>';
                }
                if ($_GET['statusUpdate'] == 'status') {
                    echo '<div class="alert alert-success animate__animated animate__fadeInDown animate__faster">
                    <i class="bi bi-check-circle me-2"></i>Discount status updated successfully!
                </div>';
                }
            }
            if (isset($_GET['statusdelete'])) {
                if ($_GET['statusdelete'] == 'deleted') {
                    echo '<div class="alert alert-success animate__animated animate__fadeInDown animate__faster">
                    <i class="bi bi-check-circle me-2"></i>Discount deleted successfully!
                </div>';
                }
            }
        ?>

        <!-- Discount Table -->
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="sellersTable">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Discount ID</th>
                                <th scope="col">Products ID</th>
                                <th scope="col">Discount Code</th>
                                <th scope="col">Discount Percentage</th>
                                <!-- <th scope="col">Discount Description</th> -->
                                <th scope="col">Discount Start Date</th>
                                <th scope="col">Discount End Date</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $query = "SELECT * FROM discounts";
                            $result = mysqli_query($conn, $query);
                            if (!$result) {
                                die('Query Failed: ' . mysqli_error($conn)); // Error handling
                            }

                            $rowCount = mysqli_num_rows($result);
                            if ($rowCount > 0) {
                                while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td><?php echo $row['discount_id']; ?></td>
                                    <td><?php echo $row['product_id']; ?></td>
                                    <td><?php echo $row['code']; ?></td>
                                    <td><?php echo $row['discount_percentage']; ?></td>
                                    <!-- <td>< ?php echo $row['description']; ?></td> -->
                                    <td><?php echo $row['valid_from']; ?></td>
                                    <td><?php echo $row['valid_until']; ?></td>
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
                                        <button type="button" class="btn btn-sm btn-info me-1" data-bs-toggle="modal" data-bs-target="#editDiscountModal<?php echo $row['discount_id']; ?>">
                                            <i class="bi bi-pencil-square"></i> View/Edit
                                        </button>
                                        <!-- Delete Button -->
                                        <button type="button" class="btn btn-sm btn-danger me-1" data-bs-toggle="modal" data-bs-target="#deleteDiscountModal<?php echo $row['discount_id']; ?>">
                                            <i class="bi bi-trash"></i> Delete
                                        </button>
                                        <!-- Status Button -->
                                        <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#changeStatusModal<?php echo $row['discount_id']; ?>">
                                            <i class="bi bi-arrow-clockwise"></i> Change Status
                                        </button>
                                    </td>
                                </tr>

                                 <!-- Edit Discount Modal -->
                                 <div class="modal fade" id="editDiscountModal<?php echo $row['discount_id']; ?>" tabindex="-1" aria-labelledby="editDiscountModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editDiscountModalLabel"> <i class="fas fa-pencil-alt"></i> Edit Discount </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="Backend/ManageDiscountsBack.php" method="POST">   
                                                    <input type="hidden" name="discount_id" value="<?php echo $row['discount_id']; ?>"> 
                                                    <div class="mb-3 input-group">
                                                        <span class="input-group-text"><i class="bi bi-card-list"></i></span>
                                                        <input type="number" class="form-control" id="products_id" name="products_id" value="<?php echo $row['product_id']; ?>" required>
                                                    </div>
                                                    <div class="mb-3 input-group">
                                                         <span class="input-group-text"><i class="bi bi-tag"></i></span>
                                                        <input type="text" class="form-control" id="discountCode" name="discountCode" placeholder="Discount Code" value="<?php echo $row['code']; ?> " required>
                                                    </div>
                                                    <div class="mb-3 input-group">
                                                        <!-- <label for="discountPercentage" class="form-label">Discount Percentage</label>  -->
                                                        <span class="input-group-text"><i class="bi bi-percent"></i></span>
                                                        <input type="number" step="0.01" class="form-control" id="discountPercentage" name="discountPercentage" placeholder="Discount Percentage" value="<?php echo $row['discount_percentage'];?>" required>
                                                    </div>
                                                    <div class="mb-3 input-group">
                                                        <!-- <label for="discountDescription" class="form-label">Discount Description</label> -->
                                                        <span class="input-group-text"><i class="bi bi-textarea-resize"></i></span>
                                                        <textarea class="form-control" id="discountDescription" name="discountDescription" rows="3" placeholder="Discount Description" required><?php echo $row['description'];?></textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="discountStartDate" class="form-label">Discount Start Date</label>
                                                        <input type="date" class="form-control" id="discountStartDate" name="discountStartDate" placeholder="Discount Start Date" value="<?php echo $row['valid_from'];?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="discountEndDate" class="form-label">Discount End Date</label>
                                                        <input type="date" class="form-control" id="discountEndDate" name="discountEndDate" placeholder="Discount End Date" value="<?php echo $row['valid_until'];?>" required>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <input type="submit" class="btn btn-primary" name="SubmitUpdate" value="Update Discount">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- Delete Discount Modal -->
                                <div class="modal fade" id="deleteDiscountModal<?php echo $row['discount_id']; ?>" tabindex="-1" aria-labelledby="deleteDiscountModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <form action="Backend/ManageDiscountsBack.php" method="POST">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteDiscountModalLabel"> <i class="fas fa-trash"></i> Delete Discount</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" name="discount_id" value="<?php echo htmlspecialchars($row['discount_id']); ?>">
                                                    Are you sure you want to delete this discount?
                                                <strong><?php echo htmlspecialchars($row['code']) . ' ' . htmlspecialchars($row['discount_percentage']); ?></strong>?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-danger" name="SubmitDelete"><i class="bi bi-trash me-1"></i>Delete</button>
                                            </div>
                                        </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Change Status Modal -->
                                <div class="modal fade" id="changeStatusModal<?php echo $row['discount_id']; ?>" tabindex="-1" aria-labelledby="changeStatusModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <form action="Backend/ManageDiscountsBack.php" method="POST">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="changeStatusModalLabel"> <i class="bi bi-arrow-clockwise me-2"></i>Change Status</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" name="discount_id" value="<?php echo htmlspecialchars($row['discount_id']); ?>">
                                                <div class="mb-3">
                                                    <p>Are you sure you want to change the status of this discount?</p>
                                                    <label for="status" class="form-label mb-3">
                                                        <i class="bi bi-info-circle me-2"></i>Status
                                                    </label>
                                                    <select class="form-select" id="status" name="status" required>
                                                        <option value="" disabled selected>Select Status</option>
                                                        <option value="1" <?php if ($row['Status'] == 1) echo 'selected'; ?>>Active</option>
                                                        <option value="0" <?php if ($row['Status'] == 0) echo 'selected'; ?>>Inactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary" name="SubmitStatus"> <i class="bi bi-arrow-right-circle me-1"></i>Change Status </button>
                                            </div>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                        <?php
                        }
                        } else {
                            echo '<tr><td colspan="10" class="text-center">No discounts found.</td></tr>';
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

        // Simple search function
        $(document).ready(function() {
            $("#searchInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("table tbody tr").filter(function() {
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