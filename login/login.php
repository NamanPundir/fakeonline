<?php
session_start();
include 'db.php';

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
        $otp = rand(100000, 999999);
        $_SESSION['email'] = $email;
        $_SESSION['otp'] = $otp;

        $conn->query("UPDATE users SET otp='$otp' WHERE email='$email'");

        // Send OTP to email (this is basic mail)
        mail($email, "Your OTP Code", "Use this OTP to verify: $otp");

        header("Location: ./otp_verify.html");
    } else {
        echo "Invalid password.";
    }
} else {
    echo "Email not found.";
}
?>