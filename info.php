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
	function closeafter(){
	setTimeout('self.close();',1000);
	}
    </script>
    <script src="../isb/js/test.js"></script>	
    <title>ISB Notification</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="justified-nav.css" rel="stylesheet">
   </head>

  <body>
      <div class="jumbotron">

	<div class="form-inline" role="form">
	<h1>Welcome to Interstellar Banking!</h1>
        <p class="lead">We Just need few more details to get you started.</p>
	
	<div class="row">
    	<form class="span6" action="accountprocess.php" method="post">
	<h5>Personal Information.<h5><br>
       	<input type="text" name = "firstname" class="form-control"  placeholder="First Name" required autofocus>
	<input type="text" name = "middlename" class="form-control" placeholder="Middle Name" required>
	<input type="text" name = "lastname" class="form-control" placeholder="Last Name" required><br>
	<input type="text" class="form-control" name="ssn"  title="###-##-####"  placeholder="SSN" required>
	<h5>Login Details.<h5><br>
	<input type="email" class="form-control" name="email" placeholder="Email" required>
	<input type="password" class="form-control" name="password" placeholder="Password" required>
	<input type="password" class="form-control" name="confirmpassword" placeholder="Confirm Password" required>
<br>
	<h5>Date of Birth.<h5><br>
	<input type="date" class="form-control" name="dob" placeholder="Date of Birth" required>
	<br>
	<h5>Contact Information.<h5><br>
	<input type="tel" class="form-control"  title='Phone Number (Format: 999999999)' name="phonehome" placeholder="Phone Home" required>
	<input type="tel" class="form-control"  title='Phone Number (Format: 999999999)' name="phonemobile" placeholder="Phone Mobile" required>
	<input type="tel" class="form-control"  title='Phone Number (Format: 999999999)' name="Intlphonemobile" placeholder="International Phone" required><br>
	<select class="form-control" name="hmaddresstype" required>
	<option "value="Residential">Residential</option>
     	<option value="Business">Business</option>
	<input type="text" class="form-control" name="hmaddress" placeholder="Address Line 1" required>
	<input type="text" class="form-control" name="hmstreet" placeholder="Address Line 2" required>
	<input type="text" class="form-control" name="hmcity" placeholder="City" required>
	<input type="text" class="form-control" name="hmstate" placeholder="State code" required>
	<input type="text" class="form-control" name="hmzip" placeholder="Zip" required>
	<input type="text" class="form-control" name="country" placeholder="Country" required>
	<br>
	<p><input class="btn btn-lg btn-success" type="submit" role="button" ></a></p>
	</form>
	</div>
	</div> <!-- /container -->
	
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

