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
          <?php###############################################
            if(isset($_GET['error'])) { 
               echo "Error Logging In!";
            }
          ?>    
            <form action="process_login.php" method="post" name="login_form">
               Email: <input type="text" name="email" /><br />
               Password: <input type="password" name="password" id="password"/><br />
               <input type="button" value="Login" onclick="formhash(this.form, this.form.password);" />
            </form>          
  </div>        
</div>
        <div id="footer"></div>
</body>
<?php mysql_close($dbhandle);?>
</html>
