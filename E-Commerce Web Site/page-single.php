<?php
include('connection.php');
session_start();

// Check if product_id is set in the query parameters
if (!isset($_GET['product_id']) || empty($_GET['product_id'])) {
    die('Product ID is missing.');
}

// Sanitize the product_id to prevent SQL injection
$product_id = intval($_GET['product_id']);

// Fetch product details from the database
$query = "SELECT * FROM products WHERE product_id = ? AND Status = 1";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $product_id);
$stmt->execute();
$result = $stmt->get_result();

// Check if the product exists
if ($result->num_rows === 0) {
    die('Product not found.');
}

// Fetch product data
$product = $result->fetch_assoc();

// Ensure the session variable for customer ID exists
if (isset($_SESSION['customer_id'])) {
    $customer_id = $_SESSION['customer_id'];

    // Query to count favorite items for the logged-in customer
    $sql_favourite = "SELECT COUNT(*) AS favourite_count FROM favourite_items WHERE customer_id = ?";
    $stmt_favourite = $conn->prepare($sql_favourite);

    if ($stmt_favourite) {
        $stmt_favourite->bind_param("i", $customer_id);
        $stmt_favourite->execute();
        $result_favourite = $stmt_favourite->get_result();
        $favourite_count = $result_favourite->fetch_assoc()['favourite_count'];
        $stmt_favourite->close();
    } else {
        echo "Error in query preparation for favourite items: " . $conn->error;
        $favourite_count = 0; // Fallback in case of an error
    }

    // Query to count cart items for the logged-in customer
    $sql_cart = "SELECT COUNT(*) AS cart_count FROM cart_items WHERE customer_id = ?";
    $stmt_cart = $conn->prepare($sql_cart);

    if ($stmt_cart) {
        $stmt_cart->bind_param("i", $customer_id);
        $stmt_cart->execute();
        $result_cart = $stmt_cart->get_result();
        $cart_count = $result_cart->fetch_assoc()['cart_count'];
        $stmt_cart->close();
    } else {
        echo "Error in query preparation for cart items: " . $conn->error;
        $cart_count = 0; // Fallback in case of an error
    }
} else {
    $favourite_count = 0; // Default to 0 if no customer is logged in
    $cart_count = 0; // Default to 0 if no customer is logged in
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Page</title>
    <link rel="icon" href="Image/icon.jfif" type="image/png">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.4.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

</head>

<body>
    <div id="page" class="page-single">

        <header>
            <div class="inner-header">
                <div class="container wide">
                    <div class="wrap">
                        <div class="header-left">
                            <div class="menu-bar">
                                <a href="#0" class="menu-trigger" trigger-button data-target="mobile-menu"><i
                                        class="ri-menu-line"></i></a>
                            </div>
                            <div class="list-inline">
                                <ul>
                                <?php if (isset($_SESSION['customer_id'])): ?>
                                        <?php
                                        // Assuming 'first_name' is stored in the session when the customer logs in.
                                        $customer_name = $_SESSION['first_name'];
                                        ?>
                                        <li class="dropdownprofile">
                                            <a href="#" class="dropdownprofile-toggle" id="customerDropdown" data-toggle="dropdownprofile" aria-haspopup="true" aria-expanded="false" style=" font-size:18px; font-weight: bold; ">
                                                <?php echo htmlspecialchars($customer_name); ?>
                                                <i class="ri-arrow-down-s-line"></i>
                                            </a>
                                            <ul class="dropdownprofile-menu" aria-labelledby="customerDropdown">
                                                <li><a href="customer/profile.php">Profile</a></li>
                                                <li><a href="customer/customer_order.php">My Orders</a></li>
                                                <li><a href="view-cart.php">My cart</a></li>
                                                <li><a href="customer/logout.php">Logout</a></li>
                                            </ul>
                                        </li>
                                    <?php else: ?>
                                        <li><a href="customer/customer.php"><i class="ri-user-line"></i></a></li>
                                    <?php endif; ?>

                                    <li>
                                        <a href="view_favourite.php">
                                            <span class="item-floating"><?php echo htmlspecialchars($favourite_count); ?></span>
                                            <i class="ri-heart-line"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="header-center">
                            <nav class="menu">
                                <ul>
                                    <li><a href="index.php"><span>Home</span></a></li>
                                    <li><a href="page-catagory.php">
                                            <span>Product</span>
                                            <i class="ri-arrow-down-s-line"></i>
                                        </a>
                                        <ul class="sub-mega">
                                            <li>
                                                <div class="container">
                                                    <div class="wrapper">
                                                        <div class="mega-content">
                                                            <div class="dotgrid">
                                                                <div class="wrapper">
                                                                    <div class="item">
                                                                        <div class="dot-image">
                                                                            <a href="" class="product-permalink"></a>
                                                                            <div class="thumbnail">
                                                                                <img src="assets/product_01.jpg" alt="">
                                                                            </div>
                                                                            <div class="thumbnail hover">
                                                                                <img src="assets/product_01b.jpg"
                                                                                    alt="">
                                                                            </div>
                                                                            <div class="actions">
                                                                                <ul>
                                                                                    <li><a href=""><i
                                                                                                class="ri-star-line"></i></a>
                                                                                    </li>
                                                                                    <li><a href=""><i
                                                                                                class="ri-arrow-left-right-line"></i></a>
                                                                                    </li>
                                                                                    <li><a href=""><i
                                                                                                class="ri-eye-line"></i></a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                            <div class="lable"><span>25%</span></div>
                                                                        </div>
                                                                        <div class="dot-info">
                                                                            <h2 class="dot-title"><a href="">the sweater
                                                                                    in Tosca</a></h2>
                                                                            <div class="product-price">
                                                                                <span class="before">$62.00</span>
                                                                                <span class="current">$45.00</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="item">
                                                                        <div class="dot-image">
                                                                            <a href="" class="product-permalink"></a>
                                                                            <div class="thumbnail">
                                                                                <img src="assets/product_02.jpg" alt="">
                                                                            </div>
                                                                            <div class="thumbnail hover">
                                                                                <img src="assets/product_02b.jpg"
                                                                                    alt="">
                                                                            </div>
                                                                            <div class="actions">
                                                                                <ul>
                                                                                    <li><a href=""><i
                                                                                                class="ri-star-line"></i></a>
                                                                                    </li>
                                                                                    <li><a href=""><i
                                                                                                class="ri-arrow-left-right-line"></i></a>
                                                                                    </li>
                                                                                    <li><a href=""><i
                                                                                                class="ri-eye-line"></i></a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                            <div class="lable"><span>25%</span></div>
                                                                        </div>
                                                                        <div class="dot-info">
                                                                            <h2 class="dot-title"><a href="">the sweater
                                                                                    in Tosca</a></h2>
                                                                            <div class="product-price">
                                                                                <span class="before">$62.00</span>
                                                                                <span class="current">$45.00</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="item">
                                                                        <div class="dot-image">
                                                                            <a href="" class="product-permalink"></a>
                                                                            <div class="thumbnail">
                                                                                <img src="assets/product_03.jpg" alt="">
                                                                            </div>
                                                                            <div class="thumbnail hover">
                                                                                <img src="assets/product_03b.jpg"
                                                                                    alt="">
                                                                            </div>
                                                                            <div class="actions">
                                                                                <ul>
                                                                                    <li><a href=""><i
                                                                                                class="ri-star-line"></i></a>
                                                                                    </li>
                                                                                    <li><a href=""><i
                                                                                                class="ri-arrow-left-right-line"></i></a>
                                                                                    </li>
                                                                                    <li><a href=""><i
                                                                                                class="ri-eye-line"></i></a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                            <div class="lable"><span>25%</span></div>
                                                                        </div>
                                                                        <div class="dot-info">
                                                                            <h2 class="dot-title"><a href="">the sweater
                                                                                    in Tosca</a></h2>
                                                                            <div class="product-price">
                                                                                <span class="before">$62.00</span>
                                                                                <span class="current">$45.00</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="links">
                                                                <div class="list-block">
                                                                    <h3 class="dot-title">Apparel</h3>
                                                                    <ul>
                                                                        <li><a href="">Prada</a></li>
                                                                        <li><a href="">Gucci</a></li>
                                                                        <li><a href="">Chanel</a></li>
                                                                        <li><a href="">Gani</a></li>
                                                                        <li><a href="">Zara</a></li>
                                                                    </ul>
                                                                </div>
                                                                <div class="list-block">
                                                                    <h3 class="dot-title">Apparel</h3>
                                                                    <ul>
                                                                        <li><a href="">Prada</a></li>
                                                                        <li><a href="">Gucci</a></li>
                                                                        <li><a href="">Chanel</a></li>
                                                                        <li><a href="">Gani</a></li>
                                                                        <li><a href="">Zara</a></li>
                                                                    </ul>
                                                                </div>
                                                                <div class="list-block">
                                                                    <h3 class="dot-title">Apparel</h3>
                                                                    <ul>
                                                                        <li><a href="">Prada</a></li>
                                                                        <li><a href="">Gucci</a></li>
                                                                        <li><a href="">Chanel</a></li>
                                                                        <li><a href="">Gani</a></li>
                                                                        <li><a href="">Zara</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    <li><a href="disc.php"><span>Disc</span></a></li>
                                </ul>
                                <ul>
                                    <li><a href="special.php">
                                            <span>Specials</span>
                                            <i class="ri-arrow-down-s-line"></i>
                                        </a>
                                        <ul class="sub-menu list-block">
                                            <li><a href="">Dolce & Gabbana</a></li>
                                            <li><a href="">Luise Vuitton</a></li>
                                            <li><a href="">Versace</a></li>
                                            <li><a href="">Dior</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="Seller/index.php"><span>Seller</span></a></li>
                                </ul>
                            </nav>
                            <div class="branding"><a href="">Shopzy</a></div>
                        </div>
                        <div class="header-right">
                            <div class="list-inline">
                                <ul>
                                    <li><a href="#0" trigger-button data-target="search-float"><i
                                                class="ri-search-line"></i></a></li>
                                                <li>
                                        <a href="#0" trigger-button data-target="data-cart">
                                            <span class="item-floating"><?php echo $cart_count; ?></span>
                                            <i class="ri-shopping-bag-line"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="wrap">
                        <div class="breadcrumb list-inline">
                            <ul>
                                <li><a href="index.php">Home</a></li>
                                <li><a href="page-catagory.php">Product</a></li>
                                <li><a href=""><?= htmlspecialchars($product['name']) ?></a></li>
                               
                            </ul>
                        </div>
                    </div>
                </div>
                <div id="search-float" class="search-float">
                    <div class="container wide">
                        <form action="" class="search">
                            <i class="ri-search-line"></i>
                            <input type="search" class="input" id="" placeholder="Search products">
                            <i class="ri-close-line" close-button></i>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <main>
            <div class="section">
                <div class="container">
                    <div class="wrap">
                        <div class="product dotgrid">
                            <div class="wrapper">
                                <div class="image">
                                    <div class="outer-main">
                                        <div class="main-image swiper">
                                            <div class="wrap swiper-wrapper">
                                            <div class="item swiper-slide"><img src="Product Image/<?= $product['image_url'] ?>" alt="" style="width: 450px;height:600px"></div>
                                            <div class="item swiper-slide"><img src="Product Image/<?= $product['image2_url'] ?>" alt="" style="width: 450px;height:600px"></div>
                                            </div>
                                        </div>
                                        <div class="custom-pagination">
                                            <div class="swiper-pagination"></div>
                                        </div>
                                    </div>
                                    <div class="outer-thumb ob-cover">
                                        <div class="thumbnail-image swiper">
                                            <div class="wrap swiper-wrapper">
                                                <div class="item swiper-slide">
                                                    <div class="thumb-wrap"><img src="Product Image/<?= $product['image_url'] ?>" alt="">
                                                    </div>
                                                </div>
                                                <div class="item swiper-slide">
                                                    <div class="thumb-wrap"><img src="Product Image/<?= $product['image2_url'] ?>" alt="">
                                                    </div>
                                                </div>
                                            
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="summary">
                                    <div class="entry">
                                        <h1 class="title"><?= htmlspecialchars($product['name']) ?></h1>
                                        <div class="product-group">
                                            <div class="product-price">
                                                <span class="current">$<?= number_format($product['price'], 2) ?></span>
                                                <div class="wrap">
                                                    <span class="before">$62.00</span>
                                                    <span class="discount">-25%</span>
                                                </div>
                                            </div>
                                            <div class="product-rating">
                                                <span>
                                                    <i class="ri-star-fill"></i>
                                                    <span>4.8</span>
                                                </span>
                                                <a href="">3 Reviews</a>
                                            </div>
                                        </div>
                                        <!-- <div class="product-color">
                                            <span>Colors:</span>
                                            <div class="wrap">
                                                <button class="tosca selected"></button>
                                                <button class="brown"></button>
                                                <button class="ocean"></button>
                                            </div>
                                        </div> -->
                                        <!-- <div class="product-size">
                                            <span>Size:</span>
                                            <div class="wrap">
                                                <button disabled>S</button>
                                                <button>M</button>
                                                <button class="selected">L</button>
                                                <button>XL</button>
                                            </div>
                                        </div> -->
                                        <div class="product-stock">
                                            <div class="wrap">
                                                <strong><?= $product['stock'] ?></strong>
                                                <span class="grey-color">in stock</span>
                                                <i class="ri-checkbox-circle-line"></i>
                                            </div>
                                        </div>
                                        <p class="description"><?= nl2br(htmlspecialchars($product['description'])) ?></p>
                                        
                                        <div class="product-action">
                                            <!-- <div class="qty">
                                                <button class="decrease">-</button>
                                                <input type="text" value="1">
                                                <button class="increase">+</button>
                                            </div> -->
                                            <?php if (isset($_SESSION['customer_id'])): ?>
                                            <div class="addcart button" style="width: 300px;margin-bottom:10px">
                                                <button type="submit" class="primary-btn"><a href="add_to_cart.php?product_id=<?= $row['product_id'] ?>">Add to cart</button>
                                            </div>
                                            <?php else: ?>
                                                <div class="addcart button" style="width: 300px;margin-bottom:10px">
                                                <button type="submit" class="primary-btn"><a href="customer/customer.php">Add to cart</button>
                                            </div>
                                            <?php endif; ?>
                                            <!-- <div class="buynow button">
                                                <button type="submit" class="secondary-btn">Buy Now</button>
                                            </div> -->
                                        </div>
                                        
                                        <div class="product-control list-inline">
                                            <ul>
                                                <li><a href=""><i class="ri-heart-line"></i><span>Add to
                                                            Wishlist</span></a></li>
                                                <li><a href=""><i
                                                            class="ri-arrow-left-right-line"></i><span>Compare</span></a>
                                                </li>
                                                <li><a href="#0" trigger-button data-target="data-share"><i
                                                            class="ri-share-forward-line"></i><span>Share</span></a>
                                                </li>
                                                <li><a href="#0" trigger-button data-target="data-question"><i class="ri-question-line"></i><span>Ask
                                                            Question</span></a></li>
                                            </ul>
                                        </div>
                                        <div class="shipping">
                                            <ul>
                                                <li>
                                                    <i class="ri-gift-line"></i>
                                                    <span>Free shipping & return</span>
                                                    <span class="grey-color">On oders over$100</span>
                                                </li>
                                                <li>
                                                    <i class="ri-truck-line"></i>
                                                    <span>estimate delivery</span>
                                                    <span class="grey-color">01 - 07 Jan , 2025</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product detail">
                            <div class="wrapper tabbed">
                                <nav class="list-inline scrollto">
                                    <ul class="wrapper">
                                        <li class="active"><a href="#0" class="tabbed-trigger"
                                                data-id="product-description"><span>Product details</span></a></li>
                                        <li><a href="#0" class="tabbed-trigger"
                                                data-id="product-custom"><span>Custom</span></a></li>
                                        <li><a href="#0" class="tabbed-trigger"
                                                data-id="product-review"><span>Reviews</span><span
                                                    class="item-floating">3</span></a></li>
                                        <li><a href="#0" class="tabbed-trigger"
                                                data-id="product-shipping"><span>Shipping</span></a></li>
                                    </ul>
                                </nav>
                                <div id="product-description" class="product-about description active">
                                    <div class="text-block">
                                        <h3>The sweater in tosca</h3>
                                        <div class="grey-color">
                                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias
                                                voluptatibus debitis asperiores quibusdam explicabo, eius voluptatum
                                                recusandae. Eum deserunt labore recusandae in libero non voluptas?</p>
                                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias
                                                voluptatibus debitis asperiores quibusdam explicabo, eius voluptatum
                                                recusandae. Eum deserunt labore recusandae in libero non voluptas?</p>
                                        </div>
                                    </div>
                                    <div class="dotgrid">
                                        <div class="wrapper">
                                            <div class="list-block">
                                                <h4>what is this?</h4>
                                                <ul class="grey-color">
                                                    <li>95% shdsf jfhsdjg</li>
                                                    <li>95% shdsf jfhsdjg</li>
                                                    <li>95% shdsf jfhsdjg</li>
                                                    <li>95% shdsf jfhsdjg</li>
                                                </ul>
                                            </div>
                                            <div class="list-block">
                                                <h4>what makes our product unique?</h4>
                                                <p class="grey-color">Lorem ipsum dolor sit amet consectetur adipisicing
                                                    elit. Consectetur corrupti cumque amet ab sequi quam!</p>
                                            </div>
                                            <div class="list-block">
                                                <h4>what makes our product unique?</h4>
                                                <p class="grey-color">Lorem ipsum dolor sit amet consectetur adipisicing
                                                    elit. Consectetur corrupti cumque amet ab sequi quam!</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="product-custom" class="product-about custom">
                                    <h3>Our custom sizes</h3>
                                    <div class="image">
                                        <img src="assets/custom-size.jpg" alt="">
                                    </div>
                                </div>
                                <div id="product-review" class="product-about review">
                                    <div class="wrapper">
                                        <h3>Rating & Review</h3>
                                        <div class="head-review">
                                            <div class="sum-rating">
                                                <strong>4.8</strong>
                                                <span>3 reviews</span>
                                            </div>
                                            <div class="button">
                                                <a href="#0" class="primary-btn" trigger-button data-target="data-review">Write a review</a>
                                            </div>
                                        </div>
                                        <div class="body-review">
                                            <div class="profile">
                                                <div class="thumb-name">
                                                    <div class="image">
                                                        <img src="assets/ig_01.jpg" alt="">
                                                    </div>
                                                    <div class="grouping">
                                                        <div class="name">Sarah</div>
                                                        <div class="rating">
                                                            <i class="ri-star-fill"></i>
                                                            <i class="ri-star-fill"></i>
                                                            <i class="ri-star-fill"></i>
                                                            <i class="ri-star-fill"></i>
                                                            <i class="ri-star-fill"></i>
                                                        </div>
                                                        <div class="date grey-color">On November 7, 2024</div>
                                                    </div>
                                                </div>
                                                <div class="comment">
                                                    <Strong>Awesom Product</Strong>
                                                    <p class="grey-color">Lorem, ipsum dolor sit amet consectetur
                                                        adipisicing elit. Facere perspiciatis iusto ea alias ex ab
                                                        cupiditate accusantium non culpa quo.</p>
                                                </div>
                                                <div class="thumb-name">
                                                    <div class="image">
                                                        <img src="assets/ig_02.jpg" alt="">
                                                    </div>
                                                    <div class="grouping">
                                                        <div class="name">Sarah</div>
                                                        <div class="rating">
                                                            <i class="ri-star-fill"></i>
                                                            <i class="ri-star-fill"></i>
                                                            <i class="ri-star-fill"></i>
                                                            <i class="ri-star-fill"></i>
                                                            <i class="ri-star-fill"></i>
                                                        </div>
                                                        <div class="date grey-color">On November 7, 2024</div>
                                                    </div>
                                                </div>
                                                <div class="comment">
                                                    <Strong>Awesom Product</Strong>
                                                    <p class="grey-color">Lorem, ipsum dolor sit amet consectetur
                                                        adipisicing elit. Facere perspiciatis iusto ea alias ex ab
                                                        cupiditate accusantium non culpa quo.</p>
                                                </div>
                                                <div class="thumb-name">
                                                    <div class="image">
                                                        <img src="assets/ig_03.jpg" alt="">
                                                    </div>
                                                    <div class="grouping">
                                                        <div class="name">Sarah</div>
                                                        <div class="rating">
                                                            <i class="ri-star-fill"></i>
                                                            <i class="ri-star-fill"></i>
                                                            <i class="ri-star-fill"></i>
                                                            <i class="ri-star-fill"></i>
                                                            <i class="ri-star-fill"></i>
                                                        </div>
                                                        <div class="date grey-color">On November 7, 2024</div>
                                                    </div>
                                                </div>
                                                <div class="comment">
                                                    <Strong>Awesom Product</Strong>
                                                    <p class="grey-color">Lorem, ipsum dolor sit amet consectetur
                                                        adipisicing elit. Facere perspiciatis iusto ea alias ex ab
                                                        cupiditate accusantium non culpa quo.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="product-shipping" class="product-about shipping">
                                    <div class="grey-color">
                                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum, harum!</p>
                                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quisquam ad ab
                                            praesentium quasi deserunt incidunt.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            

            <!-- carosal structure copy from main index -->
            <div class="carousel">
                <div class="container">
                    <div class="wrap">
                        <div class="heading">
                            <h2 class="title">New Arrivals</h2>
                        </div>
                        <div class="inner-wrapper">
                            <div class="dotgrid carouselbox swiper">

                                <div class="wrapper swiper-wrapper">
                                    <div class="item swiper-slide">
                                        <div class="dot-image">
                                            <a href="" class="product-permalink"></a>
                                            <div class="thumbnail">
                                                <img src="assets/product_01.jpg" alt="">
                                            </div>
                                            <div class="thumbnail hover">
                                                <img src="assets/product_01b.jpg" alt="">
                                            </div>
                                            <div class="actions">
                                                <ul>
                                                    <li><a href=""><i class="ri-star-line"></i></a>
                                                    </li>
                                                    <li><a href=""><i class="ri-arrow-left-right-line"></i></a>
                                                    </li>
                                                    <li><a href=""><i class="ri-eye-line"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="lable"><span>25%</span></div>
                                        </div>
                                        <div class="dot-info">
                                            <h2 class="dot-title"><a href="">the sweater
                                                    in Tosca</a></h2>
                                            <div class="product-price">
                                                <span class="before">$62.00</span>
                                                <span class="current">$45.00</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item swiper-slide">
                                        <div class="dot-image">
                                            <a href="" class="product-permalink"></a>
                                            <div class="thumbnail">
                                                <img src="assets/product_02.jpg" alt="">
                                            </div>
                                            <div class="thumbnail hover">
                                                <img src="assets/product_02b.jpg" alt="">
                                            </div>
                                            <div class="actions">
                                                <ul>
                                                    <li><a href=""><i class="ri-star-line"></i></a>
                                                    </li>
                                                    <li><a href=""><i class="ri-arrow-left-right-line"></i></a>
                                                    </li>
                                                    <li><a href=""><i class="ri-eye-line"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="lable"><span>25%</span></div>
                                        </div>
                                        <div class="dot-info">
                                            <h2 class="dot-title"><a href="">the sweater
                                                    in Tosca</a></h2>
                                            <div class="product-price">
                                                <span class="before">$62.00</span>
                                                <span class="current">$45.00</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item swiper-slide">
                                        <div class="dot-image">
                                            <a href="" class="product-permalink"></a>
                                            <div class="thumbnail">
                                                <img src="assets/product_03.jpg" alt="">
                                            </div>
                                            <div class="thumbnail hover">
                                                <img src="assets/product_03b.jpg" alt="">
                                            </div>
                                            <div class="actions">
                                                <ul>
                                                    <li><a href=""><i class="ri-star-line"></i></a>
                                                    </li>
                                                    <li><a href=""><i class="ri-arrow-left-right-line"></i></a>
                                                    </li>
                                                    <li><a href=""><i class="ri-eye-line"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="lable"><span>25%</span></div>
                                        </div>
                                        <div class="dot-info">
                                            <h2 class="dot-title"><a href="">the sweater
                                                    in Tosca</a></h2>
                                            <div class="product-price">
                                                <span class="before">$62.00</span>
                                                <span class="current">$45.00</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item swiper-slide">
                                        <div class="dot-image">
                                            <a href="" class="product-permalink"></a>
                                            <div class="thumbnail">
                                                <img src="assets/product_01.jpg" alt="">
                                            </div>
                                            <div class="thumbnail hover">
                                                <img src="assets/product_01b.jpg" alt="">
                                            </div>
                                            <div class="actions">
                                                <ul>
                                                    <li><a href=""><i class="ri-star-line"></i></a>
                                                    </li>
                                                    <li><a href=""><i class="ri-arrow-left-right-line"></i></a>
                                                    </li>
                                                    <li><a href=""><i class="ri-eye-line"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="lable"><span>25%</span></div>
                                        </div>
                                        <div class="dot-info">
                                            <h2 class="dot-title"><a href="">the sweater
                                                    in Tosca</a></h2>
                                            <div class="product-price">
                                                <span class="before">$62.00</span>
                                                <span class="current">$45.00</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item swiper-slide">
                                        <div class="dot-image">
                                            <a href="" class="product-permalink"></a>
                                            <div class="thumbnail">
                                                <img src="assets/product_02.jpg" alt="">
                                            </div>
                                            <div class="thumbnail hover">
                                                <img src="assets/product_02b.jpg" alt="">
                                            </div>
                                            <div class="actions">
                                                <ul>
                                                    <li><a href=""><i class="ri-star-line"></i></a>
                                                    </li>
                                                    <li><a href=""><i class="ri-arrow-left-right-line"></i></a>
                                                    </li>
                                                    <li><a href=""><i class="ri-eye-line"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="lable"><span>25%</span></div>
                                        </div>
                                        <div class="dot-info">
                                            <h2 class="dot-title"><a href="">the sweater
                                                    in Tosca</a></h2>
                                            <div class="product-price">
                                                <span class="before">$62.00</span>
                                                <span class="current">$45.00</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item swiper-slide">
                                        <div class="dot-image">
                                            <a href="" class="product-permalink"></a>
                                            <div class="thumbnail">
                                                <img src="assets/product_03.jpg" alt="">
                                            </div>
                                            <div class="thumbnail hover">
                                                <img src="assets/product_03b.jpg" alt="">
                                            </div>
                                            <div class="actions">
                                                <ul>
                                                    <li><a href=""><i class="ri-star-line"></i></a>
                                                    </li>
                                                    <li><a href=""><i class="ri-arrow-left-right-line"></i></a>
                                                    </li>
                                                    <li><a href=""><i class="ri-eye-line"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="lable"><span>25%</span></div>
                                        </div>
                                        <div class="dot-info">
                                            <h2 class="dot-title"><a href="">the sweater
                                                    in Tosca</a></h2>
                                            <div class="product-price">
                                                <span class="before">$62.00</span>
                                                <span class="current">$45.00</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item swiper-slide">
                                        <div class="dot-image">
                                            <a href="" class="product-permalink"></a>
                                            <div class="thumbnail">
                                                <img src="assets/product_01.jpg" alt="">
                                            </div>
                                            <div class="thumbnail hover">
                                                <img src="assets/product_01b.jpg" alt="">
                                            </div>
                                            <div class="actions">
                                                <ul>
                                                    <li><a href=""><i class="ri-star-line"></i></a>
                                                    </li>
                                                    <li><a href=""><i class="ri-arrow-left-right-line"></i></a>
                                                    </li>
                                                    <li><a href=""><i class="ri-eye-line"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="lable"><span>25%</span></div>
                                        </div>
                                        <div class="dot-info">
                                            <h2 class="dot-title"><a href="">the sweater
                                                    in Tosca</a></h2>
                                            <div class="product-price">
                                                <span class="before">$62.00</span>
                                                <span class="current">$45.00</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item swiper-slide">
                                        <div class="dot-image">
                                            <a href="" class="product-permalink"></a>
                                            <div class="thumbnail">
                                                <img src="assets/product_02.jpg" alt="">
                                            </div>
                                            <div class="thumbnail hover">
                                                <img src="assets/product_02b.jpg" alt="">
                                            </div>
                                            <div class="actions">
                                                <ul>
                                                    <li><a href=""><i class="ri-star-line"></i></a>
                                                    </li>
                                                    <li><a href=""><i class="ri-arrow-left-right-line"></i></a>
                                                    </li>
                                                    <li><a href=""><i class="ri-eye-line"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="lable"><span>25%</span></div>
                                        </div>
                                        <div class="dot-info">
                                            <h2 class="dot-title"><a href="">the sweater
                                                    in Tosca</a></h2>
                                            <div class="product-price">
                                                <span class="before">$62.00</span>
                                                <span class="current">$45.00</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="nav">
                                <div class="swiper-button-next">
                                    <i class="ri-arrow-right-line"></i>
                                </div>
                                <div class="swiper-button-prev">
                                    <i class="ri-arrow-left-line"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

    <?php
    include('footer.php');

    ?>