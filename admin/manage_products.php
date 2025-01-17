<?php
session_start();
include '../includes/db.php';

// Fetch products
$query = $pdo->query('SELECT * FROM products');
$products = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<h1>Manage Products</h1>
<a href="add_product.php">Add New Product</a>
<a href="add_category.php">Add Category</a>
<table>
    <tr>
        <th>Name</th>
        <th>Price</th>
        <th>Category</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($products as $product): ?>
    <tr>
        <td><?php echo htmlspecialchars($product['name']); ?></td>
        <td>¢<?php echo htmlspecialchars($product['price']); ?></td>
        <td><?php echo htmlspecialchars($product['category_id']); ?></td>
        <td>
            <a href="edit_product.php?id=<?php echo $product['id']; ?>">Edit</a>
            <a href="delete_product.php?id=<?php echo $product['id']; ?>">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>