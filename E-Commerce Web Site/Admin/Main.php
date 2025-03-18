<?php
include 'header.php';
$Position = $_SESSION["Position"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Include Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Include Custom CSS -->
    <link rel="stylesheet" href="css/main.css">
    <!-- Include Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>

<body>

    <div class="custom-container">
        <h1 class="text-center custom-heading"><i class="fas fa-tachometer-alt"></i> Welcome to the Admin Dashboard</h1>
        <p class="text-center mb-4">Manage your site settings and user accounts easily.</p>
        
        <!-- Notification Section -->
        <?php
        if (isset($_GET['Loginsuccess'])) {
            if ($_GET['Loginsuccess'] == 'success') {
                echo '<div class="alert alert-success animate__animated animate__fadeInDown animate__faster custom-alert"><i class="fas fa-check-circle"></i> Welcome ' . $row['first_name'] . '</div>';
            }
        }
        ?>

        <?php if ($Position == 'MainAdmin') {
                // Display Cards 
            echo "
                <div class='row mt-4'>

                    <div class='col-md-4 mb-3'>
                        <div class='card custom-card'>
                            <div class='card-body'>
                                <h5 class='card-title'><i class='fas fa-box-open'></i> Manage Products</h5>
                                <p class='card-text'>Handle products (Add, edit, delete) and view statistics.</p>
                                <a href='ManageProduct.php' class='btn custom-btn'><i class='fas fa-box'></i> Go to Products</a>
                            </div>
                        </div>
                    </div> 

                    <div class='col-md-4 mb-3'>
                        <div class='card custom-card'>
                            <div class='card-body'>
                                <h5 class='card-title'><i class='fas fa-users'></i> Manage Customers</h5>
                                <p class='card-text'>Manage customer accounts (Add, edit, delete) and review statistics.</p>
                                <a href='ManageCustomers.php' class='btn custom-btn'><i class='fas fa-user-friends'></i> Go to Customers</a>
                            </div>
                        </div>
                    </div>

                    <div class='col-md-4 mb-3'>
                        <div class='card custom-card'>
                            <div class='card-body'>
                                <h5 class='card-title'><i class='fas fa-store'></i> Manage Sellers</h5>
                                <p class='card-text'>Manage sellers (Add, edit, delete) and access statistics.</p>
                                <a href='ManageSeller.php' class='btn custom-btn'><i class='fas fa-store'></i> Go to Sellers</a>
                            </div>
                        </div>
                    </div>

                </div>

                <div class='row mt-3'>

                    <div class='col-md-4 mb-3'>
                        <div class='card custom-card'>
                            <div class='card-body'>
                                <h5 class='card-title'><i class='fas fa-store'></i> Manage Orders</h5>
                                <p class='card-text'>Handle orders (Add, edit, delete) and track progress.</p>
                                <a href='ManageOrders.php' class='btn custom-btn'><i class='fas fa-clipboard-list'></i> Go to Orders</a>
                            </div>
                        </div>
                    </div>

                    <div class='col-md-4 mb-3'>
                        <div class='card custom-card'>
                            <div class='card-body'>
                                <h5 class='card-title'><i class='fas fa-comments'></i> Manage Reviews</h5>
                                <p class='card-text'>Oversee reviews (Add, edit, delete) and view feedback.</p>
                                <a href='ManageReviews.php' class='btn custom-btn'><i class='fas fa-comments'></i> Go to Reviews</a>
                            </div>
                        </div>
                    </div>

                    <div class='col-md-4 mb-3'>
                        <div class='card custom-card'>
                            <div class='card-body'>
                                <h5 class='card-title'><i class='fas fa-tags'></i> Manage Discounts</h5>
                                <p class='card-text'>Handle Discounts (Add, edit, delete) and view statistics </p>
                                <a href='ManageDiscounts.php' class='btn custom-btn'><i class='fas fa-tags'></i> Go to Discounts</a>
                            </div>
                        </div>
                    </div>



                </div>

                <div class='row mt-3'>

                    <div class='col-md-4 mb-3'>
                        <div class='card custom-card'>
                            <div class='card-body'>
                                <h5 class='card-title'><i class='fas fa-envelope'></i> News Alletter</h5>
                                <p class='card-text'>Subcribe to our newsletter for exclusive details and offers.</p>
                                <a href='ManageNewsletter.php' class='btn custom-btn'><i class='fas fa-envelope'></i> Subscribe to News Alletter</a>
                            </div>
                        </div>
                    </div>

                    <div class='col-md-4 mb-3'>
                        <div class='card custom-card'>
                            <div class='card-body'>
                             <h5 class='card-title'><i class='fas fa-chart-line'></i> Analytics & Reports</h5>
                                <p class='card-text'>View analytics and generate detailed reports to visualize.</p>
                                <a href='Analytics&Reports.php' class='btn custom-btn'><i class='fas fa-chart-pie'></i> Go to Analytics & Reports</a>
                            </div>
                        </div>
                    </div>  
                    

                    <div class='col-md-4 mb-3'>
                        <div class='card custom-card'>
                            <div class='card-body'>
                                <h5 class='card-title'><i class='fas fa-user-cog'></i> Settings</h5>
                                <p class='card-text'>Update Administrator account details and change password.</p>
                                <a href='AdminProfile.php' class='btn custom-btn'><i class='fas fa-user-edit'></i> Edit Administrator account</a>
                            </div>
                        </div>
                    </div>

                </div>
            
            ";
        }else{
            echo "
                <div class='row mt-4'>

                    <div class='col-md-4 mb-3'>
                        <div class='card custom-card'>
                            <div class='card-body'>
                                <h5 class='card-title'><i class='fas fa-box-open'></i> Manage Products</h5>
                                <p class='card-text'>Handle products (Add, edit, delete) and view statistics.</p>
                                <a href='ManageProduct.php' class='btn custom-btn'><i class='fas fa-box'></i> Go to Products</a>
                            </div>
                        </div>
                    </div> 

                    <div class='col-md-4 mb-3'>
                        <div class='card custom-card'>
                            <div class='card-body'>
                                <h5 class='card-title'><i class='fas fa-users'></i> Manage Customers</h5>
                                <p class='card-text'>Manage customer accounts (Add, edit, delete) and review statistics.</p>
                                <a href='ManageCustomers.php' class='btn custom-btn'><i class='fas fa-user-friends'></i> Go to Customers</a>
                            </div>
                        </div>
                    </div>

                    <div class='col-md-4 mb-3'>
                        <div class='card custom-card'>
                            <div class='card-body'>
                                <h5 class='card-title'><i class='fas fa-store'></i> Manage Sellers</h5>
                                <p class='card-text'>Manage sellers (Add, edit, delete) and access statistics.</p>
                                <a href='ManageSeller.php' class='btn custom-btn'><i class='fas fa-store'></i> Go to Sellers</a>
                            </div>
                        </div>
                    </div>

                </div>

                <div class='row mt-3'>

                    <div class='col-md-4 mb-3'>
                        <div class='card custom-card'>
                            <div class='card-body'>
                                <h5 class='card-title'><i class='fas fa-store'></i> Manage Orders</h5>
                                <p class='card-text'>Handle orders (Add, edit, delete) and track progress.</p>
                                <a href='ManageOrders.php' class='btn custom-btn'><i class='fas fa-clipboard-list'></i> Go to Orders</a>
                            </div>
                        </div>
                    </div>

                    <div class='col-md-4 mb-3'>
                        <div class='card custom-card'>
                            <div class='card-body'>
                                <h5 class='card-title'><i class='fas fa-comments'></i> Manage Reviews</h5>
                                <p class='card-text'>Oversee reviews (Add, edit, delete) and view feedback.</p>
                                <a href='ManageReviews.php' class='btn custom-btn'><i class='fas fa-comments'></i> Go to Reviews</a>
                            </div>
                        </div>
                    </div>

                    <div class='col-md-4 mb-3'>
                        <div class='card custom-card'>
                            <div class='card-body'>
                                <h5 class='card-title'><i class='fas fa-tags'></i> Manage Discounts</h5>
                                <p class='card-text'>Handle Discounts (Add, edit, delete) and view statistics </p>
                                <a href='ManageDiscounts.php' class='btn custom-btn'><i class='fas fa-tags'></i> Go to Discounts</a>
                            </div>
                        </div>
                    </div> 

                </div>

                <div class='row mt-3'>

                    <div class='col-md-4 mb-3'>
                        <div class='card custom-card'>
                            <div class='card-body'>
                                <h5 class='card-title'><i class='fas fa-envelope'></i> News Alletter</h5>
                                <p class='card-text'>Subcribe to our newsletter for exclusive details and offers.</p>
                                <a href='ManageNewsletter.php' class='btn custom-btn'><i class='fas fa-envelope'></i> Subscribe to Newsletter</a>
                            </div>
                        </div>
                    </div>

                    <div class='col-md-4 mb-3'>
                        <div class='card custom-card'>
                            <div class='card-body'>
                             <h5 class='card-title'><i class='fas fa-chart-line'></i> Analytics & Reports</h5>
                                <p class='card-text'>View analytics and generate detailed reports to visualize.</p>
                                <a href='Analytics&Reports.php' class='btn custom-btn'><i class='fas fa-chart-pie'></i> Go to Analytics & Reports</a>
                            </div>
                        </div>
                    </div>  

                </div>
            ";
        }
        
        ?>
    


        

    </div>

    <!-- Include Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $('.alert').fadeOut('slow');
            }, 5000); // 5 seconds before fading out
        });
    </script>

</body>

</html>
