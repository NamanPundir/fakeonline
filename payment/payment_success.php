<?php
session_start();
include 'db.php';

$data = json_decode(file_get_contents("php://input"));
$email = $_SESSION['email'];

// Calculate total again (safety)
$sql = "SELECT p.price, c.quantity 
        FROM cart c JOIN products p ON c.product_id = p.id 
        WHERE c.user_email='$email'";
$result = $conn->query($sql);

$total = 0;
while ($row = $result->fetch_assoc()) {
    $total += $row['price'] * $row['quantity'];
}

// Insert order record
$conn->query("INSERT INTO orders (user_email, total, payment_status) VALUES ('$email', $total, 'Paid')");

// Clear user's cart
$conn->query("DELETE FROM cart WHERE user_email='$email'");

http_response_code(200);
echo "Payment recorded.";
?>