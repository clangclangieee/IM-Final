<?php
session_start();
require '../models/dbconnection.php';


// Check if the user is logged in
if (!isset($_SESSION['uid'])) {
    header("Location: ../login.php");
    exit();
}

$con = create_connection();
$uid = $_SESSION['uid'];

// Fetch products from the database
$sql = "SELECT id, name, price, image FROM products";
$products = $con->query($sql);

// Handle SQL error
if (!$products) {
    die("Query Failed: " . $con->error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>ASCH Store</title>
    <link href="style/tindahan.css" rel="stylesheet" type="text/css"/>
</head>
<body>
    <header>
        <h1>Welcome to the ASCH Store</h1>
        <nav>
            <a href="index.php">🏠 Home</a>
            <a href="profile.php">👤 Profile</a>
        </nav>
    </header>

    <main class="store-container">
        <?php if ($products->num_rows > 0): ?>
            <div class="product-grid">
                <?php while ($row = $products->fetch_assoc()): ?>
                    <div class="product-card">
                        <img src="media/<?php echo htmlspecialchars($row['image']); ?>" alt="Product Image">
                        <h3><?php echo htmlspecialchars($row['name']); ?></h3>
                        <p>₱<?php echo number_format($row['price'], 2); ?></p>
                        <form action="purchase.php" method="POST">
                            <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                            <button type="submit" class="buy-btn">Buy Now</button>
                        </form>
                        
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p>No products available right now. Please check back later.</p>
        <?php endif; ?>
    </main>
    <?php if (isset($_SESSION['success'])): ?>
    <div class="bg-green-200 text-green-800 p-4 rounded mb-6 text-center">
        <?= $_SESSION['success']; unset($_SESSION['success']); ?>
    </div>
<?php endif; ?>


    <footer>
        <p>&copy; 2025 ASCH Store. All rights reserved.</p>
    </footer>
</body>
</html>
