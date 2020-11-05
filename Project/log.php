<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: TeamSelection.php");
    exit;
}
 
// Include config file
require_once "db.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
        header("Location: log.php?enterusername");
        die();
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
        header("Location: log.php?enterpassword");
        die();
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT username, pwduser FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                           // header("location: update.html");
                           echo '<script>
                           alert("Successful Login");
                           location.href="Team/team.html";
                           </script>';
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                            echo '<script>
                            alert("Wrong password entered");
                            </script>';
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                    echo '<script>
                            alert("Username doesnt exist");
                            </script>';
                            $_SESSION = array();
 
                            // Destroy the session.
                           session_destroy();
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
<html>
<head>
<title>Log in</title> 

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body{
margin: 0;
padding: 0;
height: 400% 400%;
background: url(pl.jpg);
background-size: cover;
background-position :center;
font-family: sans-serif;
}
.logindex{
margin-top: 50px;
width: 23%;
height: 62%;
background: #000;
color: #fff;
position: absolute;
margin-left: 38%;
margin-top: 5%;
box-sizing: border-box;
padding: 70px 30px;
}
.avatar{
width: 100px;
height: 100px;
border-radius: 50%;
position: absolute;
top: -50px;
left: 110px;
}
h1{
margin: 0;
padding: 0 0 20px;
text-align: center;
font-size: 22px;
}
.logindex p{
margin: 0;
padding: 0;
font-weight: bold;
}
.logindex input{
width: 100%;
margin-bottom:20px;
}
.logindex input[type="text"], input[type="password"]
{
border:none;
border-bottom:1px solid #fff;
background: transparent;
outline: none;
height: 40px;
color: #fff;
font-size: 16px;
}
.logindex input[type="submit"]
{
border: none;
outline: none;
height: 40px;
background: #fb2525;
color: #fff;
font-size: 18px;
border-radius:20px;
}
.logindex input[type="submit"]:hover
{
cursor: pointer;
background: Yellow;
color: White;
}
.logindex a{
text-decoration: none;
font-size: 12px;
line-height: 20px;
color: darkgrey;
}
.logindex a:hover
{
color: lightblue;
}
header{
    height: 10vh;
}

ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
}

li {
  float: left;

}

li a {
  display: block;
  color: white;
  font-size: 1.3em;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  position: absolute;
  margin-left: 0%;

}

li a:hover {
  color: cyan;
}
.nav1
{
    margin: 0%;
    background-color: black;
    height: 100%;
}
.nav2
{

    width: 70%;
    height: 100%;
  display: flex;
          justify-content: space-between;
}

.logo
{
    height: 100%;
    width: 100px;
    border-radius: 0 50%  50% 0%;
}

.active
{
    color: lightgreen;
}

#Cap {
            width: 20px;
            height: 20px;
            text-align: center;
            position: relative;
            margin-top: 7px;
            margin-left: 100px;
            margin-bottom: 7px;
        }

        footer
{
    position: absolute;
    height: 10vh;
    width: 100%;
}

.foot
{
    background-color: #000;
    height: 100%;
    width: 100%;
    margin: 0;
}
.foot p
{
    margin-left: 42%;
    color: white;
    font-size: 1.3em;
  text-shadow: 2px 2px 4px red;
}
.foot a
{
    margin-left: 49%;
    color: white;
    font-size: 1.3em;
    position: absolute;
    margin-top: -1%;
}

main{
margin-top:50px;
height: 80vh;
}
</style>
</head>
<body>
<header >
    <div class="nav1">
        <div class="nav2">
            <img src="logo.jpg" class="logo">
            <li>
                <a href="index.php">HOME</a>
            </li>
            <li>
                <a href="sign.php">SIGNUP</a>
            </li>
            <li>
                <a href="log.php" class="active">LOGIN</a>
            </li>
        </div>
    </div>
</header>
<main>
<div class="logindex">
<img src="avatar.jpg" class="avatar">
<h1>Login Here</h1>
<form action="log.php" method="post" onsubmit="return validate()" name="form1" >
<p>Username (*):</p>
<input type="text" name="username" placeholder="Enter the Username" pattern="[a-zA-Z]{1}[a-zA-Z0-9]{1,10}" required>
<p>Password (*):</p>
<input type="password" name="password" placeholder="Enter Password" minlength="8" maxlength="20" required>
<p>Captcha :</p>
                <div id="Cap">
                    <p></p>
                </div>
                <p>Enter Captcha (*):</p>
                <input type="text" name="cap" minlength="1" maxlength="7" pattern="[0-9a-zA-Z]{1,7}"
                    placeholder="Enter the Captcha here" required>
                    
<input type="submit" name="" value="Login"> 
<a href="sign.php">Don't have an account? Sign Up!</a>
</form>
</div>
</main>

<footer>
    <div class="foot">
        <p>Copyright © 2020 365Predict</p>
      <a href="https://github.com/Jas-077/SE_Project.git" target="_blank">
        <i class="fa fa-github" style="color: white;font-size: 2.0em;"></i>
        </a>
    </div>
</footer>
</body>
</head>
</html>
<script>
    var x = document.getElementById("Cap");
    var t = "";
    var z = Math.floor((Math.random() * (8 - 6)) + 6);
    var ran = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    for (var i = 0; i < z; i++) {
        t += ran[Math.floor(Math.random() * ran.length)];
    }
    x.innerHTML = t;
    function validate() {
        var a = document.forms["form1"]["cap"].value;
        if (a === t)
            ;
        else {
            alert("Invalid Captcha");
            return false;
        }
    }
</script>