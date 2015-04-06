<?php
include 'databaseauth.php';
$cid = $_COOKIE["coustmerid"];
$managerid = 7 ;
$requestid1 = 1 ;
$requestid2 = 2 ;
$priority = 1 ;
$usercomment1 = "checkingaccountcreate";
$usercomment2 = "savingaccountcreate";
mysql_query("INSERT INTO generalrequests 
( CustomerId, EmployeeId, RequestTypeId, IsPriority, UserComment ) VALUES('$cid', '$managerid','$requestid1', '$priority ','$usercomment1' ) ") 
or die(mysql_error());
mysql_query("INSERT INTO generalrequests 
( CustomerId, EmployeeId, RequestTypeId, IsPriority, UserComment ) VALUES('$cid', '$managerid','$requestid2', '$priority ','$usercomment2' ) ") 
or die(mysql_error()); 

header("Location: http://localhost/isb/customerdashboard.php?ref=$cid");

?>

