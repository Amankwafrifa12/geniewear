<?php
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        echo "Login successful.";

        header('Location: index.php');
        exit;
    } else {
        echo "Invalid email or password.";
    }
}
?>

<form method="POST">
    <label for="email">Email:</label>
    <input type="email" name="email" required autocomplete="off">
    <label for="password">Password:</label>
    <input type="password" name="password" required autocomplete="off">
    <button type="submit">Login</button>
</form>