<?php

if(loggedinfac())
{
 header('Location:facultyy.php'); 
}
if(isset($_POST['uname'])&&isset($_POST['psw']))
{
  if(!empty($_POST['uname'])&&!empty($_POST['psw']))
  { 
    echo $_POST['psw'];
    $per=$db->query("SELECT * FROM PROF WHERE TEACHER_ID=".mysql_real_escape_string($_POST['uname'])." && PASSWORD='".mysql_real_escape_string($_POST['psw'])."' ") ;



if(isset($_COOKIE['usfac'])&&!empty($_COOKIE['usfac']))
{
  $_SESSION["unamefac"]= $_COOKIE['usfac'];
  header('Location:index.php');
}

if (!$per->num_rows)
{ 
echo 'Username and Password is incorrect ';
}
 
else
{
$_SESSION["unamefac"]= $_POST['uname'];
$_SESSION["passwordfac"] = $_POST['psw'];

if(isset($_POST['rmm'])) setcookie('usfac',$_POST['uname'], time() + (86400 * 30), "/");

header('Location:index.php');
}

  }
}
?>





<!DOCTYPE html>
<html>
<head>
  <title>Faculty Login</title>
   <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.teal-purple.min.css" /> 
   <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>  
  <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>





<style>
a:hover{text-decoration:none;color:default;}
body{background:#eff3f6;font-family:'Open Sans';color:black;}
      .mdl-layout {
  align-items: center;
  justify-content: center;
}
.mdl-layout__content {
  padding: 24px;
  flex: none;
}
#bg{background-image: url('assets/img/back1.jpg') ;background-repeat: round;}
    </style>

</head>
<body>
<div id=bg class="mdl-layout mdl-js-layout mdl-color--grey-100">
  <main class="mdl-layout__content">
    <div class="mdl-card mdl-shadow--6dp">
      <div class="mdl-card__title mdl-color--primary mdl-color-text--white">
        <h2 class="mdl-card__title-text">Login  &nbsp; &nbsp;&nbsp;<i class="material-icons">dashboard</i></h2>
      </div>
      <div class="mdl-card__supporting-text">
        <form action="facultylogin.php" method=POST>
          <div class="mdl-textfield mdl-js-textfield">
            <input class="mdl-textfield__input" type="text" id="username"  name="uname" required>
            <label class="mdl-textfield__label" for="username">Course ID</label>
          </div>
          <br>
          <div class="mdl-textfield mdl-js-textfield">
            <input class="mdl-textfield__input" type="password" id="userpass" name="psw" required />
            <label class="mdl-textfield__label" for="userpass">Password</label>
            </div>
            <br>
    <input type="checkbox" checked="checked" style="display: inline;" name=rmm> <p style="display: inline;">Stay Signed In</p>
    <br>
    <div class="mdl-card__actions mdl-card--border">
        <button class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">Log in</button>
      </div>
        </form>

                  </div>
      
    </div>
  </main>
</div>


<br><br><br>
</body>
</html>

