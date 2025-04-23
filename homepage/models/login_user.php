<?php
session_start();
require 'dbconnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $un = htmlspecialchars($_POST['uname']);
    $pass = htmlspecialchars($_POST['pass']);

    $con = create_connection();

    if ($con->connect_error) {
        die("Connection Failed: " . $con->connect_error);
    }

    $uname_error = 0;

    // Use prepared statement to prevent SQL injection
    $sql = "SELECT * FROM user WHERE uname = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $un);  // "s" means string type
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        
        // Verify password (if stored as hashed)
        if (password_verify($pass, $row['password'])) {
            $_SESSION['uid'] = $row['uid'];
            $_SESSION['uname'] = $row['uname'];
            $_SESSION['fname'] = $row['firstname'];
            $_SESSION['lname'] = $row['lastname'];

            header('location: ../homepage/index.php');
            exit();
        } else {
            echo "Invalid username or password!";
        }
    } else {
        echo "Invalid username or password!";
    }

    $stmt->close();
    $con->close();
}
?>