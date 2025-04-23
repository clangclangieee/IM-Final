<?php
$host = "localhost";
$user = "root";
$password = ""; // default for XAMPP
$dbname = "socmed_lastimosa"; // 🔁 Replace with your actual DB name

$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
