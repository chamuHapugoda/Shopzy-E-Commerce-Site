<div class="dotgrid">
    <?php
    include('connection.php');
    // Debugging: Output the 'sort' and 'search' parameters
    if (isset($_GET['sort'])) {
        // echo 'Sorting by: ' . $_GET['sort'] . '<br>';
    }
    if (isset($_GET['search'])) {
        // echo 'Searching for: ' . htmlspecialchars($_GET['search']);
    }
    ?>

    <?php
    // Validate and sanitize the sort option from the query parameter
    $allowed_sort_options = ['popular', 'rating', 'latest', 'low_to_high', 'high_to_low'];
    $sort_option = isset($_GET['sort']) && in_array($_GET['sort'], $allowed_sort_options) ? $_GET['sort'] : 'default';

    // Get the search query from the URL
    $search_query = isset($_GET['search']) ? trim($_GET['search']) : '';

    // Base query
    $query = "SELECT * FROM products WHERE Status = 1";

    // If a search query exists, append it to the WHERE clause
    if (!empty($search_query)) {
        $search_term = $conn->real_escape_string($search_query); // Prevent SQL injection
        $query .= " AND (name LIKE '%$search_term%' OR description LIKE '%$search_term%')";
    }

    // Append ORDER BY clause based on the selected sort option
    switch ($sort_option) {
        case 'latest':
            $query .= " ORDER BY created_at DESC";
            break;
        case 'low_to_high':
            $query .= " ORDER BY price ASC";
            break;
        case 'high_to_low':
            $query .= " ORDER BY price DESC";
            break;
        default:
            $query .= " ORDER BY created_at DESC";
            break;
    }

    // Execute the query
    $result = $conn->query($query);

    // Check if query executed successfully
    if (!$result) {
        die("Error executing query: " . $conn->error);
    }
    ?>

    <?php if ($result->num_rows > 0): ?>
        <div class="wrapper">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="item">
                    <div class="dot-image">
                    <a href="page-single.php?product_id=<?= $row['product_id'] ?>" class="product-permalink"></a>
                        <div class="thumbnail">
                            <img src="Product Image/<?= $row['image_url'] ?>" alt="" style="width: 300px; height: 310px;">
                        </div>
                        <div class="thumbnail hover">
                            <img src="Product Image/<?= $row['image2_url'] ?>" alt="" style="width: 300px; height: 310px;">
                        </div>
                        <div class="actions">
                            <ul>
                                <?php if (isset($_SESSION['customer_id'])): ?>
                                    <li><a href="add_to_favorites.php?product_id=<?= $row['product_id'] ?>">
                                            <i class="ri-heart-line"></i>
                                        </a></li>
                                    <li><a href="add_to_cart.php?product_id=<?= $row['product_id'] ?>">
                                            <i class="ri-shopping-bag-line"></i>
                                        </a></li>
                                <?php else: ?>
                                    <li><a href="customer/customer.php">
                                            <i class="ri-heart-line"></i>
                                        </a></li>
                                    <li><a href="customer/customer.php">
                                            <i class="ri-shopping-bag-line"></i>
                                        </a></li>
                                <?php endif; ?>
                                <li><a href="page-single.php?product_id=<?= $row['product_id'] ?>">
                                        <i class="ri-eye-line"></i>
                                    </a></li>
                            </ul>
                        </div>
                        <div class="lable"><span>25%</span></div>
                    </div>
                    <div class="dot-info">
                        <h2 class="dot-title"><a href="">
                                <?= $row['name'] ?>
                            </a></h2>
                            
                        <div class="product-price">
                            <span class="before">$<?= $row['price'] ?></span>
                            <span class="current">$<?= $row['price'] ?></span>
                            
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p>No products found.</p>
    <?php endif; ?>
</div>