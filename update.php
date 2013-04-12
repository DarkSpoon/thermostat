<?php
	include("login.php");
	echo "<html>";//see firefox source error about doctype
	$dbhandle=mysql_connect(localhost,$un,$pw) or die("Unable to connect!");	
	echo "Connected <BR>";	
	$selected=mysql_select_db($db) or die("Unable to select!");


	//$query="DELETE FROM Schedule";
	$query="DELETE FROM `Schedule` WHERE `Schedule`.`PID` = 1";
	$result=mysql_query($query);

	$target = mysql_real_escape_string($_POST["Target"]);
	echo "post escape test<BR>";
	$query = "INSERT INTO `Schedule` (`PID`, `DOW`, `Start`, `Stop`, `Target`) VALUES ('1', 'Mon', '00:01:00', '11:59:59', '$target');";
	echo "query built<BR>";
	$result=mysql_query($query);
	echo "query ran<BR>";
	
	echo "<a src=\"pull.php\">Pull data</a> </html>";
	//echo $result;

?>
