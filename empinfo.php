
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

    <title>ISB Employee details</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="justified-nav.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
<!--
    <div class="container">

      <div class="masthead">
        <h3 class="text-muted">ISB</h3>
        <ul class="nav nav-justified">
          <li class="active"><a href="#">Home</a></li>
          <li><a href="#">Projects</a></li>
          <li><a href="#">Services</a></li>
          <li><a href="#">Downloads</a></li>
          <li><a href="#">About</a></li>
          <li><a href="#">Contact</a></li>
        </ul>
      </div>
-->
      <!-- Jumbotron -->
      <div class="jumbotron">

	<div class="form-inline" role="form">
	<h1>Welcome to Interstellar Banking!</h1>
        <p class="lead">We Just need few more details to get you started.</p>
	
	<div class="row">
    	<form class="span6" action="employeeaccountprocess.php" method="post">
	<h5>Personal Information.<h5><br>
       	<input type="text" name = "firstname" class="form-control"  placeholder="First Name" required autofocus>
	<input type="text" name = "middlename" class="form-control" placeholder="Middle Name" required>
	<input type="text" name = "lastname" class="form-control" placeholder="Last Name" required><br>
	<input class="form-control" type="text" name="employeeid" placeholder="Employee ID" required/>
	<select class="form-control" name="userrole" required>
	<option "value="clerk">Clerk</option>
     	<option value="manager">Manager</option>
     	<option value="admin">Administrator</option><br>
	<h5>Login Details.<h5><br>
	<input type="email" class="form-control" name="uemail" placeholder="Email" required>
	<input type="password" class="form-control" name="upassword" placeholder="Password" required>
	<input type="password" class="form-control" name="confirmpassword" placeholder="Confirm Password" required><br>
	<h5>Contact Information.<h5><br>
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

