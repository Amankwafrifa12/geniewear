<?php
session_start();
include '../includes/db.php';

$product_id = $_GET['id'];
$stmt = $pdo->prepare('SELECT * FROM products WHERE id = ?');
$stmt->execute([$product_id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<h1>Edit Product</h1>
<form action="edit_product.php?id=<?php echo $product['id']; ?>" method="POST">
    <label for="name">Product Name:</label>
    <input type="text" id="name" name="name" value="<?php echo $product['name']; ?>" required><br>
    <label for="description">Description:</label>
    <textarea id="description" name="description" required><?php echo $product['description']; ?></textarea><br>
    <label for="price">Price:</label>
    <input type="number" id="price" name="price" value="<?php echo $product['price']; ?>" required><br>
    <label for="category_id">Category:</label>

    <select id="category_id" name="category_id" required>
        <?php
        $categories = $pdo->query('SELECT * FROM categories')->fetchAll(PDO::FETCH_ASSOC);
        foreach ($categories as $category) {
            echo "<option value=\"{$category['id']}\" " . ($product['category_id'] == $category['id'] ? 'selected' : '') . ">{$category['name']}</option>";
        }
        ?>
    </select><br>
    <button type="submit">Update Product</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];

    $stmt = $pdo->prepare('UPDATE products SET name = ?, description = ?, price = ?, category_id = ? WHERE id = ?');
    $stmt->execute([$name, $description, $price, $category_id, $product_id]);

    echo "Product updated successfully.";
}
?>