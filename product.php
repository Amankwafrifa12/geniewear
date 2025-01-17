<?php

include 'includes/db.php';
include 'includes/header.php';

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
    <link rel="stylesheet" href="css/styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['name']); ?></title>
</head>

<body>
    <div class="product-container">
        <img src="images/<?php echo htmlspecialchars($product['image']); ?>"
            alt="<?php echo htmlspecialchars($product['name']); ?>" class="product-image">
        <h1 class="product-name"><?php echo htmlspecialchars($product['name']); ?></h1>
        <p class="product-description"><?php echo htmlspecialchars($product['description']); ?></p>
        <p class="product-price">Price: ¢<?php echo number_format($product['price'], 2); ?></p>
        <div class="product-actions">
            <a href="add_to_cart.php?id=<?php echo $product['id']; ?>" class="btn add-to-cart">Add to Cart</a>
            <a href="index.php" class="btn back-home">Back to Homepage</a>
        </div>
    </div>
</body>

</html>