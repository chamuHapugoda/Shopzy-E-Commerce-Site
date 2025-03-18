<footer>
    <div class="inner-footer">
        <div class="container">
            <div class="wrap">
                <div class="top">
                    <div class="subscribe">
                        <h3>Subscribe Us</h3>
                        <p class="grey-color">Enter your email here</p>
                        <form action="" class="search">
                            <i class="ri-mail-line"></i>
                            <input type="email" class="input" name = "email" placeholder="Enter your email here">
                            <input type="submit" class="submit" name="submit">
                            <i class="ri-arrow-right-line"></i>
                        </form>
                        <?php
                            if(isset($_REQUEST['submit'])){
                                $email = $_REQUEST['email'];
                                $sql = "INSERT INTO newsletters (email,Status) VALUES('$email','1')";
                                $result = $conn->query($sql);
                                if($result){
                                    // header("Location: index.php?statusInsert=inserted");
                                }
                            }
                        ?>
                    </div>
                    <div class="list-block">
                        <h3 class="dot-title">Service</h3>
                        <ul>
                            <li><a href="">About us</a></li>
                            <li><a href="">Careers</a></li>
                            <li><a href="">Delivery infromation </a></li>
                            <li><a href="">Terms & conditions</a></li>
                            <li><a href="">Privacy policy</a></li>
                        </ul>
                    </div>
                    <!-- <div class="lit-block">
                                <h3 class="dot-title">Service</h3>
                                <ul>
                                    <li><a href="">About us</a></li>
                                    <li><a href="">Careers</a></li>
                                    <li><a href="">Delivery infromation </a></li>
                                    <li><a href="">Terms & conditions</a></li>
                                    <li><a href="">Privacy policy</a></li>
                                </ul>
                            </div> -->
                    <div class="list-block">
                        <h3 class="dot-title">Pages</h3>
                        <ul>
                            <li><a href="">About us</a></li>
                            <li><a href="">Careers</a></li>
                            <li><a href="">Delivery infromation </a></li>
                            <li><a href="">Terms & conditions</a></li>
                            <li><a href="">Privacy policy</a></li>
                        </ul>
                    </div>
                    <div class="list-block">
                        <h3 class="dot-title">Pages</h3>
                        <div class="comp-address-grey-color">
                            <p>Simpand 05 No 1 <br> Central Java-ID</p>
                            <p>
                                <a href="">+47632785637452</a>
                                <br>
                                <a href="">rewyuryu@youtube.com</a>
                            </p>
                            <p>
                                Weekdays:6 AM to 8 PM
                            </p>
                        </div>
                    </div>

                </div>
                <div class="bottom">
                    <div class="list-inline">
                        <ul>
                            <li><a href=""><i class="ri-facebook-line"></i></a></li>
                            <li><a href=""><i class="ri-instagram-line"></i></a></li>
                            <li><a href=""><i class="ri-twitter-line"></i></a></li>
                            <li><a href=""><i class="ri-pinterest-line"></i></a></li>
                        </ul>
                    </div>
                    <div class="copyright">
                        <p>2023 hansika piyumali. All right reserved</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
</div>

<div class="overlay" data-overlay></div>
<div id="mobile-menu" class="mobile-menu">
    <div class="wrap">
        <a href="" class="close-trigger" close-button>
            <i class="ri-close-line"></i>
        </a>
        <div class="main-menu scrollto">
            <nav class="wrapper">
                <ul>
                    <li><a href=""><span>Home</span></a></li>
                    <li class="has-child"><a href="">
                            <span>Product</span>
                            <span class="child-trigger"><i class="ri-arrow-down-s-line"></i></span>
                        </a>
                        <ul class="sub-menu list-block">
                            <li><a href="">Adidas</a></li>
                            <li><a href="">Adidas</a></li>
                            <li><a href="">Adidas</a></li>
                            <li><a href="">Adidas</a></li>
                            <li><a href="">Adidas</a></li>
                            <li><a href="">Adidas</a></li>
                            <li><a href="">Adidas</a></li>
                            <li><a href="">Adidas</a></li>
                            <li><a href="">Adidas</a></li>
                            <li><a href="">Adidas</a></li>
                            <li><a href="">Adidas</a></li>
                            <li><a href="">Adidas</a></li>
                            <li><a href="">Adidas</a></li>
                            <li><a href="">Adidas</a></li>
                            <li><a href="">Adidas</a></li>
                            <li><a href="">Adidas</a></li>
                            <li><a href="">Adidas</a></li>
                            <li><a href="">Adidas</a></li>
                            <li><a href="">Adidas</a></li>
                            <li><a href="">Adidas</a></li>
                        </ul>
                    </li>
                    <li><a href=""><span>Discount</span></a></li>
                    <li class="has-child">
                        <a href="">
                            <span>Specials</span>
                            <span class="child-trigger"><i class="ri-arrow-down-s-line"></i></span></a>

                        <ul class="sub-menu list-block">
                            <li><a href="#">Dolce & Gabbana</a></li>
                            <li><a href="#">louis Vuitton</a></li>
                            <li><a href="#">Versace</a></li>
                            <li><a href="#">Dior</a></li>
                        </ul>
                    </li>
                    <li><a href=""><span>Sale</span></a></li>
                </ul>
            </nav>
            <div class="button">
                <a href="" class="secondary-btn">Login</a>
                <a href="" class="primary-btn">Register</a>
            </div>
        </div>
    </div>
</div>

<div id="data-share" class="data-popup d-share">
    <div class="wrap">
        <div class="data-content">
            <a href="#0" class="close-trigger" close-button><i class="ri-close-line"></i></a>
            <div class="form">
                <label>Copy link</label>
                <input type="text" disabled value="njfnjjfjfjkdsjfjdsfjkdskjf">
                <span><i class="ri-file-copy-line"></i></span>
            </div>
            <div class="media-share list-inline">
                <label>Share</label>
                <ul>
                    <li><a href=""><i class="ri-facebook-line"></i></a></li>
                    <li><a href=""><i class="ri-instagram-line"></i></a></li>
                    <li><a href=""><i class="ri-pinterest-line"></i></a></li>
                    <li><a href=""><i class="ri-youtube-line"></i></a></li>
                    <li><a href=""><i class="ri-whatsapp-line"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div id="data-question" class="data-popup d-question">
    <div class="wrap">
        <div class="data-content">
            <a href="#0" class="close-trigger" close-button><i class="ri-close-line"></i></a>
            <h3>The question</h3>
            <form action="">
                <div><input type="text" placeholder="Name"></div>
                <div><input type="text" placeholder="Email"></div>
                <div><textarea placeholder="Your question is..." cols="30" rows="5"></textarea></div>
                <div class="button">
                    <button type="submit" class="secondary-btn"><a href="">Submit</a></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="data-review" class="data-popup d-review">
    <div class="wrap">
        <div class="data-content">
            <a href="#0" class="close-trigger" close-button><i class="ri-close-line"></i></a>
            <h3>Write a Review</h3>
            <form action="add_reviews.php" method="POST">
                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                <div class="dotgrid">
                    <div class="wrapper">
                        <div><input type="text" placeholder="Name"></div>
                        <div><input type="text" placeholder="Email"></div>
                    </div>
                </div>
                <div class="rating">
                    <span>Your rating:</span>
                    <div class="stars">
                        <input type="radio" name="rating" id="star5" value="5">
                        <label for="star5"><i class="ri-star-fill"></i></label>
                        <input type="radio" name="rating" id="star4" value="4">
                        <label for="star4"><i class="ri-star-fill"></i></label>
                        <input type="radio" name="rating" id="star3" value="3">
                        <label for="star3"><i class="ri-star-fill"></i></label>
                        <input type="radio" name="rating" id="star2" value="2">
                        <label for="star2"><i class="ri-star-fill"></i></label>
                        <input type="radio" name="rating" id="star1" value="1">
                        <label for="star1"><i class="ri-star-fill"></i></label>
                    </div>
                </div>
                <div><input type="text" placeholder="Review Title"></div>
                <div><textarea placeholder="Your review is..." cols="30" rows="5" name="comment"></textarea></div>
                <div class="button">
                    <button type="submit" class="secondary-btn">Submit</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- <div id="data-cart" class="cart-menu">
    <div class="wrap">
        <a href="#0" class="close-trigger" close-button><i class="ri-close-line"></i></a>
        <div class="scrollto cart-outer">
            <div class="wrapper">
                <div class="cart-list">
                    <div class="wrapper">
                        <div class="cart-header">
                            <h2>Shopping Cart</h2>
                        </div>
                        <div class="cart-body">
                            <div class="product-list scrollto">
                                <div class="wrapper">
                                    <ul>
                                        <li>
                                            <div class="grouping">
                                                <div class="quantity">
                                                    <div class="control">
                                                    <button class="decrease-btn">-</button>
                                                        <input type="text" class="quantity-input" value="1" min="1">
                                                        <button class="increase-btn">+</button>
                                                    </div>
                                                </div>
                                                <div class="thumbnail">
                                                    <a href="">
                                                        <img src="assets/product_01.jpg" alt="">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="variats">
                                                <h4 class="dot-title"><a href="">The Sweater in Tosca</a></h4>
                                                <div class="color grey-color">
                                                    <span>Color:</span>
                                                    <span>Tosca</span>
                                                </div>
                                                <div class="size grey-color">
                                                    <span>Size:</span>
                                                    <span>L</span>
                                                </div>
                                                <div class="price">$45.00</div>
                                                <a href="" class="item-remove">
                                                    <i class="ri-close-line"></i>
                                                </a>
                                            </div>
                                        </li>

                                        <li>
                                            <div class="grouping">
                                                <div class="quantity">
                                                    <div class="control">
                                                    <button class="decrease-btn">-</button>
                                                        <input type="text" class="quantity-input" value="1" min="1">
                                                        <button class="increase-btn">+</button>
                                                    </div>
                                                </div>
                                                <div class="thumbnail">
                                                    <a href="">
                                                        <img src="assets/product_02.jpg" alt="">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="variats">
                                                <h4 class="dot-title"><a href="">The Sweater in Tosca</a></h4>
                                                <div class="color grey-color">
                                                    <span>Color:</span>
                                                    <span>Tosca</span>
                                                </div>
                                                <div class="size grey-color">
                                                    <span>Size:</span>
                                                    <span>L</span>
                                                </div>
                                                <div class="price">$45.00</div>
                                                <a href="" class="item-remove">
                                                    <i class="ri-close-line"></i>
                                                </a>
                                            </div>
                                        </li>

                                        <li>
                                            <div class="grouping">
                                                <div class="quantity">
                                                    <div class="control">
                                                        <button class="decrease-btn">-</button>
                                                        <input type="text" class="quantity-input" value="1" min="1">
                                                        <button class="increase-btn">+</button>
                                                    </div>
                                                </div>
                                                <div class="thumbnail">
                                                    <a href="">
                                                        <img src="assets/product_07.jpg" alt="">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="variats">
                                                <h4 class="dot-title"><a href="">The Sweater in Tosca</a></h4>
                                                <div class="color grey-color">
                                                    <span>Color:</span>
                                                    <span>Tosca</span>
                                                </div>
                                                <div class="size grey-color">
                                                    <span>Size:</span>
                                                    <span>L</span>
                                                </div>
                                                <div class="price">$45.00</div>
                                                <a href="" class="item-remove">
                                                    <i class="ri-close-line"></i>
                                                </a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="cart-footer">
                            <div class="discount">
                                <form action="">
                                    <input type="text" class="input" placeholder="Coupon">
                                    <input type="submit" class="submit" value="Apply">
                                </form>
                            </div>
                            <div class="math-pricing">
                                <ul>
                                    <li>
                                        <span>Subtotal</span>
                                        <span class="value"></span>
                                    </li>
                                    <ul>
                                        <li><span>Shipping</span></li>
                                        <li>
                                            <div class="cartradio">
                                                <input type="radio" class="checker" name="shipping">
                                                <label for="">Free</label>

                                            </div>
                                            <span class="value"> $0.00</span>
                                        </li>

                                        <li>
                                            <div class="cartradio">
                                                <input type="radio" class="checker" name="shipping">
                                                <label for="">Flat</label>
                                            </div>
                                            <span class="value"> $10.00</span>
                                        </li>
                                    </ul>
                                    <li>
                                        <span>Promo Discount</span>
                                        <span class="value">- $0.00</span>
                                    </li>
                                    <li class="total">
                                        <span>Total</span>
                                        <span class="value"> $147.00</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="button">
                                <a href="" class="secondary-btn">Checkout</a>
                                <a href="" class="grey-link">View cart</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->


<?php
// Include the cart items fetching logic
include 'fetch_cart_items.php'; // This will fetch the cart items and total
global $total;
?>

<div id="data-cart" class="cart-menu">
    <div class="wrap">
        <a href="#0" class="close-trigger" close-button><i class="ri-close-line"></i></a>
        <div class="scrollto cart-outer">
            <div class="wrapper">
                <div class="cart-list">
                    <div class="wrapper">
                        <div class="cart-header">
                            <h2>Shopping Cart</h2>
                        </div>
                        <div class="cart-body">
                            <div class="product-list scrollto">
                                <div class="wrapper">
                                    <ul>
                                        <?php if (!empty($cart_items)) { ?>
                                            <?php foreach ($cart_items as $item) { ?>
                                                <li>
                                                    <div class="grouping">
                                                        <div class="quantity">
                                                            <div class="control">
                                                                <button class="decrease-btn" onclick="updateQuantity(<?= $item['cart_item_id'] ?>, <?= $item['quantity'] - 1 ?>)">-</button>
                                                                <input type="text" class="quantity-input" value="<?= $item['quantity'] ?>" min="1" id="quantity_<?= $item['cart_item_id'] ?>">
                                                                <button class="increase-btn" onclick="updateQuantity(<?= $item['cart_item_id'] ?>, <?= $item['quantity'] + 1 ?>)">+</button>
                                                            </div>
                                                        </div>
                                                        <div class="thumbnail">
                                                            <a href="">
                                                                <img src="Product Image/<?= $item['image_url'] ?>" alt="<?= htmlspecialchars($item['name']) ?>">
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="variats">
                                                        <h4 class="dot-title">
                                                            <a href=""><?= htmlspecialchars($item['name']) ?></a>
                                                        </h4>
                                                        <div class="color grey-color">
                                                            <span>Category:</span>
                                                            <span><?= htmlspecialchars($item['category']) ?></span>
                                                        </div>

                                                        <div class="price">$<?= number_format($item['price'], 2) ?></div>
                                                        <div class="price">Subtotal: $<?= number_format($item['subtotal'], 2) ?></div>


                                                        <a href="#" class="update-link" style="text-decoration: none; display: inline-block; margin: 10px;">
                                                            <button class="update-btn" style="background-color: #2bcbba; color: white; padding: 5px 10px; font-size: 14px; border: none; border-radius: 5px; cursor: pointer; transition: background-color 0.3s ease;"
                                                                data-cart-item-id="<?= $item['cart_item_id'] ?>"
                                                                data-quantity="<?= $item['quantity'] ?>">
                                                                Update
                                                            </button>
                                                        </a>





                                                        <a href="delete_cart_item.php?product_id=<?= isset($item['product_id']) && !empty($item['product_id']) ? $item['product_id'] : '0' ?>"
                                                            class="item-remove"
                                                            onclick="return confirm('Are you sure you want to delete this item?');">
                                                            <i class="ri-close-line"></i>
                                                        </a>




                                                    </div>
                                                </li>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <li>No items in the cart.</li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="cart-footer">
                            <div class="math-pricing">
                                <ul>
                                    <li>
                                        <span>Subtotal</span>
                                        <span class="value">$<?= number_format($total, 2) ?></span>
                                    </li>
                                    <li class="total">
                                        <span>Total</span>
                                        <span class="value">$<?= number_format($total, 2) ?></span>
                                    </li>
                                </ul>
                            </div>
                            <div class="button">
                                <a href="checkout.php" class="secondary-btn">Checkout</a>
                                <a href="view-cart.php" class="grey-link">View cart</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="script.js"></script>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get all the control buttons and the quantity input fields
        const decreaseButtons = document.querySelectorAll('.decrease-btn');
        const increaseButtons = document.querySelectorAll('.increase-btn');
        const quantityInputs = document.querySelectorAll('.quantity-input');
        const updateButton = document.querySelector('.update-btn'); // Assuming you have an update button with this class

        // Function to send the updated quantity to the server via AJAX
        function updateQuantity(cartItemId, newQuantity) {
            // Send an AJAX request to update the cart
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "update_cart.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onload = function() {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);

                    if (response.error) {
                        alert(response.error);
                    } else {
                        // Update the displayed cart items and total
                        updateCartUI(response);
                    }
                } else {
                    alert('Error updating cart');
                }
            };
            xhr.send(`cart_item_id=${cartItemId}&quantity=${newQuantity}`);
        }

        // Function to update the UI with the new cart items and total
        function updateCartUI(response) {
            // Update the quantity input value for each cart item
            response.cart_items.forEach(item => {
                const quantityInput = document.getElementById('quantity_' + item.cart_item_id);
                if (quantityInput) {
                    quantityInput.value = item.quantity; // Update quantity input field
                }
            });

            // Update the total price
            const totalElement = document.getElementById('total');
            if (totalElement) {
                totalElement.innerText = '$' + response.total.toFixed(2); // Update total with new value
            }
        }

        // Loop through all the decrease buttons and add event listeners
        decreaseButtons.forEach((decreaseButton, index) => {
            decreaseButton.addEventListener('click', function() {
                let currentValue = parseInt(quantityInputs[index].value);
                if (currentValue > 1) {
                    let newQuantity = currentValue - 1;
                    quantityInputs[index].value = newQuantity; // Decrease by 1
                    updateQuantity(quantityInputs[index].id.split('_')[1], newQuantity); // Update server
                }
            });
        });

        // Loop through all the increase buttons and add event listeners
        increaseButtons.forEach((increaseButton, index) => {
            increaseButton.addEventListener('click', function() {
                let currentValue = parseInt(quantityInputs[index].value);
                let newQuantity = currentValue + 1; // Increase by 1
                quantityInputs[index].value = newQuantity; // Update the input field
                updateQuantity(quantityInputs[index].id.split('_')[1], newQuantity); // Update server
            });
        });

        // Update total when the update button is clicked
        if (updateButton) {
            updateButton.addEventListener('click', function() {
                quantityInputs.forEach((input) => {
                    const cartItemId = input.id.split('_')[1]; // Get cart item ID from input's ID
                    const newQuantity = input.value; // Get the updated quantity from input field
                    updateQuantity(cartItemId, newQuantity); // Update on the server
                });
            });
        }
    });







    //snow animation
    const snowContainer = document.querySelector('.snow-container');

    function createSnowflake() {
        const snowflake = document.createElement('div');
        snowflake.classList.add('snowflake');
        snowflake.textContent = '❄';

        snowflake.style.left = Math.random() * 100 + 'vw';
        snowflake.style.animationDuration = Math.random() * 6 + 4 + 's';
        snowContainer.appendChild(snowflake);

        setTimeout(() => snowflake.remove(), 5000);
    }

    setInterval(createSnowflake, 200);
</script>
</body>

</html>