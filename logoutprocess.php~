<?php
include 'databaseauth.php';
session_start();
session_destroy();
$userid = $_COOKIE["user"];
mysql_query("DELETE FROM Login WHERE User='$userid'") 
or die(mysql_error());  
setcookie("user", "oawuhfowuhoiwh", time()+3600);
setcookie("coustmerid", "00000", time()+3600);
setcookie("isbtokenkey", "00000", time()+3600);
header("Location: http://localhost/isb/index.html");
?>
