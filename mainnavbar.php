<?php ob_start(); ?>
<?php include "../8driveAdmin/db.php"; ?>




<?php 
	$loginsw = 0;
	$cust_id = " ";
	$cust_fname = " ";
	//check if cx logged in with username and password  $cust_id = $_GET['custid'];
	if(isset($_GET['logsw'])) {
		$loginsw = $_GET['logsw']; //cx logged in
		$cust_id = $_GET['custid'];
		//get customer's name and display on nav bar
		$query = "SELECT * FROM customerinfo WHERE cust_id = '$cust_id'";
		$result = mysqli_query($connection, $query);
		while($row = mysqli_fetch_assoc($result)) {
			if(!empty('cust_id')) {
				$cust_fname = $row['cust_fname'];
				//echo $cust_fname;
			}
					
		}
	}
	
	//log out
	/*
	if (isset($_GET['logout'])) {
		//session_destroy();
		$loginsw = 0;
		unset($_SESSION['username']);
		//header('location: ytlogin1.php'); // redirect to log in page
	}
	*/
	
?>




<!-------------MAIN NAVBAR------->

<!-- Preloader section
================================================== -->
<section  class="preloader">

	<div class="sk-rotating-plane"></div>

</section>


<!-- Navigation section
================================================== -->
<section class="navbar navbar-fixed-top custom-navbar" role="navigation">
	<div class="container">

		<div class="navbar-header">
			<button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="icon icon-bar"></span>
				<span class="icon icon-bar"></span>
				<span class="icon icon-bar"></span>
			</button>
			<a href="#home" class="smoothScroll navbar-brand">8 Drive Cars</a>
		</div>
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav navbar-right">
				<?php if($loginsw == 0) { ?>
					<li><a href="#home" class="smoothScroll">HOME</a></li> 
					<li><a href="#portfolio" class="smoothScroll">GALLERY</a></li>
					<li><a href="8drivelogin/login.php"class="smoothScroll">SIGN IN</a></li>
					<li><a href="#faqs" class="smoothScroll">FAQs</a></li>
					<li><a href="#contact"class="smoothScroll">CONTACT US</a></li>
					<li><a href="../8driveAdmin/index.php"class="smoothScroll">ADMIN LOGIN</a></li>
				<?php } else { ?>
					<li><a href="#home" class="smoothScroll">HOME</a></li> 
					<li><a href="#portfolio" class="smoothScroll">GALLERY</a></li>
					
					<li><a href="8drivelogin/login.php?logout='1'">LOG OUT</a></li>
					
					<li><a href="#faqs" class="smoothScroll">FAQs</a></li>
					<li><a href="#contact"class="smoothScroll">CONTACT US</a></li>
					<li><a href=""class="smoothScroll"><strong>WELCOME <?php echo $cust_fname; ?>! </strong></a></li>
					<!--li><a href="../8driveAdmin/index.php"class="smoothScroll">ADMIN LOGIN</a></li-->
				<?php } ?>
			</ul>
		</div>

	</div>
</section>


