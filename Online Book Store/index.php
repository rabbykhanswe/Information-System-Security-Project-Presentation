<?php
include 'header.php';
include_once 'playfair_logic.php';
include 'db.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $raw_password = $_POST['password'];
    $raw_security = $_POST['security_q'];

    // ENCRYPT DATA
    $encrypted_pass = playfairEncrypt($raw_password, $secret_key);
    $encrypted_sec = playfairEncrypt($raw_security, $secret_key);

    $sql = "INSERT INTO users (username, password, security_ans) VALUES ('$username', '$encrypted_pass', '$encrypted_sec')";

    if ($conn->query($sql) === TRUE) {
        // UPDATED SUCCESS MESSAGE WITH BOTH FIELDS
        $message = "<b>Registration Successful!</b><br>";
        $message .= "Data saved to Database:<br>";
        $message .= "Encrypted Password: <span style='color:red; font-weight:bold;'>$encrypted_pass</span><br>";
        $message .= "Encrypted Security Ans: <span style='color:red; font-weight:bold;'>$encrypted_sec</span>";
    } else {
        $message = "Error: " . $conn->error;
    }
}
?>

<div class="card">
    <h2>Create Account</h2>
    <?php if($message) echo "<div class='alert'>$message</div>"; ?>
    <form method="post">
        <label>Username</label>
        <input type="text" name="username" required>
        
        <label>Password (A-Z, 0-9)</label>
        <input type="password" name="password" placeholder="Password" required>
        
        <label>Security Question: Pet's Name? (A-Z, 0-9)</label>
        <input type="text" name="security_q" placeholder="Answer" required>
        
        <button type="submit" class="btn">Register</button>
    </form>
    <p style="margin-top:15px; text-align:center;">Already have an account? <a href="login.php">Login here</a></p>
</div>

<?php include 'footer.php'; ?>