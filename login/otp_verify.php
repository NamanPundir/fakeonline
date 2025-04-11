<?php
session_start();
include 'db.php';

$entered_otp = $_POST['otp'];
$email = $_SESSION['email'];

$result = $conn->query("SELECT otp FROM users WHERE email='$email'");
$row = $result->fetch_assoc();

if ($entered_otp == $row['otp']) {
    $conn->query("UPDATE users SET is_verified=1 WHERE email='$email'");
    echo "OTP verified. Login successful!";
} else {
    echo "Invalid OTP.";
}
?>