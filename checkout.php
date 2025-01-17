<?php
session_start();
include 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = $_SESSION['user_id'];
    $totalPrice = $_POST['total_price']; // Calculate this from the cart items
    $status = 'pending';

    // Insert order
    $stmt = $pdo->prepare('INSERT INTO orders (user_id, total_price, status) VALUES (?, ?, ?)');
    $stmt->execute([$userId, $totalPrice, $status]);
    $orderId = $pdo->lastInsertId();

    // Insert order items
    $cartStmt = $pdo->prepare('SELECT * FROM cart WHERE user_id = ?');
    $cartStmt->execute([$userId]);
    $cartItems = $cartStmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($cartItems as $item) {
        $productId = $item['product_id'];
        $quantity = $item['quantity'];
        $price = $item['price'];

        $orderItemStmt = $pdo->prepare('INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)');
        $orderItemStmt->execute([$orderId, $productId, $quantity, $price]);
    }

    // Clear cart
    $clearCartStmt = $pdo->prepare('DELETE FROM cart WHERE user_id = ?');
    $clearCartStmt->execute([$userId]);

    echo "Order placed successfully.";
    // Redirect to a success page or summary page
}
?>

<form method="POST">
    <label for="address">Shipping Address:</label>
    <input type="text" name="address" required>
    <!-- Calculate and display total price from cart items -->
    <button type="submit" name="total_price" value="100">Checkout</button> <!-- Example total price -->
</form>