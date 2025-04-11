<?php
session_start();

if (isset($_POST['add_to_cart'])) {
    $item = [
        'id' => $_POST['product_id'],
        'name' => $_POST['product_name'],
        'price' => $_POST['product_price'],
        'qty' => 1
    ];

    // Initialize cart if not set
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Check if item already exists
    $found = false;
    foreach ($_SESSION['cart'] as &$cart_item) {
        if ($cart_item['id'] == $item['id']) {
            $cart_item['qty']++;
            $found = true;
            break;
        }
    }

    if (!$found) {
        $_SESSION['cart'][] = $item;
    }

    header("Location: ./cart.php");
    exit;
}
?>

<h2>Your Cart</h2>
<?php
if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
    echo "<ul>";
    foreach ($_SESSION['cart'] as $item) {
        echo "<li>{$item['name']} - \${$item['price']} x {$item['qty']}</li>";
    }
    echo "</ul>";
    echo "<a href='checkout.php'>Proceed to Payment</a>";
} else {
    echo "Your cart is empty.";
}
?>