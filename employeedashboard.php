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
	function popupupdatescreen(){
	window.open("http://localhost/isb/updateemployeeprofile.php","_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=500, left=300, width=500, height=800");
	}    
    </script>
    <script src="../isb/js/test.js"></script>	
    <title>ISB Employee dashboard</title>
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
$ouremployeeid = $_GET["ref"];
$usr = $_COOKIE["user"];
$tokenkeyoncookie = $_COOKIE["isbtokenkey"];
$cid = $_COOKIE["employeeid"];

//check login status
//get userId and customerId
$res = mysql_query("SELECT * FROM Login
 WHERE User = '$usr'") or die(mysql_error());
$loginid = mysql_fetch_array($res);
$tokenkeyondb = $loginid["TokenKey"];
if (($loginid["LoginStatus"] != "yes") && ($tokenkeyoncookie != $tokenkeyondb)) {
header("Location: http://localhost/isb/index.html");
}

if(($ouremployeeid != $cid)){
header("Location: http://localhost/isb/index.html");
}

$result1 = mysql_query("SELECT * FROM employee
 WHERE EmployeeId = '$ouremployeeid'") or die(mysql_error());
$row1 = mysql_fetch_array( $result1 );
//get address
$actadd = mysql_query(" SELECT `AddressType`, `AddressLine1`, `AddressLine2`, `City`, `Zipcode`, `StateCode`, `Country` 
		FROM isb.`addresses` 
		WHERE `AddressId` IN 
						(SELECT `AddressID` 
						FROM isb.`empl_addr` 
						WHERE `EmployeeID`= '$ouremployeeid' ); ");

$cusaddres = mysql_fetch_array($actadd);
$isbcustfirstname = $row1['EmployeeFirstName'];
$isbcustlastname = $row1['EmployeeLastName'];
$isbcustmiddlename = $row1['EmployeeMiddleName'];
$isbcustemail = $row1['EmailId'];
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
		<h2>Employee Dash Board</h2>
		<!-- Print data syntax --------------------------------------------------------------------------------------->
		<!-- <?php echo $isbcustfirstname." ".$isbcustmiddlename." ".$isbcustlastname; ?> -->
		<h3><p class="lead"><?php echo "Welcome ".$isbcustfirstname." ".$isbcustlastname; ?></p></h3>
		<!------------------------------------------------------------------------------------------------------------>
		<div id="tabs" >
			<ul style="background-color:#BDBDBD;">
				<!-- Define the tabs -->
				<li><a href="#tabs-1"style="color:#0B0B61;">Create Account for Customer</a></li>
				<li><a href="#tabs-2"style="color:#0B0B61;">Deposit</a></li>
				<li><a href="#tabs-3"style="color:#0B0B61;">Withdrawal</a></li>
				<li><a href="#tabs-4"style="color:#0B0B61;">Check applications</a></li>
				<li><a href="#tabs-5"style="color:#0B0B61;">Profile</a></li>
				<li><a href="#tabs-6"style="color:#0B0B61;">Contact ISB</a></li>
			</ul>
<!-------------------------------------------------------------------------------------------->
<!---			TAB 1 Create Account for Customer				    -->
<!-------------------------------------------------------------------------------------------->
			<div id="tabs-1">
				<form class="form-inline" id="myForm1" action="employeecreateaccount.php" method = "post">
				<div class="form-group">
				<input class="form-control" type="email" name="email1" placeholder="EMAIL" required>
				Account type:
				<select name="actype" >
	             		<option value="checking">Checking</option>
                 		<option value="saving">Saving</option>
                 		</select>
				<p><button type="submit" class="btn btn-primary">Create Account</button></p>
</form>
				</div>
				</form>	
				<div id="AccountHistoryDiv"></div>
			</div>
<!-------------------------------------------------------------------------------------------->
<!---			TAB 2 Deposit							    -->
<!-------------------------------------------------------------------------------------------->
			<div id="tabs-2">
				<form class="form-inline" role="form" action="employeedeposit.php" method= "post">
				<div class="form-group">
				<input class="form-control" type="email" name="email2" placeholder="EMAIL" required>
				<input class="form-control" type="number" name="amount2" placeholder="amount"  required>
												
				Account type:
				<select name="actype" >
	             		<option value="checking">Checking</option>
                 		<option value="saving">Saving</option>
                 		</select>
				<p><button type="submit" class="btn btn-primary">Deposit</button></p>
</form>
				</div>
				</form>
			</div>
<!-------------------------------------------------------------------------------------------->
<!---			TAB 3 Withdraw						    	    -->
<!-------------------------------------------------------------------------------------------->
			<div id="tabs-3">
				<form class="form-inline" id="myForm3" action="employeewithdraw.php" method= "post">
				<div class="form-group">
				<input class="form-control" class="form-control" type="email" name="email3" placeholder="EMAIL" required>
				<input class="form-control" type="number" name="amount3" placeholder="amount" required>
				Account type:
				<select name="actype" >
	             		<option value="checking">Checking</option>
                 		<option value="saving">Saving</option>
                 		</select>
				<p><button type="submit" class="btn btn-primary">Withdraw</button></p>
</form>
				</div>
				</form>
			</div>
<!-------------------------------------------------------------------------------------------->
<!---			TAB 4 Request							    -->
<!-------------------------------------------------------------------------------------------->
			<div id="tabs-4">
			<table style="width:900px">
			<tr class="thead"><td>Request Token &nbsp;</td><td>Customer ID &nbsp;</td><td>Name &nbsp;</td><td>Request: &nbsp;</td><td>Email: &nbsp;</td></tr>
			<?php
				$resultrequests = mysql_query("SELECT * FROM generalrequests ") or die(mysql_error());
				//echo "<table>";
				while($row = mysql_fetch_array($resultrequests))
 				{
					$customerid = $row['CustomerId'];
					$resultred = mysql_query("SELECT * FROM customer WHERE CustomerId = '$customerid'") or die(mysql_error());
					$cusdata = mysql_fetch_array( $resultred );
					echo "<tr>";
					echo "<td>";echo $row['RequestId'];echo"</td>";
					echo "<td>";echo $cusdata['CustomerId'];echo"</td>";
					echo "<td>";echo $cusdata['CustomerFirstName']." ".$cusdata['CustomerLastName'];echo"</td>";
					echo "<td>";echo $row['UserComment'];echo"</td>";
					echo "<td>";echo $cusdata['EmailId'];echo"</td>";
					echo "</tr>";
  				}
				//echo "</table>";
			?>
			<tbody id="balanceTableDiv"></tbody>
			</table>
			<form class="form-inline" id="myForm7" action="employeeclearrequest.php" method= "post">
				<div class="form-group">
				<input class="form-control" class="form-control" type="email" name="email3" placeholder="EMAIL" >
				<input class="form-control" type="number" name="token" placeholder="Request token" >
				Clear request token:
				<select name="cleartype" >
				<option value="only">Clear selected token</option>
	             		<option value="all">Clear all for selected email</option>
                 		</select>
				<p><button type="submit" class="btn btn-primary">Clear request token</button></p>
</div>
</form>
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
					<p><a style="float:right" class="btn btn-primary" onclick="popupupdatescreen()" role="button">Update Profile</a></p>
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

