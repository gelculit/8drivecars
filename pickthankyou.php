<?php include "pickavailableheader.php"; ?>


<?php 
	$billdoc = " ";
	$billpaydate = date('0000-00-00');
		if(isset($_POST['submitpay'])) {
			
			$billdoc = $_FILES['billdoc']['name'];
			$post_image_temp1 = $_FILES['billdoc']['tmp_name'];
			
			if(!empty($billdoc)) {
				move_uploaded_file($post_image_temp1, "docimage/$billdoc");
				$billpaydate = date('y-m-d');
			}
			
		}

?>
  
<?php  
	/*get all necessary parameters */
	$loginsw = $_GET['logsw'];
	$docempty = $_GET['docempty'];
	$scrshot = $_GET['screenshot']; 
	$indate = $_GET['begdate'];
	$retdate = $_GET['retdate'];
	$diff_date = $_GET['diffdate'];
	$cardayratepeak = $_GET['totalrate'];
	$car_id = $_GET['carid'];  
	$cust_id = $_GET['custid'];  
	$cdrive = $_GET['wdrive'];
	$airportpick = $_GET['airpick'];
	$airdetail = $_GET['airdetail'];
	
	
	
?>

<?php
	/*create custrentinfo database*/
		$custQuery = "SELECT * FROM custrentinfo";
		$custQuery = "INSERT INTO custrentinfo (cust_id, cust_car_id, cust_reserve_date, car_drive, cust_airport, cust_air_details, cust_pickup_date, cust_return_date, cust_howmany_days, cust_rent_amt, cust_bill_screenshot, cust_bill_paydate) ";
		$custQuery .= "VALUES ('{$cust_id}', '{$car_id}', now(), '{$cdrive}', '{$airportpick}', '{$airdetail}', '{$indate}', '{$retdate}', '{$diff_date}', '{$cardayratepeak}', '{$billdoc}', '{$billpaydate}')";
		
		$create_cust_query = mysqli_query($connection, $custQuery);
		
		if(!$create_cust_query) {
            die("Query Failed " . mysqli_error($connection));
        }
		
?>

	  
	  
	 
        

        <div class="tm-page-wrap mx-auto">
            <section class="tm-banner">
                <div class="tm-container-outer tm-banner-bg">
                    <div style="background: url(img/about-bg.jpg) center top no-repeat; background-attachment: fixed;" class="container">
						<div class="row tm-banner-row" id="tm-section-search">
							
								<?php
									echo "<form action='' method='get' enctype='multipart/form-data' class='tm-search-form tm-section-pad-2'>";
									echo "<h4 class='text-center'><strong>Thank you for using 8DriveCars!</strong></h4>	";	
								?>
								
								<hr>
								
								<!--------->
								<br>
								<?php 
								if($loginsw == 1) {
									$docempty = 1;
								}
								if($scrshot == 1 OR $docempty == 0) {
									echo "<h6 class='text-center'>To upload screen shot of required documents at a later time, please click <strong>SIGN IN</strong> on the main page and enter your username and password. You will automatically be routed to the screen shot upload option.</h6>	";	
								} 
								if($scrshot == 2 OR $loginsw == 1){
									echo "<h6 class='text-center'>An email confirmation of the reservation and copy of the Terms and Conditions will be sent to your email...</h6>	";	
								}
								
								?>
						
								
								<!---------->
								<br><br>
								<!---EDIT or CONFIRM buttons-->
								<?php
								
								echo "<div class='form-row tm-search-form-row'>";
									/*  logsw={$loginsw}&custid={$cust_id}  -- work on this later*/
									echo	"<a href='../index.php?logsw={$loginsw}&custid={$cust_id}' role='button' class='btn btn-warning tm-btn tm-btn-search text-uppercase'>Done</a>";
								
								echo "</div>";
								
								?>
								
							</form>  		
                                    
                           </div> <!-- row -->
                        <div class="tm-banner-overlay"></div>
						<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                        
                    </div>  <!-- .container -->                   
                </div>     <!-- .tm-container-outer -->                 
            </section>     <!-- .tm-container-outer  --> 

<?php include "pickavailablefooter.php"; ?>
