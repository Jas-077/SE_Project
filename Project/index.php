<?php
session_start();
?>
<html>
    <head>
    <title>Home Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
  
      body{
margin: 0;
padding: 0;
height: 400% 400%;
background: url(ch.jpg);
background-size: cover;
background-position :center;
font-family: sans-serif;
}
    h1
    { 
    Margin-top:0px;
    margin-bottom:0px;
    Color:yellow ;
    font-family:"Calibri";
    Font-size:50px;
    }
    ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
}
header{
    height: 10vh;
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
    height: 170%;
    width: 150px;
    position: relative;
    margin-top: -6%;
    border-radius: 0 50%  50% 0%;
}

.active
{
    color: lightgreen;
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
    p1
    {
    color: rgb(255, 204, 0);
    font-size: 45px;
    }
    p2
    {
    color: rgb(255, 204, 0);
    font-size: 25px;
    }
    footer
{
    
    height: 10%;
    width: 100%;
    
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
font-family:"Chalkboard SE";
}
#title
{
  background-color: #000;
}
    </style>
    </head>
    <body>
      <div id="title">
      <center>
        <h1 id="pl"><b>356Predict</b></h1>
        </center>
        </div>
    <header>
    <div class="nav1">
      <div class="nav2">
          <img src="logo.jpg" class="logo">
          <li>
              <a href="index.php" class="active">HOME</a>
          </li>
          <li>
              <a href="Starting lineup.htm" id="two" >TEAMS LIST</a>
          </li>
          <li>
              <a href="faq.htm" id="three">FAQ</a>
          </li>
          <li>
            <a href="log.php" id="four">LOGIN</a>
        </li>
        <li>
          <a href="sign.php" id="five">SIGNUP</a>
      </li>
      </div>
  </div>
    </header>
    <main>
    <center>
    <p1>Welcome to 365Predict</p1><br>
    <p2 id="p2">Please Login or Sign up to continue</p2>
    <center>
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
    if (array_key_exists("loggedin", $_SESSION)) {
    if( $_SESSION["loggedin"] = true)
    {
    echo '<script>
    document.getElementById("two").innerHTML="UPDATE";
    document.getElementById("two").href="update.html";
    document.getElementById("three").innerHTML="TEAM";
    document.getElementById("three").href="Team/team.html";
    document.getElementById("four").innerHTML="MATCH";
    document.getElementById("four").href="Match.php";
    document.getElementById("five").innerHTML="LOGOUT";
    document.getElementById("five").href="logout.php";
    document.getElementById("p2").innerHTML="Pls select teams to see the Predicted Score";
    </script>';
    }
  }
?>