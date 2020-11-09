<?php
require_once "db.php";

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
use PHPMailer\PHPMailer\PHPMailer;

/* If you installed PHPMailer without Composer do this instead: */

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
// Check connection
if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $a = $_POST["pass1"];
    $sql2 = "select * from otp_con";
    $result = mysqli_query($link, $sql2);
    $row = mysqli_fetch_array($result);
    $mail = $row["mail"];
    $a = password_hash($a, PASSWORD_DEFAULT);
    $sql1 = "UPDATE users SET pwduser='$a' WHERE email='$mail'";
    mysqli_query($link, $sql1);
    $sql3 = "DELETE FROM otp_con WHERE mail='$mail'";
    mysqli_query($link, $sql3);
    echo '<script>
    alert("Password Successfully Changed 👍. Pls login with the new credentials.");
    location.href="log.php";
    </script>';
}
?>
<html>
    <head> 
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<title>Forget Password</title>
<style>
    body {
        margin: 0;
padding: 0;
height: 400% 400%;
background-image: linear-gradient(45deg, rgb(3, 7, 17) 0%, #031832 50%, #0E2847 100%);
            animation: Gradient 15s ease infinite;
            animation-direction: alternate;
            animation-delay: 5s;
background-size: cover;
background-position :center;
font-family: sans-serif;
        }

        main{
margin-top:50px;
height: 80vh;
overflow: hidden;
}
        @keyframes Gradient {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
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

.mail{
            width: 30%;
            margin-left: 38%;
            margin-top: 12%;
            font-size: 1.4em;
            font-family: Comic Sans MS;
            color: white;
        }
        .mail input {
            width: 70%;
            margin-bottom: 20px;
            font-family:"Lucida Console", Monaco, monospace;
        }
        .mail input[type="password"]
         {
            border: none;
            border-bottom: 1px solid #fff;
            background: transparent;
            outline: none;
            height: 40px;
            color:#45A29E ;
            font-size: 16px;
            font-family:"Lucida Console", Monaco, monospace;
        }
        #but1 {
            display: inline-block;
            background-color: #031832;
            color: #66fcf1;
            height: 40px;
            width: 47%;
            font-size: 20px;
            border: 1px solid;
            padding: 10px;
            cursor: pointer;
            box-shadow: 5px 5px 3px rgb(2, 41, 88);
        }

        #but1:hover {
            background-color: #087575;
            color: #0E2847;
        }

        #but1:active {
            background-color: #031832;
            color: #66fcf1;
            box-shadow: 0px 2px rgb(2, 41, 88);
            transform: translateY(2px);
        }

</style>
    </head>
    <body>
        <header>
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
                        <a href="log.php">LOGIN</a>
                    </li>
                </div>
            </div>
        </header>
        <main>
            <div class="mail">
                <form action="forget3.php" method="POST" id="form1" onsubmit="return validate()">
                <p>Password (*):</p>
                        <input type="password" name="pass1" minlength="8" maxlength="20" placeholder="Enter a strong Password"
                            required>
                        <p>Confirm Password (*):</p>
                        <input type="password" name="pass2" minlength="8" maxlength="20" placeholder="Enter the above Password"
                            required>
                            <input type="submit" name="" value="Change Password" id="but1">
                </form>
        </main>
        <script>
            function validate() {
                var x = document.forms["form1"]["pass1"].value;
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
        <footer>
            <div class="foot">
                <p>Copyright © 2020 365Predict</p>
              <a href="https://github.com/Jas-077/SE_Project.git" target="_blank">
                <i class="fa fa-github" style="color: white;font-size: 2.0em;"></i>
                </a>
            </div>
        </footer>
    </body>
</html>