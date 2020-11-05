<?php
require_once "db.php";
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $user=$_POST["user"];
    $username=$_SESSION["username"];
    $sql="update users set username='$user' where username='$username'";
    if(mysqli_query($link,$sql))
    {
        $_SESSION["username"]=$user;
        header("location:update.html");
    }
    else
    echo "Failed";
}
?>