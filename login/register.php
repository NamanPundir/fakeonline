<?php
session_start();
include 'db.php';

$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$otp = rand(100000, 999999);

// Check if email already exists
$check = $conn->query("SELECT * FROM users WHERE email='$email'");
if ($check->num_rows > 0) {
    echo "Email already registered.";
    exit;
}

// Insert new user
$sql = "INSERT INTO users (email, password, otp) VALUES ('$email', '$password', '$otp')";
if ($conn->query($sql)) {
    $_SESSION['email'] = $email;
    $_SESSION['otp'] = $otp;

    // Send OTP via email (basic)
    mail($email, "Your OTP Code", "Your OTP code is: $otp");

    header("Location: ./otp_verify_register.html");
} else {
    echo "Error: " . $conn->error;
}
?>