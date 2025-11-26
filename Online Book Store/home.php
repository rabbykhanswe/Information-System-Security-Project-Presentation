<?php
// 1. Safe Session Start
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 2. THE GATEKEEPER
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit(); 
}

// 3. Load Header
include 'header.php'; 

// --- BOOK DATABASE (ARRAY) ---
// This list contains 20 unique books with specific online images
$books = [
    [
        "title" => "Cyber Security 101",
        "desc" => "Learn the basics of network defense.",
        "price" => "50.00",
        "img" => "https://images.unsplash.com/photo-1550751827-4bd374c3f58b?auto=format&fit=crop&w=500&q=60"
    ],
    [
        "title" => "PHP Web Mastery",
        "desc" => "Build secure dynamic websites.",
        "price" => "40.00",
        "img" => "https://images.unsplash.com/photo-1599507593499-a3f7d7d97667?auto=format&fit=crop&w=500&q=60"
    ],
    [
        "title" => "Algorithm Logic",
        "desc" => "Master Playfair, Sort, and Search.",
        "price" => "35.00",
        "img" => "https://images.unsplash.com/photo-1509228468518-180dd4864904?auto=format&fit=crop&w=500&q=60"
    ],
    [
        "title" => "Python for AI",
        "desc" => "Artificial Intelligence with Python.",
        "price" => "55.00",
        "img" => "https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?auto=format&fit=crop&w=500&q=60"
    ],
    [
        "title" => "Data Structures",
        "desc" => "Organize data efficiently.",
        "price" => "45.00",
        "img" => "https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=500&q=60"
    ],
    [
        "title" => "JavaScript Pro",
        "desc" => "Modern ES6+ development.",
        "price" => "38.00",
        "img" => "https://images.unsplash.com/photo-1579468118864-1b9ea3c0db4a?auto=format&fit=crop&w=500&q=60"
    ],
    [
        "title" => "SQL Injection",
        "desc" => "Database security deep dive.",
        "price" => "42.00",
        "img" => "https://images.unsplash.com/photo-1544383835-bda2bc66a55d?auto=format&fit=crop&w=500&q=60"
    ],
    [
        "title" => "Linux Command",
        "desc" => "Master the terminal shell.",
        "price" => "30.00",
        "img" => "https://images.unsplash.com/photo-1629654297299-c8506221ca97?auto=format&fit=crop&w=500&q=60"
    ],
    [
        "title" => "Cryptography",
        "desc" => "The science of secret codes.",
        "price" => "48.00",
        "img" => "https://images.unsplash.com/photo-1603899122634-f086ca5f5ddd?auto=format&fit=crop&w=500&q=60"
    ],
    [
        "title" => "React Native",
        "desc" => "Build mobile apps with JS.",
        "price" => "52.00",
        "img" => "https://images.unsplash.com/photo-1633356122544-f134324a6cee?auto=format&fit=crop&w=500&q=60"
    ],
    [
        "title" => "Machine Learning",
        "desc" => "Predictive models and data.",
        "price" => "65.00",
        "img" => "https://images.unsplash.com/photo-1555949963-ff9fe0c870eb?auto=format&fit=crop&w=500&q=60"
    ],
    [
        "title" => "Cloud Computing",
        "desc" => "AWS, Azure, and Google Cloud.",
        "price" => "58.00",
        "img" => "https://images.unsplash.com/photo-1451187580459-43490279c0fa?auto=format&fit=crop&w=500&q=60"
    ],
    [
        "title" => "Blockchain",
        "desc" => "Decentralized ledger tech.",
        "price" => "70.00",
        "img" => "https://images.unsplash.com/photo-1621761191319-c6fb62004040?auto=format&fit=crop&w=500&q=60"
    ],
    [
        "title" => "C++ Gaming",
        "desc" => "Game development engines.",
        "price" => "44.00",
        "img" => "https://images.unsplash.com/photo-1552820728-8b83bb6b773f?auto=format&fit=crop&w=500&q=60"
    ],
    [
        "title" => "Java Enterprise",
        "desc" => "Robust backend systems.",
        "price" => "46.00",
        "img" => "https://images.unsplash.com/photo-1517694712202-14dd9538aa97?auto=format&fit=crop&w=500&q=60"
    ],
    [
        "title" => "Deep Learning",
        "desc" => "Neural networks explained.",
        "price" => "62.00",
        "img" => "https://images.unsplash.com/photo-1507146426996-ef05306b995a?auto=format&fit=crop&w=500&q=60"
    ],
    [
        "title" => "Dark Web",
        "desc" => "Understanding hidden services.",
        "price" => "49.00",
        "img" => "https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?auto=format&fit=crop&w=500&q=60"
    ]
];
?>

<div style="text-align:center; margin-bottom:30px;">
    <h1 style="color:#2c3e50;">Welcome to SecureBook Store</h1>
    <p>Select a book to purchase.</p>
</div>

<div class="book-grid">
    <?php foreach($books as $book): ?>
        <div class="book-card">
            <img src="<?php echo $book['img']; ?>" class="book-img" alt="<?php echo $book['title']; ?>">
            <div class="book-info">
                <h3><?php echo $book['title']; ?></h3>
                <p><?php echo $book['desc']; ?></p>
                <p style="font-weight:bold; color:#e74c3c;">$<?php echo $book['price']; ?></p>
                <a href="payment.php?book=<?php echo urlencode($book['title']); ?>">
                    <button class="btn">Buy Now</button>
                </a>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php include 'footer.php'; ?>