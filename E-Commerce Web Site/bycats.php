<div class="bycats">
    <div class="container">
        <div class="wrap">
            <div class="heading sort-list tabs">
                <span class="grey-color">in</span>
                <div class="wrap">
                    <h3 class="opt-trigger">
                        <span class="value">Women</span>
                        <i class="ri-arrow-down-s-line"></i>
                    </h3>
                    <ul>
                        <li class="active"><a data-id="women" href="" class="tabbed-trigger">Women</a></li>
                        <li><a data-id="men" href="" class="tabbed-trigger">Men</a></li>
                        <li><a data-id="accessaries" href="" class="tabbed-trigger">Accessaries</a></li>
                    </ul>
                </div>
            </div>
            <div class="tabbed">
                <div id="women" class="sort-data active">

                    <div class="dotgrid">
                        <div class="wrapper">
                            <?php

                            $sql = "SELECT * FROM products WHERE category = 'Women' AND Status = 1";
                            $result = $conn->query($sql);


                            ?>

                            <?php if ($result->num_rows > 0): ?>
                            <?php while ($row = $result->fetch_assoc()): ?>
                            <div class="item">
                                <div class="dot-image">
                                    <a href="" class="product-permalink"></a>
                                    <div class="thumbnail">
                                        <img src="Product Image/<?= $row['image_url'] ?>" alt="" style="width: 300px; height: 400px;">
                                    </div>
                                    <div class="thumbnail hover">
                                        <img src="Product Image/<?= $row['image2_url'] ?>" alt="" style="width: 300px; height: 400px;">
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
                                        <span class="before">$
                                            <?= number_format($row['price'] * 1.25, 2) ?>
                                        </span> 
                                        <span class="current">$
                                            <?= $row['price'] ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <?php endwhile; ?>
                            <?php else: ?>
                            <p>No products found.</p>
                            <?php endif; ?>
                    

                        </div>
                    </div>
                </div>
                <div id="men" class="sort-data">
                    <div class="dotgrid">
                        <div class="wrapper">
                            <?php

                            $sql = "SELECT * FROM products WHERE category = 'Men' AND Status = 1";
                            $result = $conn->query($sql);


                            ?>

                            <?php if ($result->num_rows > 0): ?>
                            <?php while ($row = $result->fetch_assoc()): ?>
                            <div class="item">
                                <div class="dot-image">
                                    <a href="" class="product-permalink"></a>
                                    <div class="thumbnail">
                                        <img src="Product Image/<?= $row['image_url'] ?>" alt="" style="width: 350px; height: 400px;">
                                    </div>
                                    <div class="thumbnail hover">
                                        <img src="Product Image/<?= $row['image2_url'] ?>" alt="" style="width: 350px; height: 400px;">
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
                                        <span class="before">$
                                            <?= number_format($row['price'] * 1.25, 2) ?>
                                        </span>
                                        <span class="current">$
                                            <?= $row['price'] ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <?php endwhile; ?>
                            <?php else: ?>
                            <p>No products found.</p>
                            <?php endif; ?>
                    
                        </div>
                    </div>
                </div>
                <div id="accessaries" class="sort-data">
                    <div class="dotgrid">
                        <div class="wrapper">
                            <?php

                            $sql = "SELECT * FROM products WHERE category = 'Accessaries' AND Status = 1";
                            $result = $conn->query($sql);

                            ?>

                            <?php if ($result->num_rows > 0): ?>
                            <?php while ($row = $result->fetch_assoc()): ?>
                            <div class="item">
                                <div class="dot-image">
                                    <a href="" class="product-permalink"></a>
                                    <div class="thumbnail">
                                        <img src="Product Image/<?= $row['image_url'] ?>" alt="" style="width: 300px; height: 400px;">
                                    </div>
                                    <div class="thumbnail hover">
                                        <img src="Product Image/<?= $row['image2_url'] ?>" alt="" style="width: 300px; height: 400px;">
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
                                        <span class="before">$
                                            <?= number_format($row['price'] * 1.25, 2) ?>
                                        </span> <!-- Assuming 25% discount -->
                                        <span class="current">$
                                            <?= $row['price'] ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <?php endwhile; ?>
                            <?php else: ?>
                            <p>No products found.</p>
                            <?php endif; ?>
                    

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>