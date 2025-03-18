<?php
include 'header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage News Alletter</title>
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
        <h1 class="header-title text-center mb-5">Manage News Alletter</h1>

        <!-- Add New Seller Button -->
        <div class="row mb-3">
            <div class="col-md-12 text-center">
                <button type="button" class="btn btn-primary btn-lg shadow-lg rounded-pill px-5 py-3" 
                data-bs-toggle="modal" data-bs-target="#addNewsletterModal" 
                style="background-color: #0d6efd; border-color: #0a58ca;">
                    <i class="bi bi-plus-circle me-2"></i>Add New News alletter
                </button>
            </div>
        </div>

        <!-- Add Newsletter Modal -->
        <div class="modal fade" id="addNewsletterModal" tabindex="-1" aria-labelledby="addNewsletterModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addNewsletterModalLabel"><i class="bi bi-plus-circle me-2"></i>Add News Alletter</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addNewsletterForm" action="Backend/ManageNewsletterBack.php" method="post" enctype="multipart/form-data" >
                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <input type="submit" class="btn btn-primary" name="SubmitInsert" value="Add Newsletter">
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
                        placeholder="Search Email..." 
                        aria-label="Search Email">
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
                    <i class="bi bi-check-circle me-2"></i>News alletter added successfully!
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
                    <i class="bi bi-check-circle me-2"></i>News alletter updated successfully!
                </div>';
                }
                if ($_GET['statusUpdate'] == 'status') {
                    echo '<div class="alert alert-success animate__animated animate__fadeInDown animate__faster">
                    <i class="bi bi-check-circle me-2"></i>News alletter status updated successfully!
                </div>';
                }
            }
            if (isset($_GET['statusdelete'])) {
                if ($_GET['statusdelete'] == 'deleted') {
                    echo '<div class="alert alert-success animate__animated animate__fadeInDown animate__faster">
                    <i class="bi bi-check-circle me-2"></i>News alletter deleted successfully!
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
                                <th scope="col">id</th>
                                <th scope="col">email</th>
                                <th scope="col">created_at</th>
                                <th scope="col">status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql = "SELECT * FROM newsletters";
                                $result = $conn->query($sql);
                                
                                if (!$result) {
                                    die('Query Failed: ' . mysqli_error($conn)); // Error handling
                                }
    
                                $rowCount = mysqli_num_rows($result);
                                if ($rowCount > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) { ?>>
                                    <tr>
                                        <th><?php echo $row['newsletter_id']; ?></th>
                                        <td><?php echo $row['email']; ?></td>
                                        <td><?php echo $row['subscribed_at']; ?></td>
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
                                            <button type="button" class="btn btn-sm btn-info me-1" data-bs-toggle="modal" data-bs-target="#editNewsModal<?php echo $row['newsletter_id']; ?>">
                                                <i class="bi bi-pencil-square"></i> View/Edit
                                            </button>
                                            <!-- Delete Button -->
                                            <button type="button" class="btn btn-sm btn-danger me-1" data-bs-toggle="modal" data-bs-target="#deleteNewsModal<?php echo $row['newsletter_id']; ?>">
                                                <i class="bi bi-trash"></i> Delete
                                            </button>
                                            <!-- Status Button -->
                                            <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#changeStatusModal<?php echo $row['newsletter_id']; ?>">
                                                <i class="bi bi-arrow-clockwise"></i> Change Status
                                            </button>
                                        </td> 
                                    </tr>  

                                    <!-- Edit News Modal -->
                                    <div class="modal fade" id="editNewsModal<?php echo $row['newsletter_id']; ?>" tabindex="-1" aria-labelledby="editNewsModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editNewsModalLabel">Edit Newsletter</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="Backend/ManageNewsletterBack.php" method="POST">
                                                        <div class="mb-3">
                                                            <input type="hidden" name="newsletter_id" value="<?php echo $row['newsletter_id']; ?>">
                                                            <label for="email" class="form-label">Email</label>
                                                            <input type="email" class="form-control" name="email" id="email" value="<?php echo $row['email']; ?>" required>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <input type="submit" class="btn btn-primary" name="SubmitUpdate" value="Update Newsletter">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Delete News Modal -->  
                                    <div class="modal fade" id="deleteNewsModal<?php echo $row['newsletter_id']; ?>" tabindex="-1" aria-labelledby="deleteNewsModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="Backend/ManageNewsletterBack.php" method="POST">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteNewsModalLabel"> <i class="fas fa-trash"></i> Delete Newsletter</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="hidden" name="newsletter_id" value="<?php echo $row['newsletter_id']; ?>">
                                                        Are you sure you want to delete this newsletter?
                                                        <strong><?php echo $row['email']; ?></strong>?
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
                                    <div class="modal fade" id="changeStatusModal<?php echo $row['newsletter_id']; ?>" tabindex="-1" aria-labelledby="changeStatusModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="Backend/ManageNewsletterBack.php" method="POST">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="changeStatusModalLabel">Change Status</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="hidden" name="newsletter_id" value="<?php echo $row['newsletter_id']; ?>">
                                                            
                                                        <div class="mb-3">
                                                            <p>Are you sure you want to change the status of this news alletter?</p>
                                                            <label for="status" class="form-label mb-3">
                                                                <i class="bi bi-info-circle me-2"></i>Status
                                                            </label>
                                                            <select class="form-select" id="status" name="status" required>
                                                                <option value="" disabled selected>Select Status</option>
                                                                <option value="1" <?php if ($row['Status'] == 1) echo 'selected'; ?>>Active</option>
                                                                <option value="0" <?php if ($row['Status'] == 0) echo 'selected'; ?>>Inactive</option>
                                                            </select>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <input type="submit" class="btn btn-primary" name="SubmitStatus" value="Change Status">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>  
                                    </div>

                            <?php
                            }
                            } else {
                                echo '<tr><td colspan="10" class="text-center">No newsletter found.</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    
</body>
</html>