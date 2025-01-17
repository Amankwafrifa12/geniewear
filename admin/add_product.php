<?php
session_start();
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];
    $image = $_FILES['image']['name'];

    // Upload image
    move_uploaded_file($_FILES['image']['tmp_name'], "../images/$image");

    $stmt = $pdo->prepare('INSERT INTO products (name, description, price, category_id, image) VALUES (?, ?, ?, ?, ?)');
    $stmt->execute([$name, $description, $price, $category_id, $image]);

    echo "Product added successfully.";
}
?>

<form method="POST" enctype="multipart/form-data">
    <label for="name">Name:</label>
    <input type="text" name="name" required>
    <label for="description">Description:</label>
    <textarea name="description" required></textarea>
    <label for="price">Price:</label>
    <input type="text" name="price" required>
    <label for="category_id">Category:</label>
    <select name="category_id" id="category_id" required>
        <option selected disabled>Select Category</option>
        <?php
        $categories = $pdo->query('SELECT * FROM categories')->fetchAll(PDO::FETCH_ASSOC);
        foreach ($categories as $category) {
            echo "<option value=\"{$category['id']}\">{$category['name']}</option>";
        }
        ?>

    </select>

    <label for="image">Image:</label>
    <input type="file" name="image" required>
    <button type="submit">Add Product</button>
</form>