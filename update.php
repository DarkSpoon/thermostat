<?php
	include("login.php");

	$dbhandle=mysql_connect(localhost,$un,$pw) or die("Unable to connect!");
	
	echo "Connected <BR>";
	
	$selected=mysql_select_db($db) or die("Unable to select!");

	$query="DELETE FROM tablename";
	$result=mysql_query($query);

	$target = mysql_real_escape_string($_POST['Target']);
	$query = "INSERT INTO Schedule VALUES ('1','Mon', '00:00', '23:59', '$target')";
	$result=mysql_query($query);
	
	echo $result;

$redirect = 'pull.php';
echo "<center><font face=\"tahoma\">Click <a href=\"$redirect\">here</a> if your browser does not automatically redirect you</font></center>";
?>
<SCRIPT LANGUAGE="JavaScript">
redirTime = "2550";
redirURL = "<?php echo $redirect ?>";
function redirTimer() {
self.setTimeout("self.location.href = redirURL;",redirTime);}
</script>
<BODY onLoad="redirTimer()">
<?php

?>