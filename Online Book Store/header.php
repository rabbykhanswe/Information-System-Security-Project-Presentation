<?php
// SAFETY CHECK: Only start session if one isn't already running
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>SecureBook Store</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar">
        <a href="home.php" class="logo">📚 BookStore</a>
        <div class="nav-links">
            <a href="home.php">Home</a>
            <?php if(isset($_SESSION['user'])): ?>
                <a href="#">Hello, <?php echo htmlspecialchars($_SESSION['user']); ?></a>
                <a href="login.php?action=logout">Logout</a>
            <?php else: ?>
                <a href="login.php">Login</a>
                <a href="register.php">Register</a>
            <?php endif; ?>
        </div>
    </nav>
    
    <div class="container">