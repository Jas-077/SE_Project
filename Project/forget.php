<?php
require_once "db.php";

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

/* If you installed PHPMailer without Composer do this instead: */

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
// Check connection
if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
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
            width: 25%;
            margin-left: 38%;
            margin-top: 17%;
            font-size: 1.4em;
            font-family: Comic Sans MS;
            color: white;
        }
        .mail input {
            width: 70%;
            margin-bottom: 20px;
            font-family:"Lucida Console", Monaco, monospace;
        }
        .mail input[type="text"]
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
            width: 40%;
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
                <form action="forget.php" method="POST" id="form1">
                    Enter Registered Email-id:
                    <input type="text" name="mail"
                            pattern="[a-zA-z]{1,}[.]{0,1}[a-zA-z0-9]{0,}[@][a-z]{1,10}[.][a-zA-z]{2,3}"
                            placeholder="Enter your valid email-id" required>
                            <input type="submit" name="" value="Send OTP" id="but1">
                </form>
                <form action="forget2.php" method="POST" id="form2" style="display:none;">
                    Enter Recieved OTP:
                    <input type="text" name="otp"
                            pattern="[0-9]{4}"
                            placeholder="OTP" required style="letter-spacing: 2em;" maxlength="4" minlength="4">
                            <input type="submit" name="" value="Verify OTP" id="but1">
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
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql2 = "select * from otp_con";
    $result = mysqli_query($link, $sql2);
    $row = mysqli_fetch_array($result);
    $mail = $row["mail"];
    $sql3 = "DELETE FROM otp_con WHERE mail='$mail'";
    mysqli_query($link, $sql3);

    $sql = "SELECT * FROM users WHERE email = ?;";
    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_mail);

        // Set parameters
        $param_mail = trim($_POST["mail"]);

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            /* store result */
            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) != 1) {
                echo '<script>
                alert("This mail address is not a registered one...Please Signup");
                </script>';
            } else {
                echo '<script>
                alert("OTP has been sent...Please check your mail");
                </script>';

/* Create a new PHPMailer object. Passing TRUE to the constructor enables exceptions. */
                $mail = new PHPMailer(true);
                $result = "";
                $generator = "1357902468";
                for ($i = 1; $i <= 4; $i++) {
                    $result .= substr($generator, (rand() % (strlen($generator))), 1);
                }
/* Open the try/catch block. */
                try {
                    //$mail->SMTPDebug= 2;
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'noreply.locknkey@gmail.com';
                    $mail->Password = 'Lock&key!';
                    $mail->SMTPSecure = 'tls';
                    $mail->Port = 587;

                    $mail->setFrom('noreply.locknkey@gmail.com', '365Predict');
                    $mail->addAddress(trim($_POST["mail"]));

                    $mail->isHTML(true);
                    $mail->Subject = "Forgot Password Instructions";
                    $mail->Body = "Hello,<br> Pls Enter this OTP: " . $result . " and follow the instructions to change your password.<br><br>Thankyou,<br>Lock&Key Team";

                    $mail->send();
                    echo 'Message sent';
                    echo '<script>
document.getElementById("form1").style.display="none";
document.getElementById("form2").style.display="block";
</script>';
                    $sql1 = $link->prepare("insert into otp_con (otp,mail) values(?,?)");
                    $sql1->bind_param("ss", $result, $_POST["mail"]);

                    $sql1->execute();
                } catch (Exception $e) {
                    echo "Message could not be sent. Error: ";
                }

            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
        // Close statement
        mysqli_stmt_close($stmt);
    }
}

?>