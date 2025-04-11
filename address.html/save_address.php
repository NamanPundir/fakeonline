<?php
session_start();
include 'db.php';

if (!isset($_SESSION['email'])) {
    die("Please login to save address.");
}

$email = $_SESSION['email'];
$full_name = $_POST['full_name'];
$phone = $_POST['phone'];
$address1 = $_POST['address_line1'];
$address2 = $_POST['address_line2'];
$city = $_POST['city'];
$state = $_POST['state'];
$postal = $_POST['postal_code'];
$country = $_POST['country'];

// Check if address already exists (optional)
$conn->query("DELETE FROM addresses WHERE user_email='$email'");

$sql = "INSERT INTO addresses 
(user_email, full_name, phone, address_line1, address_line2, city, state, postal_code, country)
VALUES 
('$email', '$full_name', '$phone', '$address1', '$address2', '$city', '$state', '$postal', '$country')";

if ($conn->query($sql)) {
    echo "Address saved successfully. <a href='../payment/payment.html'>Continue to Payment</a>";
} else {
    echo "Error saving address: " . $conn->error;
}
?>
