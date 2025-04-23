<?php
session_start();
require '../models/dbconnection.php';

if (!isset($_SESSION['uid'])) {
    header("Location: login.php");
    exit();
}

$uid = $_SESSION['uid'];
$uname = $_SESSION['uname'];
$fname = $_SESSION['fname'];
$lname = $_SESSION['lname'];

// Fetch avatar from DB
$con = create_connection();
$stmt = $con->prepare("SELECT avatar FROM user WHERE uid = ?");
$stmt->bind_param("i", $uid);
$stmt->execute();
$stmt->bind_result($avatar);
$stmt->fetch();
$stmt->close();

// Fetch purchase history
$purchases_stmt = $con->prepare("
    SELECT pr.name, pr.price, p.purchase_date 
    FROM purchases p 
    JOIN products pr ON p.product_id = pr.id 
    WHERE p.uid = ? 
    ORDER BY p.purchase_date DESC
");
$purchases_stmt->bind_param("i", $uid);
$purchases_stmt->execute();
$purchases_result = $purchases_stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title><?php echo htmlspecialchars($uname); ?>'s Profile | ASCH</title>
  <link href="style/profile.css" rel="stylesheet" type="text/css"/>
  </head>
<body>
  <header>
    <div class="logo">👤 PROFILE</div>
    <nav class="top-nav">
      <a href="index.php">Home 🏠</a>
    </nav>
  </header>
  
  <main class="profile-container">
    <div class="profile-header">
      <img src="media/<?php echo htmlspecialchars($avatar); ?>" alt="User Avatar" class="avatar">
      <div class="user-info">
        <p><strong>Name:</strong> <?php echo htmlspecialchars($fname . ' ' . $lname); ?></p>
        <p><strong>Username:</strong> <?php echo htmlspecialchars($uname); ?></p>
        <p><strong>User ID:</strong> <?php echo htmlspecialchars($uid); ?></p>
      </div>
    </div>

    <div class="profile-actions">
      <a href="edit_profile.php" class="btn">✏️ Edit Profile</a>
      <a href="login_page/index.php" class="btn btn-secondary">📤 Change Profile</a>
    </div>

    <div class="purchase-history">
      <h3>🧾 Purchase History</h3>
      <ul>
        <?php if ($purchases_result->num_rows > 0): ?>
          <?php while ($item = $purchases_result->fetch_assoc()): ?>
            <li>
              <?php echo htmlspecialchars($item['name']); ?> — ₱<?php echo $item['price']; ?> 
              <small>(<?php echo $item['purchase_date']; ?>)</small>
            </li>
          <?php endwhile; ?>
        <?php else: ?>
          <li>No purchases yet.</li>
        <?php endif; ?>
      </ul>
    </div>
  </main>

  <footer>
    <p>&copy; 2025 ASCH Anime Hub. All rights reserved.</p>
  </footer>
</body>
</html>
