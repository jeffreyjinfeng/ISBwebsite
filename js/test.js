window.onload = function(){
//alert('hi');
getAccountHistory();
getAccountsBalance();
};
var id = 100010000;


//Json request for getting account history details.

var $tableFields = '';
var url ="localhost/isb";

function prettyDate(date){
var year = date.slice(0,4);
var month = date.slice(5,7);
var day = date.slice(8,10);
return month+'/'+day+'/'+year;
}

function getAccountHistory(){
//alert('hi');
$.getJSON('remote.php?action=history&id='+id, {}, function(response){
if(response.success){
//alert('hi');
var i = 0;
while(i <  response.transactions.length){
var date = '2014-04-17';//response.transactions[i][0].slice(0,10);
date = prettyDate(date);
$tableFields += '<tr><td>'+response.accountNames[i][0]+'</td><td>'+response.transactions[i][1]+'</td><td>'+response.transactions[i][2]+'</td><td>$'+response.transactions[i][3]+'</td><td>'+date+'</td></tr>';
i++;
}
var $AHDiv = $('#AccountHistoryDiv');
$AHDiv.append($tableFields);
}
else{
alert('bye');
}
});
}

var $balanceTableFields = '';
function getAccountsBalance(){
$.getJSON('remote.php?action=balance&id='+id, {}, function(response){
//alert('hi');
if(response.success){
var $balanceTableDiv = $('#balanceTableDiv');
var i = 0;
while(i < response.balance.length){
var date = response.balance[i][2].slice(0,10);
date = prettyDate(date);
$balanceTableFields += '<tr><td>'+response.balance[i][0]+'</td><td>'+response.balance[i][1]+'</td><td>'+date+'</td></tr>';
i++;
}
$balanceTableDiv.append($balanceTableFields);
}
});
}

function popupupdatescreen(errorid, refid){
	var link = "http://localhost/isb/notification.php/?errorid=";
	var erid = errorid;
	var link = link.concat(erid);
	var userid = refid;
	var reflink = "http://localhost/isb/employeedashboard.php?ref=";
	window.open(link ,"_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=500, left=300, width=500, height=800");
	var reflink = reflink.concat(userid);
	window.location.href = reflink;
	}
function popupupdatescreencust(errorid, refid){
	var link = "http://localhost/isb/notification.php/?errorid=";
	var erid = errorid;
	var link = link.concat(erid);
	var userid = refid;
	var reflink = "http://localhost/isb/customerdashboard.php?ref=";
	window.open(link ,"_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=500, left=300, width=500, height=800");
	var reflink = reflink.concat(userid);
	window.location.href = reflink;
	}

function closeafter(){
	setTimeout('self.close();',5000);
	}

function transferFunds(){
var $account1 = $('#account1').val();
var $account2 = $('#account2').val();
var $amount = parseInt($('#transfer_amount').val());
//alert($account1);
//alert($account2);
alert($amount);
$.getJSON('http://localhost/isb/remote.php?action=transfer&id='+id+'&account1='+$account1+'&account2='+$account2+'&amount='+$amount, {}, function(response){
if(response.success){
alert(response.message);
}
});
}
