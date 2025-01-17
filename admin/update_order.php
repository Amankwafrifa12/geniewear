<?php
session_start();
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $orderId = $_POST['order_id'];
    $status = $_POST['status'];

    $stmt = $pdo->prepare('UPDATE orders SET status = ? WHERE id = ?');
    $stmt->execute([$status, $orderId]);

    echo "Order status updated.";
    header('Location: view_orders.php');
    exit();
}

$orderId = $_GET['id'];
?>

<form method="POST">
    <input type="hidden" name="order_id" value="<?php echo $orderId; ?>">
    <label for="status">Status:</label>
    <select name="status">
        <option value="pending">Pending</option>
        <option value="shipped">Shipped</option>
        <option value="delivered">Delivered</option>
        <option value="cancelled">Cancelled</option>
    </select>
    <button type="submit">Update Status</button>
</form>