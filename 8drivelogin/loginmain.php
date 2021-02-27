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
  <title>Customer Log In</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="bg-dark">
  <div style="background: url(img/about-bg.jpg) center top no-repeat; " class="container"><br><br>
    <div class="card card-login mx-auto mt-5">
      <div class="card-header"><strong>Sign in to view your account..</strong></div>
      <div class="card-body">
        <form>
          <div class="form-group">
            <label for="exampleInputEmail1">Username</label>
            <input class="form-control" id="exampleInputEmail1" type="email" aria-describedby="emailHelp" placeholder="Enter username" required/>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input class="form-control" id="exampleInputPassword1" type="password" placeholder="Enter Password" required/>
          </div>
		  
          <!--div class="form-group">
            <div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input" type="checkbox"> Remember Password</label>
            </div>
          </div-->
		  
		  <?php
		  echo "<a href='../pickavailability/pickuploaddocs.php?carid={$car_id}&carmodel={$carmodel}&cardesc={$cardesc}&cartrans={$cartrans}&carcap={$carcapacity}' role='button' class='btn btn-warning btn-block'>Log In</a>";
          ?>
		  
		  <!--<a class="btn btn-warning btn-block" href="">Login</a>-->
        </form>
		<?php
		/* use this only when cx pressed sign in on nav
        echo "<div class='text-center'>";
        echo  "<a class='d-block small mt-3' href='register.php?carid={$car_id}&carmodel={$carmodel}&cardesc={$cardesc}&cartrans={$cartrans}&carcap={$carcapacity}'>New to 8drivecars? Register here.</a>";
          //<!--a class="d-block small" href="forgot-password.html">Forgot Password?</a-->
        echo "</div>";
		*/
		?>
        </div>
	    
    </div><br><br><br><br><br><br><br><br><br><br><br><br>
  </div>
  
  
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>
