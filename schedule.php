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
<title>A Farewell to Colors by Bryant Smith</title>
</head>

<body>
    <div id="page">
		
        <div id="header">
        	<h1>Thermostat</h1>
            <h2>Control you HVAC with RaspberryPi</h2>
            
      </div>
  <div id="bar">
        	<div class="link"><a href="index.php?w=0">Index</a></div>
            <div class="link"><a href="schedule.php?w=0">Schedule</a></div>
            <div class="link"><a href="pull.php">Pull</a></div>
            
      </div>
        <div align="center" class="contentTitle"><h1>Schedule</h1></div>
        
        <div class="contentText">
        	<?php
include("login.php");


//print some html for a button
echo "<!DOCTYPE HTML PUBLIC \"-\/\/W3C\/\/DTD HTML 4.01\/\/EN\" \"http:\/\/www.w3.org/TR/html4/strict.dtd\">";
echo "<html>";
 echo "<head>";
  echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">";
echo "  <title>Thermostat</title>";
echo " </head>";
echo " <body>";
	echo "<form method=\"post\" action=\"index.php?w=0\">";
	echo "<input type=\"submit\" value=\"Index\">";
	echo "</form>";
	echo "<form method=\"post\" action=\"schedule.php?w=0\">";
	echo "<input type=\"submit\" value=\"Schedule\">";
	echo "</form>";
	echo "<form method=\"post\" action=\"pull.php\">";
	echo "<input type=\"submit\" value=\"Pull\">";
	echo "</form>";
	echo "<form method=\"post\" action=\"schedule.php?w=1\">";
	echo "<select name=\"Day\">";
	echo "<option value=\"Mon\">Monday</option>";
	echo "<option value=\"Tue\">Tuesday</option>";
	echo "<option value=\"Wed\">Wednesday</option>";
	echo "<option value=\"Thu\">Thursday</option>";
	echo "<option value=\"Fri\">Friday</option>";
	echo "<option value=\"Sat\">Saturday</option>";
	echo "<option value=\"Sun\">Sunday</option>";
	echo "</select>	";
	echo "<input type=\"text\" name=\"Start\">";
	echo "<input type=\"text\" name=\"End\">";
	echo "<input type=\"text\" name=\"SchedTarget\">";
	echo "<input type=\"submit\" value=\"Submit\">";
	echo "</form>";
echo " </body>";
echo "</html>";

if ($_GET['w']){
	$dbhandle=mysql_connect(localhost,$un,$pw) or die("Unable to connect!");	
	echo "Connected <BR>";	
	$selected=mysql_select_db($db) or die("Unable to select!");


	$target = mysql_real_escape_string($_POST["SchedTarget"]);
	$dow = mysql_real_escape_string($_POST["Day"]);
	$start = mysql_real_escape_string($_POST["Start"]);
	$end = mysql_real_escape_string($_POST["End"]);
	echo "post escape test<BR>";
	#needs to check for overlaping schedules
	$query = "INSERT INTO `Schedule` (`DOW`, `Start`, `Stop`, `Target`) VALUES ('$dow', '$start', '$end', '$target');";
	echo "query built<BR>";
	$result=mysql_query($query);
	echo "query ran<BR>";
}
?>
          
  </div>        
</div>
        <div id="footer"></div>

</body>
</html>



















