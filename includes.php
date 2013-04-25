<?php
	//$dbhandle=mysql_connect(localhost,"pi","raspberry") or die("Unable to connect!");      
  	//$selected=mysql_select_db("thermostat") or die("Unable to select!");


	define("HOST", "localhost"); // The host you want to connect to.
	define("USER", "pi"); // The database username.
	define("PASSWORD", "raspberry"); // The database password. 
	define("DATABASE", "thermostat"); // The database name.
	 
	$selected = new mysqli(HOST, USER, PASSWORD, DATABASE);

	//$selected = new mysqli_select_db($dbhandle, DATABASE);

	if(mysqli_connect_errno()) {
      echo "Connection Failed: " . mysqli_connect_errno();
      exit();
  	}

?>