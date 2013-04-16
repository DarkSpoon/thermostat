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
        	<div class="link"><a href="index.php?w=0">Home</a></div>
            <div class="link"><a href="schedule.php?w=0">Schedule</a></div>
            <div class="link"><a href="pull.php">Pull</a></div>
            
      </div>
        <div align="center" class="contentTitle"><h1>Schedule</h1></div>
        
        <div class="contentText">
			<hr>
			<form method="post" action="schedule.php?w=1">
			<select name="Day">
			<option value="Mon">Monday</option>
			<option value="Tue">Tuesday</option>
			<option value="Wed">Wednesday</option>
			<option value="Thu">Thursday</option>
			<option value="Fri">Friday</option>
			<option value="Sat">Saturday</option>
			<option value="Sun">Sunday</option>
			</select>
			<input type="text" name="Start">
			<input type="text" name="Stop">
			<input type="text" name="SchedTarget">
			<input type="submit" value="Submit">
			</form>
			<BR>
			<BR>
			<hr>
			<?php
				include("login.php");
				$dbhandle=mysql_connect(localhost,$un,$pw) or die("Unable to connect!");		
				$selected=mysql_select_db($db) or die("Unable to select!");

				#delete entry of passed PID
				if ($_GET['d']){
					$pid=mysql_real_escape_string($_GET['d']);
					$query="DELETE FROM Schedule WHERE PID=$pid";
					$result=mysql_query($query);
					//mysql_close($dbhandle);
				}


				#update entry of passed PID
				if ($_GET['u']){
					$pid=mysql_real_escape_string($_GET['u']);
					$target = mysql_real_escape_string($_POST["SchedTarget"]);
					$dow = mysql_real_escape_string($_POST["Day"]);
					$start = mysql_real_escape_string($_POST["Start"]);
					$stop = mysql_real_escape_string($_POST["Stop"]);
					$query = "UPDATE Schedule SET DOW=$dow, Start=$start, Stop=$stop, Target=$target WHERE PID=$pid";
        			$result=mysql_query($query);
        		}

				#write the new entry
				if ($_GET['w']){
					$target = mysql_real_escape_string($_POST["SchedTarget"]);
					$dow = mysql_real_escape_string($_POST["Day"]);
					$start = mysql_real_escape_string($_POST["Start"]);
					$stop = mysql_real_escape_string($_POST["Stop"]);
					#needs to check for overlaping schedules
					$query = "INSERT INTO `Schedule` (`DOW`, `Start`, `Stop`, `Target`) VALUES ('$dow', '$start', '$stop', '$target');";
					$result=mysql_query($query);
					//mysql_close($dbhandle);
				}

				#show schedule via dynamic html 
				$query="SELECT * from Schedule";
				$result=mysql_query($query);
				while($row=mysql_fetch_array($result)){
					$pid=$row{'PID'};
					$dow=$row{'DOW'};
					$start=$row{'Start'};
					$stop=$row{'Stop'};
					$target=$row{'Target'};

					#echo html
					echo "<form method=\"post\" action=\"schedule.php?u=$pid\"> ";
					echo "<select name=\"Day\"> ";
					#decide which is default selection
					switch ($dow) {
					    case "Mon":
					        echo "<option value=\"Mon\" selected=\"selected\">Monday</option> ";
							echo "<option value=\"Tue\">Tuesday</option> ";
							echo "<option value=\"Wed\">Wednesday</option> ";
							echo "<option value=\"Thu\">Thursday</option> ";
							echo "<option value=\"Fri\">Friday</option> ";
							echo "<option value=\"Sat\">Saturday</option> ";
							echo "<option value=\"Sun\">Sunday</option> ";
					        break;
					    case "Tue":
							echo "<option value=\"Mon\">Monday</option> ";
							echo "<option value=\"Tue\" selected=\"selected\">Tuesday</option> ";
							echo "<option value=\"Wed\">Wednesday</option> ";
							echo "<option value=\"Thu\">Thursday</option> ";
							echo "<option value=\"Fri\">Friday</option> ";
							echo "<option value=\"Sat\">Saturday</option> ";
							echo "<option value=\"Sun\">Sunday</option> ";
					        break;
				        case "Wed":
							echo "<option value=\"Mon\">Monday</option> ";
							echo "<option value=\"Tue\">Tuesday</option> ";
							echo "<option value=\"Wed\" selected=\"selected\">Wednesday</option> ";
							echo "<option value=\"Thu\">Thursday</option> ";
							echo "<option value=\"Fri\">Friday</option> ";
							echo "<option value=\"Sat\">Saturday</option> ";
							echo "<option value=\"Sun\">Sunday</option> ";
					        break;
				        case "Thu":
							echo "<option value=\"Mon\">Monday</option> ";
							echo "<option value=\"Tue\">Tuesday</option> ";
							echo "<option value=\"Wed\">Wednesday</option> ";
							echo "<option value=\"Thu\" selected=\"selected\">Thursday</option> ";
							echo "<option value=\"Fri\">Friday</option> ";
							echo "<option value=\"Sat\">Saturday</option> ";
							echo "<option value=\"Sun\">Sunday</option> ";
					        break;
				        case "Fri":
							echo "<option value=\"Mon\">Monday</option> ";
							echo "<option value=\"Tue\">Tuesday</option> ";
							echo "<option value=\"Wed\">Wednesday</option> ";
							echo "<option value=\"Thu\">Thursday</option> ";
							echo "<option value=\"Fri\" selected=\"selected\">Friday</option> ";
							echo "<option value=\"Sat\">Saturday</option> ";
							echo "<option value=\"Sun\">Sunday</option> ";
					        break;
				        case "Sat":
							echo "<option value=\"Mon\">Monday</option> ";
							echo "<option value=\"Tue\">Tuesday</option> ";
							echo "<option value=\"Wed\">Wednesday</option> ";
							echo "<option value=\"Thu\">Thursday</option> ";
							echo "<option value=\"Fri\">Friday</option> ";
							echo "<option value=\"Sat\" selected=\"selected\">Saturday</option> ";
							echo "<option value=\"Sun\">Sunday</option> ";
					        break;
				        case "Sun":
					        echo "<option value=\"Mon\">Monday</option> ";
							echo "<option value=\"Tue\">Tuesday</option> ";
							echo "<option value=\"Wed\">Wednesday</option> ";
							echo "<option value=\"Thu\">Thursday</option> ";
							echo "<option value=\"Fri\">Friday</option> ";
							echo "<option value=\"Sat\">Saturday</option> ";
							echo "<option value=\"Sun\" selected=\"selected\">Sunday</option> ";
					        break;
					    }
					echo "</select> ";
					echo "<input type=\"text\" value=\"$start\" name=\"Start\"> ";
					echo "<input type=\"text\" value=\"$stop\" name=\"Stop\"> ";
					echo "<input type=\"text\" value=\"$target\" name=\"SchedTarget\"> ";
					echo "<input type=\"submit\" value=\"Save\"> ";
					echo "<a href=\"schedule.php?d=$pid\"><img border=\"0\" src=\"delete.png\" align=\"absmiddle\" alt=\"Delete entry\" width=\"23\" height=\"20\"> </a>";
					//echo "<a href=\"schedule.php?u=$pid\"><img border=\"0\" src=\"save.png\" align=\"middle\" alt=\"Update entry\" width=\"23\" height=\"20\">";
					echo "</form> ";
					//echo "<BR>";
				}
				mysql_close($dbhandle);
			?>
          
  </div>        
</div>
        <div id="footer"></div>

</body>
</html>