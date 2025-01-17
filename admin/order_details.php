<?php
session_start();
include '../includes/db.php';

$orderId = $_GET['id'];
$stmt = $pdo->prepare('SELECT * FROM order_items WHERE order_id = ?');
$stmt->execute([$orderId]);
$orderItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h1>Order Details</h1>
<table>
    <tr>
        <th>Product ID</th>
        <th>Quantity</th>
        <th>Price</th>
    </tr>
    <?php foreach ($orderItems as $item): ?>
        <tr>
            <td><?php echo $item['product_id']; ?></td>
            <td><?php echo $item['quantity']; ?></td>
            <td>$<?php echo $item['price']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>
<a href="view_orders.php">Back to Orders</a>