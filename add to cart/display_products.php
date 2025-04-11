<?php
include 'db.php';
session_start();
$result = $conn->query("SELECT * FROM products");

while ($row = $result->fetch_assoc()) {
    echo "<div class='product'>";
    echo "<h3>" . $row['name'] . "</h3>";
    echo "<p>Price: $" . $row['price'] . "</p>";
    echo "<form action='./add_to_cart.php' method='POST'>";
    echo "<input type='hidden' name='product_id' value='" . $row['id'] . "'>";
    echo "<input type='number' name='quantity' value='1' min='1'>";
    echo "<button type='submit'>Add to Cart</button>";
    echo "</form>";
    echo "</div><hr>";
}
?>