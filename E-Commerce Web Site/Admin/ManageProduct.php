<?php
include 'header.php'; // Ensure this file includes the necessary database connection and header content
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>

    <!-- Include Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

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
        <h1 class="header-title text-center mb-5">Manage Products</h1>


        <!-- Add New Product Button -->
        <div class="row mb-4">
            <div class="col-12 text-center">
                <button type="button" class="btn btn-primary btn-lg shadow-lg rounded-pill px-5 py-3" 
                        data-bs-toggle="modal" data-bs-target="#addProductModal" 
                        style="background-color: #0d6efd; border-color: #0a58ca;">
                    <i class="bi bi-plus-circle me-2"></i> Add New Product
                </button>
            </div>
        </div>

        <!-- Add Product Modal -->
        <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg"> <!-- Larger modal for better spacing -->
                <div class="modal-content rounded-4 shadow-lg">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="addProductModalLabel">
                            <i class="bi bi-plus-circle me-2"></i>Add New Product
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <form action="Backend/ManageProductBack.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                            <!-- Seller ID -->
                            <div class="mb-4">
                                <label for="seller_id" class="form-label">
                                    <i class="bi bi-person-bounding-box me-2"></i>Seller ID
                                </label>
                                <input type="text" class="form-control rounded-pill" id="seller_id" name="seller_id" placeholder="Enter Seller ID" required>
                            </div>

                            <!-- Product Name -->
                            <div class="mb-4">
                                <label for="product_name" class="form-label">
                                    <i class="bi bi-box-fill me-2"></i>Product Name
                                </label>
                                <input type="text" class="form-control rounded-pill" id="product_name" name="product_name" placeholder="Enter Product Name" required>
                            </div>

                            <!-- Product Description -->
                            <div class="mb-4">
                                <label for="product_description" class="form-label">
                                    <i class="bi bi-file-earmark-text me-2"></i>Product Description
                                </label>
                                <textarea class="form-control rounded-3" id="product_description" name="product_description" rows="4" 
                                        placeholder="Enter Product Description" required></textarea>
                            </div>

                            <!-- Price and Quantity -->
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="product_price" class="form-label">
                                        <i class="bi bi-currency-dollar me-2"></i>Product Price
                                    </label>
                                    <input type="number" step="0.01" class="form-control rounded-pill" id="product_price" name="product_price" placeholder="Enter Price" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="product_quantity" class="form-label">
                                        <i class="bi bi-box-seam me-2"></i>Product Quantity
                                    </label>
                                    <input type="number" class="form-control rounded-pill" id="product_quantity" name="product_quantity" placeholder="Enter Quantity" required>
                                </div>
                            </div>

                            <!-- Product Category -->
                            <div class="mb-4">
                                <label for="product_category" class="form-label">
                                    <i class="bi bi-tags-fill me-2"></i>Product Category
                                </label>
                                <select class="form-select rounded-pill" id="product_category" name="product_category" required>
                                    <option value="" disabled selected>Select Category</option>
                                    <option value="men">Men</option>
                                    <option value="women">Women</option>
                                    <option value="accessaries">Accessaries</option>
                                </select>
                            </div>

                            <!-- Images Upload -->
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="product_image" class="form-label">
                                        <i class="bi bi-image me-2"></i>Product Image
                                    </label>
                                    <input type="file" class="form-control rounded-pill" id="product_image" name="product_image" accept="image/*" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="product_image2" class="form-label">
                                        <i class="bi bi-film me-2"></i>Product Image 2
                                    </label>
                                    <input type="file" class="form-control rounded-pill" id="product_image2" name="product_image2" accept="image/*">
                                </div>
                            </div>

                            <!-- Modal Footer -->
                            <div class="modal-footer mt-4">
                                <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary rounded-pill px-4" name="Submit">Add Product</button>
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
                                <li><a class="dropdown-item" href="ManageProduct.php?Fillter=All">All</a></li>
                                <li><a class="dropdown-item" href="ManageProduct.php?Fillter=Active">Active</a></li>
                                <li><a class="dropdown-item" href="ManageProduct.php?Fillter=Inactive">Inactive</a></li>
                            </ul>
                    </div>
                </div>
            </div>
        </div>


        <!-- animation success -->
        <?php
        if (isset($_GET['statusInsert'])) {
            if ($_GET['statusInsert'] == 'insert') {
                echo '<div class="alert alert-success animate__animated animate__fadeInDown animate__faster"><i class="bi bi-check-circle me-2"></i>
                Product Add successfully!</div>';
            }
        }
        if (isset($_GET['statusdelete'])) {
            if ($_GET['statusdelete'] == 'deleted') {
                echo '<div class="alert alert-success animate__animated animate__fadeInDown animate__faster"><i class="bi bi-check-circle me-2"></i>
                Product deleted successfully!</div>';
            }
        }

        if (isset($_GET['statusUpdate'])) {
            if ($_GET['statusUpdate'] == 'updated') {
                echo '<div class="alert alert-success animate__animated animate__fadeInDown animate__faster"><i class="bi bi-check-circle me-2"></i>
                Product Update successfully!</div>';
            }
            if ($_GET['statusUpdate'] == 'status') {
                echo '<div class="alert alert-success animate__animated animate__fadeInDown animate__faster">
                <i class="bi bi-check-circle me-2"></i>Product access updated successfully!!
              </div>';
            }
        }

        ?>

        <!-- Products Table -->
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Seller ID</th>
                                <th scope="col">Product ID</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Product Price</th>
                                <th scope="col">Product Quantity</th>
                                <th scope="col">Product Category</th>
                                <th scope="col">Product Image</th>
                                <!-- <th scope="col">Product Video</th> -->
                                <th scope="col">Status</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                             if(isset($_REQUEST['Fillter'])){
                                if($_REQUEST['Fillter'] == 'Active'){
                                    $query = "SELECT * FROM products WHERE Status ='1'";
                                     $result = mysqli_query($conn, $query);
                                }
                                if($_REQUEST['Fillter'] == 'Inactive'){
                                    $query = "SELECT * FROM products WHERE Status = '0'";
                                    $result = mysqli_query($conn, $query);
                                }
                                if($_REQUEST['Fillter'] == 'All'){
                                    $query = "SELECT * FROM products";
                                     $result = mysqli_query($conn, $query);
                                }
                            } else {
                                $query = "SELECT * FROM products";
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
                                        <td><?php echo htmlspecialchars($row['product_id']); ?></td>
                                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                                        <td><?php echo htmlspecialchars($row['price']); ?></td>
                                        <td><?php echo htmlspecialchars($row['stock']); ?></td>
                                        <td><?php echo htmlspecialchars($row['category']); ?></td>
                                        <?php
                                            if (empty($row['image_url'])) {
                                                echo '<th>No Image</th>';
                                            } else {
                                                echo '<td><img src="../Product Image/' . htmlspecialchars($row['image_url']) . '" alt="Product Image"></td>';
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
                                            <button type="button" class="btn btn-sm btn-info me-1" data-bs-toggle="modal" data-bs-target="#editProductModal<?php echo $row['product_id']; ?>">
                                                <i class="bi bi-pencil-square"></i> View/Edit
                                            </button>
                                            <!-- Delete Button -->
                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteProductModal<?php echo htmlspecialchars($row['product_id']); ?>">
                                                <i class="bi bi-trash"></i>Delete
                                            </button>
                                           
                                            <!-- Status Button -->
                                            <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#changeStatusModal<?php echo $row['product_id']; ?>" Style="margin-top: 5px;">
                                                <i class="bi bi-arrow-clockwise"></i> Change Status
                                            </button>
                                        </td>
                                    </tr>

                                <!-- Edit Product Modal -->
                                <div class="modal fade" id="editProductModal<?php echo htmlspecialchars($row['product_id']); ?>" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content rounded-4 shadow-lg">
                                            <div class="modal-header bg-primary text-white">
                                                <h5 class="modal-title" id="editProductModalLabel">
                                                    <i class="bi bi-pencil-fill me-2"></i>Edit Product
                                                </h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body p-4">
                                                <form action="Backend/ManageProductBack.php" method="post" enctype="multipart/form-data">
                                                    <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($row['product_id']); ?>">

                                                    <!-- Product Name -->
                                                    <div class="mb-3">
                                                        <label for="edit_product_name" class="form-label">
                                                            <i class="bi bi-box-fill me-2"></i>Product Name
                                                        </label>
                                                        <input type="text" class="form-control rounded-pill" id="edit_product_name" name="product_name" value="<?php echo htmlspecialchars($row['name']); ?>" required>
                                                    </div>

                                                    <!-- Product Description -->
                                                    <div class="mb-3">
                                                        <label for="edit_product_description" class="form-label">
                                                            <i class="bi bi-file-earmark-text me-2"></i>Product Description
                                                        </label>
                                                        <textarea class="form-control rounded-3" id="edit_product_description" name="product_description" rows="3" required><?php echo htmlspecialchars($row['description']); ?></textarea>
                                                    </div>

                                                    <!-- Price and Quantity -->
                                                    <div class="row g-3">
                                                        <div class="col-md-6">
                                                            <label for="edit_product_price" class="form-label">
                                                                <i class="bi bi-currency-dollar me-2"></i>Product Price
                                                            </label>
                                                            <input type="number" step="0.01" class="form-control rounded-pill" id="edit_product_price" name="product_price" value="<?php echo htmlspecialchars($row['price']); ?>" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="edit_product_quantity" class="form-label">
                                                                <i class="bi bi-box-seam me-2"></i>Product Quantity
                                                            </label>
                                                            <input type="number" class="form-control rounded-pill" id="edit_product_quantity" name="product_quantity" value="<?php echo htmlspecialchars($row['stock']); ?>" required>
                                                        </div>
                                                    </div>

                                                    <!-- Category -->
                                                    <div class="mb-4">
                                                        <label for="product_category" class="form-label">
                                                            <i class="bi bi-tags-fill me-2"></i>Product Category
                                                        </label>
                                                        <select class="form-select rounded-pill" id="product_category" name="product_category" required>
                                                            <option value="" disabled selected>Select Category</option>
                                                            <option value="men">Men</option>
                                                            <option value="women">Women</option>
                                                            <option value="accessaries">Accessaries</option>
                                                        </select>
                                                    </div>

                                                    <!-- Images upload -->
                                                    <div class="row g-3">
                                                        <div class="col-md-6">
                                                            <label for="edit_product_image" class="form-label">
                                                                <i class="bi bi-image me-2"></i>Product Image
                                                            </label>
                                                            <input type="file" class="form-control rounded-pill" id="edit_product_image" name="product_image" accept="image/*">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="edit_product_Image2" class="form-label">
                                                                <i class="bi bi-film me-2"></i>Product Image 2
                                                            </label>
                                                            <input type="file" class="form-control rounded-pill" id="edit_product_Image2" name="product_image2" accept="image/*">
                                                        </div>
                                                    </div>

                                                    <!-- Footer Buttons -->
                                                    <div class="modal-footer mt-4">
                                                        <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary rounded-pill px-4" name="Update">Update Product</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Delete Product Modal -->
                                <div class="modal fade" id="deleteProductModal<?php echo htmlspecialchars($row['product_id']); ?>" tabindex="-1" aria-labelledby="deleteProductModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content rounded-4 shadow-lg">
                                            <div class="modal-header bg-danger text-white">
                                                <h5 class="modal-title" id="deleteProductModalLabel">
                                                    <i class="bi bi-trash-fill me-2"></i>Delete Product
                                                </h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-center p-4">
                                                <p>Are you sure you want to delete the product:</p>
                                                <h6 class="text-danger fw-bold"><?php echo htmlspecialchars($row['name']); ?></h6>
                                            </div>
                                            <div class="modal-footer justify-content-center">
                                                <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                                                <form action="Backend/ManageProductBack.php" method="post" class="d-inline">
                                                    <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($row['product_id']); ?>">
                                                    <button type="submit" class="btn btn-danger rounded-pill px-4" name="SubmitDelete">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Change Status Modal -->
                                <div class="modal fade" id="changeStatusModal<?php echo htmlspecialchars($row['product_id']); ?>" tabindex="-1" aria-labelledby="changeStatusModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content rounded-4 shadow-lg">
                                            <div class="modal-header bg-warning text-dark">
                                                <h5 class="modal-title" id="changeStatusModalLabel">
                                                    <i class="bi bi-arrow-clockwise me-2"></i>Change Product Status
                                                </h5>
                                                <button type="button" class="btn-close btn-close-dark" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="Backend/ManageProductBack.php" method="POST">
                                                    <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($row['product_id']); ?>">
                                                    <div class="mb-3">
                                                        <label for="status" class="form-label">
                                                            <i class="bi bi-info-circle me-2"></i>Status
                                                        </label>
                                                        <select class="form-select rounded-pill" id="status" name="status" required>
                                                            <option value="" disabled selected>Select Status</option>
                                                            <option value="1" <?php if ($row['Status'] == 1) echo 'selected'; ?>>Active</option>
                                                            <option value="0" <?php if ($row['Status'] == 0) echo 'selected'; ?>>Inactive</option>
                                                        </select>
                                                    </div>
                                                    <div class="modal-footer mt-4">
                                                        <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary rounded-pill px-4" name="SubmitStatus">Change Status</button>
                                                    </div>
                                                </form>
                                            </div>
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