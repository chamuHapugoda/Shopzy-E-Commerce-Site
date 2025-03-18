<?php
 session_start();
 include('connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   

    if (!isset($_SESSION['customer_id'])) {
        header("Location: customer/customer.php");
        exit();
    }

    if (!isset($_POST['product_id'], $_POST['rating'], $_POST['comment'])) {
        echo "All fields are required.";
        exit();
    }

    $customer_id = $_SESSION['customer_id'];
    $product_id = intval($_POST['product_id']);
    $rating = intval($_POST['rating']);
    $comment = trim($_POST['comment']);

    // Validate rating value
    if ($rating < 1 || $rating > 5) {
        echo "Invalid rating.";
        exit();
    }

    // Fetch seller_id for the product
    $query = "SELECT seller_id FROM products WHERE product_id = ?";
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        die("Error preparing seller_id query: " . $conn->error);
    }
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $seller_id = $result->fetch_assoc()['seller_id'];

        // Insert the review
        $insert_query = "
            INSERT INTO product_reviews (product_id, customer_id, seller_id, rating, comment, Status)
            VALUES (?, ?, ?, ?, ?, 1)
        ";
        $insert_stmt = $conn->prepare($insert_query);

        if (!$insert_stmt) {
            die("Error preparing insert query: " . $conn->error);
        }

        $insert_stmt->bind_param("iiiss", $product_id, $customer_id, $seller_id, $rating, $comment);

        if ($insert_stmt->execute()) {
            echo "Review added successfully.";
            header("Location: page-catagory.php?id=" . $product_id);
            exit();
        } else {
            die("Error executing insert query: " . $insert_stmt->error);
        }
    } else {
        echo "Invalid product ID.";
    }
} else {
    echo "Invalid request.";
}

?>
