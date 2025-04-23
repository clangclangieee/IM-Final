<?php
session_start();
require '../models/dbconnection.php'; // Ensure correct path to dbconnection.php

// Check if user is logged in
if (!isset($_SESSION['uid'])) {
    header('Location: login.php');
    exit();
}

$con = create_connection(); // Use the function from dbconnection.php

// Get current user ID
$uid = $_SESSION['uid'];

$success_message = '';
$error_message = '';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_fname = htmlspecialchars($_POST['fname']);
    $new_lname = htmlspecialchars($_POST['lname']);
    $new_uname = htmlspecialchars($_POST['uname']);
    $new_pass = !empty($_POST['pass']) ? password_hash($_POST['pass'], PASSWORD_DEFAULT) : null;

    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    // Update user info (update password only if provided)
    if ($new_pass) {
        $sql = "UPDATE user SET firstname=?, lastname=?, uname=?, password=? WHERE uid=?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ssssi", $new_fname, $new_lname, $new_uname, $new_pass, $uid);
    } else {
        $sql = "UPDATE user SET firstname=?, lastname=?, uname=? WHERE uid=?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("sssi", $new_fname, $new_lname, $new_uname, $uid);
    }

    if ($stmt->execute()) {
        // Update session values
        $_SESSION['uname'] = $new_uname;
        $_SESSION['fname'] = $new_fname;
        $_SESSION['lname'] = $new_lname;
        $success_message = "Profile updated successfully!";
    } else {
        $error_message = "Error updating profile. Please try again.";
    }

    $stmt->close();
}

// Fetch current data for display
$sql = "SELECT * FROM user WHERE uid=?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $uid);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>ASCH - Anime Hub</title>
  <link href="style.css" rel="stylesheet" />
  <link href="style/style.css" rel="stylesheet" type="text/css"/>
</head>
<body>
  <header>
    <div class="menu-icon">☰</div>
    <div class="logo">ASCH</div>
    <div class="search-bar">
      <input type="text" placeholder="Search anime..." />
      <button>🔍</button>
    </div>
    <nav class="top-nav">
    
      <a href="profile.php">←Back</a>
    </nav>
  </header>
    <main class="profile-container">
        <div class="profile-card">
            <?php if ($success_message): ?>
                <p class="success"><?php echo $success_message; ?></p>
            <?php elseif ($error_message): ?>
                <p class="error"><?php echo $error_message; ?></p>
            <?php endif; ?>

            <form method="POST">
                <label>First Name:</label>
                <input type="text" name="fname" value="<?php echo htmlspecialchars($user['firstname']); ?>" required>

                <label>Last Name:</label>
                <input type="text" name="lname" value="<?php echo htmlspecialchars($user['lastname']); ?>" required>

                <label>Username:</label>
                <input type="text" name="uname" value="<?php echo htmlspecialchars($user['uname']); ?>" required>

                <label>New Password (leave blank to keep current):</label>
                <input type="password" name="pass" placeholder="Enter new password">

                <button type="submit">Save Changes</button>
            </form>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 AnimeList. All rights reserved.</p>
    </footer>
</body>
</html>
