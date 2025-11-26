<?php
include 'header.php';

// If no order was just made, redirect home
if(!isset($_SESSION['last_order'])) {
    header("Location: home.php");
    exit();
}

$order = $_SESSION['last_order'];
?>

<div class="success-card">
    <div class="checkmark">✔</div>
    <h2 style="color:#2ecc71; border:none;">Order Complete!</h2>
    <p>Thank you, <b><?php echo $_SESSION['user']; ?></b>.</p>
    <p>Your order for <b><?php echo $order['book']; ?></b> has been placed.</p>
    
    <hr style="margin: 20px 0; border: 0; border-top: 1px solid #eee;">
    
    <h3 style="color:#c0392b; font-size:18px;">⚠️ Security Algorithm Demo</h3>
    <p style="font-size:13px; color:#7f8c8d;">Here is how your data was saved in the database using the 6x6 Playfair Cipher:</p>
    
    <div class="data-box">
        <p><b>Original Input:</b> <?php echo $order['original_card']; ?></p>
        <p>--------------------------------</p>
        <p><b>[DATABASE] Encrypted Card:</b><br>
        <?php echo $order['encrypted_card']; ?></p>
        <p><b>[DATABASE] Encrypted CVV:</b><br>
        <?php echo $order['encrypted_cvv']; ?></p>
    </div>
    
    <a href="home.php"><button class="btn">Back to Home</button></a>
</div>

<?php 
// Clear the order from session so it doesn't show again on refresh
// unset($_SESSION['last_order']); 
include 'footer.php'; 
?>