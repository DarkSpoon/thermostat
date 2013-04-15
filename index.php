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
	echo "<form method=\"post\" action=\"index.php\">";
	echo "<input type=\"text\" name=\"SchedTarget\">";
	echo "<input type=\"submit\" value=\"Submit\">";
	echo "</p>";
	echo "</form>";

echo " </body>";
echo "</html>";
echo isset($_POST['Target']; 
//echo isset($_POST["Target"];
/*if (isset($_POST['Target'])){
 
	$dbhandle=mysql_connect(localhost,$un,$pw) or die("Unable to connect!");	
	echo "Connected <BR>";	
	$selected=mysql_select_db($db) or die("Unable to select!");


	$target = mysql_real_escape_string($_POST["Target"]);
	echo "post escape test<BR>";
	$query = "UPDATE `User_Req` (`Temp`) VALUES ('$target');";
	echo "query built<BR>";
	$result=mysql_query($query);
	echo "query ran<BR>";
}*/
?>