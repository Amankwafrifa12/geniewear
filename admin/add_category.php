<?php
session_start();
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];

    $stmt = $pdo->prepare('INSERT INTO categories (name) VALUES (?)');
    $stmt->execute([$name]);

    echo "Category added successfully.";
}
?>

<h1>Add Category</h1>
<form action="add_category.php" method="POST">
    <label for="name">Category Name:</label>
    <input type="text" id="name" name="name" required><br>
    <button type="submit">Add Category</button>
</form>