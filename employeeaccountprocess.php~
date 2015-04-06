<html><body>

<?php
include 'databaseauth.php';
// Make a MySQL Connection
$firstname = $_POST['firstname'];
$middlename = $_POST['middlename'];
$lastname = $_POST['lastname'];
$userpassword = $_POST['upassword'];
$cpassword = $_POST['confirmpassword'];
//$email = $_POST['uemail'];
$email = mysql_real_escape_string($_POST['uemail']);
$employeeid = $_POST['employeeid'];
$userid = $employeeid;
$userrole = $_POST['userrole'];
$hmaddresstype = $_POST['hmaddresstype'];
$hmaddress = $_POST['hmaddress'];
$hmstreet = $_POST['hmstreet'];
$hmcity = $_POST['hmcity'];
$hmstate = $_POST['hmstate'];
$hmzip = $_POST['hmzip'];
$country = $_POST['country'];
$useraccesslevel = 2;
$firstlogindate = date("Y/m/d");
$lastlogindate = date("Y/m/d");
$lastdatemodified = date("Y/m/d");


if($userrole == "clerk") $useraccesslevel = 2;
if($userrole == "manager") $useraccesslevel = 3;
if($userrole == "admin") $useraccesslevel = 4;

$urlok = 'http://localhost/isb/welcome.html';
$urlerror = 'http://localhost/isb/error.html';


if($userpassword == $cpassword )
{
mysql_query("INSERT INTO isb.`UserId`( `UserAccessLevel`, `FirstLoginDate`, `LastLoginDate`, `LoginPassword`, `UserRoleDescription`) 
			VALUES ( '$useraccesslevel',NOW(),NOW(),'$userpassword','$userrole')")
or die(mysql_error());
// Get a specific result from the "example" table
$result = mysql_query("SELECT * FROM UserId
 WHERE LoginPassword= '$userpassword'") or die(mysql_error());  
// get the first (and hopefully only) entry from the result
$row = mysql_fetch_array( $result );
$usrid = $row['UserId'];

mysql_query("INSERT INTO employee 
( EmployeeFirstName, EmployeeMiddleName, EmployeeLastName, EmailId, UserId, LastDateModified) VALUES('$firstname', '$middlename', '$lastname', '$email','$usrid', '$lastdatemodified') ") 
or die(mysql_error());

//Enter into table address 
mysql_query("INSERT INTO `addresses`( `AddressType`,`AddressLine1`, `AddressLine2`, `City`, `Zipcode`, `StateCode`, `Country`) VALUES ('$hmaddresstype ','$hmaddress', '$hmstreet', '$hmcity', '$hmzip', '$hmstate', '$country')")
or die(mysql_error());

// Get ID`s

// Get max address ID
$addid = mysql_query("SELECT MAX(AddressId) as AddressId FROM addresses");
$addidval = mysql_fetch_array($addid);
$addressref = $addidval["AddressId"];
// Get max employee ID
$addid = mysql_query("SELECT MAX(EmployeeId) as AddressId FROM employee");
$addidval = mysql_fetch_array($addid);
$cusressref = $addidval["AddressId"];
//Enter into table empl_addr
mysql_query("INSERT INTO `empl_addr`(`EmployeeId`, `AddressID`) 
			VALUES 	('$cusressref','$addressref')")
or die(mysql_error());

//------------------------------------------------

$url = "http://localhost/isb/empindex.html";
$string = "\""."<a href=$url>login</a>"."\"";
header( "Location: $urlok" );
}
else{
header( "Location: $urlerror" );
}

?>

</body></html>

