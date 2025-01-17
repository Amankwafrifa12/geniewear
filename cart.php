<?php
session_start();
include 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Fetch cart items for the user
$stmt = $pdo->prepare('SELECT cart.*, products.name, products.price FROM cart JOIN products ON cart.product_id = products.id WHERE user_id = ?');
$stmt->execute([$_SESSION['user_id']]);
$cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Handle cart actions (update quantities, remove items, etc.)
?>

<div class="cart">
    <?php foreach ($cartItems as $item): ?>
        <div class="cart-item">
            <h2><?php echo htmlspecialchars($item['name']); ?></h2>
            <p>Price: $<?php echo htmlspecialchars($item['price']); ?></p>
            <p>Quantity: <?php echo htmlspecialchars($item['quantity']); ?></p>
            <!-- Update quantity and remove item form -->
        </div>
    <?php endforeach; ?>
</div>