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
            <div class="link"><a href="pull.php">Pull</a></div>
            
      </div>

        <div align="center" class="contentTitle"><h1>Current Status</h1></div>
        
        <div class="contentText">
          <hr>
            <?php
              include("login.php");
              $dbhandle=mysql_connect(localhost,$un,$pw) or die("Unable to connect!");  
              $selected=mysql_select_db($db) or die("Unable to select!");


              $query="SELECT * from User_Req";
              $result=mysql_query($query);
              #Build strings to display what is currently running. 
              while($row=mysql_fetch_array($result)){
                $AC=$row{'AC'};
                $Heat=$row{'Heater'};
                $Fan=$row{'Fan'};

                if($AC==1)
                  echo "Cool, ";
                else if($Heat==1)
                  echo "Heat, ";
                if($Fan==0)
                  echo "Auto <BR>";
                else if($Fan==1)
                  echo "On <BR>";
              }

              $query="SELECT * from Conditions";
              $result=mysql_query($query);
              while($row=mysql_fetch_array($result)){
                echo "Currently: ".$row{'Temp'}."F<BR>";
                $AC=$row{'AC'};
                $Heat=$row{'Heat'};
                $Fan=$row{'Fan'};
                
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
                echo "Target: ".$row{'Target'}."F<BR>";
              }
              #build output string
              #$output=$heatcool.$fanauto.$running.$fanrunning.$currenttarget;
              #echo $output;
              //mysql_close($dbhandle);

            ?>
  </div>
        <div align="center" class="contentTitle"><h1>Manual Settings</h1></div>
        
        <div class="contentText">
          <hr>
          <h2>HVAC</h2>
          <hr>
          <form method="post" action="index.php?w=1">
          <input type="radio" name="HVAC" value="heat"> Heater<br>
          <input type="radio" name="HVAC" value="ac" checked> AC<br>
          <h2>Fan</h2>
          <hr>
          <input type="radio" name="fan" value="1"> On<br>
          <input type="radio" name="fan" value="0" checked> Auto<br>
          <input type="submit" value="Submit"></form>
          <h2>Temperature</h2>
          <hr>
          <form method="post" action="index.php?w=1">
          <input type="text" name="Target">
          <input type="submit" value="Submit"></form><form method="post" action="index.php?w=2"><input type="submit" value="Reset"></form>
          
  </div>        
</div>
        <div id="footer"></div>
  <?php
    if ($_GET['w']==1){
        //include("login.php");
        //$dbhandle=mysql_connect(localhost,$un,$pw) or die("Unable to connect!");      
        //$selected=mysql_select_db($db) or die("Unable to select!");

        #Set manual overrides
        $hvac=mysql_real_escape_string($_POST["HVAC"]);
        $fan=mysql_real_escape_string($_POST["fan"]);
        if(isset($_POST["Target"])){
          $target = mysql_real_escape_string($_POST["Target"]);
        } 
        else {
          $target=0;
        }
        
        if ($hvac=="heat"){
          $heater=1;
          $ac=0;
        }
        elseif ($hvac=="ac"){
          $heater=0;
          $ac=1;
        }
        $query = "UPDATE User_Req SET Heater=$heater, AC=$ac, Fan=$fan, Temp=$target";
        $result=mysql_query($query);

        mysql_close($dbhandle);
    }
    if ($_GET['w']==2){
        $query = "UPDATE User_Req SET Temp=0";
        $result=mysql_query($query);

        mysql_close($dbhandle);
    }
  ?>
</body>
</html>
