<?php


if( (!isset($_SESSION['loggedin'])))
{
    echo "";
}
else 
{
	unset($_SESSION['loggedin']);
	session_destroy();
	header("Location: http://localhost/isb/index.html");
    	exit;
}

?>
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
    <script>
	function popupupdatescreencust(){
	window.open("http://localhost/isb/updatecustomerprofile.php","_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=500, left=300, width=500, height=800");
	} 
	   
    </script>
    <script src="../isb/js/test.js"></script>	
    <title>ISB customer dashboard</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="justified-nav.css" rel="stylesheet">
  </head>

  <body>
<div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="http://www.isb.com"><font color=#4099FF>Interstellar Banking</font></a>
            </div>
      <!-- Jumbotron -->
      <div class="jumbotron">

<!-------------------------------------------------------------------------------------------->
<!---			Php data fetching from customer table				    -->
<!-------------------------------------------------------------------------------------------->
<?php
include 'databaseauth.php';
//Get data from get request
$ourcustomerid = $_GET["ref"];
$usr = $_COOKIE["user"];
$tokenkeyoncookie = $_COOKIE["isbtokenkey"];
$cid = $_COOKIE["coustmerid"];

//check login status
//get userId and customerId
$res = mysql_query("SELECT * FROM Login
 WHERE User = '$usr'") or die(mysql_error());
$loginid = mysql_fetch_array($res);
$tokenkeyondb = $loginid["TokenKey"];
if (($loginid["LoginStatus"] != "yes") && ($tokenkeyoncookie != $tokenkeyondb)) {
header("Location: http://localhost/isb/index.html");
}

if(($ourcustomerid != $cid)){
header("Location: http://localhost/isb/index.html");
}

//get userId and customerId
$result1 = mysql_query("SELECT * FROM customer
 WHERE CustomerId = '$ourcustomerid'") or die(mysql_error());
$row1 = mysql_fetch_array( $result1 );
//get address
$actadd = mysql_query(" SELECT `AddressType`, `AddressLine1`, `AddressLine2`, `City`, `Zipcode`, `StateCode`, `Country` 
		FROM isb.`addresses` 
		WHERE `AddressId` IN 
						(SELECT `AddressID` 
						FROM isb.`cust_addr` 
						WHERE `CustomerID`= '$ourcustomerid' ); ");

$cusaddres = mysql_fetch_array($actadd);
$isbcustfirstname = $row1['CustomerFirstName'];
$isbcustlastname = $row1['CustomerLastName'];
$isbcustmiddlename = $row1['CustomerMiddleName'];
$isbcustphonehome = $row1['PhoneHome'];
$isbcustphonemobile = $row1['PhoneMobile1'];
$isbcustphoneinternational = $row1['PhoneInternational'];
$isbcustDOB = $row1['DOB'];
$isbcustemail = $row1['EmailId'];
$isbcustssn = $row1['SSN'];
$isbcustaddresstype = $cusaddres["AddressType"];
$isbcustaddressline1 = $cusaddres["AddressLine1"];
$isbcustaddressline2 = $cusaddres["AddressLine2"];
$isbcustaddresscity = $cusaddres["City"];
$isbcustaddresszipcode = $cusaddres["Zipcode"];
$isbcustaddressstatecode = $cusaddres["StateCode"];
$isbcustaddresscountry = $cusaddres["Country"];
?>
<!-------------------------------------------------------------------------------------------->
<!---			TABS DEFINATION AREA						    -->
<!-------------------------------------------------------------------------------------------->
	<body onload="getAccountHistory()" >
		<p><a style="float:right" class="btn btn-primary" href="http://localhost/isb/logoutprocess.php" role="button">Logout</a></p>
		<h2>Customer Dash Board</h2>
		<!-- Print data syntax --------------------------------------------------------------------------------------->
		<!-- <?php echo $isbcustfirstname." ".$isbcustmiddlename." ".$isbcustlastname; ?> -->
		<h3><p class="lead"><?php echo "Welcome ".$isbcustfirstname." ".$isbcustlastname; ?></p></h3>
		<!------------------------------------------------------------------------------------------------------------>
		<div id="tabs" >
			<ul style="background-color:#BDBDBD;">
				<!-- Define the tabs -->
				<li><a href="#tabs-1"style="color:#0B0B61;">Account Summary</a></li>
				<li><a href="#tabs-2"style="color:#0B0B61;">Balance</a></li>
				<li><a href="#tabs-3"style="color:#0B0B61;">Fund Transfer</a></li>
				<li><a href="#tabs-4"style="color:#0B0B61;">Manage accounts</a></li>
				<li><a href="#tabs-5"style="color:#0B0B61;">Profile</a></li>
				<li><a href="#tabs-6"style="color:#0B0B61;">Contact ISB</a></li>
			</ul>
<!-------------------------------------------------------------------------------------------->
<!---			TAB 1 ACCOUNT SUMMARY						    -->
<!-------------------------------------------------------------------------------------------->
			<div id="tabs-1">
				<table style="width:900px">
			<tr class="thead"><td> Account ID &nbsp;</td><td>TransactionDetail&nbsp;</td><td>Transaction Date &nbsp;</td><td>Amount: &nbsp;</td></tr>
			<?php
				$transacchecking = mysql_query(" SELECT *
		FROM isb.`transactions` 
		WHERE `AccountId` IN 
						(SELECT `AccountId` 
						FROM isb.`account` 
						WHERE `CustomerID`= '$ourcustomerid' AND `AccountType`='checking' ); ");
				$transacsaving = mysql_query(" SELECT *
		FROM isb.`transactions` 
		WHERE `AccountId` IN 
						(SELECT `AccountId` 
						FROM isb.`account` 
						WHERE `CustomerID`= '$ourcustomerid' AND `AccountType`='saving' ); ");
				//echo "<table>";
				while($row = mysql_fetch_array($transacchecking))
 				{
					echo "<tr>";
					echo "<td>";echo $row['AccountId'];echo"</td>";
					echo "<td>";echo $row['TransactionDetail'];echo"</td>";
					echo "<td>";echo $row['TransactionDate'];echo"</td>";
					echo "<td>";echo $row['Amount'];echo"</td>";
					echo "</tr>";
  				}
				while($row = mysql_fetch_array($transacsaving))
 				{
					echo "<tr>";
					echo "<td>";echo $row['AccountId'];echo"</td>";
					echo "<td>";echo $row['TransactionDetail'];echo"</td>";
					echo "<td>";echo $row['TransactionDate'];echo"</td>";
					echo "<td>";echo $row['Amount'];echo"</td>";
					echo "</tr>";
  				}
				//echo "</table>";
			?>
			<tbody id="balanceTableDiv"></tbody>
			</table>
			</div>
<!-------------------------------------------------------------------------------------------->
<!---			TAB 2 ACCOUNT BALANCE						    -->
<!-------------------------------------------------------------------------------------------->
			<div id="tabs-2">
				<?php
			//pull data from accounts
			//get userId and customerId
			$acc1 = "Checking";
			$acc2 = "Saving";
			// pulls data concerning checking or savings from account table
			$resultcusacctchk = mysql_query("SELECT * FROM account
			 WHERE CustomerId = '$ourcustomerid' AND AccountType = '$acc1' ") or die(mysql_error());
			$resultcusacctsav = mysql_query("SELECT * FROM account
			 WHERE CustomerId = '$ourcustomerid' AND AccountType = '$acc2' ") or die(mysql_error());
			$row1chk = mysql_fetch_array( $resultcusacctchk );
			$row1sav = mysql_fetch_array( $resultcusacctsav );
			//---------------------------------------------------------------------------------------
			$reqid1 = 1;
			$reqid2 = 2;
			$resultrequestchk = mysql_query("SELECT * FROM generalrequests
			 WHERE CustomerId = '$ourcustomerid' AND RequestTypeId = '$reqid1' ") or die(mysql_error());
			$row2chk = mysql_fetch_array( $resultrequestchk );
			$resultrequestsav = mysql_query("SELECT * FROM generalrequests
			 WHERE CustomerId = '$ourcustomerid' AND RequestTypeId = '$reqid2' ") or die(mysql_error());
			$row2sav = mysql_fetch_array( $resultrequestsav ); 
			//---------------------------------------------------------------------------------------
			?>	
	

			<?php if ($row1chk == NULL): ?>
  			<p><a style="float:centre" class="btn btn-primary" href="http://localhost/isb/accountrequestprocess.php" role="button">Request Checking Account activation</a></p>
			<?php if($row2chk == NULL){ echo "Please make a checking account request";} else echo "Checking Account requested"; ?>
			<? elseif ($row1chk != NULL): ?>
			<!---------------------------------------------------->
			<table  style="width:900px">
			<tr class="thead"><td>Account Type&nbsp;</td><td>Balance&nbsp;</td></tr>
			<tr>
			  <td><h4>Checking</h4></td>
			  <td><?php echo "$".$row1chk['CurrentBalance']; ?></td> 
			</tr>
			</table>
			<!---------------------------------------------------->
			<? else: ?>
  			<p>There seems to be a problem with your account please contact the ISB customer support.</p>
			<? endif; ?>
			
			<?php if ($row1sav == NULL): ?>
  			<p><a style="float:centre" class="btn btn-primary" href="http://localhost/isb/accountrequestprocess.php" role="button">Request Savings Account activation</a></p>
			<?php if($row2sav == NULL){ echo "Please make a Savings account request";} else echo "Savings Account requested"; ?>
			<? elseif ($row1sav != NULL): ?>
			<!---------------------------------------------------->
			<table style="width:900px">
			<tr class="thead"><td>Account Type&nbsp;</td><td>Balance&nbsp;</td></tr>
			<tr>
			  <td><h4>Savings</h4></td>
			  <td><?php echo "$".$row1sav['CurrentBalance']; ?></td>  
			</tr>
			</table>
			<!---------------------------------------------------->
			<? else: ?>
  			<p>There seems to be a problem with your account please contact the ISB customer support.</p>
			<? endif; ?>
			</div>
<!-------------------------------------------------------------------------------------------->
<!---			TAB 3 FUND TRANSFER						    -->
<!-------------------------------------------------------------------------------------------->
			<div id="tabs-3">
				<h4>Transfer funds Between different accounts at ISB</h4>
				<form class="form-inline" role="form" action="transfertoaccount.php" method= "post">
				<div class="form-group">
				<h4>To:</h4>
				<input class="form-control" type="number" name="accountnumber" placeholder="Account number" required>
				<input class="form-control" type="email" name="email" placeholder="EMAIL" required>
				<input class="form-control" type="number" name="amount" placeholder="amount"  required>
				<h4>From your account</h4>								
				Account type:
				<select name="actype" >
	             		<option value="checking">Checking</option>
                 		<option value="saving">Saving</option>
                 		</select>
				<p><button type="submit" class="btn btn-primary">Transfer</button></p>
				</form>
				</div>
				</form>
			</div>
<!-------------------------------------------------------------------------------------------->
<!---			TAB 4 MANAGE ACCOUNTS						    -->
<!-------------------------------------------------------------------------------------------->
			<div id="tabs-4">
			<?php
			//pull data from accounts
			//get userId and customerId
			$acc1 = "Checking";
			$acc2 = "Saving";
			// pulls data concerning checking or savings from account table
			$resultcusacctchk = mysql_query("SELECT * FROM account
			 WHERE CustomerId = '$ourcustomerid' AND AccountType = '$acc1' ") or die(mysql_error());
			$resultcusacctsav = mysql_query("SELECT * FROM account
			 WHERE CustomerId = '$ourcustomerid' AND AccountType = '$acc2' ") or die(mysql_error());
			$row1chk = mysql_fetch_array( $resultcusacctchk );
			$row1sav = mysql_fetch_array( $resultcusacctsav );
			//---------------------------------------------------------------------------------------
			$reqid1 = 1;
			$reqid2 = 2;
			$resultrequestchk = mysql_query("SELECT * FROM generalrequests
			 WHERE CustomerId = '$ourcustomerid' AND RequestTypeId = '$reqid1' ") or die(mysql_error());
			$row2chk = mysql_fetch_array( $resultrequestchk );
			$resultrequestsav = mysql_query("SELECT * FROM generalrequests
			 WHERE CustomerId = '$ourcustomerid' AND RequestTypeId = '$reqid2' ") or die(mysql_error());
			$row2sav = mysql_fetch_array( $resultrequestsav ); 
			//---------------------------------------------------------------------------------------
			?>	
	

			<?php if ($row1chk == NULL): ?>
  			<p><a style="float:centre" class="btn btn-primary" href="http://localhost/isb/accountrequestprocess.php" role="button">Request Checking Account activation</a></p>
			<?php if($row2chk == NULL){ echo "Please make a checking account request";} else echo "Checking Account requested"; ?>
			<? elseif ($row1chk != NULL): ?>
			<!---------------------------------------------------->
			<table style="width:900px">
			<tr class="thead"><td>Account Type&nbsp;</td><td>Account number&nbsp;</td><td>Status&nbsp;</td><td>Created on:&nbsp;</td><td>Last Modified&nbsp;</td></tr>
			<tr>
			  <td><h4>Checking</h4></td>
			  <td><?php echo $row1chk['AccountId']; ?></td>
			  <td>Active</td> 
			  <td><?php echo $row1chk['OpenedDate']; ?></td>
			  <td><?php echo $row1chk['LastModifiedDateTime']; ?></td>
			</tr>
			</table>
			<!---------------------------------------------------->
			<? else: ?>
  			<p>There seems to be a problem with your account please contact the ISB customer support.</p>
			<? endif; ?>
			
			<?php if ($row1sav == NULL): ?>
  			<p><a style="float:centre" class="btn btn-primary" href="http://localhost/isb/accountrequestprocess.php" role="button">Request Savings Account activation</a></p>
			<?php if($row2sav == NULL){ echo "Please make a Savings account request";} else echo "Savings Account requested"; ?>
			<? elseif ($row1sav != NULL): ?>
			<!---------------------------------------------------->
			<table style="width:900px">
			<tr class="thead"><td>Account Type&nbsp;</td><td>Account number&nbsp;</td><td>Status&nbsp;</td><td>Created on:&nbsp;</td><td>Last Modified&nbsp;</td></tr>
			<tr>
			  <td><h4>Savings</h4></td>
			  <td><?php echo $row1sav['AccountId']; ?></td>
			  <td>Active</td> 
			  <td><?php echo $row1sav['OpenedDate']; ?></td>
			  <td><?php echo $row1sav['LastModifiedDateTime']; ?></td>
			</tr>
			</table>
			<!---------------------------------------------------->
			<? else: ?>
  			<p>There seems to be a problem with your account please contact the ISB customer support.</p>
			<? endif; ?>


			</div>
<!-------------------------------------------------------------------------------------------->
<!---			TAB 5 	 PROFILE						    -->
<!-------------------------------------------------------------------------------------------->
			<div id="tabs-5">
			<table>
					<tr><td>Name: &nbsp;</td><td> <?php echo $isbcustfirstname." ".$isbcustmiddlename." ".$isbcustlastname; ?>&nbsp;
					</td></tr>
					<tr><td>Address: &nbsp;</td><td><?php echo $isbcustaddressline1.", ".$isbcustaddressline2.", ".$isbcustaddresscity.", ".$isbcustaddresszipcode.", ".$isbcustaddressstatecode.", ".$isbcustaddresscountry;?>&nbsp;
					</td></tr>
					<tr><td>Phone Home: &nbsp;</td><td><?php echo $isbcustphonehome; ?>&nbsp;
					</td></tr>
					<tr><td>Phone Mobile: &nbsp;</td><td><?php echo $isbcustphonemobile; ?>&nbsp;
					</td></tr>
					<tr><td>Phone International: &nbsp;</td><td><?php echo $isbcustphoneinternational; ?>&nbsp;
					</td></tr>
					<tr><td>Date of Birth: &nbsp;</td><td><?php echo $isbcustDOB; ?>&nbsp;
					</td></tr>
					<tr><td>Email: &nbsp;</td><td><?php echo $isbcustemail; ?>&nbsp;
					</td></tr>
					<tr><td>SSN: &nbsp;</td><td><?php echo $isbcustssn; ?>&nbsp;
					</td></tr>
					<p><a style="float:right" class="btn btn-primary" onclick="popupupdatescreencust()" role="button">Update Profile</a></p>
<!--------------------------------------------------------------------------------------------->
<!--------------------------------------------------------------------------------------------->
			</table>
			</div>
<!-------------------------------------------------------------------------------------------->
<!---			TAB 6 CONTACTS						    -->
<!-------------------------------------------------------------------------------------------->
			<div id="tabs-6">
			<table style="width:900px">
			<tr class="thead"><td>Employee &nbsp;</td><td> Position &nbsp;</td><td>Phone: &nbsp;</td><td>Office &nbsp;</td><td>Email: &nbsp;</td></tr>
			<tr>
			  <td>Naveen Mysore</td>
			  <td>Manager</td> 
			  <td>(980)228-1211</td>
			  <td>Tech way, ISB headquarters, San Francisco, CA.</td>
			  <td>nmysore@isb.com.</td>
			</tr>
			<tr>
			  <td>Elon Musk</td>
			  <td>Manager</td> 
			  <td>(980)228-1211</td>
			  <td>Tech way, ISB headquarters, San Francisco, CA.</td>
			  <td>elon@isb.com.</td>
			</tr>
			<tbody id="balanceTableDiv"></tbody>
			</table>
		</div>
<!-------------------------------------------------------------------------------------------->
<!---			TABS END						    -->
<!-------------------------------------------------------------------------------------------->
	

	<!-->
      </div>

      <!-- Example row of columns -->
      <div class="row">
        <div class="col-lg-4">
          <h2>ISB Policies</h2>
          <p> ISB policies are subjected change please read our policies. </p>
          <p><a class="btn btn-primary" href="#" role="button">View Policies &raquo;</a></p>
        </div>
        <div class="col-lg-4">
          <h2>Secure your Account</h2>
          <p> Dont access your account in public networks. </p>
          <p><a class="btn btn-primary" href="#" role="button"> Learn more &raquo;</a></p>
       </div>
        <div class="col-lg-4">
          <h2> Customer Support </h2>
          <p> Reach our Customer support service any time.</p>
          <p><a class="btn btn-primary" href="#" role="button"> Contact &raquo;</a></p>
        </div>
      </div>

      <!-- Site footer -->
      <div class="footer">
        <p>&copy; Interstellar Banking Company 2014</p>
      </div>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>

