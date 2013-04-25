<?php
define("HOST", "localhost"); // The host you want to connect to.
define("USER", "pi"); // The database username.
define("PASSWORD", "raspberry"); // The database password. 
define("DATABASE", "secure_login"); // The database name.

$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);

define("HOST2", "localhost"); // The host you want to connect to.
define("USER2", "pi"); // The database username.
define("PASSWORD2", "raspberry"); // The database password. 
define("DATABASE2", "thermostat"); // The database name.
	 
$selected = new mysqli(HOST2, USER2, PASSWORD2, DATABASE2);
?>