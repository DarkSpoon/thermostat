<?php
include("login.php");
$dbhandle=mysql_connect(localhost,$un,$pw) or die("Unable to connect!");	
echo "Connected <BR>";	
$selected=mysql_select_db($db) or die("Unable to select!");



$query="SELECT * from Conditions";
$result=mysql_query($query);

while($row=mysql_fetch_array($result)){
echo "<BR>Average temp from query ".$row{'Temp'}."F<BR>";
$AC=$row{'AC'};
$Heat=$row{'Heat'};
$Fan=$row{'Fan'};

if($AC==1)
echo "AC is running<BR>";
else if($Heat==1)
echo "Heat is running<BR>";
if ($Fan==1)
echo "Fan is running<BR>";

}

$query="SELECT Target from Conditions";
$result=mysql_query($query);
while($row=mysql_fetch_array($result)){
echo "Target temp from query ".$row{'Target'}."F<BR>";
}

mysql_close($dbhandle);

?>
