<?php
/*define("HOST", "localhost"); // The host you want to connect to.
define("USER", "pi"); // The database username.
define("PASSWORD", "raspberry"); // The database password. 
define("DATABASE", "secure_login"); // The database name.
define("DATABASE2", "thermostat")*/

$con = new mysqli("localhost", "pi", "raspberry");
$mysqli = mysqli_select_db($con, "secure_login");
$selected = mysqli_select_db($con, "thermostat");

if(mysqli_connect_errno()) {
      echo "Connection Failed: " . mysqli_connect_errno();
      exit();
  	}

/*define("HOST2", "localhost"); // The host you want to connect to.
define("USER2", "pi"); // The database username.
define("PASSWORD2", "raspberry"); // The database password. 
define("DATABASE2", "thermostat"); // The database name.
	 
$selected = new mysqli(HOST2, USER2, PASSWORD2, DATABASE2);*/
?>