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

	echo "<form method=\"post\" action=\"pull.php\">";
	echo "<input type=\"submit\" value=\"Pull.php\">";
	echo "</form>";

echo " </body>";
echo "</html>";


$dbhandle=mysql_connect(localhost,$un,$pw) or die("Unable to connect!");	
echo "Connected <BR>";	
$selected=mysql_select_db($db) or die("Unable to select!");


$target = mysql_real_escape_string($_POST["Target"]);
$dow = $_POST["Day"];
echo $dow;
$start = mysql_real_escape_string($_POST["Start"]);
$end = mysql_real_escape_string($_POST["End"]);
echo "post escape test<BR>";
#needs to check for overlaping schedules
#$query = "INSERT INTO `Schedule` (`DOW`, `Start`, `Stop`, `Target`) VALUES ('$dow', '$start', '$end', '$target');";
echo "query built<BR>";
$result=mysql_query($query);
echo "query ran<BR>";

?>