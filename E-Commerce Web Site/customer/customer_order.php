<?php
session_start();

include_once('connection.php');

if (!isset($_SESSION['customer_id'])) {
    die("Unauthorized access.");
}

$customer_id = $_SESSION['customer_id'];

if (isset($_POST['remove_item'])) {
    $order_id = (int)$_POST['remove_item'];
    $sql = "UPDATE orders SET status = 'cancelled' WHERE order_id = ? AND customer_id = ? AND status = 'pending'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $order_id, $customer_id);
    if ($stmt->execute()) {
        echo "Order cancelled successfully.";
    } else {
        echo "Failed to cancel order.";
    }
    $stmt->close();
}

if (isset($_POST['update_quantity_2'])) {
    $order_id = (int)$_POST['update_quantity_2'];
    $sql = "UPDATE orders SET status = 'delivered' WHERE order_id = ? AND customer_id = ? AND status = 'shipped'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $order_id, $customer_id);
    if ($stmt->execute()) {
        echo "Order status updated to completed.";
    } else {
        echo "Failed to update order status.";
    }
    $stmt->close();
}

$sql = "SELECT o.order_id, o.status, o.quntity, o.total_price, p.name AS product_name, p.image_url 
        FROM orders o 
        JOIN products p ON o.product_id = p.product_id 
        WHERE o.customer_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $customer_id);
$stmt->execute();
$result = $stmt->get_result();

$orders = [];
while ($row = $result->fetch_assoc()) {
    $orders[] = $row;
}
$stmt->close();
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.4.0/fonts/remixicon.css" rel="stylesheet" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            color: #333;
            line-height: 1.6;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 30px;
            background-color: #ffffff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        header .logo {
            font-size: 28px;
            font-weight: bold;
            color: #333;
        }

        header nav ul {
            list-style-type: none;
            display: flex;
            gap: 20px;
        }
        h1{
            text-align: center;
            font-family: sans-serif;
            margin-top: 30px;
        }
        header nav ul li a {
            text-decoration: none;
            color: #333;
            font-size: 18px;
            padding: 5px 10px;
            transition: all 0.3s ease;
        }

        header nav ul li a:hover {
            color: #2bcbba;
            text-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }

        .cart-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            max-width: 1500px;
            margin: 50px auto;
            padding: 0 15px;
        }

        .cart-items {
            width: 1500px;
            overflow: auto;
            height: 400px;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .cart-items table {
            
            width: 100%;
            background-color: #fff;
            border-collapse: collapse;
        }
        .cart-items th{
            background-color:rgb(63, 125, 119);
            color: white;
        }

        .cart-items th,
        .cart-items td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #e0e0e0;
        }
        .cart-items tbody{
            overflow: auto;
            height: 400px;
        }

        .cart-items td input {
            width: 50px;
            padding: 5px;
            text-align: center;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .remove-btn {
            background-color: #ff5b5b;
            color: #fff;
            border: none;
            padding: 8px 15px;
            cursor: pointer;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .remove-btn:hover {
            background-color: #878282;
            transform: translateY(-3px);
        }

        .cart-total {
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            height: fit-content;
        }

        .cart-total .coupon input {
            width: 70%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .apply-coupon-btn {
            background-color: #2bcbba;
            color: #fff;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .apply-coupon-btn:hover {
            background-color: #949292;
            transform: translateY(-3px);
        }

        .cart-total .total-summary p {
            margin: 15px 0;
            font-size: 18px;
        }

        .checkout-btn {
            width: 60%;
            margin-left: 130px;
            background-color: #2bcbba;
            color: #fff;
            padding: 15px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .checkout-btn:hover {
            background-color: #949292;
            transform: translateY(-3px);
        }

        .cart-image {
            text-align: center;
            margin-bottom: 10px;
        }

        .cart-img {
            max-width: 100%;
            height: 300px;
        }

        .coupon {
            margin-top: 30px;
        }

        .coupon input {
            width: 400px;
            height: 50px;
            margin-right: 20px;
            border-radius: 5px;
        }

        .total-summary p {
            font-weight: bold;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }

        .total-summary i {
            margin-right: 15px;
        }

        .update-btn {
            background-color: #2bcbba;
            color: #fff;
            border: none;
            margin-left: 10px;
            padding: 8px 15px;
            cursor: pointer;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .update-btn:hover {
            background-color: #949292;
            transform: translateY(-3px);
        }

        footer {
    background-color: #333;
    color: #fff;
    padding: 30px 0;
    text-align: center;
    margin-top: 50px;
}

.footer-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 15px;
}

.footer-content {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    gap: 15px;
}

.footer-logo h2 {
    font-size: 24px;
    font-weight: bold;
}

.footer-contact p {
    font-size: 16px;
    margin: 5px 0;
}

.footer-social a {
    margin: 0 10px;
    font-size: 20px;
    color: #fff;
    text-decoration: none;
    transition: color 0.3s ease;
}

.footer-social a:hover {
    color: #2bcbba;
}


       
        @media (max-width: 768px) {
            .cart-container {
                grid-template-columns: 1fr;
            }

            header .logo {
                font-size: 24px;
            }

            header nav ul {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>

<body>
    <header>
        <div class="logo">Shopzy..</div>
        <nav>
            <ul>
                <li><a href="../index.php">Your oders > Home</a></li>
            </ul>
        </nav>
    </header>
    <h1>My Oders</h1>
    <div class="cart-container">
      
        <div class="cart-items">
            <form action="" method="POST">
                <table>
                    <thead>
                        <tr>
                            <th>Product Image</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                            <th>Receive Confirm</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($orders) > 0): ?>
                            <?php foreach ($orders as $order): ?>
                                <tr>
                                    <td><img src="../Product Image/<?php echo htmlspecialchars($order['image_url']); ?>" alt="<?php echo htmlspecialchars($order['product_name']); ?>" style="width: 50px; height: 50px; object-fit: cover;"></td>
                                    <td><?php echo htmlspecialchars($order['product_name']); ?></td>
                                    <td>$<?php echo htmlspecialchars($order['total_price']); ?></td>
                                    <td><?php echo htmlspecialchars($order['status']); ?></td>
                                    <td><?php echo htmlspecialchars($order['quntity']); ?></td>
                                    <td>$<?php echo htmlspecialchars($order['total_price']); ?></td>
                                    <td>
                                        <?php if ($order['status'] === 'pending'): ?>
                                            <button type="submit" name="remove_item" value="<?php echo $order['order_id']; ?>" class="remove-btn">Cancel</button>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($order['status'] === 'shipped'): ?>
                                            <button type="submit" name="update_quantity_2" value="<?php echo $order['order_id']; ?>" class="update-btn">Received</button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8">No orders found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </form>
        </div>
    </div>

    <footer>
        <div class="footer-container">
            <div class="footer-content">
                <div class="footer-logo">
                    <h2>Shopzy</h2>
                </div>
                <div class="footer-contact">
                    <p>Email: contact@shopzy.com</p>
                    <p>Phone: +1 (234) 567-890</p>
                </div>
                <div class="footer-social">
                    <a href="#" class="social-icon"><i class="ri-facebook-fill"></i></a>
                    <a href="#" class="social-icon"><i class="ri-twitter-fill"></i></a>
                    <a href="#" class="social-icon"><i class="ri-instagram-fill"></i></a>
                    <a href="#" class="social-icon"><i class="ri-linkedin-fill"></i></a>
                </div>
            </div>
        </div>
    </footer>
    
</body>

</html>
