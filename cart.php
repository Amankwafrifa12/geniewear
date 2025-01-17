<?php
session_start();
include 'includes/db.php';

// Fetch products in the cart
$cart = $_SESSION['cart'] ?? [];
$products = []; // Initialize $products as an empty array

if ($cart) {
    $placeholders = implode(',', array_fill(0, count($cart), '?'));
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id IN ($placeholders)");
    $stmt->execute(array_keys($cart));
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
</head>

<body>
    <h1>Your Cart</h1>
    <?php if (!empty($products)): ?>
        <ul>
            <?php foreach ($products as $product): ?>
                <li>
                    <?php echo htmlspecialchars($product['name']); ?> -
                    Quantity: <?php echo $cart[$product['id']]; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Your cart is empty.</p>
    <?php endif; ?>
    <a href="index.php">Continue Shopping</a>
</body>

</html>