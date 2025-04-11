<?php
$host = "localhost";
$user = "root";
$password = "N@man7223";
$dbname = "clickcart";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>