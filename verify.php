<html>
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
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script>
			$(function() {
				$( "#tabs" ).tabs();
			});
    </script>
    <script>    
    function add_field() 
    {
        var form = document.getElementsByTagName('form')[0],
        input = document.createElement('input');
        input.setAttribute('type', 'text');
        input.setAttribute('name', 'item');
        form.appendChild(input);
	window.open("http://localhost/isb/info.php","_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=500, left=500, width=400, height=400");
    };
</script>
    <script src="../isb/js/test.js"></script>	
    <title>ISB customer dashboard</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="justified-nav.css" rel="stylesheet">
  </head>

<body>
<?php
mysql_connect("localhost", "root", "n2pl") or die(mysql_error());
mysql_select_db("isb") or die(mysql_error());
// Get max address ID
$addid = mysql_query("SELECT MAX(AddressId) as AddressId FROM addresses");
$addidval = mysql_fetch_array($addid);
$addressref = $addidval["AddressId"];
echo "MAX add";
echo $addressref;

$addid = mysql_query("SELECT MAX(CustomerId) as AddressId FROM customer");
$addidval = mysql_fetch_array($addid);
$cusressref = $addidval["AddressId"];
//echo "MAX add";
//echo $cusressref;


$custumid = 3 ;
$actadd = mysql_query(" SELECT `AddressType`, `AddressLine1`, `AddressLine2`, `City`, `Zipcode`, `StateCode`, `Country` 
		FROM isb.`addresses` 
		WHERE `AddressId` IN 
						(SELECT `AddressID` 
						FROM isb.`cust_addr` 
						WHERE `CustomerID`= '$custumid' ); ");
$addidval = mysql_fetch_array($actadd);
$addressref = $addidval["AddressLine2"];
echo $addressref;


?>
<form name="input" method="get" style="display: block;">
    <div class="ui-input-text">
        <input type="text" name="item"><br>
        <div data-role="navbar">
            <button type="button" onclick="add_field()">ADD</button>
        </div>
    </div>
</form>
</body>
</html>
