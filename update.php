<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Thermostat</title>
 </head>
 <body>
	<?php
		include("login.php");
		$dbhandle=mysql_connect(localhost,$un,$pw) or die("Unable to connect!");	
		echo "Connected <BR>";	
		$selected=mysql_select_db($db) or die("Unable to select!");


		$query="DELETE FROM `Schedule` WHERE `Schedule`.`PID` = 1";
		$result=mysql_query($query);

		$target = mysql_real_escape_string($_POST["Target"]);
		echo "post escape test<BR>";
		$query = "INSERT INTO `Schedule` (`PID`, `DOW`, `Start`, `Stop`, `Target`) VALUES ('1', 'Mon', '00:01:00', '11:59:59', '$target');";
		echo "query built<BR>";
		$result=mysql_query($query);
		echo "query ran<BR>";

	?>
	<a src=\"pull.html\">Pull data</a>
</body>
</html>