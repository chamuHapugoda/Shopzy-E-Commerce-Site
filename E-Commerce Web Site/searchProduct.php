<div class="dotgrid">
<div class="wrapper">

<?php
include "connection.php";

$searchInput = mysqli_real_escape_string($conn, $_POST["search"]);

if (empty($searchInput)) {
    echo "<h5>Please enter a search term.</h5>";
    exit;
}

$query = "SELECT * FROM `products` WHERE `name` LIKE '%$searchInput%' AND `status` = 1";
$result = mysqli_query($conn, $query);
$num = mysqli_num_rows($result);

if ($num == 0) {
    echo "<h5>No results found</h5>";
} else {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='product-item'>
                <div class='product-image'>
                    <img src='uploads/{$row['image_url']}' alt='product image'>
                </div>
                <div class='product-details'>
                    <h3>{$row['name']}</h3>
                    <span class='des'>{$row['description']}</span>
                    <p>\${$row['price']}</p>
                    <div class='product-text'>
                        <div class='cart-button'>
                            <button class='add-to-cart'>
                                <a href='add-to-cart.php?product_id={$row['product_id']}'>
                                    <i class='fa-solid fa-cart-plus'></i>
                                </a>
                            </button>
                            <a href='single-product-view.php?product_id={$row['product_id']}' class='view'>
                                <i class='fa-solid fa-circle-info'></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>";
    }
}
?>
</div>
</div>