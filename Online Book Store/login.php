<?php
include 'header.php';
include_once 'playfair_logic.php';
include 'db.php';

// Handle Logout
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    session_destroy();
    header("Location: login.php");
    exit();
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $raw_password = $_POST['password'];

    // TO LOGIN: We must encrypt the input to match the stored cipher
    $encrypted_try = playfairEncrypt($raw_password, $secret_key);

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$encrypted_try'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['user'] = $username;
        header("Location: home.php");
    } else {
        $error = "Invalid Username or Password!";
    }
}
?>

<div class="card">
    <h2>Member Login</h2>
    <?php if($error) echo "<div class='alert' style='background:#ffcece; border-color:red;'>$error</div>"; ?>
    <form method="post">
        <label>Username</label>
        <input type="text" name="username" required>
        
        <label>Password</label>
        <input type="password" name="password" required>
        
        <button type="submit" class="btn">Log In</button>
    </form>
    <p style="margin-top:15px; text-align:center;">New user? <a href="index.php">Register here</a></p>
</div>

<?php include 'footer.php'; ?>