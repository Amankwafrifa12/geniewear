<?php

session_start();
// Fetch products in the cart
$cart = $_SESSION['cart'] ?? [];

if ($cart) {
    $placeholders = implode(',', array_fill(0, count($cart), '?'));
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id IN ($placeholders)");
    $stmt->execute(array_keys($cart));
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Count total items in the cart
    $total_items = array_sum($cart);

    echo '<span class="cart-badge">' . $total_items . '</span>';
} else {
    echo 'Cart';
}
