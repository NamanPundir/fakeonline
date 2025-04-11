<?php
session_start();
include 'db.php';

$email = $_SESSION['email'];

$sql = "SELECT p.price, c.quantity 
        FROM cart c JOIN products p ON c.product_id = p.id 
        WHERE c.user_email='$email'";
$result = $conn->query($sql);

$total = 0;
while ($row = $result->fetch_assoc()) {
    $total += $row['price'] * $row['quantity'];
}

echo json_encode(['total' => number_format($total, 2)]);
?>