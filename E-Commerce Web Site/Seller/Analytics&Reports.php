<?php 
    include 'header.php';
    include 'Backend/Analyticsback.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analytics & Reports</title>

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
        
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/pagestyle.css">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
        }

        .custom-container {
            max-width: 98%;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.15);
        }

        .header-title {
            font-size: 2.8rem;
            font-weight: bold;
            color: #495057;
            margin-bottom: 10px;
        }

        .header-subtitle {
            font-size: 1rem;
            color: #6c757d;
        }

        .card {
            margin: 10px;
            flex: 1;
            min-width: 250px;
            border: none;
            border-radius: 10px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .card-body {
            text-align: center;
        }

        .highlight {
            background-color: #f0f9ff; /* Light Blue */
            padding: 5px 10px;
            border-radius: 8px;
            font-weight: bold;
            color: #0d6efd; /* Dark Blue */
            font-size: 1.2rem;
        }

        .highlightActive {
            background-color: #e9f7f0; /* Light Green */
            padding: 5px 10px;
            border-radius: 8px;
            font-weight: bold;
            color: #198754; /* Dark Green */
            font-size: 1.2rem;
        }

        .highlightOnline {
            background-color: #eef8e6; /* Light Olive */
            padding: 5px 10px;
            border-radius: 8px;
            font-weight: bold;
            color: #557a3b; /* Olive Green */
            font-size: 1.2rem;
        }

        .highlightPending {
            background-color: #fff8e6; /* Light Yellow */
            padding: 5px 10px;
            border-radius: 8px;
            font-weight: bold;
            color: #ffbf00; /* Golden Yellow */
            font-size: 1.2rem;
        }

        .highlightShipped {
            background-color: #e8f4fd; /* Light Blue */
            padding: 5px 10px;
            border-radius: 8px;
            font-weight: bold;
            color:rgb(13, 157, 253); /* Dark Blue */
            font-size: 1.2rem;
        }


        .highlightCancelled {
            background-color: #fdecec; /* Light Red */
            padding: 5px 10px;
            border-radius: 8px;
            font-weight: bold;
            color: #dc3545; /* Dark Red */
            font-size: 1.2rem;
        }


        .card-title {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 10px;
            color: #343a40;
        }

        .card-text {
            font-size: 1rem;
            color: #6c757d;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .back {
            display: inline-flex;
            align-items: center;
            margin-bottom: 20px;
            color: #ffffff;
        }

        .back:hover {
            text-decoration: none;
            background-color: #0056b3;
        }

        @media (max-width: 768px) {
            .header-title {
                font-size: 2rem;
            }
        }
    </style>
</head>

<body>
    <!-- Back Button with Icon -->
    <a href="main.php" class="btn btn-primary back" style="margin: 20px;">
        <i class="bi bi-arrow-left me-2"></i> Back to Dashboard
    </a>

    <!-- Header -->
    <div class="text-center mb-4">
        <h1 class="header-title">Analytics & Reports</h1>
        <p class="header-subtitle">Track and monitor key performance metrics effortlessly.</p>
    </div>

    <!-- Analytics Cards -->
    <div class="custom-container">
        <div class="grid">
            <!-- Product Count Card -->
            <div class="card bg-light">
                <div class="card-body">
                    <i class="bi bi-box-seam display-4 text-primary mb-3"></i>
                    <h5 class="card-title">Product Count</h5>
                    <p class="card-text">Total Products: <span class="highlight"> <?php echo $productCount; ?></p>
                    <p class="card-text">Active Products: <span class="highlightActive"><?php echo $activeProductCount; ?></span></p>
                </div>
            </div>

            <!-- Order Count Card -->
            <div class="card bg-light">
                <div class="card-body">
                    <i class="bi bi-receipt-cutoff display-4 text-info mb-3"></i>
                    <h5 class="card-title">Order Count</h5>
                    <p class="card-text">Total Orders: <span class="highlight"><?php echo $orderCount; ?></span></p>
                    <p class="card-text">Pending Orders: <span class="highlightPending"><?php echo $pendingOrderCount; ?></span></p>
                    <p class="card-text">Shipped Orders: <span class="highlightShipped"><?php echo $shippedOrderCount; ?></span></p>
                    <p class="card-text">Delivered Orders: <span class="highlightActive"><?php echo $deliveredOrderCount; ?></span></p>
                    <p class="card-text">Cancelled Orders: <span class="highlightCancelled"><?php echo $cancelledOrderCount; ?></span></p>
                </div>
            </div>

            <!-- Reviews Count Card -->
            <div class="card bg-light">
                <div class="card-body">
                    <i class="bi bi-star-fill display-4 text-warning mb-3"></i>
                    <h5 class="card-title">Reviews</h5>
                    <p class="card-text">Total Reviews: <span class="highlight"><?php echo $reviewCount; ?></span></p>
                    <!-- <p class="card-text">Active Reviews: <span class="highlightActive"><?php echo $activeReviewCount; ?></span></p> -->
                </div>
            </div>

            <!-- Discount Count Card -->
            <div class="card bg-light">
                <div class="card-body">
                    <i class="bi bi-percent display-4 text-purple mb-3"></i>
                    <h5 class="card-title">Discounts</h5>
                    <p class="card-text">Total Discounts: <span class="highlight"><?php echo $discountCount; ?></span></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
