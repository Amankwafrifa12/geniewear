<?php

include 'includes/db.php';
include 'includes/header.php';

$query = $pdo->query('SELECT * FROM products');
$products = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="products">
    <?php foreach ($products as $product): ?>
        <div class="product">
            <img src="images/<?php echo htmlspecialchars($product['image']); ?>"
                alt="<?php echo htmlspecialchars($product['name']); ?>">
            <h2><?php echo htmlspecialchars($product['name']); ?></h2>
            <p><?php echo htmlspecialchars($product['description']); ?></p>
            <p>$<?php echo htmlspecialchars($product['price']); ?></p>
            <a href="product.php?id=<?php echo $product['id']; ?>">View Details</a>
        </div>
    <?php endforeach; ?>
</div>

<?php include 'includes/footer.php'; ?>