<?php

require_once "db.php";
 
// Define variables and initialize with empty values
$username = $password =  $email= $name="";
$username_err = $password_err = $email_err= $name="";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
        header("Location: sign.php?emptyusername");
        die();
    } else{
        // Prepare a select statement
        $sql = "SELECT * FROM accounts.users WHERE username = ?;";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                    echo '<script>
                alert("Username already taken");
                </script>';
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";
        header("Location: sign.php?emptypassword");     
        die();
    } elseif(strlen(trim($_POST["password"])) < 5){
        $password_err = "Password must have atleast 5 characters.";
        header("Location: sign.php?passwordmusthaveatleast5characters");
        die();
    } else{
        $password = trim($_POST["password"]);
        $password=password_hash($password, PASSWORD_DEFAULT);
    }
    
    $name=trim($_POST["name"]);
    $email=trim($_POST["email"]);
    
    // Check input errors before inserting in database
    if(empty($username) && empty($password)  && empty($name) && empty($email)){
     echo "Empty fields";
     header("Location: sign.php?emptyfields");
     die();
}
        Else
{

        // Prepare an insert statement
        $sql = "INSERT INTO accounts.users (username,name,email,pwduser) VALUES ('$username', '$name', '$email', '$password')";
        $sql2="Insert into accounts.teams (username2) values('$username');";
 mysqli_query($link,$sql);
        mysqli_query($link,$sql2);
            header("Location: log.php?registrationsuccessful");
        }

    
    // Close connection
    mysqli_close($link);
}
?>
<html>
<head>
<title>Sign Up</title> 

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
width: 23%;
height: 72%;
background: #000;
color: #fff;
position: absolute;
margin-left: 38%;
margin-top: 3%;
box-sizing: border-box;
padding: 70px 30px;
}
.avatar{
width: 100px;
height: 100px;
border-radius: 50%;
position: absolute;
top: -50px;
left: 35%;
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
.logindex input[type="text"], input[type="password"] ,input[type="Date"]
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
<body>
<header >
    <div class="nav1">
        <div class="nav2">
            <img src="logo.jpg" class="logo">
            <li>
                <a href="index.php">HOME</a>
            </li>
            <li>
                <a href="sign.php" class="active">SIGNUP</a>
            </li>
            <li>
                <a href="log.php">LOGIN</a>
            </li>
        </div>
    </div>
</header>
<main>
<div class="logindex">
<img src="avatar.jpg" class="avatar">
<h1>Sign Up</h1>
<form action="sign.php" method="post" onsubmit="return validate()">
<p>Full name (*):</p>
<input type="text" name="name" placeholder="Enter the Full name" minlength="1" maxlength="30" required pattern="[A-Z]{1}[ A-Za-z]{1,30}">
<p>Username (*):</p>
<input type="text" name="username" placeholder="Enter the Username" minlength="1" maxlength="30" required>
<label for="email">Email (*):</label><br>
<input type="text" name="email" pattern="[a-zA-z]{1,}[.]{0,1}[a-zA-z0-9]{0,}[@][a-z]{1,10}[.][a-zA-z]{2,3}"
                    placeholder="Enter your valid email-id" required>
<p>Password (*):</p>
<input type="password" name="password" minlength="8" maxlength="20" placeholder="Enter a strong Password"
                    required>
<p>Confirm Password (*):</p>
<input type="password" name="pass2" minlength="8" maxlength="20" placeholder="Enter the above Password"
                    required>
<input type="submit" name="" value="Sign Up"> 
<a href="log.php">Already have an account? Log in!</a>
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
    function validate() {
        var x = document.forms["form1"]["passwprd"].value;
        var y = document.forms["form1"]["pass2"].value;
        var strongRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
        if (strongRegex.test(x)) {
            if (x != y) {
                alert("Pls Enter the correct password in Confirm password option");
                return false;
            }
        }
        else {
            alert("The entered Password is not strong enough");
            return false;
        }
    }
</script>
