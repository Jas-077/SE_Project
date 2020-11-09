<?php
require_once "db.php";
session_start();
$team1=$_SESSION["team1"];
$team2=$_SESSION["team2"];
if($team1=="" && $team2=="")
{
    echo '<script>
    alert("Pls select teams");
    location.href="Team/team.html";
    </script>';

}
$sql1="SELECT Image FROM league where Name='$team1';";
$sql2="SELECT Image FROM league where Name='$team2';";
$sql3="SELECT Win FROM league where Name='$team1';";
$sql4="SELECT Win FROM league where Name='$team2';";
$query=mysqli_query($link,$sql1);
$query2=mysqli_query($link,$sql2);
$query3=mysqli_query($link,$sql3);
$query4=mysqli_query($link,$sql4);
$row=mysqli_fetch_array($query);
$row2=mysqli_fetch_array($query2);
$row3=mysqli_fetch_array($query3);
$row4=mysqli_fetch_array($query4);
$image= $row["Image"];
$image2= $row2["Image"];
$p1=$row3["Win"];
$p2=$row4["Win"];
$dif=(abs)($p1-$p2);
$dif2=0;
if($dif>.15)
{
    $dif2=5;
}
else
$dif2=3;
$ch= array(1,0,1,1,1,0,1,1,0,1,1);
$ch2= array(1,0,1,1,0,1,0,1,1,0);
$s1=0;
$k=0;
$s2=0;
if($p1>$p2 || $team1=="Arsenal" || $team2=="Arsenal")
{
$ran= rand(0,10);
if($ch[$ran]%2!=0)
{
while($k==0)
{
$s1= rand(0,$dif2);
$s2= rand(0,$dif2);
if($s1>$s2)
{
$k=-1;
}
}
}
else
{
    while($k==0)
{
$s1= rand(0,$dif2);
$s2= rand(0,$dif2-1);
if($s1<$s2)
{
$k=-1;
}
Else
{
}
}
}
}
elseif($p1<$p2)
{
$ran= rand(0,9);
if($ch2[$ran]%2!=0)
{
while($k==0)
{
$s1= rand(0,$dif2);
$s2= rand(0,$dif2);
if($s1<$s2)
{
$k=-1;
}
Else
{
}
}
}
else
{
    while($k==0)
{
$s1= rand(0,$dif2);
$s2= rand(0,$dif2);
if($s1>$s2)
{
$k=-1;
}
Else
{
}
}
}

}
?>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<meta charset="UTF-8">
        <title>
            Match 
        </title>
<style>
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
flex-wrap: wrap;
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

.p1
{
font-size: 200px;
color: rgb(124,252,0);
font-family: 'Impact'; 
margin-left: 40%;
text-shadow: 3px 3px 3px rgb(217, 245, 95);
}
.p2
{

font-size: 200px;
color: rgb(57,255,20);
font-family: 'Impact'; 
margin-left: 40%;
text-shadow: 3px 3px 3px rgb(217, 245, 95);
}
p2
{
font-size: 5em;
color: rgb(196, 196, 88);
}
p3
{
  position: relative;
left: 5%;
font-size: 75px;
font-family: ff-tisa-sans-web-pro, sans-serif;
font-weight: 100;
color: rgb(252, 112, 245);
text-shadow: 3px 3px 3px rgb(5, 44, 173);
}
p4
{
position: relative;
left: 450px;
font-size: 40px;
font-family: 'Chalkboard';
Color: Orange;
}
body
{
    
background-image: url(bcg3.jpg);
background-size: cover;
background-position: center;
background-attachment: fixed; 
}
footer
{
    position: absolute;
    height: 10%;
    width: 100%;
    margin-top: 5%;
    margin-bottom: 0%;
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
    margin-left: 40.5%;
    color: rgb(163, 233, 233);
    font-size: 1.4em;
    font-family: Arial, Helvetica, sans-serif;
  text-shadow: 2px 2px 4px rgb(67, 85, 245);
}
.foot a
{
    margin-left: 47.6%;
    color: cyan;
    font-size: 1.3em;
    position: absolute;
    margin-top: -1%;
}
#sel
{
  color: whitesmoke;
  margin-left: 43.0%;
  font-size: 1.7em;
  font-family: Chalkboard;
  text-shadow: 1px 1px 2px whitesmoke;
}

#two
{
  animation: spin2 2s alternate infinite;
}
#dis
{
  color: aqua;
  font-size: 3em;
  font-family: Chalkboard;
  position: absolute;
  margin-left: 50%;
  margin-top: -30%;
}
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg);
  margin-left: 0%; }
  100% { transform: rotate(360deg);
  margin-left: 50%; }
}
@keyframes spin2 {
  0% { transform: rotate(0deg);
  margin-top: 0%; }
  100% { transform: rotate(360deg);
  margin-top: 37%; }
}
table
{
  border-width: 1px;
  border-color: white;
  border-style:dashed;
  border-top-color: red;
  border-bottom-color: red;
  border-left-color: blue;
  border-right-color: blue;
  margin-left: 30%;
}

#tab 
{
  width:100px;
  height: 500px;
  background-color: rgb(18, 146, 67);
  
}
#v 
{
  color:white;
  font-size: 7em;
  position: absolute;
  margin-left: 1.2%;
  margin-top:7%;
  font-family: Chalkboard;
  color: rgb(236, 12, 225);
  text-shadow: 3px 3px 3px violet;
}
#s
{
  color:white;
  font-size: 7em;
  position: absolute;
  margin-left: 2%;
  margin-top:20%;
  font-family: Chalkboard;
  color: rgb(236, 12, 225);
  text-shadow: 3px 3px 3px violet;
}
</style>
</head>
<body>
<header id="head1">
    <div class="nav1">
        <div class="nav2">
            <img src="logo.jpg" class="logo">
            <li>
                <a href="index.php">HOME</a>
            </li>
            <li>
                <a href="update.html" >UPDATE</a>
            </li>
            <li>
                <a href="Team/team.html" >TEAM</a>
            </li>
            <li>
                <a href="Match.php" class="active">MATCH</a>
            </li>
            <li>
                <a href="logout.php" >LOGOUT</a>
            </li>
        </div>
    </div>
</header>
<main id="main2">
<br>
<br>
<br>
<br>
<p3>Full Time:</p3>
<br>
<br>
<br>
<table>
  <tr>
    <td><img src="<?php echo $image;?>" width="400"  alt="image" class="image1"><span id="v">V</span><span id="s">S</span>
    <br><p1 class="p1"><?php echo $s1; ?></p1></td>
    <td><div id="tab"></div></td>
    <td><img src="<?php echo $image2;?>" width="400"  alt="image" class="image2"><br><p1 class="p2"><?php echo $s2; ?></p1></td>
  </tr>
</table>

<br>
<br>
<p4>Thanks for playing.Pls Sign Out.</p4>
</main>
<footer id="foot2">
    <div class="foot">
        <p>Copyright © 2020 365Predict</p>
      <a href="https://github.com/Jas-077/SE_Project.git" target="_blank">
        <i class="fa fa-github" style="color: cyan;font-size: 2.0em;"></i>
        </a>
    </div>
</footer>
</body>
</html>
<script>
    var myVar;
    function pre()
    {
      document.getElementById("b1").style.display="block";
    document.getElementById("dis").style.display="block";
    document.getElementById("head1").style.display="none";
    document.getElementById("foot2").style.display="none";
    document.getElementById("main2").style.display="none";
        myVar=setTimeout(pre2,0000);
    }
    function pre2()
    {
        document.getElementById("b1").style.display="none";
    document.getElementById("dis").style.display="none";
    document.getElementById("head1").style.display="block";
    document.getElementById("foot2").style.display="block";
    document.getElementById("main2").style.display="block";
    }

</script>