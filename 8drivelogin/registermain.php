<?php  
	/*This passes the car id from pickavailable */
	$car_id = $_GET['carid'];  
	$cardesc = $_GET['cardesc'];
	$cartrans = $_GET['cartrans'];
	$carcapacity = $_GET['carcap'];
	$carmodel = $_GET['carmodel'];
	
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Create an 8drivecars account</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="bg-dark">
  <div style="background: url(img/about-bg.jpg) center top no-repeat; " class="container">
  <br><br>
    <div class="card card-register mx-auto mt-5">
      <div class="card-header"><strong>Please create a username and password to sign up...</strong></div>
      <div class="card-body">
        <form>
          <!--div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputName">First name</label>
                <input class="form-control" id="exampleInputName" type="text" aria-describedby="nameHelp" placeholder="Enter first name">
              </div>
              <div class="col-md-6">
                <label for="exampleInputLastName">Last name</label>
                <input class="form-control" id="exampleInputLastName" type="text" aria-describedby="nameHelp" placeholder="Enter last name">
              </div>
            </div>
          </div-->
          <div class="form-group">
            <label for="exampleInputEmail1">Create your username</label>
            <input class="form-control" id="exampleInputEmail1" type="email" aria-describedby="emailHelp" placeholder="Enter preferred username">
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputPassword1">Create password</label>
                <input class="form-control" id="exampleInputPassword1" type="password" placeholder="Password">
              </div>
              <div class="col-md-6">
                <label for="exampleConfirmPassword">Confirm password</label>
                <input class="form-control" id="exampleConfirmPassword" type="password" placeholder="Confirm password">
              </div>
            </div>
          </div>
          <!--a class="btn btn-warning btn-block" href="login.php">Register</a-->
		  <?php
        echo "<div class='text-center'>";
        echo  "<a class='btn btn-warning btn-block' href='login.php?carid={$car_id}&carmodel={$carmodel}&cardesc={$cardesc}&cartrans={$cartrans}&carcap={$carcapacity}'>Register</a>";
          //<!--a class="d-block small" href="forgot-password.html">Forgot Password?</a-->
        echo "</div>";
		?>
        </form>
        <?php
		/* use this only when cx pressed sign in on nav
        echo "<div class='text-center'>";
        echo  "<a class='d-block small mt-3' href='login.php?carid={$car_id}&carmodel={$carmodel}&cardesc={$cardesc}&cartrans={$cartrans}&carcap={$carcapacity}'>Go To Log In</a>";
          //<!--a class="d-block small" href="forgot-password.html">Forgot Password?</a-->
        echo "</div>";
		*/
		?>
      </div><!-- ./ card body -->
	  
    </div>
	<br><br><br><br><br><br><br><br><br><br><br><br>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>
