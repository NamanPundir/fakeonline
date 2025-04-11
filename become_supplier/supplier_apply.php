<?php
session_start();
include 'db.php';

if (!isset($_SESSION['email'])) {
    die("Please login to apply.");
}

$email = $_SESSION['email'];
$company = $_POST['company_name'];
$contact = $_POST['contact_number'];
$type = $_POST['product_type'];
$address = $_POST['address'];

// Check if user already applied
$check = $conn->query("SELECT * FROM suppliers WHERE user_email='$email'");
if ($check->num_rows > 0) {
    echo "You’ve already submitted an application. Please wait for review.";
    exit;
}

$sql = "INSERT INTO suppliers (user_email, company_name, contact_number, product_type, address)
        VALUES ('$email', '$company', '$contact', '$type', '$address')";

if ($conn->query($sql)) {
    echo "Application submitted successfully! We’ll review and get back to you.";
} else {
    echo "Something went wrong: " . $conn->error;
}
?>