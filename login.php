<?php
	$un="pi";
	$pw="raspberry";
	$dbhandle=mysql_connect(localhost,$un,$pw) or die("Unable to connect!");
	
	echo "Connected <BR>";
	
	$selected=mysql_select_db(thermostat) or die("Unable to select!");

?>