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
	function closescreen(){
	window.close();
	}    
    </script>
    <script src="../isb/js/test.js"></script>	
    <title>ISB Employee data Updated</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="justified-nav.css" rel="stylesheet">
   </head>
<?php
include 'databaseauth.php';
$firstname = $_POST['firstname'];
$middlename = $_POST['middlename'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$password = $_POST['password'];
$hmaddresstype = $_POST['hmaddresstype'];
$hmaddress = $_POST['hmaddress'];
$hmstreet = $_POST['hmstreet'];
$hmcity = $_POST['hmcity'];
$hmstate = $_POST['hmstate'];
$zip = $_POST['zip'];
$country = $_POST['country'];
$date = date('m/d/Y h:i:s a', time());
$accesslevel = 1 ;
$urlok = 'http://localhost/isb/welcome.html';
$urlerror = 'http://localhost/isb/error.html';
//----------------------------------------
$urlerror = 'http://localhost/isb/error.html';



//get userId and customerId
$result1 = mysql_query("SELECT * FROM employee
 WHERE EmailId = '$email'") or die(mysql_error());
$row1 = mysql_fetch_array( $result1 );
$userid = $row1['UserId'];
$customID = $row1['EmployeeId'];
// check password based on userId
$result2 = mysql_query("SELECT * FROM UserId
 WHERE UserId= '$userid'") or die(mysql_error());  
// get the first (and hopefully only) entry from the result
$row2 = mysql_fetch_array( $result2 );

if($row2['LoginPassword'] == $password ){
//------------------------------------------------------ Update data
if(! empty($firstname)){//firstname
mysql_query("UPDATE isb.`employee` 
		SET `EmployeeFirstName`='$firstname' 
		WHERE `EmployeeId`= '$customID';");
}
if(! empty($middlename)){//middlename
mysql_query("UPDATE isb.`employee` 
		SET `EmployeeMiddleName`='$middlename' 
		WHERE `EmployeeId`= '$customID';");
}
if(! empty($lastname)){//lastname
mysql_query("UPDATE isb.`employee` 
		SET `EmployeeLastName`='$lastname' 
		WHERE `EmployeeId`= '$customID';");
}


mysql_query("UPDATE isb.`employee` 
		SET `LastDateModified`= NOW() 
		WHERE `EmployeeId`='$customID';");
//-------------------------------------------------------------------


}
//----------------------------------------
else{
header( "Location: $urlerror" );
}
?>
<body  onload="window.resizeTo(600,200)">
<h2 bgcolor="#BDBDBD">Your data is updated</h2>
<p><a style="float:left" class="btn btn-primary" onclick="closescreen()" role="button">Close</a></p>
</body>
</head>
