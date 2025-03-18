<?php
include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Dashboard</title>

    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Include Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Include Custom CSS -->
    <link rel="stylesheet" href="css/main.css">
    <!-- Include Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <style>
        
        /* Falling Snow Effect */
        .snowflake {
            color: #fff;
            font-size: 1em;
            position: fixed;
            top: -10px;
            z-index: 5;
            animation: fall linear infinite;
        }

        @keyframes fall {
            0% {
                transform: translateY(0) rotate(0deg);
                opacity: 1;
            }
            100% {
                transform: translateY(100vh) rotate(360deg);
                opacity: 0.5;
            }
        }
    </style>
</head>

<body>

    <!-- Snowflakes -->
    <div id="snowflakes-container"></div>

    <div class="custom-container">
        <h1 class="text-center custom-heading"><i class="fas fa-tachometer-alt"></i> Welcome to the Seller Dashboard</h1>
        <p class="text-center mb-4">Manage your products, orders, and more.</p>

        <!-- Notification Section -->
        <?php
        if (isset($_GET['Loginsuccess'])) {
            if ($_GET['Loginsuccess'] == 'success') {
                echo '<div class="alert alert-success animate__animated animate__fadeInDown animate__faster custom-alert"><i class="fas fa-check-circle"></i> Welcome ' . $row['first_name'] . '</div>';
            }
        }
        ?>

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
        </div>

        <div class='row mt-4'>
            <div class='col-md-4 mb-3'>
                <div class='card custom-card'>
                    <div class='card-body'>
                        <h5 class='card-title'><i class='fas fa-tags'></i> Manage Discounts</h5>
                        <p class='card-text'>Handle Discounts (Add, edit, delete) and view statistics </p>
                        <a href='ManageDiscounts.php' class='btn custom-btn'><i class='fas fa-tags'></i> Go to Discounts</a>
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

        // Generate falling snow
        function createSnowflakes() {
            const snowflakesContainer = document.getElementById('snowflakes-container');
            for (let i = 0; i < 10; i++) {
                const snowflake = document.createElement('div');
                snowflake.classList.add('snowflake');
                snowflake.style.left = `${Math.random() * 100}vw`;
                snowflake.style.animationDuration = `${Math.random() * 3 + 2}s`;
                snowflake.style.fontSize = `${Math.random() * 10 + 10}px`;
                snowflake.textContent = '❄';
                snowflakesContainer.appendChild(snowflake);

                setTimeout(() => {
                    snowflake.remove();
                }, 5000); // Remove snowflakes after animation
            }
        }

        setInterval(createSnowflakes, 1500); // Generate new snowflakes every 0.5s
    </script>
</body>

</html>