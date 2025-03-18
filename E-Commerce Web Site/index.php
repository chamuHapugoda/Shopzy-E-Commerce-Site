<?php
include('connection.php');
session_start();

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

        // Close the statement
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

        // Close the statement
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
    <title>Shopzy..</title>
    <link rel="icon" href="Image/icon.jfif" type="image/png">

    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.4.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <style>

@keyframes slideDown {
    10% {
        transform: translateX(40px); 
        opacity: 0;
    }
    80% {
        transform: translateX(0); 
        opacity: 1; 
    }
   
   
}

.alert {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: end;
    font-size: 14px;
    font-weight: 500; 
    margin: 0;  
    border-radius: 8px;
    transition: all 8s ease; 
    position: fixed; 
    top: 700px; 
    transform: translateX(20%);
    padding: 0 30px;
    z-index: 1000;
    animation: slideDown 5s ease;
    opacity: 0; 
    animation-fill-mode: forwards;
}

.success, .error {
    color: white;
    margin-bottom: 10px; 
    padding: 0 30px;
}

.success {
    background-color: #4CAF50;
}

.error {
    background-color: #F44336;
}





    </style>

</head>

<body>
    <!-- <div class="snow-container"></div> -->

    <div id="page" class="page-home">

        <div class="alert">
            <div class="success">
                <?php
                if (isset($_GET['success']) && $_GET['success'] === "loginsuccess") {
                    echo ' Welcome to our website!';
                }
                ?>
            </div>
        
        </div>

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
            <?php
            include('slider.php');
            ?>


            <div class="guide">
                <div class="container">
                    <div class="wrap">
                        <div class="heading">
                            <h2 class="title">Products Guide</h2>
                        </div>
                        <div class="dotgrid scrollto">
                            <div class="wrapper">
                                <div class="item">
                                    <div class="dot-image">
                                        <div class="thumbnail hover">
                                            <img src="assets/guide_01.png" alt="">
                                        </div>
                                    </div>
                                    <div class="dot-info">
                                        <h3 class="dot-title">The Blue Ocean MX</h3>
                                        <p class="grey-color">Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                                            Facere ratione deserunt nulla.</p>

                                    </div>
                                </div>
                                <div class="item">
                                    <div class="dot-image">
                                        <div class="thumbnail hover">
                                            <img src="assets/guide_02.png" alt="">
                                        </div>
                                    </div>
                                    <div class="dot-info">
                                        <h3 class="dot-title">The Blue Ocean MX</h3>
                                        <p class="grey-color">Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                                            Facere ratione deserunt nulla.</p>

                                    </div>
                                </div>
                                <div class="item">
                                    <div class="dot-image">
                                        <div class="thumbnail hover">
                                            <img src="assets/guide_03.png" alt="">
                                        </div>
                                    </div>
                                    <div class="dot-info">
                                        <h3 class="dot-title">The Blue Ocean MX</h3>
                                        <p class="grey-color">Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                                            Facere ratione deserunt nulla.</p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- =========guide========= -->

            <?php
            include('carousel.php');
            ?>

            <!-- =========carousal========= -->

            <?php
            include('bycats.php');
            ?>
            <!-- =========bycats========= -->

            <div class="banner">
                <div class="container">
                    <div class="wrap">
                        <div class="content">
                            <span>Promo</span>
                            <h3 class="title">Get Ready! <br> Winter is coming..</h3>
                            <div class="button"><a href="" class="primary-btn">Go get it</a></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- =========banner========= -->

            <div class="fromblog">
                <div class="container">
                    <div class="wrap">
                        <div class="heading">
                            <h2 class="title">From The Blog</h2>
                        </div>
                        <div class="dotgrid scrollto">
                            <div class="wrapper">
                                <div class="item">
                                    <div class="dot-image">
                                        <div class="thumbnail hover">
                                            <a href="">
                                                <img src="assets/blog_01.jpg" alt="">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="dot-info">
                                        <a href="">Hoodie</a>
                                        <h3 class="dot-title">
                                            <a href="">What is easier knitting or crocheting?</a>
                                        </h3>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="dot-image">
                                        <div class="thumbnail hover">
                                            <a href="">
                                                <img src="assets/blog_02.jpg" alt="">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="dot-info">
                                        <a href="">Hoodie</a>
                                        <h3 class="dot-title">
                                            <a href="">What is easier knitting or crocheting?</a>
                                        </h3>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="dot-image">
                                        <div class="thumbnail hover">
                                            <a href="">
                                                <img src="assets/blog_03.jpg" alt="">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="dot-info">
                                        <a href="">Hoodie</a>
                                        <h3 class="dot-title">
                                            <a href="">What is easier knitting or crocheting?</a>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="button">
                            <a href="" class="secondary-btn">Read more</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- =========fromblog========= -->

            <div class="frominsta">
                <div class="container wide">
                    <div class="wrap">
                        <div class="heading">
                            <h2 class="title">Polular Instagram Photos</h2>
                        </div>
                        <div class="dotgrid scrollto">
                            <div class="wrapper">
                                <div class="item">
                                    <div class="dot-image">
                                        <a href=""></a>
                                        <div class="thumbnail">
                                            <img src="assets/ig_01.jpg" alt="">
                                        </div>
                                        <div class="actions">
                                            <i class="ri-instagram-line"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="dot-image">
                                        <a href=""></a>
                                        <div class="thumbnail">
                                            <img src="assets/ig_02.jpg" alt="">
                                        </div>
                                        <div class="actions">
                                            <i class="ri-instagram-line"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="dot-image">
                                        <a href=""></a>
                                        <div class="thumbnail">
                                            <img src="assets/ig_03.jpg" alt="">
                                        </div>
                                        <div class="actions">
                                            <i class="ri-instagram-line"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="dot-image">
                                        <a href=""></a>
                                        <div class="thumbnail">
                                            <img src="assets/ig_04.jpg" alt="">
                                        </div>
                                        <div class="actions">
                                            <i class="ri-instagram-line"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="dot-image">
                                        <a href=""></a>
                                        <div class="thumbnail">
                                            <img src="assets/ig_05.jpg" alt="">
                                        </div>
                                        <div class="actions">
                                            <i class="ri-instagram-line"></i>
                                        </div>
                                    </div>
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