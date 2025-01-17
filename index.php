<?php

include 'includes/db.php';
include 'includes/header.php';

$query = $pdo->query('SELECT * FROM products');
$products = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="products-grid">
    <?php
    // Include database connection
    include 'includes/db.php';

    // Fetch products from the database
    $products = $pdo->query('SELECT * FROM products')->fetchAll(PDO::FETCH_ASSOC);

    foreach ($products as $product): ?>
        <div class="product-card">
            <img src="images/<?php echo htmlspecialchars($product['image']); ?>"
                alt="<?php echo htmlspecialchars($product['name']); ?>">
            <h2><?php echo htmlspecialchars($product['name']); ?></h2>
            <p>¢<?php echo number_format($product['price'], 2); ?></p>
            <a href="product.php?id=<?php echo $product['id']; ?>" class="btn"><i class="fas fa-info-circle"></i> View
                Details</a>
        </div>
    <?php endforeach; ?>
</div>
</div>

<?php include 'includes/footer.php'; ?>