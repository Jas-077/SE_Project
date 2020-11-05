<?php
require_once "db.php";
$user=$oppo="";
session_start();
$_SESSION["team1"]="";
$_SESSION["team2"]="";
if($_SERVER["REQUEST_METHOD"] == "POST")
{



$user= trim($_POST["team1"]);
$oppo= trim($_POST["team2"]);

$_SESSION["team1"]=$user;
$_SESSION["team2"]=$oppo;
$se=$_SESSION["username"];
$sql="update teams set user_team='$user', opponent_team='$oppo' where username2='$se';";
mysqli_query($link,$sql);
echo '<script>
alert("Teams are successfully selected");
location.href="Match.php";
</script>';
}
?>
