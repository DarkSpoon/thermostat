<?php
define("HOST", "localhost"); // The host you want to connect to.
define("USER", "pi"); // The database username.
define("PASSWORD", "raspberry"); // The database password. 
define("DATABASE", "secure_login"); // The database name.
define("DATABASE2", "thermostat")

$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);

$selected = new mysqli(HOST, USER, PASSWORD, DATABASE2);

?>