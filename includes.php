<?php
	$dbhandle=mysql_connect(localhost,"pi","raspberry") or die("Unable to connect!");      
  	$selected=mysql_select_db("thermostat") or die("Unable to select!");
?>