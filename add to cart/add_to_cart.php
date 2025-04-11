<?php
session_start();
include 'db.php';

if (!isset($_SESSION['email'])) {
    echo "Please login first.";
    exit;
}

$email = $_SESSION['email'];
$product_id = $_POST['product_id'];
$quantity = $_POST['quantity'];

// Check if item already in cart
$check = $conn->query("SELECT * FROM cart WHERE user_email='$email' AND product_id=$product_id");
if ($check->num_rows > 0) {
    $conn->query("UPDATE cart SET quantity = quantity + $quantity WHERE user_email='$email' AND product_id=$product_id");
} else {
    $conn->query("INSERT INTO cart (user_email, product_id, quantity) VALUES ('$email', $product_id, $quantity)");
}

echo "Added to cart. <a href='./products.html'>Back to products</a>";
?>