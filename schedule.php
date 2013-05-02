 <?php  
  include("db_connect.php");
  include("functions.php");
  include("nocsrf.php");
  sec_session_start();
  if(login_check($mysqli) != true) {header('Location: ./login.php?');}
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
			<?php 
				if(login_check($mysqli) == true) {
					echo "result: $result <br>"; 
					echo "token: $token <br>";
					#delete entry of passed PID
					if ($_GET['d']){
						try{ 
	          				NoCSRF::check( 'csrf_token', $_POST, true, 60*10, false );
	          				$result = 'CSRF check passed. Form parsed.';
							$pid=mysqli_real_escape_string($selected, $_GET['d']);
							$statement = $selected->prepare("DELETE FROM Schedule WHERE PID=?");
				            $statement->bind_param("i", $pid);
				            $statement->execute();
				            $statement->close();
				        }
		            	catch ( Exception $e ){
		              		// CSRF attack detected
		              		$result = $e->getMessage() . ' Form ignored.';
		            	}
					}


					#update entry of passed PID
					if ($_GET['u']){
						try{ 
	          				NoCSRF::check( 'csrf_token', $_POST, true, 60*10, false );
	          				$result = 'CSRF check passed. Form parsed.';
		        			$pid=mysqli_real_escape_string($selected,$_GET['u']);
		        			$target=mysqli_real_escape_string($selected,$_POST["SchedTarget$pid"]);
		        			$dow==mysqli_real_escape_string($selected,$_POST["day$pid"]);
		        			$start=mysqli_real_escape_string($selected,$_POST["Start$pid"]);
		        			$stop=mysqli_real_escape_string($selected,$_POST["Stop$pid"]);
		        			
		        			$statement = $selected->prepare("UPDATE Schedule SET DOW=?, Start=?, Stop=?, Target=? WHERE PID=?");
		        			$statement->bind_param("ssssi", $dow, $start, $stop, $target, $pid);
		        			$statement->execute();
		        			$statement->close();
		        		}
		            	catch ( Exception $e ){
		              		// CSRF attack detected
		              		$result = $e->getMessage() . ' Form ignored.';
		            	}
	        		}

					#write the new entry
					if ($_GET['w']){
						try{ 
	          				NoCSRF::check( 'csrf_token', $_POST, true, 60*10, false );
	          				$result = 'CSRF check passed. Form parsed.';
							$target=mysqli_real_escape_string($selected,$_POST["SchedTarget"]);
							$dow=mysqli_real_escape_string($selected,$_POST["dow"]);
							$start=mysqli_real_escape_string($selected,$_POST["Start"]);
							$stop=mysqli_real_escape_string($selected,$_POST["Stop"]);
							#needs to check for overlaping schedules
							$statement = $selected->prepare("INSERT INTO Schedule (DOW, Start, Stop, Target) VALUES (?, ?, ?, ?)");
		        			$statement->bind_param("ssss", $dow, $start, $stop, $target);
		        			$statement->execute();
		        			$statement->close();
		        		}
		            	catch ( Exception $e ){
		              		// CSRF attack detected
		              		$result = $e->getMessage() . ' Form ignored.';
		            	}						
					}
					$token = NoCSRF::generate( 'csrf_token' );
					echo "new token: $token";
				} else {
   					echo 'You are not authorized to access this page, please login. <br/>';
				}
			?>
			<form method="post" action="schedule.php?w=1">
			<input type="hidden" name="csrf_token" value="<?php echo $token; ?>">
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
					
					#show schedule via dynamic html 
					$statement = $selected->prepare("SELECT PID, DOW, Start, Stop, Target from Schedule ORDER BY DOW, Start");
					$statement->execute();
					$statement->bind_result($pid, $dow, $start, $stop, $target);
					while ($statement->fetch()) {

						#echo html
						echo "<form method=\"post\" action=\"schedule.php?u=$pid\"> ";
						echo "<input type=\"hidden\" name=\"csrf_token\" value=\"$token\">";
						//echo "<input type=\"hidden\" name=\"csrf_token\" value=\"$token\"> ";
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