<?php
session_start();
require '../models/dbconnection.php';

if (!isset($_SESSION['uid'])) {
  header('Location: ../login.php');
  exit();
}

$uid = $_SESSION['uid'];
$con = create_connection();
$sql = "SELECT avatar, firstname, lastname FROM user WHERE uid = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $uid);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$avatar = !empty($user['avatar']) ? $user['avatar'] : 'default.jpg';
$fullname = htmlspecialchars($user['firstname'] . ' ' . $user['lastname']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>ASCH - Anime Streaming And Community Hub</title>
  <link href="style/style.css" rel="stylesheet" type="text/css"/>
</head>
<body>
 <header>
  <div class="logo">ASCH</div>

  <div class="search-bar">
    <input type="text" placeholder="Search anime..." />
    <button>🔍</button>
  </div>

  <nav class="top-nav">
    <a href="store.php">ANI STORE</a>
  </nav>
  <div class="menu-container">
    <div class="profile-toggle">
      <!-- Reversed Order: Toggle Icon First, Avatar Second -->
      <div class="toggle-icon" onclick="toggleProfileMenu()">☰</div>
      <img src="../media/<?php echo htmlspecialchars($avatar); ?>" alt="User Avatar" class="avatar">
      <span class="profile-name"><?php echo $fullname; ?></span>

      <div class="profile-menu" id="profileMenu">
        <a href="profile.php" class="menu-btn">Profile Account</a>
        <a href="#" class="menu-btn">Settings ▼</a>

        <div class="toggle-item">
          <label for="darkModeSwitch">Dark Mode</label>
          <input type="checkbox" id="darkModeSwitch" onchange="toggleDarkMode()">
        </div>

        <div class="toggle-item">
          <label for="aboutSwitch">About this Website</label>
          <input type="checkbox" id="aboutSwitch">
        </div>

        <a href="../index.php" class="menu-btn logout">Log Out</a>
      </div>
    </div>
  </div>

  <script>
    function toggleProfileMenu() {
      const menu = document.getElementById("profileMenu");
      menu.style.display = menu.style.display === "flex" ? "none" : "flex";
    }

    function toggleDarkMode() {
      document.body.classList.toggle("dark-mode");
    }

    document.addEventListener("click", function (event) {
      const menu = document.getElementById("profileMenu");
      const icon = document.querySelector(".toggle-icon");
      if (!menu.contains(event.target) && !icon.contains(event.target)) {
        menu.style.display = "none";
      }
    });
  </script>
</header>



  <div class="sub-nav">
    <a href="selection/all.php">All</a>
    <a href="selection/horror.php">Horror</a>
    <a href="selection/fantasy.php">Adventure</a>
    <a href="selection/isekai.php">Isekai</a>
    <a href="selection/romance.php">Romance</a>
    <a href="selection/scifi.php">Sci-fi</a>
    <a href="selection/mecha.php">Mecha</a>
    <a href="selection/ecchi.php">Ecchi</a>
  </div>
</body>
</html>
