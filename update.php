<?php
	include("login.php");
	$dbhandle=mysql_connect(localhost,$un,$pw) or die("Unable to connect!");	
	echo "Connected <BR>";	
	$selected=mysql_select_db($db) or die("Unable to select!");


	//$query="DELETE FROM Schedule";
	$query="DELETE FROM `thermostat`.`Schedule` WHERE `Schedule`.`PID` = 1";
	$result=mysql_query($query);

	$target = mysql_real_escape_string($_POST["Target"]);
	echo "post escape test";
	$query = "INSERT INTO `Schedule` (`PID`, `DOW`, `Start`, `Stop`, `Target`) VALUES ('1', 'Mon', '00:01:00', '11:59:59', '$target');";
	echo "query built";
	$result=mysql_query($query);
	echo "query ran";
	
	//echo $result;

?>
