<?php
session_start();
include '../includes/db.php';

// Check if user is admin
if ($_SESSION['role'] !== 'admin') {
    header('Location: ../index.php');
    exit();
}
?>

<h1>Welcome to Admin Dashboard</h1>
<ul>
    <li><a href="manage_products.php">Manage Products</a></li>
    <li><a href="view_orders.php">View Orders</a></li>

</ul>