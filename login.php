<?php 
  include("includes.php"); 
  include("db_connect.php");
  include("functions.php");
  sec_session_start();
?>
<script type="text/javascript" src="sha512.js"></script>
<script type="text/javascript" src="forms.js"></script>
 <!--
Design by Bryant Smith
http://www.bryantsmith.com
http://www.aszx.net
email: templates [-at-] bryantsmith [-dot-] com
Released under Creative Commons Attribution 2.5 Generic.  In other words, do with it what you please; but please leave the link if you'd be so kind :)

Name       : A Farewell to Colors
Description: One column, with top naviagation
Version    : 1.0
Released   : 20081230
-->


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css" />
<title>Thermostat</title>
</head>
<body>
    <div id="page">
    
        <div id="header">
          <h1>Thermostat</h1>
            <h2>Control your heat and AC with RaspberryPi</h2>
            
      </div>
  <div id="bar">
          <div class="link"><a href="index.php?w=0">Home</a></div>
            <div class="link"><a href="schedule.php?w=0">Schedule</a></div>
              <?php
                if(login_check($mysqli) == true) {
                  echo "<div class=\"link\"><a href=\"logout.php\">Logout</a></div>";
                }
                else {
                  echo "<div class=\"link\"><a href=\"login.php\">Login</a></div>";
                }
              ?>
            
      </div>
      <div align="center" class="contentTitle"><h1>Login</h1></div>        
        <div class="contentText">
          <hr>
            <form action="process_login.php" method="post" name="login_form">
               Email: <input type="text" name="email" /><br />
               Password: <input type="password" name="password" id="password"/><br />
               <button type="submit" class="btn" onclick="formhash(this.form, this.form.password);">Sign in</button>
                <!-- if login failed show this -->
                <?php if(isset($_GET['error'])) {?>
                <div class="alert alert-error fade in error">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong>Ups! That wasn't correct...</strong>
                </div>
                <?php }?> 
            </form>          
        </div> 
        <br>
        <div align="center" class="contentTitle"><h1>Register</h1></div>
          <div class="contentText">       
            <hr>
            <form action="register.php" method="post" name="registration_form">
              Username: <input type="text" id="username" name="username">
              Email: <input type="text" id="email" name="email">
              Password:  <input type="password" name="password" id="password">
              <input type="hidden" name="p" id="p" value="">
              <button type="submit" class="btn" onclick="formhash(this.form, this.form.password, this.form.p);">Register</button>

              <!-- If registration successfull show everything ok info -->
              <?php if(isset($_GET['success'])) {?>
              <div class="alert alert-success fade in" id="success">
              <button type="button" class="close" data-dismiss="alert">x</button>
              <strong>Registration done! <br>Please log in...</strong>
              </div>
              <?php }?>

              <!-- if registration error show this -->
              <?php if(isset($_GET['registrationfailed'])) {?>
              <div class="alert alert-error fade in error" >
              <button type="button" class="close" data-dismiss="alert">x</button>
              <strong>Ups! Something went wrong...</strong>
              </div>
              <?php }?> 
          </div>
        <div id="footer"></div>
</body>
<?php mysql_close($dbhandle);?>
</html>
