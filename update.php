<?php
	include("login.php");
	$dbhandle=mysql_connect(localhost,$un,$pw) or die("Unable to connect!");	
	echo "Connected <BR>";	
	$selected=mysql_select_db($db) or die("Unable to select!");


	$query="DELETE FROM Schedule";
	$result=mysql_query($query);

	$target = mysql_real_escape_string($_POST["Target"]);
	echo "post escape test";
	$query = "INSERT INTO Schedule (DOW, Start, End, Target) VALUES ('Mon', '00:00:00', '23:59:00', '$target')";
	echo "query built";
	$result=mysql_query($query);
	echo "query ran";
	
	//echo $result;

?>
