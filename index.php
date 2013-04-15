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

	echo "<p>";
	echo "<form method=\"post\" action=\"index.php?write=1\">";
	echo "<input type=\"text\" name=\"Target\">";
	echo "<input type=\"submit\" value=\"Submit\">";
	echo "</p>";
	echo "</form>";

echo " </body>";
echo "</html>";

$writeChanges = $_GET['write'];
echo $writeChanges;

if ($writeChanges==1) {
//if (isset($_POST['Target'])){
 	
	$dbhandle=mysql_connect(localhost,$un,$pw) or die("Unable to connect!");	
	echo "Connected <BR>";	
	$selected=mysql_select_db($db) or die("Unable to select!");

	#Set manual overrides
	$target = mysql_real_escape_string($_POST["Target"]);
	$query = "UPDATE User_Req SET Temp=$target";
	$result=mysql_query($query);
	echo "query ran<BR>";
}
?>