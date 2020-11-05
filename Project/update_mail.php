<?php
require_once "db.php";
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $mail=$_POST["mail"];
    $username=$_SESSION["username"];
    $sql="update users set email='$mail' where username='$username'";
    if(mysqli_query($link,$sql))
    {
        header("location:update.html");
    }
    else
    echo "Failed";
}
?>