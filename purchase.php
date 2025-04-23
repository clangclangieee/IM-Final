<?php
session_start();
require '../models/dbconnection.php';

if (!isset($_SESSION['uid'])) {
    header("Location: ../login.php");
    exit();
}

$con = create_connection();
$uid = $_SESSION['uid'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {
    $product_id = intval($_POST['product_id']);
    
    // Use the correct column name ('uid' instead of 'user_id')
    $sql = "INSERT INTO purchases (uid, product_id, purchase_date) VALUES (?, ?, NOW())";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ii", $uid, $product_id);
    
    if ($stmt->execute()) {
        header("Location: store.php?success=1");
        exit();
    } else {
        echo "Purchase failed: " . $con->error;
    }
} else {
    echo "Invalid request.";
}
?>
