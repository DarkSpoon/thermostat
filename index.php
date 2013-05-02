<?php 
  include("db_connect.php");
  include("functions.php");
  include("nocsrf.php");

  sec_session_start();
  //session_start();
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
      <div align="center" class="contentTitle"><h1>Current Status</h1></div>
        
        <div class="contentText">
          <hr>
      <?php
        if(login_check($mysqli) == true) {
          

          #Set manual overrides for Heat, AC, and Fan
          if ($_GET['w']==1){
            try{ 
              NoCSRF::check( 'csrf_token', $_POST, true, 60*10, false );
              $hvac=mysqli_real_escape_string($selected, $_POST["HVAC"]);
              $fan=mysqli_real_escape_string($selected, $_POST["fan"]);       
              
              if ($hvac=="heat"){
                $heater=1;
                $ac=0;
              }
              elseif ($hvac=="ac"){
                $heater=0;
                $ac=1;
              }

              if($statement = $selected->prepare("UPDATE User_Req SET Heater=?, AC=?, Fan=?")){
                $statement->bind_param("iii", $heater, $ac, $fan);
                $statement->execute();
                $statement->close();
              }else echo "1, not prepared";
              $result = 'CSRF check passed. Form parsed.';
            }
            catch ( Exception $e ){
              // CSRF attack detected
              $result = $e->getMessage() . ' Form ignored.';
            }
          }


          #reset temp to scheduled temp
          if ($_GET['w']==2){
              if($statement = $selected->prepare("UPDATE User_Req SET Temp=0")){
                //$statement->bind_param("i", 0);
                $statement->execute();
                $statement->close();
              }else echo "2, not prepared";
          }


          #set manual override for temp         
          if ($_GET['w']==3){
              if(empty($_POST["Target"])){              
                $target = 0;
              } 
              else {
                $target=mysqli_real_escape_string($selected, $_POST["Target"]);
              }
              if($statement = $selected->prepare("UPDATE User_Req SET Temp = ?")){
                $statement->bind_param('s', $target);
                $statement->execute();
                $statement->close();
              }else echo "3, not prepared";
          }


          if ($statement = $selected->prepare("SELECT AC, Heater, Fan from User_Req")) { 
            $statement->execute();
            $statement->bind_result($ACrunning, $Heatrunning, $Fanrunning);
            $statement->fetch();
            #Build strings to display what is currently running. 
            if($ACrunning==1)
              echo "Cool, ";
            else if($Heatrunning==1)
              echo "Heat, ";
            if($Fanrunning==0)
              echo "Auto <BR>";
            else if($Fanrunning==1)
              echo "On <BR>";
            $statement->close();
          } else echo "No query ran";

         if($statement = $selected->prepare("SELECT Temp, Target, AC, Heat, Fan from Conditions")){
          $statement->execute();
          $statement->bind_result($temp, $target, $AC, $Heat, $Fan);
          $statement->fetch();
            
            echo "$temp F<br>";
            #The below values will be used to trigger relays in server code and should reflect an accurate status
            if($AC==1)
              echo "AC is running<BR>";
            else if($Heat==1)
              echo "Heat is running<BR>";
            else if($AC==0 && $Heat==0)
              echo "System is idle<BR>";
            if ($Fan==1)
              echo "Fan is running<BR>";
            else if ($Fan==0)
              echo "Fan is not running<BR>";              
            $statement->close();
          } else echo "No query ran";

        } else {
          echo 'You are not authorized to access this page, please login. <br/>';
        }
      ?>
  </div>
        <div align="center" class="contentTitle"><h1>Manual Settings</h1></div>
        
        <div class="contentText">
          <hr>
          <h2>HVAC</h2>
          <hr>
          <form method="post" action="index.php?w=1">
          <input type="radio" name="HVAC" value="heat"<?php if($Heatrunning) echo "checked";?> > Heater<br>
          <input type="radio" name="HVAC" value="ac" <?php if($ACrunning) echo "checked";?> > AC<br>
          <h2>Fan</h2>
          <hr>
          <input type="radio" name="fan" value="1"<?php if($Fanrunning==1) echo "checked";?> > On<br>
          <input type="radio" name="fan" value="0" <?php if($Fanrunning==0) echo "checked";?> > Auto<br>
          <input type="submit" value="Submit">
          <input type="hidden" name="csrf_token" value="<?php echo $token; ?>"></form>
          <h2>Temperature</h2>
          <hr>
          <form method="post" action="index.php?w=3">
          <input type="text" value=<?php echo $target." "; ?>name="Target">
          <input type="submit" value="Submit">
          <input type="hidden" name="csrf_token" value="<?php echo $token; ?>"></form>

          <form method="post" action="index.php?w=2"><input type="submit" value="Reset">
          <input type="hidden" name="csrf_token" value="<?php echo $token; ?>"></form>
          
  </div>        
</div>
        <div id="footer"></div>
</body>
<?php 
  $selected->close();
?>
</html>
