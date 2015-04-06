<html>
	<head>
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
	</head>
	<body onload="getAccountHistory()">
		<a style="float:right" href="#">Logout</a>
		<h1>Interstellar Bank Home Page</h1>
		<div id="tabs">
			<ul>
				<!-- Define the tabs -->
				<li><a href="#tabs-1">Account History</a></li>
				<li><a href="#tabs-2">Balance</a></li>
				<li><a href="#tabs-3">Tab 3</a></li>
				<li><a href="#tabs-4">Tab 4</a></li>
				<li><a href="#tabs-5">Tab 5</a></li>
				<li><a href="#tabs-6">Tab 6</a></li>
			</ul>
			<!-- Each of these divs defines the content of it's respective tab section. -->
			<!-- the HTML in each div will be display only when the respective tab is selected -->
			<div id="tabs-1">
				<table>
					<tr class="thead"><td>Transaction Number&nbsp;</td><td>Details</td><td>&nbsp;&nbsp;Type&nbsp;&nbsp;</td><td>Amount&nbsp;&nbsp;</td><td>Balance</td><td>Date</td></tr>
					<tr><td>1</td><td>Payment For Rent</td><td>&nbsp;&nbsp;Credit</td><td>$500</td><td>$3500</td><td>4/10/2014</td></tr>
					<tr><td>2</td><td>Deposit From Work</td><td>&nbsp;&nbsp;Debit</td><td>$500</td><td>$4000</td><td>4/11/2014</td></tr>
					
					<div id="AccountHistoryDiv"></div>
				</table>
			</div>
			<div id="tabs-2">
				<table>
					<tr class="thead"><td>Account &nbsp;</td><td>Balance &nbsp;</td><td>As Of: &nbsp;</td></tr>
					<tr><td>Savings &nbsp;</td><td>$5000 &nbsp;</td><td>3/28/2014 &nbsp;</td></tr>
					<tr><td>Checking &nbsp;</td><td>$4000 &nbsp;</td><td>3/20/2014 &nbsp;</td></tr>
				</table>
			</div>
			<div id="tabs-3">
				Test Text 3
			</div>
			<div id="tabs-4">
				Test Text 4
			</div>
			<div id="tabs-5">
				Test Text 5
			</div>
			<div id="tabs-6">
				Test Text 6
			</div>
		</div>
	</body>
</html>
