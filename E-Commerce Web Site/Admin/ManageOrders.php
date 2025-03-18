<?php
include 'header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders</title>
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
         <h1 class="header-title text-center mb-5">Manage Orders</h1>

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
                                <li><a class="dropdown-item" href="ManageOrders.php?Fillter=all">All</a></li>
                                <li><a class="dropdown-item" href="ManageOrders.php?Fillter=pending">Pending</a></li>
                                <li><a class="dropdown-item" href="ManageOrders.php?Fillter=shipped">Shipped</a></li>
                                <li><a class="dropdown-item" href="ManageOrders.php?Fillter=delivered">Delivered</a></li>
                                <li><a class="dropdown-item" href="ManageOrders.php?Fillter=cancelled">Cancelled</a></li>
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

        <!-- Order Table -->
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Order ID</th>
                                <th scope="col">Customer</th>
                                <th scope="col">Product</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total Price</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(isset($_REQUEST['Fillter'])){
                                    if($_REQUEST['Fillter'] == "pending"){
                                        $query = "SELECT * FROM orders where status = 'pending'";
                                            $result = mysqli_query($conn, $query);
                                    }
                                    if($_REQUEST['Fillter'] == "shipped"){
                                        $query = "SELECT * FROM orders where status = 'shipped'";
                                            $result = mysqli_query($conn, $query);
                                    }
                                    if($_REQUEST['Fillter'] == "delivered"){
                                        $query = "SELECT * FROM orders where status = 'delivered'";
                                            $result = mysqli_query($conn, $query);
                                    }
                                    if($_REQUEST['Fillter'] == "cancelled"){
                                        $query = "SELECT * FROM orders where status = 'cancelled'";
                                            $result = mysqli_query($conn, $query);
                                    }
                                    if($_REQUEST['Fillter'] == "all"){
                                        $query = "SELECT * FROM orders";
                                            $result = mysqli_query($conn, $query);
                                    }
                                }
                                else{
                                    $query = "SELECT * FROM orders";
                                    $result = mysqli_query($conn, $query);
                                }

                                if (!$result) {
                                    die('Query Failed: ' . mysqli_error($conn)); // Error handling
                                }
    
                                $rowCount = mysqli_num_rows($result);
                                if ($rowCount > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <tr>
                                        <td><?php echo $row['order_id']; ?></td>
                                        <td><?php echo $row['customer_id']; ?></td>
                                        <td><?php echo $row['product_id']; ?></td>
                                        <th><?php echo $row['quntity']; ?></th>
                                        <td><?php echo $row['total_price']; ?></td>
                                        <td>
                                        <?php
                                            if ($row['status'] == "pending") {
                                                echo '<span class="badge bg-warning text-dark"><i class="bi bi-check-circle me-1"></i>pending</span>';
                                            }
                                            if ($row['status'] == "shipped") {
                                                echo '<span class="badge bg-primary"><i class="bi bi-check-circle me-1"></i>shipped</span>';
                                            }
                                            if ($row['status'] == "delivered") {
                                                echo '<span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>delivered</span>';
                                            }
                                            if ($row['status'] == "cancelled") {
                                                echo '<span class="badge bg-danger"><i class="bi bi-x-circle me-1"></i>cancelled</span>';
                                            }
                                        ?>
                                        </td>
                                        <td> 
                                            <!-- view Button -->
                                            <button type="button" class="btn btn-sm btn-info me-1" data-bs-toggle="modal" data-bs-target="#viewOrderModal<?php echo $row['order_id']; ?>">
                                                <i class="bi bi-pencil-square"></i> View/Edit
                                            </button>
                                        </th>
                                    </tr>

                                    <!-- View Order Modal -->
                                    <div class="modal fade" id="viewOrderModal<?php echo $row['order_id']; ?>" tabindex="-1" aria-labelledby="viewOrderModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="viewOrderModalLabel">Order Details</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="Order ID" class="form-label">Order ID:</label>
                                                        <input type="text" class="form-control" id="Order_id" name="Order_id" value="<?php echo htmlspecialchars($row['order_id']); ?>" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="customer_id" class="form-label">Customer ID:</label>
                                                        <input type="text" class="form-control" id="customer_id" name="customer_id" value="<?php echo htmlspecialchars($row['customer_id']);?>" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="product_id" class="form-label">Product ID:</label>
                                                        <input type="text" class="form-control" id="product_id" name="product_id" value="<?php echo htmlspecialchars($row['product_id']);?>" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="quntity" class="form-label">Quantity:</label>
                                                        <input type="text" class="form-control" id="quntity" name="quntity" value="<?php echo htmlspecialchars($row['quntity']);?>" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="total_price" class="form-label">Total Price:</label>
                                                        <input type="text" class="form-control" id="total_price" name="total_price" value="<?php echo htmlspecialchars($row['total_price']);?>" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="address" class="form-label">Address:</label>
                                                       <input type="text" class="form-control" id="address" name="address" value="<?php echo htmlspecialchars($row['shipping_address']);?>" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="status" class="form-label">Status:</label>
                                                        <?php
                                                            if ($row['status'] == "pending") {
                                                                echo '<span class="badge bg-warning text-dark"><i class="bi bi-check-circle me-1"></i>pending</span>';
                                                            }
                                                            if ($row['status'] == "shipped") {
                                                                echo '<span class="badge bg-primary"><i class="bi bi-check-circle me-1"></i>shipped</span>';
                                                            }
                                                            if ($row['status'] == "delivered") {
                                                                echo '<span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>delivered</span>';
                                                            }
                                                            if ($row['status'] == "cancelled") {
                                                                echo '<span class="badge bg-danger"><i class="bi bi-x-circle me-1"></i>cancelled</span>';
                                                            }
                                                        ?>
                                                    </div>
                                                    <div class="mb-3">
                                                        <lable for="Payment Method" class="form-label">Payment Method:</lable>
                                                        <?php
                                                        if ($row['payment_method'] == "bank_transfer") {
                                                            echo '<span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>Bank Transfer</span>';
                                                        }
                                                        if($row['payment_method'] == "credit_card"){
                                                            echo '<span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>Creadit Card</span>';
                                                        }
                                                        if($row['payment_method'] == "paypal"){
                                                            echo '<span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>Paypal</span>';
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="mb-3">
                                                        <lable for="Order Date" class="form-label">Order Date:</lable>  
                                                        <input type="text" class="form-control" id="order_date" name="order_date" value="<?php echo htmlspecialchars($row['created_at']);?>" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <lable for="Updated Date" class="form-label">Updated Date:</lable>  
                                                        <input type="text" class="form-control" id="updated_date" name="updated_date" value="<?php echo htmlspecialchars($row['updated_at']);?>" readonly>
                                                    </div>
                                                    
                                                </div>
                                                <div class="modal-footer">  
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--Delete Modal  -->
                                
                            <?php
                                    }
                                } else {
                                    echo '<tr><td colspan="10" class="text-center">No orders found.</td></tr>';
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