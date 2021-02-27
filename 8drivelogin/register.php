<!-- ***THIS IS FOR FIRST TIME LOG IN AND REGISTRATION USE ONLY*** -->
<?php include "../../8driveAdmin/db.php"; ?>


<?php  
	/*This passes the car id from pickavailable */
	$loginsw = $_GET['logsw']; //&logsw={$loginsw}
	$car_id = $_GET['carid'];  
	$cardesc = $_GET['cardesc'];
	$cartrans = $_GET['cartrans'];
	$carcapacity = $_GET['carcap'];
	$carmodel = $_GET['carmodel'];
	$cdrive = $_GET['wdrive'];
	$indate = $_GET['begdate'];
	$retdate = $_GET['retdate'];
	$cardayratepeak = $_GET['totalrate'];
	$custfname = $_GET['fname'];
	$custlname = $_GET['lname'];
	$cust_id = " "; //&custid={$cust_id}
	$cdrive = $_GET['wdrive'];
	//$airportpick = $_GET['airpick'];
	//$airdetail = $_GET['airdetail'];
	
		
?>



<?php


$passwordsw = 0; //to check if password or username had already been created
$nextsw = 0; //check if next step button needs to be displayed
$passnotsw = 0;
$passwordnotsame = "<center><h6>Make sure both passwords are the exactly the same</h6></center>";

if(isset($_POST['create_register'])) {
	
	//check if cx have no existing password and username --> check possibility of using this in pickcustinfo.php
	//$custQuery = "SELECT * FROM customerlogins WHERE cust_fname = $custfname AND cust_lname = $custlname   WHERE cust_username = $username";
	$username = $_POST['userName'];
	//echo $username;
	$custQuery = "SELECT * FROM customerlogins";
	$duplicate = mysqli_query($connection, $custQuery);
	
	while ($row = mysqli_fetch_assoc($duplicate)) {
		if($username == $row['cust_username']) {
			$passwordsw = 1; //passowrd and username already exist!!!
		}
	}
	
	//if(!empty($duplicate)) {
	//	$passwordsw = 1; //passowrd and username already exist!!!
	//	echo $uname;
	//}
	
	//get cust id for updating in database
	$custQuery = "SELECT * FROM customerinfo";
	$select_cust_by_id = mysqli_query($connection, $custQuery);

		
	while ($row = mysqli_fetch_assoc($select_cust_by_id)) {
		if($row['cust_fname'] == $custfname AND $row['cust_lname'] == $custlname ) {
			$cust_id = $row['cust_id'];
			//echo $cust_id;
		}
	}
	
	
	if($passwordsw == 0) {
		
		$custstat = "UNVERIFIED";
		$password1 = $_POST['inputPassword'];
		$password2 = $_POST['confirmPassword'];
		if($password1 == $password2) {
			$custQuery = "SELECT * FROM customerlogins";
			$custQuery = "INSERT INTO customerlogins (cust_id, cust_username, cust_password, cust_status) ";
			$custQuery .= "VALUES ('{$cust_id}', '{$username}', '{$password1}', '{$custstat}' )";
		
			$create_cust_query = mysqli_query($connection, $custQuery);
		
			if(!$create_cust_query) {
				die("Query Failed " . mysqli_error($connection));
			}
			$nextsw = 1;
			$passnotsw = 0;
		} else {
			$passnotsw = 1;
			$nextsw = 0;
		}
	
	}	
	
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
	  
		<?php
			echo "<form action='register.php?ispassword={$passwordsw}&carid={$car_id}&carmodel={$carmodel}&cardesc={$cardesc}&cartrans={$cartrans}&carcap={$carcapacity}&wdrive={$cdrive}&begdate={$indate}&retdate={$retdate}&totalrate={$cardayratepeak}&fname={$custfname}&lname={$custlname}&custid={$cust_id}&wdrive={$cdrive}&logsw={$loginsw}' method='post' class='tm-search-form tm-section-pad-2'>";
		?>
		
		<!--
		carid={$car_id}&carmodel={$carmodel}&cardesc={$cardesc}&cartrans={$cartrans}&carcap={$carcapacity}&wdrive={$cdrive}&begdate={$indate}&retdate={$retdate}&totalrate={$cardayratepeak}&fname={$custfname}&lname={$custlname}&custid={$cust_id}&wdrive={$cdrive}&airpick={$airportpick}&airdetail={$airdetail}&logsw={$loginsw}
		-->
		
          <div class="form-group">
            <label for="exampleInputEmail1">Create your username</label>
			
			<?php
			if($passwordsw == 1) {
				$nextsw = 0;
				echo "<input class='form-control' name='userName' type='text' placeholder='Username you are creating is not available...' required/>";
			} else if($nextsw == 0) {
				if($passnotsw == 0) {
					echo "<input class='form-control' name='userName' type='text' placeholder='Enter preferred username' required/>";
				} else {
					echo "<input class='form-control' name='userName' type='text' value={$username} required/>";
				}
			} else {
				echo "<input class='form-control' name='userName' type='text' value={$username} required/>";
			}
			?>
          </div>
		  
		<div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputPassword1">Create password</label>
                <input class="form-control" name="inputPassword" type="password" placeholder="Enter password" required/>
              </div>
			  <?php
              echo "<div class='col-md-6'>";
              echo  "<label for='exampleConfirmPassword'>Confirm password</label>";
			
				echo  "<input class='form-control' name='confirmPassword' type='password' placeholder='Confirm password' required/>";
			  
              echo "</div>";
			  ?>
            </div>
          </div>
		  <hr>
          <!--a class="btn btn-warning btn-block" href="login.php">Register</a-->
		  <?php
		   
		  if($passnotsw == 1) {
			  echo $passwordnotsame;
		  }
		  ?>
		  
		  <?php
        echo "<div class='text-center'>";
        if($nextsw == 0) {
			echo	"<button type='submit' name='create_register' role='button' class='btn btn-warning btn-block'>Register</button>";
			echo  "<a class='d-block small' href='../pickavailability/pickuploaddocs.php?ispassword={$passwordsw}&carid={$car_id}&carmodel={$carmodel}&cardesc={$cardesc}&cartrans={$cartrans}&carcap={$carcapacity}&wdrive={$cdrive}&begdate={$indate}&retdate={$retdate}&totalrate={$cardayratepeak}&fname={$custfname}&lname={$custlname}&custid={$cust_id}&wdrive={$cdrive}&logsw={$loginsw}'>I already have an 8 Drive Cars account</a>";
        } else {
			echo "<strong>You have successfully created your username and password. Please take note of your details as these are your permanent credentials</strong><br>";
			echo  "<a class='btn btn-warning btn-block' href='../pickavailability/pickuploaddocs.php?ispassword={$passwordsw}&carid={$car_id}&carmodel={$carmodel}&cardesc={$cardesc}&cartrans={$cartrans}&carcap={$carcapacity}&wdrive={$cdrive}&begdate={$indate}&retdate={$retdate}&totalrate={$cardayratepeak}&fname={$custfname}&lname={$custlname}&custid={$cust_id}&wdrive={$cdrive}&logsw={$loginsw}'>Next Step</a><br>";
		}
		echo "</div>";
		?>
        </form>
        
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
