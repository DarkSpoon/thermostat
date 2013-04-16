 <!--
Design by Bryant Smith
http://www.bryantsmith.com
http://www.aszx.net
email: templates [-at-] bryantsmith [-dot-] com
Released under Creative Commons Attribution 2.5 Generic.  In other words, do with it what you please; but please leave the link if you'd be so kind :)

Name       : A Farewell to Colors
Description: One column, with top naviagation
Version    : 1.0
Released   : 20081230
-->


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css" />
<title>Thermostat</title>
</head>

<body>
    <div id="page">
		
        <div id="header">
        	<h1>Thermostat</h1>
            <h2>Control you HVAC with RaspberryPi</h2>
            
      </div>
  <div id="bar">
        	<div class="link"><a href="index.php?w=0">Index</a></div>
            <div class="link"><a href="schedule.php?w=0">Schedule</a></div>
            <div class="link"><a href="pull.php">Pull</a></div>
            
      </div>
        <div align="center" class="contentTitle"><h1>Current Status</h1></div>
        
        <div class="contentText">
        	<hr>
          	<?php
				include("login.php");
				$dbhandle=mysql_connect(localhost,$un,$pw) or die("Unable to connect!");	
				$selected=mysql_select_db($db) or die("Unable to select!");



				$query="SELECT * from Conditions";
				$result=mysql_query($query);

				while($row=mysql_fetch_array($result)){
				echo "Currently: ".$row{'Temp'}."F<BR>";
				$AC=$row{'AC'};
				$Heat=$row{'Heat'};
				$Fan=$row{'Fan'};
				
				#Display what is currently running. 
				#The below values will be used to trigger relays and should reflect an accurate status
				if($AC==1)
					echo "AC is running<BR>";
				else if($Heat==1)
					echo "Heat is running<BR>";
				else if($AC==0 && $Heat==0)
					echo "System is idle<BR>";
				if ($Fan==1)
					echo "Fan is running<BR>";
				if ($Fan==0)
					echo "Fan is on auto<BR>";
				echo "Target: ".$row{'Target'}."F<BR>";

				}

				mysql_close($dbhandle);

			?>
  </div>        
</div>
        <div id="footer"></div>
</body>
</html>