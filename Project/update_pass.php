<?php
require_once "db.php";
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $pass=$_POST["pass"];
    $username=$_SESSION["username"];
    $pass=password_hash($pass,PASSWORD_DEFAULT);
    $sql="update users set pwduser='$pass' where username='$username'";
    if(mysqli_query($link,$sql))
    {
        echo '<script>
        alert("Password Updated");
        location.href="update.html";
        </script>';
    }
    else
    echo "Failed";
}
?>