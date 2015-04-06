<?php

include 'databaseauth.php'


if($_GET['action']=='history'){
getAccountHistory();
}
else if($_GET['action']=='balance'){
getAccountBalance();
}

else if($_GET['action']=='transfer'){
transferFunds();
}

function getAccountHistory(){
try{
//get required inputs
$id = $_GET['id'];
$result = mysql_query("SELECT AccountId FROM account WHERE CustomerId=$id");
$transactions = array();
$transaction = array();
$accountNames = array();
$i = 0;
//get loop through for each account
while($accountIds = mysql_fetch_row($result)){
$accountId=$accountIds[0];
$transactionResult = mysql_query("SELECT TransactionDate, TransactionDetail, TransactionType, Amount FROM transactions WHERE AccountId=$accountId");
//get each transaction for each account.
while($transaction = mysql_fetch_row($transactionResult)){
$transactions[$i] = $transaction;
$accountNameResult = mysql_query("SELECT AccountType FROM account WHERE AccountId=$accountId");
$accountName = mysql_fetch_row($accountNameResult);
$accountNames[$i] = $accountName;
$i = $i + 1;
}
}
//build response array
$response['success'] = true;
$response['transactions'] = $transactions;
$response['accountNames'] = $accountNames;
}
catch(exception $e){
$response['success'] = false;
$response['message'] = $e;
}
//send back json array
header('Content-Type: application/json');
echo json_encode($response);

}

function getAccountBalance(){
try{
//get required inputs
$id = $_GET['id'];
$balance = array();
//get the balances
$result = mysql_query("SELECT AccountType,CurrentBalance,LastModifiedDateTime FROM account WHERE CustomerId=$id");
$i = 0;
while($balances = mysql_fetch_row($result)){

$balance[$i] = $balances;
$i = $i + 1;
}
//create the resonse array
$response['success'] = true;
$response['balance'] = $balance;

}
catch (exception $e){
$response['success'] = false;
$response['message'] = $e;
}
//send back json array.
header('Content-Type: application/json');
echo json_encode($response);
}

function transferFunds(){
try{
//get required inputs
$account1 = $_GET['account1'];
$account2 = $_GET['account2'];
$customerId = $_GET['id'];
$amount = $_GET['amount'];
$transactionType = 'Debit';
$transactionDetail = 'Transfer Between Accounts';

//update transactions table
$AccountIdResult = mysql_query("SELECT AccountId FROM account WHERE CustomerId='$customerId' AND AccountType='$account1' LIMIT 1") or die(mysql_error());
$accountId1Array = mysql_fetch_row($AccountIdResult) or die(mysql_error());
$accountId1 = $accountId1Array[0];
mysql_query("INSERT INTO transactions (AccountId, TransactionDetail, TransactionType, Amount) VALUES ('$accountId1', '$transactionDetail', '$transactionType', '$amount')") or die(mysql_error());

$AccountIdResult2 = mysql_query("SELECT AccountId FROM account WHERE CustomerId= '$customerId' AND AccountType='$account2' LIMIT 1") or die(mysql_error());
$accountId2Array = mysql_fetch_row($AccountIdResult2);
$transactionType = 'Credit';
$accountId2 = $accountId2Array[0];
mysql_query("INSERT INTO transactions (AccountId, TransactionDetail, TransactionType, Amount) VALUES ('$accountId2', '$transactionDetail', '$transactionType', '$amount')") or die(mysql_error());

//update account table.
$newAmountResult1 = mysql_query("SELECT CurrentBalance FROM account WHERE AccountId='$accountId1' LIMIT 1") or die(mysql_error());
$newAmountAccount1 = mysql_fetch_row($newAmountResult1) or die(mysql_error());
$newIntAmountAccount1 = $newAmountAccount1[0] - $amount;
mysql_query("UPDATE account SET CurrentBalance = '$newIntAmountAccount1' where AccountId='$accountId1'");

$newAmountResult2 = mysql_query("SELECT CurrentBalance FROM account WHERE AccountId='$accountId2' LIMIT 1") or die(mysql_error());
$newAmountAccount2 = mysql_fetch_row($newAmountResult2) or die(mysql_error());
$newIntAmountAccount2 = $newAmountAccount2[0] + $amount;
mysql_query("UPDATE account SET CurrentBalance = '$newIntAmountAccount2' where AccountId='$accountId2'");

//set the response array to send back
$response['success'] = true;
$response['message'] = 'The Transaction Was a Success';
}
catch(exception $e){
$response['success'] = false;
$response['message'] = $e;
}
//send back json array
header('Content-Type: application/json');
echo json_encode($response);
}

?>
