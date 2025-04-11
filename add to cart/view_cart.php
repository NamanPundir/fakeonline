<?php
session_start();
include 'db.php';

if (!isset($_SESSION['email'])) {
    echo "Please login first.";
    exit;
}

$email = $_SESSION['email'];

$sql = "SELECT p.name, p.price, c.quantity 
        FROM cart c JOIN products p ON c.product_id = p.id 
        WHERE c.user_email='$email'";
$result = $conn->query($sql);

$total = 0;
while ($row = $result->fetch_assoc()) {
    $subtotal = $row['price'] * $row['quantity'];
    $total += $subtotal;
    echo "<p>" . $row['name'] . " - Quantity: " . $row['quantity'] . " - $" . $subtotal . "</p>";
}
echo "<hr><strong>Total: $$total</strong>";
?>