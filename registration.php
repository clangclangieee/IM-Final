<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>ASCH - Anime Streaming And Community Hub</title>
  <link href="style/style.css" rel="stylesheet" type="text/css"/>
</head>
<body>
  <header>
    <div class="logo">ASCH</div>
    <nav>
        <a href="login.php">Log In</a>
      <a href="index.php">Home</a>
      <a href="more.php">More</a>
    </nav>
  </header>
    
<form id="loginform" action="models/register_user.php" method="POST">
    <h2>Register </h2>

    <!-- Username -->
    <label for="uname">Username</label>
    <input type="text" name="uname" id="uname" placeholder="Enter your username" required>

    <!-- Email -->
    <label for="email">Email</label>
    <input type="email" name="email" id="email" placeholder="Enter your email" required>

    <!-- First Name -->
    <label for="fname">First Name</label>
    <input type="text" name="fname" id="fname" placeholder="Enter your first name" required>

    <!-- Last Name -->
    <label for="lname">Last Name</label>
    <input type="text" name="lname" id="lname" placeholder="Enter your last name" required>

    <!-- Gender -->
    <label for="gender">Gender</label>
    <select name="gender" id="gender" required>
        <option value="">Select Gender</option>
        <option value="male">Male</option>
        <option value="female">Female</option>
        <option value="other">Other</option>
    </select>

    <!-- Birthdate -->
    <label for="bdate">Birthdate</label>
    <input type="date" name="bdate" id="bdate" required>

    <!-- Password -->
    <label for="pass">Password</label>
    <input type="password" name="pass" id="pass" placeholder="Enter password" required>

    <!-- Confirm Password -->
    <label for="conpass">Confirm Password</label>
    <input type="password" name="conpass" id="conpass" placeholder="Confirm password" required>

    <!-- EULA Agreement -->
    <div>
        <input type="checkbox" name="eula" id="eula" required>
        <label for="eula">I agree to the <a href="#">End-User License Agreement</a></label>
    </div>

    <!-- Register Button -->
    <input type="submit" value="Register">

    <!-- Already have an account? -->
    <p>Already have an account? <a href="login.php">Login here</a></p>
</form>
