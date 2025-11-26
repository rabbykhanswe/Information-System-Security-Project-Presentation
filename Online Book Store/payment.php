<?php
include 'header.php';
include_once 'playfair_logic.php'; // Ensure this is the 6x6 version!
include 'db.php';

// Check if logged in
if(!isset($_SESSION['user'])) {
    echo "<script>alert('Please Login first!'); window.location='login.php';</script>";
    exit();
}

$book = isset($_GET['book']) ? $_GET['book'] : "Unknown Book";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $card_num = $_POST['card_num'];
    $cvv = $_POST['cvv'];
    $expiry = $_POST['expiry'];
    $book_name = $_POST['book_name']; // Get hidden book name
    
    // 1. ENCRYPT DATA (Using 6x6 Playfair - Supports Numbers)
    $enc_card = playfairEncrypt($card_num, $secret_key);
    $enc_cvv = playfairEncrypt($cvv, $secret_key);
    
    // 2. INSERT INTO DATABASE
    $sql = "INSERT INTO payments (book_name, card_number, cvv, expiry_date) VALUES ('$book_name', '$enc_card', '$enc_cvv', '$expiry')";
    
    if ($conn->query($sql) === TRUE) {
        // 3. STORE DATA IN SESSION FOR THE SUCCESS PAGE DEMO
        $_SESSION['last_order'] = [
            'book' => $book_name,
            'original_card' => $card_num, // Just for demo comparison
            'encrypted_card' => $enc_card,
            'encrypted_cvv' => $enc_cvv
        ];
        
        // 4. REDIRECT TO ORDER COMPLETE
        echo "<script>window.location='order_complete.php';</script>";
        exit();
    } else {
        $msg = "Error: " . $conn->error;
    }
}
?>

<div class="card" style="max-width: 500px;">
    <h2>Checkout</h2>
    <div class="alert" style="background: #e1f5fe;">
        <strong>Item:</strong> <?php echo $book; ?><br>
        <strong>Total:</strong> $50.00
    </div>

    <form method="post">
        <input type="hidden" name="book_name" value="<?php echo $book; ?>">

        <label>Card Number</label>
        <input type="text" name="card_num" placeholder="4500 1234 5678 9010" required>
        
        <div style="display:flex; gap:10px;">
            <div style="flex:1">
                <label>CVV</label>
                <input type="text" name="cvv" placeholder="123" required>
            </div>
            <div style="flex:1">
                <label>Expiry Date</label>
                <input type="text" name="expiry" placeholder="12/26" required>
            </div>
        </div>

        <button type="submit" class="btn" style="background:#27ae60;">Pay Now</button>
    </form>
    
    <div style="margin-top:10px; font-size:12px; color:#7f8c8d;">
        <p>🔒 Secure 6x6 Playfair Encryption Enabled</p>
    </div>
</div>

<?php include 'footer.php'; ?>