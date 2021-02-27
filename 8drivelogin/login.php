<?php include "../../8driveAdmin/db.php"; ?>

<?php  
	session_start();
	$username = "";
	$errors = array();
	//log user in from login page
	if (isset($_POST['log_in'])) {
		$username = mysqli_real_escape_string($connection, $_POST['usernameInput']);
		$password = mysqli_real_escape_string($connection, $_POST['passwordInput']);
		
		//ensure that form feilds are filled properly
		if(empty($username)) {
			array_push($errors, "Username is required");
		}
		if(empty($password)) {
			array_push($errors, "Password is required");
		}
		
		if(count($errors) == 0) {
			
			$password = $password; //md5($password);  encrypt pasword before comparing
			$query = "SELECT * FROM customerlogins WHERE cust_username = '$username' AND cust_password = '$password'";
			$result = mysqli_query($connection, $query);
			
			while($row = mysqli_fetch_assoc($result)) {
					
					if(!empty('cust_id')) {
						$cust_id = $row['cust_id'];
					
						/***experiment placing if !empty here mar 23***/
						$cust_doc1 = $row['cust_doc1'];
						$cust_doc2 = $row['cust_doc2'];
						$cust_doc3 = $row['cust_doc3'];
						$cust_doc4 = $row['cust_doc4'];
						$cust_doc5 = $row['cust_doc5'];
						$cust_doc6 = $row['cust_doc6'];
						$cust_residency = $row['cust_residency'];
						$cust_status = $row['cust_status'];
						
					
					}
					
			}
			
			$query = "SELECT * FROM customerinfo WHERE cust_id = '$cust_id'";
			$result = mysqli_query($connection, $query);
			
			while($row = mysqli_fetch_assoc($result)) {
					
				$cust_fname = $row['cust_fname'];
			
			}
			
			
			if(mysqli_num_rows($result) == 1) {
				
				// log user in
				$_SESSION['username'] = $username;
				$_SESSION['success'] = "You are now logged in";
				
				/*  We need to place a query for custrentinfo database and get value of cust_bill_screenshot for later eval when logging in */
				$query = "SELECT * FROM custrentinfo WHERE cust_id = '$cust_id'";
				$result = mysqli_query($connection, $query);
				
				while($row = mysqli_fetch_assoc($result)) {
					$cust_bill_status = $row['cust_bill_status'];
				}
				
				/***experiment placing if !empty here mar 23***/	//empty($cust_doc1) OR empty($cust_doc1) OR empty($cust_doc1) OR BILL PAY!!!
				if($cust_status == "UNVERIFIED" OR $cust_status == "ADDITIONAL DOCS REQUIRED" OR $cust_status == "PRIMARY DOCS REQUIRED" OR $cust_status == "AWAITING PAYMENT" OR $cust_doc1 == "" OR $cust_doc2 == "" OR $cust_doc3 == "") {
					
					$notempty = 0;
					if(!empty($cust_doc1) AND !empty($cust_doc2) AND !empty($cust_doc3)) {
						$notempty = 1;
					}
					
					$notemptysup = 0;
					if(!empty($cust_doc4) AND !empty($cust_doc5) AND !empty($cust_doc6)) {
						$notemptysup = 1;
					}
					
					$notemptybill = 0;
					if(!empty($cust_bill_status)) {
						$notemptybill = 1;
					}
					
					// /*doc1, doc2, doc3 missing or status unverified, primary required, additional docs required awaiting payment*/
					header("location: ../pickavailability/logincheckdocs.php?logsw={$loginsw}&cust_fname={$cust_fname}&cust_bill_status={$cust_bill_status}&notemptybill={$notemptybill}&notempty={$notempty}&notemptysup={$notemptysup}&custid={$cust_id}&cust_doc1={$cust_doc1}&cust_doc2={$cust_doc2}&cust_doc3={$cust_doc3}&cust_doc4={$cust_doc4}&cust_doc5={$cust_doc5}&cust_doc6={$cust_doc6}&cust_status={$cust_status}&cust_residency={$cust_residency}");
					
					
				} else {  //IF STATUS = APPROVED OR REJECTED ---> AT THIS POINT ADD VALIDATION IF RENT IS ONGOING AND VEHICLE NOT YET RETURNED
				
					header("location: ../index.php?logsw=1&custid={$cust_id}"); //redirect to home page
				}
				
			} else {
				array_push($errors, "Username/password combination not recognized");
				
			}
		}
		
	}
	//log out
	if (isset($_GET['logout'])) {
		session_destroy();
		//$loginsw = 0;
		unset($_SESSION['username']);
		header('location: ../index.php?logsw=0&custid={$cust_id}"'); // redirect to log in page
	}
	
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
		<?php
			echo "<form  action='login.php' method='post'>";
			
			//display validation errors here -->
			include("errors.php"); 
			
        ?>
		
		  <div class="form-group">
			<label for="exampleInputEmail1">Username</label>
            <input class="form-control" name="usernameInput" id="exampleInputEmail1" type="text" required/>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input class="form-control" name="passwordInput" id="exampleInputPassword1" type="password" placeholder="Enter Password" required/>
          </div>
		  
		  <hr>
		  <button type="submit" name="log_in" role="button" class="btn btn-warning btn-block">Sign In</button>
		  
        </form>
		<?php
		/* use this only when cx pressed sign in on nav*/
        echo "<div class='text-center'>";
        echo  "<a class='d-block small' href='../index.php'>Back to homepage</a>";
          //<!--a class="d-block small mt-3" href="forgot-password.html">Forgot Password?</a-->
        echo "</div>";
		
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
