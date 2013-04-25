<?php 
  //include("includes.php"); 
  include("db_connect.php");
  include("functions.php");
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
         /* if ($_GET['w']==1){
              #Set manual overrides for Heat, AC, and Fan
              $hvac=mysqli_real_escape_string($selected, $_POST["HVAC"]);
              $fan=mysqli_real_escape_string($selected, $_POST["fan"]);
              //$hvac=mysql_real_escape_string($_POST["HVAC"]);
              //$fan=mysql_real_escape_string($_POST["fan"]);            
              
              if ($hvac=="heat"){
                $heater=1;
                $ac=0;
              }
              elseif ($hvac=="ac"){
                $heater=0;
                $ac=1;
              }
              //$query = "UPDATE User_Req SET Heater=$heater, AC=$ac, Fan=$fan";
              //$result=mysql_query($query);
              $statment = $selected->prepare("UPDATE `User_Req` SET `Heater`=?, `AC`=?, `Fan`=?");
              $statement->bind_param("iii", $heater, $AC, $fan);
              $statement->execute();
              //$statement-> bind_result($result);//can echo $result
              //$statement->fetch();
              $statement->close();
          }*/
          /*if ($_GET['w']==2){#reset temp to scheduled temp
              //$query = "UPDATE User_Req SET Temp=0";
              //$result=mysql_query($query);
              $statment = $selected->prepare("UPDATE `User_Req` SET `Temp`=?");
              $statement->bind_param("i", 0);
              $statement->execute();
              $statement->close();
          }*/

          /*if ($_GET['w']==3){#set manual override for temp
              if(empty($_POST["Target"])){              
                $target = 0;
              } 
              else {
                //$target = mysql_real_escape_string($_POST["Target"]);
                $target=mysqli_real_escape_string($selected, $_POST["Target"]);
              }
              //$query = "UPDATE User_Req SET Temp=$target";
              //$result=mysql_query($query);

              $statment = $selected->prepare("UPDATE `User_Req` SET `Temp` = ?");
              $statement->bind_param('f', $target);
              $statement->execute();
              $statement->close();
              
          }*/


          //$query="SELECT * from User_Req";
          //echo $mysqli->host_info . "\n";
          echo $selected->host_info . "\n";
          if($selected->connect_error){
             echo "Not connected, error";
          }else{
             echo "Connected.";
          }
          //if ($statment = $selected->prepare("SELECT AC, Heat, Fan from User_Req")){
          $statment = $selected->prepare("SELECT AC, Heat, Fan from User_Req"
            $statement->execute();
            //$result=mysql_query($query);
            $ACrunning=NULL;
            $Heatrunning=NULL;
            $Fanrunning=NULL;
            $statement->bind_result($ACrunning, $Heatrunning, $Fanrunning);
            $statement->fetch();
            if($ACrunning==1)
              echo "Cool, ";
            else if($Heatrunning==1)
              echo "Heat, ";
            if($Fanrunning==0)
              echo "Auto <BR>";
            else if($Fanrunning==1)
              echo "On <BR>";
            $statement->close();
          //} else echo "No query ran: $statement";
          #Build strings to display what is currently running. 
          /*while($row=mysql_fetch_array($result)){
            $ACrunning=$row{'AC'};
            $Heatrunning=$row{'Heater'};
            $Fanrunning=$row{'Fan'};

            if($ACrunning==1)
              echo "Cool, ";
            else if($Heatrunning==1)
              echo "Heat, ";
            if($Fanrunning==0)
              echo "Auto <BR>";
            else if($Fanrunning==1)
              echo "On <BR>";
          }*/

          //$query="SELECT * from Conditions";
         /* $statment = $selected->prepare("SELECT `AC`,`Heat`,`Fan`,`Target` from `Conditions`");
          //$result=mysql_query($query);
          $statement->execute();
          $AC=NULL;
          $Heat=NULL:
          $Fan=NULL;
          $Target=NULL;
          $statement->bind_result($AC, $Heat, $Fan, $Target);
          $statement->close();*/
          /*while($row=mysql_fetch_array($result)){
            echo "Currently: ".$row{'Temp'}."F<BR>";
            $AC=$row{'AC'};
            $Heat=$row{'Heat'};
            $Fan=$row{'Fan'};*/
            
            /*#The below values will be used to trigger relays in server code and should reflect an accurate status
            if($AC==1)
              echo "AC is running<BR>";
            else if($Heat==1)
              echo "Heat is running<BR>";
            else if($AC==0 && $Heat==0)
              echo "System is idle<BR>";
            if ($Fan==1)
              echo "Fan is running<BR>";
            else if ($Fan==0)
              echo "Fan is not running<BR>";  */              
            /*$target=$row{'Target'};
          }*/

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
          <input type="submit" value="Submit"></form>
          <h2>Temperature</h2>
          <hr>
          <form method="post" action="index.php?w=3">
          <input type="text" value=<?php echo $target." "; ?>name="Target">
          <input type="submit" value="Submit"></form><form method="post" action="index.php?w=2"><input type="submit" value="Reset"></form>
          
  </div>        
</div>
        <div id="footer"></div>
</body>
<?php /*mysql_close($dbhandle);*/
$selected->close();
?>
</html>
