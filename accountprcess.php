<?php
$firstname = $_POST['firstname'];
$middlename = $_POST['middlename'];
$lastname = $_POST['lastname'];
$phonehome = $_POST['phonehome'];
$phonemobile = $_POST['phonemobile'];
$email = $_POST['email'];
$password = $_POST['password'];
$cpassword = $_POST['confirmpassword'];
$dob = $_POST['dob'];
$ssn = $_POST['ssn'];
$hmaddress = $_POST['hmaddress'];
$hmstreet = $_POST['hmstreet'];
$hmcity = $_POST['hmcity'];
$hmstate = $_POST['hmstate'];
$zip = $_POST['zip'];
$ofaddress = $_POST['ofaddress'];
$ofstreet = $_POST['ofstreet'];
$ofcity = $_POST['ofcity'];
$ofstate = $_POST['ofstate'];
$ofzip = $_POST['ofzip'];
$date = date('m/d/Y h:i:s a', time());
$accesslevel = 1 ;
// Make a MySQL Connection
mysql_connect("localhost", "root", "n2pl") or die(mysql_error());
mysql_select_db("isb") or die(mysql_error());
mysql_query(INSERT INTO `UserRoleId`( `UserAccessLevel`, `FirstLoginDate`, `LastLoginDate`, `LoginPassword`, `UserRoleDescription`) VALUES ('$accesslevel',NOW(),NOW(),'$password','Customer');)
or die(mysql_error());
// Get a specific result from the "example" table
//$result = mysql_query("SELECT * FROM UserRoleId
// WHERE email= '$email'") or die(mysql_error());  
// get the first (and hopefully only) entry from the result
//$row = mysql_fetch_array( $result );


// Enter into table customer
mysql_connect("localhost", "root", "n2pl") or die(mysql_error());
mysql_select_db("isb") or die(mysql_error());
mysql_query(INSERT INTO `customer`(`CustomerFirstName`, `CustomerMiddleName`, `CustomerLastName`, `PhoneHome`, `PhoneMobile1`, `PhoneInternational`, `EmailId`, `LastDateModified`, `DOB`, `UserId`, `SSN`) VALUES ('$firstname','$middlename','$lastname','$phonehome','$phonemobile','$phonemobile','$email','$dob','$date','$dob','0','$ssn');)
or die(mysql_error());


?>
