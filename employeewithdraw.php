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
			$(function() {
				$( "#tabs" ).tabs();
			});
    </script>
    <script src="../isb/js/test.js"></script>	
    <title>ISB employee withdraw</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="justified-nav.css" rel="stylesheet">
  </head>
  <body>
<?php
include 'databaseauth.php';
$email = $_POST['email3'];
$amount = $_POST['amount3'];
$transactionamount = $amount;
$actype = $_POST['actype'];

//check the username
$result1 = mysql_query("SELECT * FROM customer
WHERE EmailId = '$email'") or die(mysql_error());
$row1 = mysql_fetch_array( $result1 );
$userid = $row1['UserId'];
$CustomerId = $row1['CustomerId'];
$email2 = $row1['EmailId'];
$cid = $_COOKIE["employeeid"];

if($email != $email2 ){
$errorid = 17 ;
 echo "<script> popupupdatescreen($errorid, $cid); </script>";
}else{

//check the existence of the account
$result3 = mysql_query("SELECT * FROM account
WHERE CustomerId = '$CustomerId' AND AccountType= '$actype'") or die(mysql_error());
$row3 = mysql_fetch_array( $result3);
$cactype = $row3['AccountType'];
if ($cactype != $actype){
$errorid = 15 ;
 echo "<script> popupupdatescreen($errorid, $cid); </script>";
}else{
// check the balance of account
$balance = $row3['CurrentBalance'];

if ($balance < $amount){
$errorid = 18 ;
 echo "<script> popupupdatescreen($errorid, $cid); </script>";
}else{
// withdraw a certain amount of money and display the current balance of the account
$balance = $balance - $amount;

mysql_query("UPDATE isb.`account` 
SET `CurrentBalance`='$balance' 
WHERE `CustomerId`= '$CustomerId' and AccountType= '$actype';") or die(mysql_error());;

//update the transaction table
$acountid = $row3['AccountId'];
$detail = 'withdraw';
$transactionstatus = 'successfully';
mysql_query("INSERT INTO transactions 
(AccountId,TransactionDate, TransactionDetail, TransactionType, Amount,TransactionStatus) VALUES('$acountid', NOW(), '$detail','Deposit', '$transactionamount', '$transactionstatus') ") 
or die(mysql_error());
$errorid = 19 ;
 echo "<script> popupupdatescreen($errorid, $cid); </script>";
}
}
}
?>
</body>
</html>
