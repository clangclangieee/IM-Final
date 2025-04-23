<?php
session_start();
require '../models/dbconnection.php';


if (!isset($_SESSION['uid'])) {
    header('Location: ../login.php');
    exit();
}

$con = create_connection();
$uid = $_SESSION['uid'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fname = htmlspecialchars($_POST['firstname']);
    $lname = htmlspecialchars($_POST['lastname']);
    $avatar = $_FILES['avatar'];

    $avatar_name = basename($avatar['name']);
    $target_path = "../media/" . $avatar_name;

    if (move_uploaded_file($avatar['tmp_name'], $target_path)) {
        $sql = "UPDATE user SET firstname = ?, lastname = ?, avatar = ? WHERE uid = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("sssi", $fname, $lname, $avatar_name, $uid);
        $stmt->execute();

        $_SESSION['fname'] = $fname;
        $_SESSION['lname'] = $lname;

        header("Location: index.php");
        exit();
    } else {
        $error = "Failed to upload avatar.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Complete Your Profile</title>
</head>
<body>
    <h2>Set Up Your Profile</h2>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST" enctype="multipart/form-data">
        <label>First Name:</label><br>
        <input type="text" name="firstname" required><br><br>

        <label>Last Name:</label><br>
        <input type="text" name="lastname" required><br><br>

        <label>Avatar:</label><br>
        <input type="file" name="avatar" accept="image/*" required><br><br>

        <button type="submit">Save Profile</button>
    </form>
</body>
</html>
<link href="style/style.css" rel="stylesheet" type="text/css"/>