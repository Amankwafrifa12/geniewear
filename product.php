<?php
session_start();
include 'includes/db.php';

// Get the product ID from the URL
$product_id = $_GET['id'] ?? null;

if (!$product_id) {
    echo "Product not found.";
    exit();
}

// Fetch product details from the database
$stmt = $pdo->prepare('SELECT * FROM products WHERE id = ?');
$stmt->execute([$product_id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    echo "Product not found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['name']); ?></title>
</head>

<body>
    <img src="images/<?php echo htmlspecialchars($product['image']); ?>"
        <h1><?php echo htmlspecialchars($product['name']); ?></h1>
    <p><?php echo htmlspecialchars($product['description']); ?></p>
    <p>Price: ¢<?php echo number_format($product['price'], 2); ?></p>
    <a href="add_to_cart.php?id=<?php echo $product['id']; ?>">Add to Cart</a>
    <a href="index.php">Back to Homepage</a>
</body>

</html>