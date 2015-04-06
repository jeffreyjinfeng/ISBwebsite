<?php
include 'databaseauth.php';
$firstname = $_POST['firstname'];
$middlename = $_POST['middlename'];
$lastname = $_POST['lastname'];
$phonehome = $_POST['phonehome'];
$phonemobile = $_POST['phonemobile'];
$internationalphonemobile = $_POST['Intlphonemobile'];
$email = $_POST['email'];
$password = $_POST['password'];
$cpassword = $_POST['confirmpassword'];
$dob = $_POST['dob'];
$ssn = $_POST['ssn'];
$hmaddresstype = $_POST['hmaddresstype'];
$hmaddress = $_POST['hmaddress'];
$hmstreet = $_POST['hmstreet'];
$hmcity = $_POST['hmcity'];
$hmstate = $_POST['hmstate'];
$hmzip = $_POST['hmzip'];
$country = $_POST['country'];
$date = date('m/d/Y h:i:s a', time());
$accesslevel = 1 ;
$urlok = 'http://localhost/isb/welcome.html';
$urlerror = 'http://localhost/isb/error.html';
$Userroledesp = "Customer";
// Make a MySQL Connection
if($password == $cpassword )
{
mysql_query("INSERT INTO isb.`UserId`( `UserAccessLevel`, `FirstLoginDate`, `LastLoginDate`, `LoginPassword`, `UserRoleDescription`) 
			VALUES ( 1,NOW(),NOW(),'$password','$Userroledesp')")
or die(mysql_error());
// Get a specific result from the "example" table
$result = mysql_query("SELECT * FROM UserId
 WHERE LoginPassword= '$password'") or die(mysql_error());  
// get the first (and hopefully only) entry from the result
$row = mysql_fetch_array( $result );
$usrid = $row['UserId'];

// Enter into table customer
mysql_query("INSERT INTO `customer`(`CustomerFirstName`, `CustomerMiddleName`, `CustomerLastName`, `PhoneHome`, `PhoneMobile1`, `PhoneInternational`, `EmailId`, `LastDateModified`, `DOB`, `UserId`, `SSN`) VALUES ('$firstname','$middlename','$lastname','$phonehome','$phonemobile','$phonemobile','$email',NOW(),'$dob','$usrid','$ssn')")
or die(mysql_error());

//Enter into table address customer
mysql_query("INSERT INTO `addresses`( `AddressType`,`AddressLine1`, `AddressLine2`, `City`, `Zipcode`, `StateCode`, `Country`) VALUES ('$hmaddresstype ','$hmaddress', '$hmstreet', '$hmcity', '$hmzip', '$hmstate', '$country')")
or die(mysql_error());

// Get ID`s

// Get max address ID
$addid = mysql_query("SELECT MAX(AddressId) as AddressId FROM addresses");
$addidval = mysql_fetch_array($addid);
$addressref = $addidval["AddressId"];
// Get max customer ID
$addid = mysql_query("SELECT MAX(CustomerId) as AddressId FROM customer");
$addidval = mysql_fetch_array($addid);
$cusressref = $addidval["AddressId"];
//Enter into table cust_addr
mysql_query("INSERT INTO `cust_addr`(`CustomerID`, `AddressID`) 
			VALUES 	('$cusressref','$addressref')")
or die(mysql_error());

header( "Location: $urlok" );
}
else{
header( "Location: $urlerror" );
}
?>
