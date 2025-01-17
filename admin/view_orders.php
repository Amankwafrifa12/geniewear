<?php
session_start();
include '../includes/db.php';

// Fetch orders
$stmt = $pdo->query('SELECT * FROM orders');
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h1>View Orders</h1>
<table>
    <tr>
        <th>Order ID</th>
        <th>User ID</th>
        <th>Total Price</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($orders as $order): ?>
        <tr>
            <td><?php echo $order['id']; ?></td>
            <td><?php echo $order['user_id']; ?></td>
            <td>$<?php echo $order['total_price']; ?></td>
            <td><?php echo $order['status']; ?></td>
            <td>
                <a href="order_details.php?id=<?php echo $order['id']; ?>">Details</a>
                <a href="update_order.php?id=<?php echo $order['id']; ?>">Update</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>