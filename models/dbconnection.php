<?php
function create_connection() {
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "socmed_lastimosa"; // Ensure this matches phpMyAdmin

    $conn = new mysqli($host, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}
?>