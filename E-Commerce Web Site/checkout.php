<?php
session_start(); // Ensure session is started for accessing the logged-in user

// Assuming the user is logged in and their user_id is stored in the session
$customer_id = $_SESSION['customer_id'];

// Connect to the database
include('connection.php'); // Your database connection file

// Fetch cart items for the logged-in user
$query = "
    SELECT c.cart_item_id, c.quantity, p.name, p.price, p.product_id ,  p.image_url
    FROM cart_items c
    JOIN products p ON c.product_id = p.product_id
    WHERE c.customer_id = ?
";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$result = $stmt->get_result();

$cart_items = [];
$total_amount = 0;

while ($row = $result->fetch_assoc()) {
    $cart_items[] = $row;
    $total_amount += $row['price'] * $row['quantity']; // Calculate total amount
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Page</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f5f5f5;
            padding: 20px;
        }

        .checkout-container {
            margin-top: 50px;
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .form-section,
        .summary-section {
            background: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            flex: 1;
            max-width: 600px;
        }

        .form-section h2,
        .summary-section h2 {
            font-size: 1.5rem;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 10px;
        }

        .form-section h2::after {
            content: "";
            position: absolute;
            left: 2%;
            bottom: 0;
            width: 20%;
            height: 1px;
            background-color: black;
        }

        .form-group {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 15px;
        }


        input[type="checkbox"] {
            width: 15px;
            height: 15px;
            border-radius: 50%;
            appearance: none;
            border: 2px solid #ccc;
            background-color: #fff;
            position: relative;
        }

        input[type="checkbox"]:checked {
            background-color: #1a73e8;
            border-color: #1a73e8;
        }


        input[type="checkbox"] {
            width: 15px;
            height: 15px;
            border-radius: 50%;
            appearance: none;
            border: 2px solid #ccc;
            background-color: #fff;
            position: relative;
        }

        input[type="checkbox"]:checked {
            background-color: #ffffff;
            border-color: #ffffff;
            border: 4px solid #2bcbba;
        }


        textarea {
            resize: none;
            height: 80px;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 10px;
        }

        .summary-box {
            background: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            margin-bottom: 20px;
        }

        .summary-box .summary-details p,
        .summary-box .total p {
            display: flex;
            justify-content: space-between;
            font-size: 1rem;
            margin: 10px 0;
        }

        .summary-box .total p {
            font-weight: bold;
        }

        .form-section button {
            background-color: #2bcbba;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            margin-top: 10px;
            width: 100%;
        }

        .order-details {
            max-height: 200px;
            overflow-y: auto;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 10px;
        }

        .order-item {
            display: flex;
            gap: 10px;
            margin-bottom: 10px;
            align-items: center;
        }

        .order-item img {
            width: 70px;
            height: 70px;
            border-radius: 4px;
            object-fit: cover;
        }

        .order-item-info {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .order-item-info span {
            font-size: 0.9rem;
        }

        .order-item-info .item-price {
            font-weight: bold;
            color: #000000;
        }

        /* Payment Method in Form Section */
        .payment-method-group {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            margin-top: 20px;
        }

        .payment-method-group .checkbox-group {
            align-items: center;
        }
    </style>
</head>

<body>
    <div class="checkout-container">
        <div class="form-section">
            <h2>Payment Method</h2>

            <div class="payment-method-group">
                <div class="checkbox-group">
                    <input type="checkbox" id="credit-card" checked>
                    <label for="credit-card">Credit Card</label>
                </div>
                <div class="checkbox-group">
                    <input type="checkbox" id="paypal">
                    <label for="paypal">PayPal</label>
                </div>
                <div class="checkbox-group">
                    <input type="checkbox" id="cash-on-delivery">
                    <label for="cash-on-delivery">Cash on Delivery</label>
                </div>
            </div>

            <h2 style="margin-top: 15px;">Shipping address</h2>
            <form action="checkout_back.php" method="POST">
                <input type="text" placeholder="Card Holder name" name="card_holder_name">
                <textarea placeholder="Shipping Address" name="shipping_address"></textarea>
                <!-- <input type="text" placeholder="Email" >
        <input type="email" placeholder="CNN" > -->
                <input type="tel" placeholder="Postal Code">

                <div class="form-group">
                    <input type="text" placeholder="Card Number">
                    <input type="text" placeholder="CVN">
                </div>

                <h2>Billing address</h2>
                <div class="checkbox-group">
                    <input type="checkbox" id="same-address" checked>
                    <label for="same-address">Same as shipping address</label>
                </div>
                <button type="submit">Proceed to Checkout</button>

            </form>
        </div>

        <div class="summary-section">
            <div class="summary-box">
                <h2>The total amount of</h2>
                <div class="summary-details">
                    <p>Sub Total <span>$<?php echo number_format($total_amount, 2); ?></span></p>
                    <p>Shipping <span>Free</span></p>
                </div>
                <div class="total">
                    <p>The total amount <span>$<?php echo number_format($total_amount, 2); ?></span></p>
                </div>
              
            </div>
            <div class="order-details">
            <h2 style="text-align: center;">Order Details</h2>
                <?php foreach ($cart_items as $item): ?>
                <div class="order-item">
                <img src="Product Image/<?php echo $item['image_url']; ?>" alt="<?php echo $item['name']; ?>">
                    <div class="order-item-info">
                        <span><?php echo $item['name']; ?></span>
                        <span class="item-price">$<?php echo number_format($item['price'], 2); ?></span>
                        <span class="item-price"><?php echo $item['quantity']; ?></span>
                    </div>
                </div>
                <?php endforeach; ?>       
                
                
            </div>
        </div>
    </div>
</body>

</html>