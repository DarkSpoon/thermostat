 <?php 
  //include("includes.php"); 
  //include("db_connect.php");
  //include("functions.php");
  //sec_session_start();
  //if(login_check($mysqli) != true) {header('Location: ./login.php?');}
?>
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
<?php include "includes.php" ?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css" />
<title>Thermostat</title>
</head>

<body>
    <div id="page">
		
        <div id="header">
        	<h1>Thermostat</h1>
            <h2>Control your heat and AC with RaspberryPi</h2>
            
      </div>
  <div id="bar">
        	<div class="link"><a href="index.php?w=0">Home</a></div>
            <div class="link"><a href="schedule.php?w=0">Schedule</a></div>
            <div class="link"><a href="logout.php">Logout</a></div>
            
      </div>
        <div align="center" class="contentTitle"><h1>Schedule</h1></div>
        
        <div class="contentText">
			<hr>
			<form method="post" action="schedule.php?w=1">
			<select name="Day">
			<option value=1>Monday</option>
			<option value=2>Tuesday</option>
			<option value=3>Wednesday</option>
			<option value=4>Thursday</option>
			<option value=5>Friday</option>
			<option value=6>Saturday</option>
			<option value=0>Sunday</option>
			</select>
			<input type="text" name="Start">
			<input type="text" name="Stop">
			<input type="text" name="SchedTarget">
			<input type="submit" value="Add">
			</form>
			<BR>
			<BR>
			<hr>
			<?php
				if(login_check($mysqli) == true) {
					#delete entry of passed PID
					if ($_GET['d']){
						//$pid=mysql_real_escape_string($_GET['d']);
						$pid=mysqli_real_escape_string($selected, $_GET['d']);
						//$query="DELETE FROM Schedule WHERE PID=$pid";
						//$result=mysql_query($query);
						$statment = $selected->prepare("DELETE FROM Schedule WHERE `PID`=?");
			            $statement->bind_param("i", $pid);
			            $statement->execute();
			            //$statement-> bind_result($result);//can echo $result
			            //$statement->fetch();
			            $statement->close();
					}


					#update entry of passed PID
					if ($_GET['u']){
						/*$pid=mysql_real_escape_string($_GET['u']);
						$target = mysql_real_escape_string($_POST["SchedTarget$pid"]);
						$dow = mysql_real_escape_string($_POST["Day$pid"]);
						$start = mysql_real_escape_string($_POST["Start$pid"]);
						$stop = mysql_real_escape_string($_POST["Stop$pid"]);

						$query = "UPDATE `Schedule` SET `DOW`='$dow',`Start`='$start',`Stop`='$stop',`Target`='$target' WHERE `PID`='$pid'";
	        			$result=mysql_query($query);*/
	        			$pid=mysqli_real_escape_string($selected,$_GET['u']);
	        			$target=mysqli_real_escape_string($selected,$_POST["SchedTarget$pid"]);
	        			$dow==mysqli_real_escape_string($selected,$_POST["day$pid"]);
	        			$start=mysqli_real_escape_string($selected,$_POST["Start$pid"]);
	        			$stop=mysqli_real_escape_string($selected,$_POST["Stop$pid"]);=mysqli_real_escape_string($selected,$_POST["SchedTarget$pid"]);
	        			
	        			$statment = $selected->prepare("UPDATE `Schedule` SET `DOW`=?,`Start`=?,`Stop`=?,`Target`=? WHERE `PID`=?");
	        			$statement->bind_param("sssfi", $dow, $start, $stop, $target, $pid);
	        			$statement->execute();
	        			$statement->close();

	        		}

					#write the new entry
					if ($_GET['w']){
						/*$target = mysql_real_escape_string($_POST["SchedTarget"]);
						$dow = mysql_real_escape_string($_POST["Day"]);
						$start = mysql_real_escape_string($_POST["Start"]);
						$stop = mysql_real_escape_string($_POST["Stop"]);*/
						$target=mysqli_real_escape_string($selected,$_POST["SchedTarget"]);
						$dow=mysqli_real_escape_string($selected,$_POST["dow"]);
						$start=mysqli_real_escape_string($selected,$_POST["Start"]);
						$stop=mysqli_real_escape_string($selected,$_POST["Stop"]);
						#needs to check for overlaping schedules
						/*$query = "INSERT INTO `Schedule` (`DOW`, `Start`, `Stop`, `Target`) VALUES ('$dow', '$start', '$stop', '$target');";
						$result=mysql_query($query);*/
						$statment = $selected->prepare("INSERT INTO `Schedule` (`DOW`, `Start`, `Stop`, `Target`) VALUES (?, ?, ?, ?)");
	        			$statement->bind_param("sssf", $dow, $start, $stop, $target);
	        			$statement->execute();
	        			$statement->close();
						
					}

					#show schedule via dynamic html 
					#$query="SELECT * from Schedule";
					//$query="SELECT * from Schedule ORDER BY DOW, Start";
					$statment = $selected->prepare("SELECT `PID`, `DOW`, `Start`, `Stop`, `Target` from Schedule ORDER BY DOW, Start");
					$statement->execute();
					
					//$result=mysql_query($query);
					$pid=NULL;
					$dow=NULL;
					$start=NULL;
					$stop=NULL;
					$target=NULL;
					$statement->bind_result($pid, $dow, $start, $stop, $target)
					while ($statement->fetch()) {
					/*while($row=mysql_fetch_array($result)){
						$pid=$row{'PID'};
						$dow=$row{'DOW'};
						$start=$row{'Start'};
						$stop=$row{'Stop'};
						$target=$row{'Target'};*/

						#echo html
						echo "<form method=\"post\" action=\"schedule.php?u=$pid\"> ";
						echo "<select name=\"Day$pid\"> ";
						#decide which is default selection
						switch ($dow) {
						    case 1:
						        echo "<option value=1 selected=\"selected\">Monday</option> ";
								echo "<option value=2>Tuesday</option> ";
								echo "<option value=3>Wednesday</option> ";
								echo "<option value=4>Thursday</option> ";
								echo "<option value=5>Friday</option> ";
								echo "<option value=6>Saturday</option> ";
								echo "<option value=0>Sunday</option> ";
						        break;
						    case 2:
								echo "<option value=1>Monday</option> ";
								echo "<option value=2 selected=\"selected\">Tuesday</option> ";
								echo "<option value=3>Wednesday</option> ";
								echo "<option value=4>Thursday</option> ";
								echo "<option value=5>Friday</option> ";
								echo "<option value=6>Saturday</option> ";
								echo "<option value=0>Sunday</option> ";
						        break;
					        case 3:
								echo "<option value=1>Monday</option> ";
								echo "<option value=2>Tuesday</option> ";
								echo "<option value=3 selected=\"selected\">Wednesday</option> ";
								echo "<option value=4>Thursday</option> ";
								echo "<option value=5>Friday</option> ";
								echo "<option value=6>Saturday</option> ";
								echo "<option value=0>Sunday</option> ";
						        break;
					        case 4:
								echo "<option value=1>Monday</option> ";
								echo "<option value=2>Tuesday</option> ";
								echo "<option value=3>Wednesday</option> ";
								echo "<option value=4 selected=\"selected\">Thursday</option> ";
								echo "<option value=5>Friday</option> ";
								echo "<option value=6>Saturday</option> ";
								echo "<option value=0>Sunday</option> ";
						        break;
					        case 5:
								echo "<option value=1>Monday</option> ";
								echo "<option value=2>Tuesday</option> ";
								echo "<option value=3>Wednesday</option> ";
								echo "<option value=4>Thursday</option> ";
								echo "<option value=5 selected=\"selected\">Friday</option> ";
								echo "<option value=6>Saturday</option> ";
								echo "<option value=0>Sunday</option> ";
						        break;
					        case 6:
								echo "<option value=1>Monday</option> ";
								echo "<option value=2>Tuesday</option> ";
								echo "<option value=3>Wednesday</option> ";
								echo "<option value=4>Thursday</option> ";
								echo "<option value=5>Friday</option> ";
								echo "<option value=6 selected=\"selected\">Saturday</option> ";
								echo "<option value=0>Sunday</option> ";
						        break;
					        case 0:
						        echo "<option value=1>Monday</option> ";
								echo "<option value=2>Tuesday</option> ";
								echo "<option value=3>Wednesday</option> ";
								echo "<option value=4>Thursday</option> ";
								echo "<option value=5>Friday</option> ";
								echo "<option value=6>Saturday</option> ";
								echo "<option value=0 selected=\"selected\">Sunday</option> ";
						        break;
						    }
						echo "</select> ";
						echo "<input type=\"text\" value=\"$start\" name=\"Start$pid\"> ";
						echo "<input type=\"text\" value=\"$stop\" name=\"Stop$pid\"> ";
						echo "<input type=\"text\" value=\"$target\" name=\"SchedTarget$pid\"> ";
						echo "<input type=\"submit\" value=\"Save\"> ";
						#echo "<button type=\"submit\" name=\"Save\" value=\"Save\" border=\"0\"> <img src=\"images/save.png\" alt=\"Save\"></button>";
						echo "<a href=\"schedule.php?d=$pid\"><img border=\"0\" src=\"images/delete.png\" align=\"absmiddle\" alt=\"Delete entry\" width=\"23\" height=\"20\"> </a>";
						echo "</form> ";
						//echo "<BR>";
					}
					$statement->close();
					//mysql_close($dbhandle);
					$selected->close();
				} else {
   					echo 'You are not authorized to access this page, please login. <br/>';
				}
			?>
          
  </div>        
</div>
        <div id="footer"></div>

</body>
</html>