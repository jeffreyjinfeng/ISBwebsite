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
    <script src="../isb/js/test.js"></script>	
    <title>ISB Notification</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="justified-nav.css" rel="stylesheet">
   </head>
<?php
include 'databaseauth.php';
$email2 = $_POST['email2'];
$actype = $_POST['actype'];
$amount = $_POST['amount2'];
$ouremployeeid = $_GET["ref"];
$transactionamount = $amount;
$cid = $_COOKIE["employeeid"];
//check whether the email is right or wrong
$result1 = mysql_query("SELECT * FROM customer
 WHERE EmailId = '$email2'") or die(mysql_error());
$row1 = mysql_fetch_array( $result1 );
$userid = $row1['UserId'];
$CustomerId = $row1['CustomerId'];
$email = $row1['EmailId'];

if ($email != $email2){
$errorid = 14 ;
 echo "<script> popupupdatescreen($errorid, $cid); </script>"; 
}else{
// check the existance of the account
$result3 = mysql_query("SELECT * FROM account
 WHERE CustomerId = '$CustomerId' and AccountType= '$actype'") or die(mysql_error());
 $row3 = mysql_fetch_array( $result3);
 $cactype = $row3['AccountType'];
  if ($cactype != $actype){
 $errorid = 15 ;
 echo "<script> popupupdatescreen($errorid, $cid); </script>";
 }else{
// if exsit -> add the value and display the current balance.
$balance = $row3['CurrentBalance'];
$balance = $balance + $amount;

mysql_query("UPDATE account 
		SET CurrentBalance='$balance' 
		WHERE CustomerId= '$CustomerId' and AccountType= '$actype'") or die(mysql_error());
		
//update the transaction table
$acountid = $row3['AccountId'];
$detail = 'deposit';
$deposit = 'deposit';
$transactionstatus = 'successfully';
mysql_query("INSERT INTO transactions 
(AccountId,TransactionDate, TransactionDetail, TransactionType, Amount,TransactionStatus) VALUES('$acountid', NOW(), '$detail','$deposit', '$transactionamount', '$transactionstatus') ") 
or die(mysql_error());

$errorid = 16 ;
 echo "<script> popupupdatescreen($errorid, $cid); </script>";

}
}
?>
</head>
</html>
