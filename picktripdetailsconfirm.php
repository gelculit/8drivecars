<?php include "../../8driveAdmin/db.php"; ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Make A Reservation</title>

    <!-- load stylesheets -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">  <!-- Google web font "Open Sans" -->
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">                <!-- Font Awesome -->
    <link rel="stylesheet" href="css/bootstrap.min.css">                                      <!-- Bootstrap style -->
    <link rel="stylesheet" type="text/css" href="css/datepicker.css"/>
    <link rel="stylesheet" href="css/templatemo-style.css">                                   <!-- Templatemo style -->
      </head>

      <body>
	  
<!--munideliver={$munideliver}&citydeliver={$citydeliver}&add1={$add1}&add2={$add2}&wheredeliver={$wheredel}&
edit={$the_car_id}&carid={$carid}&carmodel={$carmodel}&cardesc={$cardesc}&cartrans={$cartrans}&carcap={$carcapacity}&wdrive={$cdrive}&
begdate={$indate}&retdate={$retdate}&totalrate={$cardayratepeak}&wdrive={$cdrive}&logsw={$loginsw}&custid={$cust_id}"); 

-->	  
<?php




	$loginsw = $_GET['logsw']; //&logsw={$loginsw} &custid={$cust_id}
	$cust_id = $_GET['custid']; //&custid={$cust_id}
    $the_car_id = $_GET['carid']; 
	$cdrive = $_GET['wdrive'];
	$indate = $_GET['begdate'];
	$retdate = $_GET['retdate'];
	$cardayratepeak = $_GET['totalrate'];
	
	$munideliver = $_GET['munideliver'];
	$citydeliver = $_GET['citydeliver'];
	$add1 = $_GET['add1'];
	$add2 = $_GET['add2'];
	$wheredel = $_GET['wheredeliver'];
	$zone_fee = $_GET['zonefee'];
	
	$carid = $_GET['carid'];
	$cardesc = $_GET['cardesc'];
	$carmodel = $_GET['carmodel'];
	$carcapacity = $_GET['carcap'];
	$cartrans = $_GET['cartrans']; 
	if($loginsw == 1) {  // March 27 3:21AM
		$delipickup = $_GET['delipickup'];
	}
	
	
	
	if($cdrive == "Yes") {
		$withdrive = "with driver";
	} else {
		$withdrive = "without driver";
	}
	
	
	//post info
    $query = "SELECT * FROM cardetail WHERE car_id = $the_car_id ";
	//--->insert here select to check pricing season
    $select_car_by_id = mysqli_query($connection, $query);

    // ***ACTUAL ADDING OF DATA TO TABLE
    while($row = mysqli_fetch_assoc($select_car_by_id)) {

			$carid = $row['car_id'];
			$cardesc = $row['car_desc'];
			$carmodel = $row['car_model'];
			//$carimage = $row['car_image'];
			$carcapacity = $row['car_capacity'];
			$cartrans = $row['car_trans'];
			$cardiy = $row['car_diy'];
			//$cardiy24 = $row['car_diy24'];
			//$cardiy1wk = $row['car_diy1wk'];
			//$cardiy1m = $row['car_diy1m'];

    }
	
	
	
	//convert all variables to be used for displaying date
	$stamp_indate = strtotime($indate);
	$start_day = date('d', $stamp_indate);
	$start_month = date('F', $stamp_indate);
	$start_year = date('Y', $stamp_indate);
	
	$stamp_retdate = strtotime($retdate);
	$end_day = date('d', $stamp_retdate);
	$end_month = date('F', $stamp_retdate);
	$end_year = date('Y', $stamp_retdate);

	$diff_date = ($stamp_retdate - $stamp_indate)/60/60/24;
	$diff_date = round($diff_date,0,PHP_ROUND_HALF_UP) ;

?>

		<div class="tm-page-wrap mx-auto">
            <section class="tm-banner">
                <div class="tm-container-outer tm-banner-bg">
                    <div style="background: url(img/about-bg.jpg) center top no-repeat; background-attachment: fixed;" class="container">
						<div class="row tm-banner-row" id="tm-section-search">
						
						<?php
							echo "<form action='picktripdetailsconfirm.php?zonefee={$zone_fee}&wheredeliver={$wheredel}&citydeliver={$citydeliver}&edit={$the_car_id}&carid={$carid}&carmodel={$carmodel}&cardesc={$cardesc}&cartrans={$cartrans}&carcap={$carcapacity}&wdrive={$cdrive}&begdate={$indate}&retdate={$retdate}&totalrate={$cardayratepeak}&wdrive={$cdrive}&logsw={$loginsw}&custid={$cust_id}' method='get' class='tm-search-form tm-section-pad-2'>";
							echo "<h4 class='text-center'><strong>{$carmodel} {$carcapacity}-seater {$cartrans}  Transmission</strong></h4><br>	";						
						
						?>
						<div class="form-row tm-search-form-row">
							<h6><p>
						By clicking I Agree you have agreed to the Terms and Conditions. Your rent information has been saved and will be reviewed shortly. An email confirmation will be sent to you after the review. <?php if($cdrive == "No") { echo "Summary of your rent details are as follows:"; } ?>
							<br><br></p></h6>
						</div>
						
						<?php
							//IF WITHOUT DRIVER
							if($cdrive == "No") {
						
							
								$cardayrateformat = number_format($cardayratepeak, 2);
								echo "<h6>You have scheduled using the vehicle for <strong>{$diff_date}</strong> day/s <strong>{$withdrive}</strong>. <br></h6>";
								
								echo "<h6>Start Date : <strong>{$start_day} {$start_month} {$start_year}</strong></h6>";
								echo "<h6>Return Date: <strong>{$end_day} {$end_month} {$end_year}</strong></h6>";
								echo "<h6>Start Time: <strong>9 AM</strong></h6>";
								echo "<h6>Vehicle Rent Amount: <strong>Php {$cardayrateformat}</strong></h6>";
								
								
								if($loginsw == 1) {  // March 27 3:21AM
									if($delipickup == "Pick-up") {
										echo "<h6>Vehicle will be picked up at <strong>8DriveCars office</strong></h6>";
									} else {
										echo "<h6>Vehicle will be delivered to <strong>{$wheredel}</strong></h6>";
										echo "<h6>An additional <strong>Php700 ~ Php900</strong> fee will be added for delivery. Fee rate is according to your address' proximity from 8drivecars office.</h6>";
									}
								} else {
									
									if($wheredel == "Address") {
										$wheredel = "Address On File";
										$howmuch = "Php700.00 ~ Php900.00";
									} 
									if($wheredel == "Nominate") {
										$wheredel = "Nominated Address";
										$howmuch = "Php".$zone_fee.".00";
									} 
									
										echo "<h6>Vehicle will be delivered to <strong>{$wheredel}</strong></h6>";
										
										echo "<h6>An additional <strong>{$howmuch}</strong> delivery fee will be added. Fee rate is according to your address' proximity from 8drivecars office.</h6>";
										
										
										
								}
								
								
								//echo "<hr>";
							//echo "<div class='form-row tm-search-form-row'> ";
							//echo "	<h6><strong>Now that we have your preferred vehicle and schedule, tell us more about your trip...</strong><br>";
							//echo "	</h6>";
							//echo "</div>";
							}
							?>
							<br><br>
							
							<!-- Ask if cu wants to do payment now -->
							
							<div class='form-row tm-search-form-row'>
								<div class="form-group tm-form-group tm-form-group-pad tm-form-group-1">
								<?php
									echo "<a href='pickdetailconfirmuploadbill.php?custid={$cust_id}' role='button' class='btn btn-warning tm-btn tm-btn-search text-uppercase'>Upload Proof of Payment?</a>";
								?>
								</div>
								<!--
								upload variables:
								$date = date('Y-m-d') - compare with custrentinfo -> cust_reserve_date
								$cust_id
								get car_trans_id
								-->
								
							
								<div class="form-group tm-form-group tm-form-group-pad tm-form-group-1">
									<a href="../index.php" role="button" class="btn btn-warning tm-btn tm-btn-search text-uppercase">Upload Later</a>
								</div>
							</div>
							
							
                            </form>  
								
                        </div> <!-- row -->
						
                        <div class="tm-banner-overlay"></div>
						
						
						<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                        
                    </div>  <!-- .container -->                   
                </div>     <!-- .tm-container-outer -->                 
            </section>
					
		</div>	

<?php include "pickavailablefooter.php"; ?>
