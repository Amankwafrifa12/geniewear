<?php

include 'includes/db.php';
include 'includes/header.php';

$query = $pdo->query('SELECT * FROM products');
$products = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>GenieWear - Clothing and Apparel Brand</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body>


    <main>

        <main>
            <div class="container">

                <div class="products-grid">
                    <?php
                    // Include database connection
                    include 'includes/db.php';

                    // Fetch products from the database
                    $products = $pdo->query('SELECT * FROM products')->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($products as $product): ?>
                    <div class="product-card"
                        onclick='window.location.href="product.php?id=<?php echo $product['id']; ?>"'>
                        <img src="images/<?php echo htmlspecialchars($product['image']); ?>"
                            alt="<?php echo htmlspecialchars($product['name']); ?>">
                        <h2><?php echo htmlspecialchars($product['name']); ?></h2>
                        <p>¢<?php echo number_format($product['price'], 2); ?></p>

                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <?php include 'includes/footer.php'; ?>