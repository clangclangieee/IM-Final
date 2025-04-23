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
        <a href="index.php">Home</a>
      <a href="registration.php">Sign Up</a>
      <a href="more.php">More</a>
    </nav>
  </header>
    
<link href="res/login.css" rel="stylesheet" type="text/css"/>
<form id="loginform" action="models/login_user.php"  method="POST">
    <label for="uname">Username/Email</label>
    <input type="text" name="uname" id="uname" placeholder="Username/Email" required>

    <label for="pass">Password</label> 
    <input type="password" name="pass" id="pass" placeholder="Password" required> 

    <div id="signedin">
        <input type="checkbox" name="signedin" id="signedin" value="1">
        <label for="signedin">Keep me signed in</label> 
    </div>

    <input type="submit" value="Login"> 
</form> 
    <p>Don't have an account? <a href="registration.php">Register here</a></p>
</form>



            