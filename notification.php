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
	function closescreen(){
	window.close();
	}    
    </script>
    <script>
	function closeafter(){
	setTimeout('self.close();',5000);
	}
    </script>
    <script src="../isb/js/test.js"></script>	
    <title>ISB Notification</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="justified-nav.css" rel="stylesheet">
   </head>

<body onload="window.resizeTo(600,200)">
<?php
include 'databaseauth.php';
$errorid = $_GET['errorid'];
?>
<?php if($errorid == 1) : ?>
    <h2 bgcolor="#BDBDBD">This email already exists</h2>
	<script>
    	closeafter();
	</script>	
<?php endif; ?>
<?php if($errorid == 2) : ?>
    <h2 bgcolor="#BDBDBD">Password Mismath</h2>
<?php endif; ?>
<?php if($errorid == 3) : ?>
    <h2 bgcolor="#BDBDBD">We couldn`t find the information you are seeking in our database</h2>
<?php endif; ?>
<?php if($errorid == 4) : ?>
    <h1 bgcolor="#BDBDBD">Please check your email and password</h1>
<?php endif; ?>
<?php if($errorid == 5) : ?>
    <h2 bgcolor="#BDBDBD">Your profile is updated sucessfully</h2>
<?php endif; ?>
<?php if($errorid == 6) : ?>
    <h2 bgcolor="#BDBDBD">A request to activate your Checking and savings accounts has been submitted
			You can use your accounts once your accounts once it has been activated.</h2>
<?php endif; ?>
<?php if($errorid == 7) : ?>
    <h2 bgcolor="#BDBDBD">The requested amount has been sucessfully trasferred.</h2>
<?php endif; ?>
<?php if($errorid == 8) : ?>
    <h2 bgcolor="#BDBDBD">We were unable to process your transfer request due to low balance.</h2>
<?php endif; ?>
<?php if($errorid == 9) : ?>
    <h2 bgcolor="#BDBDBD">We were unable to process your transfer request, please check the information you entered.</h2>
<?php endif; ?>
<?php if($errorid == 10) : ?>
    <h2 bgcolor="#BDBDBD"> Account has been sucessfully created.</h2>
<?php endif; ?>
<?php if($errorid == 11) : ?>
    <h2 bgcolor="#BDBDBD">A Savings account has been sucessfully created.</h2>
<?php endif; ?>
<?php if($errorid == 12) : ?>
    <h2 bgcolor="#BDBDBD">The system was unable to create an account please check the input field.</h2>
<?php endif; ?>
<?php if($errorid == 13) : ?>
    <h2 bgcolor="#BDBDBD">This account has been already created.</h2>
<?php endif; ?>
<?php if($errorid == 14) : ?>
    <h2 bgcolor="#BDBDBD">The system was unable to make a deposit.</h2>
<?php endif; ?>
<?php if($errorid == 15) : ?>
    <h2 bgcolor="#BDBDBD">The account doesnot exist.</h2>
<?php endif; ?>
<?php if($errorid == 16) : ?>
    <h2 bgcolor="#BDBDBD">The Deposit was sucessful.</h2>
<?php endif; ?>
<?php if($errorid == 17) : ?>
    <h2 bgcolor="#BDBDBD">The user doesn`t exist.</h2>
<?php endif; ?>
<?php if($errorid == 18) : ?>
    <h2 bgcolor="#BDBDBD">Insufficient Balance.</h2>
<?php endif; ?>
<?php if($errorid == 19) : ?>
    <h2 bgcolor="#BDBDBD">Withdraw was sucessful.</h2>
<?php endif; ?>
<?php if($errorid == 20) : ?>
    <h2 bgcolor="#BDBDBD">The Request Token has been cleared.</h2>
<?php endif; ?>
<?php if($errorid == 21) : ?>
    <h2 bgcolor="#BDBDBD">ALL Request Tokens have been cleared.</h2>
<?php endif; ?>
<?php if($errorid == 22) : ?>
    <h2 bgcolor="#BDBDBD">The Request token was not found.</h2>
<?php endif; ?>
<?php if($errorid == 23) : ?>
    <h2 bgcolor="#BDBDBD">Amount was transferred sucessfully.</h2>
<?php endif; ?>
<p><a style="float:left" class="btn btn-primary" onclick="closescreen()" role="button">Close</a></p>
</body>
</html>












