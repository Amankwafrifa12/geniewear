<?php
session_start();
include '../includes/db.php';

$product_id = $_GET['id'];
$stmt = $pdo->prepare('DELETE FROM products WHERE id = ?');
$stmt->execute([$product_id]);

echo "Product deleted successfully.";
header('Location: dashboard.php');
exit();
