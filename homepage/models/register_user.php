<?php
require 'dbconnection.php';

$un = htmlspecialchars($_POST['uname']);
$fn = htmlspecialchars($_POST['fname']);
$ln = htmlspecialchars($_POST['lname']);
$em = htmlspecialchars($_POST['email']);
$gender = htmlspecialchars($_POST['gender']);
$bdate = htmlspecialchars($_POST['bdate']);
$pass = htmlspecialchars($_POST['pass']);
$cpass = htmlspecialchars($_POST['conpass']);

$con = create_connection();

if ($con->connect_error) {
    die("Connection Failed: " . $con->connect_error);
}

// Check if username exists
$sql_uname = "SELECT * FROM user WHERE uname = ?";
$stmt_uname = $con->prepare($sql_uname);
$stmt_uname->bind_param("s", $un);
$stmt_uname->execute();
$result_uname = $stmt_uname->get_result();
$uname_error = ($result_uname->num_rows > 0) ? 1 : 0;

// Check if email exists
$sql_email = "SELECT * FROM user WHERE email = ?";
$stmt_email = $con->prepare($sql_email);
$stmt_email->bind_param("s", $em);
$stmt_email->execute();
$result_email = $stmt_email->get_result();
$email_error = ($result_email->num_rows > 0) ? 1 : 0;

// Validate password match
$password_error = (strcmp($pass, $cpass) != 0) ? 1 : 0;

// If no errors, insert user into database
if ($uname_error == 0 && $email_error == 0 && $password_error == 0) {
    // Hash the password before inserting
    $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

    $sql_insert = "INSERT INTO user (uname, firstname, lastname, email, gender, birthdate, password) 
                   VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt_insert = $con->prepare($sql_insert);
    $stmt_insert->bind_param("sssssss", $un, $fn, $ln, $em, $gender, $bdate, $hashed_pass);
    
    if ($stmt_insert->execute()) {
        header("location: ../login.php?regsuccess=1");
        exit();
    } else {
        echo "Error: " . $stmt_insert->error;
    }
} else {
    // Redirect with correct parameter formatting
    header("location: ../registration.php?uname_error=$uname_error&email_error=$email_error&pas_error=$password_error");
    exit();
}

$stmt_uname->close();
$stmt_email->close();
$con->close();
?>