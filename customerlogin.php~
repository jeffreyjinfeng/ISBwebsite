<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">
    <link rel="stylesheet" href="../isb/css/jquery-ui.css">
    <link rel="stylesheet" href="../isb/css/application.css">
<script src="../isb/js/jquery-1.10.2.js"></script>
    <script src="../isb/js/jquery-ui-1.10.4.custom.js"></script>
    <script>
	function popupupdatescreen(){
	window.open("http://localhost/isb/notification.php/?errorid=4","_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=500, left=300, width=500, height=800");
	window.location.href = 'http://localhost/isb/';
	} 
	   
    </script>
    <script>
	function closeafter(){
	setTimeout('self.close();',5000);
	}
    </script>
    <script src="../isb/js/test.js"></script>	
    <title>ISB Notification</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="justified-nav.css" rel="stylesheet">
   </head>
<?php session_start(); ?>
<body>
<?php
include 'databaseauth.php';
$email = mysql_real_escape_string($_POST['email']);
$password = $_POST['password'];
$urlerror = 'http://localhost/isb/notification.php/?errorid=4';

//get userId and customerId
$result1 = mysql_query("SELECT * FROM customer
 WHERE EmailId = '$email'") or die(mysql_error());
$row1 = mysql_fetch_array( $result1 );
$userid = $row1['UserId'];
$customID = $row1['CustomerId'];
// check password based on userId
$result2 = mysql_query("SELECT * FROM UserId
 WHERE UserId= '$userid'") or die(mysql_error());  
// get the first (and hopefully only) entry from the result
$row2 = mysql_fetch_array( $result2 );

if($row2['LoginPassword'] == $password ){
//--**************************************** Change login status to 1
$_SESSION['loggedin'] = "yes";
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}
$LoginStatus = "yes";
$token = rand(1000, 10000);
$key = $userid.$token;
setcookie("user", "$userid", time()+3600);
setcookie("coustmerid", "$customID", time()+3600);
setcookie("isbtokenkey", "$key", time()+3600);

mysql_query("INSERT INTO isb.`Login`( `User`,`TokenKey`, `LoginStatus`, `IP`) 
			VALUES ( '$userid','$key','$LoginStatus','$ip')")
or die(mysql_error());

//-------------------------------------------------------------------
$lastlogindate = date("Y/m/d");
$lastdatemodified = date("Y/m/d");



// update the LastLoginDate in UserRoleId table in database 

mysql_query("UPDATE UserId SET LastLoginDate = '$lastlogindate'
 WHERE UserId = '$userid'") 
or die(mysql_error());


// update the LastDateModified in employee table in database
mysql_query("UPDATE customer SET LastDateModified = '$lastdatemodified'
 WHERE EmailId = '$email'") 
or die(mysql_error());


//-------------------------------------------------------------------

$urlwelcomeback = 'http://localhost/isb/customerdashboard.php?ref='.$customID;
header( "Location: $urlwelcomeback" );
}

//http://localhost/we/landing-page/accounts/mick75/profile.php
else{
echo "<script> popupupdatescreen(); </script>";
}

?>
</body></html>
