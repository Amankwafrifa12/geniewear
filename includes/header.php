<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<header>
    <div class="logo-container" onclick="window.location.href='index.php';">
        <img src="./images/GenieWear2.png" alt="GenieWear Logo" class="logo">
    </div>
    <div class="hamburger" onclick="toggleMenu()">
        <i class="fas fa-bars"></i>
    </div>
    <nav id="nav-links">
        <a href="index.php"><i class="fas fa-home"></i> Home</a>
        <a href="cart.php" class="cart-icon">
            <i class="fas fa-shopping-cart"></i>
            <?php include 'cart-data.php'; ?>

        </a>
        <?php
        if (isset($_SESSION['user_id'])): ?>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
        <?php else: ?>
        <a href="login.php"><i class="fas fa-sign-in-alt"></i> Login</a>
        <a href="signup.php"><i class="fas fa-user-plus"></i> Sign Up</a>
        <?php endif; ?>
    </nav>
</header>

<script>
function toggleMenu() {
    const nav = document.getElementById('nav-links');
    nav.classList.toggle('show');
}
</script>