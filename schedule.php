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
            <h2>Control you HVAC with RaspberryPi</h2>
            
      </div>
  <div id="bar">
        	<div class="link"><a href="index.php?w=0">Home</a></div>
            <div class="link"><a href="schedule.php?w=0">Schedule</a></div>
            <div class="link"><a href="pull.php">Pull</a></div>
            
      </div>
        <div align="center" class="contentTitle"><h1>Schedule</h1></div>
        
        <div class="contentText">
			<hr>
			<form method="post" action="schedule.php?w=1">
			<select name="Day">
			<option value="Mon">Monday</option>
			<option value="Tue">Tuesday</option>
			<option value="Wed">Wednesday</option>
			<option value="Thu">Thursday</option>
			<option value="Fri">Friday</option>
			<option value="Sat">Saturday</option>
			<option value="Sun">Sunday</option>
			</select>
			<input type="text" name="Start">
			<input type="text" name="End">
			<input type="text" name="SchedTarget">
			<input type="submit" value="Submit">
			</form>
			
			<?php
				include("login.php");
				if ($_GET['w']){
					$dbhandle=mysql_connect(localhost,$un,$pw) or die("Unable to connect!");		
					$selected=mysql_select_db($db) or die("Unable to select!");

					/*
					$target = mysql_real_escape_string($_POST["SchedTarget"]);
					$dow = mysql_real_escape_string($_POST["Day"]);
					$start = mysql_real_escape_string($_POST["Start"]);
					$end = mysql_real_escape_string($_POST["End"]);
					#needs to check for overlaping schedules
					$query = "INSERT INTO `Schedule` (`DOW`, `Start`, `Stop`, `Target`) VALUES ('$dow', '$start', '$end', '$target');";
					$result=mysql_query($query);
					mysql_close($dbhandle);*/
				}
			?>
          
  </div>        
</div>
        <div id="footer"></div>

</body>
</html>