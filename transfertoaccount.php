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
$status = 1;
$email = $_POST['email'];
$actype = $_POST['actype'];
$amount = $_POST['amount'];
$account = $_POST['accountnumber'];
$cid = $_COOKIE["coustmerid"];// this is loggedin cutomer id
$toaccounttype = "checking";
//-------- To account -----------
$result3 = mysql_query("SELECT * FROM account
 WHERE AccountId='$account'") or die(mysql_error());
$toaccountdetails = mysql_fetch_array($result3);
if($toaccountdetails == NULL){
$status = 0;
$errorid = 15;
echo "<script> popupupdatescreencust($errorid, $cid ); </script>";
}
//----------To account email
$result1 = mysql_query("SELECT * FROM customer
 WHERE EmailId = '$email'") or die(mysql_error());
$toaccountemail = mysql_fetch_array( $result1 );
if($toaccountemail  == NULL){
$status  = 0 ;
$errorid = 15;
echo "<script> popupupdatescreencust($errorid, $cid ); </script>";
}
//---------- from account number

//----------Check if account and email match--
$customerID = $toaccountemail['CustomerId'];
$chk = "checking";
$sav = "saving";
$resultacchk = mysql_query("SELECT * FROM account
 WHERE CustomerId = '$customerID' AND AccountType = '$chk' ") or die(mysql_error());
$toaccountchk = mysql_fetch_array( $resultacchk );
$resultacsav = mysql_query("SELECT * FROM account
 WHERE CustomerId = '$customerID' AND AccountType = '$sav' ") or die(mysql_error());
$toaccountsav = mysql_fetch_array( $resultacsav );
if($account  != $toaccountsav['AccountId']){
	if($account  != $toaccountchk['AccountId'])
{
	$status = 0 ;
	$errorid = 15;
	echo "<script> popupupdatescreencust($errorid, $cid ); </script>";
}
}

//------------------------------------------------------
//----------- check for suffient balance
$resultac = mysql_query("SELECT * FROM account
 WHERE CustomerId = '$cid' AND AccountType = '$actype' ") or die(mysql_error());
$fromaccountdetails = mysql_fetch_array( $resultac );
$currentamount = $fromaccountdetails['CurrentBalance'];
if ($amount > $currentamount){
$status = 0;
$errorid = 18;
echo "<script> popupupdatescreencust($errorid, $cid ); </script>";
}

//--------------------------------------------------
//----------If everything is ok we can now transfer

if ($status == 1) {
//--- fetch the current amount and update
$currentamount = $toaccountdetails['CurrentBalance'];
$newamount = $currentamount + $amount ;
mysql_query("UPDATE account 
		SET CurrentBalance='$newamount' 

		WHERE AccountId = '$account' AND AccountType = '$toaccounttype' ") or die(mysql_error());
//-----------------------------

//---------- deduct from "from" account
$currentamount = $fromaccountdetails['CurrentBalance'];
$newamount = $currentamount - $amount ;
mysql_query("UPDATE account 
		SET CurrentBalance='$newamount' 
		WHERE CustomerId = '$cid' AND AccountType = '$actype' ") or die(mysql_error());
$errorid = 23;
echo "<script> popupupdatescreencust($errorid, $cid ); </script>";
//----------------------------------------

//update the transaction table of TO
$acountid = $account;
$detail = 'deposit of from account '.$fromaccountdetails['AccountId'];
$deposit = 'deposit';
$transactionstatus = 'successfully';
mysql_query("INSERT INTO transactions 
(AccountId,TransactionDate, TransactionDetail, TransactionType, Amount,TransactionStatus) VALUES('$acountid', NOW(), '$detail','$deposit', '$amount', '$transactionstatus') ") 
or die(mysql_error());

//--------------------------------------------------
//update the transaction table of From
$acountid = $fromaccountdetails['AccountId'];
$detail = 'Transfer to account '.$account;
$deposit = 'transfer';
$transactionstatus = 'successfully';
mysql_query("INSERT INTO transactions 
(AccountId,TransactionDate, TransactionDetail, TransactionType, Amount,TransactionStatus) VALUES('$acountid', NOW(), '$detail','$deposit', '$amount', '$transactionstatus') ") 
or die(mysql_error());
$errorid = 16;
echo "<script> popupupdatescreencust($errorid, $cid ); </script>";
//---------------------

//------------------------------------------------------

}
else {
$errorid = 14;
echo "<script> popupupdatescreencust($errorid, $cid ); </script>";
}
 
?>
