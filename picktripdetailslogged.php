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
	  
<?php 
$t_and_csw= 0;
$citydeliver = " ";
$munideliver = " ";
$citydeliversw = 0; // check if a selction for city was made
$munideliversw = 0; // check if a selction for municipality was made
$wheredelmsg = " ";
$add1=" ";
$add2=" ";
$wheredel = " ";
$locationsw = 0; //to check if a location was nominated by user
$wheredeliversw=0; // to check if submit for where to deliver is pressed
$nextsw = 0; //to check if info has been typed and submit button pressed
$deli_address = " "; //will be delivered to address on file
$zone_fee = 0; //customer delivery fee for alternate address
$loginsw = 0; //if cu is logged in
$deliverpickupsw = 0; //deliver or pick up?
$delipickup = " "; // used to GET delivery or pick up



if(isset($_POST['deliverpickup'])) {
	
	$delipickup = $_POST['delipickup'];
	//echo $delipickup;
	
	if($delipickup == "Deliver") {
		$deliverpickupsw = 1;  } // 1 = vehicle is for delivery
	if($delipickup == "Pick-up") {
		$deliverpickupsw = 2;   }// 2 = vehicle is for pickup
		$deli_address = "No";
	if($delipickup == " ") {
		$deliverpickupsw = 0;   // 0 = n o option is selected yet
	}
	//echo $deliverpickupsw;
	
	
}




if(isset($_POST['tripdetail'])) {
		//$airportpick = $_POST['airportpick'];
		//$airdetail = $_POST['airdetail'];
		$nextsw = 1;
		$delipickup = $_GET['delipickup'];  //experiment 3:17 19/03
		$deli_address = $_GET['deli_address']; //check if deliver to address or nominate
}

if(isset($_POST['deliver'])) { // if where to deliver button is pressed
	
		//$cust_id = $_GET['custid']; //experiment
		
		$delipickup = $_GET['delipickup'];  //experiment 3:17 19/03
		$deli_address = $_GET['deli_address']; //check if deliver to address or nominate
		
		$deliverpickupsw = 1; //cx chose vehicle delivered
		$wheredeliversw=1;
		$wheredel = $_POST['wheredel'];
		if($wheredel == "Address") {
			$wheredelmsg = "Vehicle will be delivered to your address on file";
			//this is where you do something to make sure car is delivered to address/indicate in database
			$deli_address = "Yes";
		} 
		if($wheredel == "Nominate") {
			$wheredelmsg = "Vehicle will be delivered a nominated address. Please fill up address information below.";
			$deli_address = "No";
		}
		if($wheredel == " ") {
			$deli_address = " ";
			$deliverpickupsw = 1;
		}
		
		
		
}

if(isset($_POST['cityselect'])) {  //if submit button for city is pressed
	$add1 = $_POST['add1'];
	$add2 = $_POST['add2'];
	$locationsw = 1;
	$wheredel = "Nominate";
	$wheredeliversw = 1;
	$wheredelmsg = "Vehicle will be delivered a nominated address. Please fill up address information below.";
	$citydeliver = $_POST['citydeliver'];  // contains the value of selected city
	$citydeliversw = 1; // a city has been chosen
	
	$delipickup = $_GET['delipickup'];  //experiment 3:17 19/03
	$deli_address = $_GET['deli_address']; //check if deliver to address or nominate
	
	$deliverpickupsw = 1; //cx chose vehicle delivered
	
	$query = "SELECT * FROM zone_city";
    $select_city = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_city)) {
		$zonecity = $row['zone_ct'];
		if($citydeliver == $zonecity) {
			$zone_id = $row['zone_id']; //get the zone_ct_id
		}
	}


}


if(isset($_POST['muniselect'])) {  //if submit button for municipality is pressed
	$add1 = $_POST['add1'];
	$add2 = $_POST['add2'];
	$locationsw = 1;
	$wheredel = "Nominate";
	$wheredeliversw = 1;
	$wheredelmsg = "Vehicle will be delivered to a nominated address. Please fill up address information below.";
	$munideliver = $_POST['munideliver'];
	$citydeliver = $_GET['citydeliver'];  //???
	
	$delipickup = $_GET['delipickup'];  //experiment 3:17 19/03
	$deli_address = $_GET['deli_address']; //check if deliver to address or nominate
	
	$deliverpickupsw = 1; //cx chose vehicle delivered
	
	$citydeliversw = 1; // a city has been chosen
	$munideliversw = 1; // a municipality has been chosen
	$deli_address = "No"; //will be delivered to nominated address
	
	
	$query = "SELECT * FROM zone_municipality";
    $select_municipality = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_municipality )) {
		$zonemunicipality = $row['zone_municipal'];
		if($munideliver == $zonemunicipality) {
			$zone_fee = $row['zone_fee']; //get the delivery fee for this zone
			//echo $zone_fee;
		}
	}
	
	
	

}


if(isset($_POST['submitaddress'])) {  //if alternate address fill up form is complete

	//header("location: picktripdetailsconfirm.php?munideliver={$munideliver}&citydeliver={$citydeliver}&add1={$add1}&add2={$add2}&wheredeliver={$wheredel}&edit={$the_car_id}&carid={$carid}&carmodel={$carmodel}&cardesc={$cardesc}&cartrans={$cartrans}&carcap={$carcapacity}&wdrive={$cdrive}&begdate={$indate}&retdate={$retdate}&totalrate={$cardayratepeak}&wdrive={$cdrive}&logsw={$loginsw}&custid={$cust_id}"); 

	$delipickup = $_GET['delipickup'];  //experiment 3:17 19/03
	$deli_address = $_GET['deli_address']; //check if deliver to address or nominate

	$t_and_csw= 1;

	$wheredel = $_GET['wheredel'];

	if($wheredel == "Nominate") {

		$add1 = $_POST['add1'];
		$add2 = $_POST['add2'];
		$cust_id = $_GET['custid'];
		$citydeliver = $_GET['citydeliver'];
		$munideliver = $_GET['muni_deliver'];
		$zone_fee = $_GET['zonefee'];
		//echo $cust_deli_fee;
	
		$deliverpickupsw = 1; //cx chose vehicle delivered


		$custQuery = "SELECT * FROM cust_alt_address";
		$custQuery = "INSERT INTO cust_alt_address (cust_id, cust_reserve_date, cust_add1, cust_add2, cust_city, cust_municipality, cust_deli_fee) ";
		$custQuery .= "VALUES ('{$cust_id}', now(), '{$add1}', '{$add2}', '{$citydeliver}', '{$munideliver}', '{$zone_fee}' )";
		
		$create_cust_query = mysqli_query($connection, $custQuery);
		
		if(!$create_cust_query) {
			die("Query Failed " . mysqli_error($connection));
		}
	}
	
	//if($delipickup == "Pick-up") {
	//	$deliverpickupsw = 2;   }// 2 = vehicle is for pickup
	//}
	
}

if(isset($_POST['submitagree'])) {  //if I Agree button was pressed

	$delipickup = $_GET['delipickup'];  //experiment 3:17 19/03
	$deli_address = $_GET['deli_address']; //check if deliver to address or nominate

	$loginsw = $_GET['logsw']; //&logsw={$loginsw} &custid={$cust_id}
	$cust_id = $_GET['custid']; //&custid={$cust_id}
    $the_car_id = $_GET['carid']; 
	$cdrive = $_GET['wdrive'];
	$indate = $_GET['begdate'];
	$retdate = $_GET['retdate'];
	$cardayratepeak = $_GET['totalrate'];
	
	/*check if for deliver or pick up*/
	if($delipickup == "Deliver") {
		$cust_deli_pick = "Delivery";  } // 1 = vehicle is for delivery
	if($delipickup == "Pick-up") {
		$cust_deli_pick = "Pick-Up";   
		$deli_address = "No";  }   // 2 = vehicle is for pickup
		
	
	
	$stamp_indate = strtotime($indate);
	$stamp_retdate = strtotime($retdate);
	$diff_date = ($stamp_retdate - $stamp_indate)/60/60/24;
	
	/*bring in the other important vars
	$add1 = $_POST['add1'];
	$add2 = $_POST['add2'];
	$munideliver = $_POST['munideliver'];
	$citydeliver = $_GET['citydeliver'];  *///???
	
	//save all information on file then place a finish or done button
	
	$cust_rental_status = "For Review";

	$custQuery = "SELECT * FROM custrentinfo";
	$custQuery = "INSERT INTO custrentinfo (cust_id, cust_car_id, cust_reserve_date, car_drive, cust_pickup_date, cust_return_date, cust_deli_pick, cust_delitoaddress, cust_howmany_days, cust_rental_status, cust_rent_amt ) ";
	$custQuery .= "VALUES ('{$cust_id}', '{$the_car_id}', now(), '{$cdrive}', '{$indate}', '{$retdate}', '{$cust_deli_pick}', '{$deli_address}', '{$diff_date}', '{$cust_rental_status}', '{$cardayratepeak}' )";
		
	$create_cust_query = mysqli_query($connection, $custQuery);
		
	if(!$create_cust_query) {
		die("Query Failed " . mysqli_error($connection));
	}
	
header("location: picktripdetailsconfirm.php?delipickup={$delipickup}&munideliver={$munideliver}&citydeliver={$citydeliver}&zonefee={$zone_fee}&add1={$add1}&add2={$add2}&wheredeliver={$wheredel}&edit={$the_car_id}&carid={$the_car_id}&carmodel={$carmodel}&cardesc={$cardesc}&cartrans={$cartrans}&carcap={$carcapacity}&wdrive={$cdrive}&begdate={$indate}&retdate={$retdate}&totalrate={$cardayratepeak}&wdrive={$cdrive}&logsw={$loginsw}&custid={$cust_id}"); 



}


?>
	  
<?php
	$loginsw = $_GET['logsw']; //&logsw={$loginsw} &custid={$cust_id}
	$cust_id = $_GET['custid']; //&custid={$cust_id}
    $the_car_id = $_GET['carid']; 
	$cdrive = $_GET['wdrive'];
	$indate = $_GET['begdate'];
	$retdate = $_GET['retdate'];
	$cardayratepeak = $_GET['totalrate'];
	
	
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

	$stamp_indate = strtotime($indate);
	$start_day = date('d', $stamp_indate);
	$start_month = date('F', $stamp_indate);
	$start_year = date('Y', $stamp_indate);
	
	$stamp_retdate = strtotime($retdate);
	$end_day = date('d', $stamp_retdate);
	$end_month = date('F', $stamp_retdate);
	$end_year = date('Y', $stamp_retdate);

	$diff_date = ($stamp_retdate - $stamp_indate)/60/60/24;

?>

		<div class="tm-page-wrap mx-auto">
            <section class="tm-banner">
                <div class="tm-container-outer tm-banner-bg">
                    <div style="background: url(img/about-bg.jpg) center top no-repeat; background-attachment: fixed;" class="container">
						<div class="row tm-banner-row" id="tm-section-search">
						
						
						<?php
							echo "<form action='picktripdetailslogged.php?deli_address={$deli_address}&delipickup={$delipickup}&wheredel={$wheredel}&citydeliver={$citydeliver}&muni_deliver={$munideliver}&zonefee={$zone_fee}&edit={$the_car_id}&carid={$carid}&carmodel={$carmodel}&cardesc={$cardesc}&cartrans={$cartrans}&carcap={$carcapacity}&wdrive={$cdrive}&begdate={$indate}&retdate={$retdate}&totalrate={$cardayratepeak}&logsw={$loginsw}&custid={$cust_id}' method='post' class='tm-search-form tm-section-pad-2'>";
							echo "<h4 class='text-center'><strong>{$carmodel} {$carcapacity}-seater {$cartrans}  Transmission</strong></h4><br>	";						
						//deliver={$wheredeliversw}&
						
						?>
						
						
							<!--if($t_and_csw == 0) 
							<?php //if($t_and_csw == 0) { ?> -->
							
							
							<?php
							$cardayrateformat = number_format($cardayratepeak, 2);
								echo "<h6>You have scheduled using the vehicle for <strong>{$diff_date}</strong> day/s <strong>{$withdrive}</strong>. <br></h6>";
								
								echo "<h6>Start Date : <strong>{$start_day} {$start_month} {$start_year}</strong></h6>";
								echo "<h6>Return Date: <strong>{$end_day} {$end_month} {$end_year}</strong></h6>";
								echo "<h6>Start Time: <strong>9 AM</strong></h6>";
								echo "<h6>Vehicle Total Amount: <strong>Php {$cardayrateformat}</strong></h6>";
								
							//echo "<hr>";
							echo "<div class='form-row tm-search-form-row'> ";
							//echo "	<h6><strong>Now that we have your preferred vehicle and schedule, tell us more about your trip...</strong><br>";
							echo "	</h6>";
							echo "</div>";
							?>
							
							<?php  

							//IF WITHOUT DRIVER
							if($cdrive == "No") {
								if($t_and_csw == 0) { // if t&c is not yet clicked	
									echo "<hr>";
									echo "<div class='form-row tm-search-form-row'> ";
									echo "	<h6><strong>Now that we have your preferred vehicle and schedule, tell us more about your trip...</strong><br>";
									echo "	</h6>";
									echo "</div>";
								
/*<!----------------from here (customer is logged in) --------------------------------->	*/			

									if($loginsw==1 AND $deliverpickupsw == 0) { ?>
							
									
										<div class="form-row tm-search-form-row">
											<?php if($delipickup == " ") {?>
										
											<div class="form-group tm-form-group tm-form-group-pad tm-form-group-1">   
												<label for="wdrive">Deliver or Pick-up?</label>     
												<select name="delipickup" class="form-control tm-select" id="inputAdult">
													<option value=" " selected>Select one</option>
													<option value="Deliver">Deliver</option>
													<option value="Pick-up">Pick-up</option>
												</select>  
											</div>
									
											<div class="form-group tm-form-group tm-form-group-pad tm-form-group-1">
												<label for="btnSubmit">&nbsp;</label>
												<button type="submit" name="deliverpickup" class="btn btn-warning tm-btn tm-btn-search text-uppercase" id="btnSubmit">Submit</button>
											</div>
										
											<?php } else { ?>
										
											<div class="form-group tm-form-group tm-form-group-pad tm-form-group-1">   
												<label for="wdrive">Deliver or Pick-up?</label>  
												<p> <?php echo $delipickup; ?> </p>
											<?php } ?>
										
									</div> 
								
									<?php }  ?>





				
<!----------------from here (customer is logged in) --------------------------------->	

								<?php 
							
/*if cu wants delivered*/		if($deliverpickupsw == 1) {  
							
							
									//Ask where customer wants to have the vehicle delivered 
									if($wheredeliversw==1) { ?>
							
										<div class="form-row tm-search-form-row">
											<div class="form-group tm-form-group tm-form-group-pad tm-form-group-12">                                       
												<label for="wdrive">Where to deliver?</label>     
												<p> <?php echo $wheredelmsg; ?> </p>
											</div>
										</div>
							
									<?php  } else { ?>
							
										<div class="form-row tm-search-form-row">

											<div class="form-group tm-form-group tm-form-group-pad tm-form-group-1">                                       
												<label for="wdrive">Where to deliver?</label>     
												<select name="wheredel" class="form-control tm-select" id="inputAdult">
													<option value=" " selected>Select one</option>
													<option value="Address">Address on file</option>
													<option value="Nominate">Nominate an address</option>
												</select>  
											</div>
									
											<div class="form-group tm-form-group tm-form-group-pad tm-form-group-1">
												<label for="btnSubmit">&nbsp;</label>
												<button type="submit" name="deliver" class="btn btn-warning tm-btn tm-btn-search text-uppercase" id="btnSubmit">Submit</button>
											</div>
										</div> 
								
								<?php } ?>


							<!-- /.  //Ask where customer wants to have the vehicle delivered -->


							
<!--nominate address--->		<?php 
								if($wheredel == "Nominate") {  ?>	<!-- if cx wants to have vehicle delivered to different address -->
							
<!----t_and_csw------>			<?php if($t_and_csw == 0) { ?>				
							
									<?php if($munideliversw == 1 AND $citydeliversw == 1) { ?>  <!--IF MUNICIPALITY AND CITY is selected-->
								
								
								
										<div class="form-row tm-search-form-row"> 
									
											<div class="form-group tm-form-group tm-form-group-pad tm-form-group-1">
												<label for="inputCity">Address 1</label>
												<input name="add1" type="text" class="form-control" placeholder="Block #, lot #, street name" <?php if($locationsw == 1) {echo "value={$add1}"; } ?> > 
											</div>
									
											<div class="form-group tm-form-group tm-form-group-pad tm-form-group-1">
												<label for="inputCity">Address 2</label>
												<input name="add2" type="text" class="form-control" placeholder="Subdivision, Barangay" <?php if($locationsw == 1) {echo "value={$add2}"; } ?>> 
											</div>
										</div>
								
										<div class="form-row tm-search-form-row"> 
								
											<div class="form-group tm-form-group tm-form-group-pad tm-form-group-1">
												<label for="inputCity">Municipality</label>
												<p><strong><?php echo $munideliver;  ?></strong></p> 
											</div>
									
											<div class="form-group tm-form-group tm-form-group-pad tm-form-group-1">
												<label for="inputCity">City</label>
												<p><strong><?php echo $citydeliver;  ?></strong></p> 
											</div>
									
										</div> 
								
										<br>
										<h6><center>Delivery fee: <strong>Php <?php echo $zone_fee; ?>.00</strong></center></h6>
								
										<!--once submit is pressed, creste a T&C section -->
								
										<button type="submit" name="submitaddress" class="btn btn-warning tm-btn tm-btn-search text-uppercase" id="btnSubmit">Submit</button>
								
								
									<?php } else {?> <!--IF MUNICIPALITY AND CITY IS NOT YET selected-->
							
										<hr>
										<div class="form-row tm-search-form-row"> 
									
											<div class="form-group tm-form-group tm-form-group-pad tm-form-group-1">
												<label for="inputCity">Address 1</label>
												<input name="add1" type="text" class="form-control" placeholder="Block #, lot #, street name" <?php if($locationsw == 1) {echo "value={$add1}"; } ?> > 
											</div>
									
											<div class="form-group tm-form-group tm-form-group-pad tm-form-group-1">
												<label for="inputCity">Address 2</label>
												<input name="add2" type="text" class="form-control" placeholder="Subdivision, Barangay" <?php if($locationsw == 1) {echo "value={$add2}"; } ?>> 
											</div>
										</div>
								
										<div class="form-row tm-search-form-row"> 
											<?php if($citydeliversw == 0) { ?>
									
									
										
											<div class="form-group tm-form-group tm-form-group-pad tm-form-group-1">
												<label for="inputCity">City</label>
												<select name="citydeliver" class="form-control tm-select" id="inputAdult">
												<option value=" " selected>Select one</option>
												
												<!-- upload city info from zone_city database here for selection-->
												
												<?php 
												 $query = "SELECT * FROM zone_city";
												$select_city = mysqli_query($connection, $query);

												// ***ACTUAL ADDING OF DATA TO TABLE
												while($row = mysqli_fetch_assoc($select_city)) {

													$cityselect = $row['zone_ct'];
												
													echo "<option value={$cityselect}>{$cityselect}</option>";
												
												}
												?>
												
												</select>   
											</div>
									
											<div class="form-group tm-form-group tm-form-group-pad tm-form-group-1">
												<label for="btnSubmit">&nbsp;</label>
												<button type="submit" name="cityselect" class="btn btn-warning tm-btn tm-btn-search text-uppercase" id="btnSubmit">Select</button>
											</div>
									
											<?php } else { ?>
									
											<div class="form-group tm-form-group tm-form-group-pad tm-form-group-1">
												<label for="inputCity">City</label>
												<p><strong><?php echo $citydeliver;  ?></strong></p> 
											</div>
										
											<?php } ?>
									
										</div>	
									
									
								
									
										<div class="form-row tm-search-form-row"> 
										<?php
										if($munideliversw == 0 AND $citydeliversw == 1 ) {
											//if($citydeliversw == 1 ) {   //if city was already chosen?>	
									
									
								
											<div class="form-group tm-form-group tm-form-group-pad tm-form-group-1">
												<label for="inputCity">Municipality</label>
												<select name="munideliver" class="form-control tm-select" id="inputAdult">
												<option value=" " selected>Select one</option>
										
												<!-- upload municipality info from zone_city database here for selection BASED ON CITY SELECTED-->
										
												<?php
										
													$query = "SELECT * FROM zone_municipality";
													$select_municipality = mysqli_query($connection, $query);

											
													while($row = mysqli_fetch_assoc($select_municipality)) {
														$zone_ct_id = $row['zone_ct_id'];
														if($zone_id == $zone_ct_id) { 
													
															$zonemunicipal = $row['zone_municipal'];
															//$cust_deli_fee = $row['zone_fee'];
												
															echo "<option value={$zonemunicipal}>{$zonemunicipal}</option>";
														}
													}
										
										
												?>
										
													</select>   
											</div>
									
											<div class="form-group tm-form-group tm-form-group-pad tm-form-group-1">
												<label for="btnSubmit">&nbsp;</label>
												<button type="submit" name="muniselect" class="btn btn-warning tm-btn tm-btn-search text-uppercase" id="btnSubmit">Select</button>
											</div>
								
									<?php //} ?>
										<?php } else  if($munideliversw == 1) {   //if municipality was already chosen ?>	
								
											<div class="form-group tm-form-group tm-form-group-pad tm-form-group-1">
												<label for="inputCity">Municipality</label>
												<p><strong><?php echo $munideliver;  ?></strong></p> 
											</div>
									
									
										<?php } ?>
								
								
										</div>
								
 <!--  /.IF MUNI AND CITY IS-->	<?php } ?> <!--  /.IF MUNICIPALITY AND CITY IS selected-->
							
								
								
								
<!--  /.t_and_csw = 0 -->	<?php } ?> 			
								
							
<!--/.nominate address-><?php }  ?> 
							<!-- /.$wheredelsw = "NOMINATE" -->
							
<!--address on file-->	<?php 
						if($wheredel == "Address") {    //<!-- if address on file is selected -->
							
							if($t_and_csw == 0) { ?>
									<!--once submit is pressed, creste a T&C section -->
									<button type="submit" name="submitaddress" class="btn btn-warning tm-btn tm-btn-search text-uppercase" id="btnSubmit">Submit</button>
							
							<?php } 
							
						} ?> <!-- /.if address on file is selected ********************** 02/29 -->
<!--address on file-->							
							
<!---------------- /.  if without driver --------------------------------->	


<!--/.if cu wants delivered--><?php } ?>


<!---------------------------- Create an else for cu wants to pick up ------------------------------->
						<?php
						if($deliverpickupsw == 2) {  ?>
						
							<div class="form-row tm-search-form-row">
								<div class="form-group tm-form-group tm-form-group-pad tm-form-group-12">                                       
									<label for="wdrive">Deliver or Pick-Up?</label>     
									<p> <?php echo "You have chosen to pick up the vehicle from 8DriveCars office"; ?> </p>
								</div>
							</div>
							
							<button type="submit" name="submitaddress" class="btn btn-warning tm-btn tm-btn-search text-uppercase" id="btnSubmit">Submit</button>
							
						<?php
						} ?>

<!--------------------------/. Create an else for cu wants to pick up ------------------------------->

							
<!--if t&c is not yet click	-->	<?php } ?>





							
							<?php
							 
							//if with driver
/* if with driver	*/		} else {
							
								echo "<div class='form-row tm-search-form-row'> ";
								echo "	<h6><strong>Since you wanted a vehicle with a driver, you will be contacted thru phone after submitted documents are approved. Press the button to continue to the next step.</strong><br>";
								echo "	</h6>";
								echo "</div>	";
								echo "<br>"; 
							
								if($t_and_csw == 0) { ?>
							
									<button type="submit" name="submitaddress" class="btn btn-warning tm-btn tm-btn-search text-uppercase" id="btnSubmit">Submit</button>
							
								<?php } ?>
								

<!---------------- /.  up to here (customer is logged in) --------------------------------->	
							
							<?php }  ?>
 <!------------ /. with / without driver ----------------->
 
 
 
							
							<?php //} ?>  <!-- /. if($t_and_csw == 0) -->
							
							<?php if($t_and_csw == 1) { ?>
							
								
							
													<!--	 //***********THIS IS WHERE WE CREATE IF FOR T&C-->
							<hr>
							<h6><strong><center>8Drive Rental Terms and Conditions <br><br></center></strong></h6>
							<div  style="height:300px; overflow-x:scroll;"> <!--T&C is in a scrollable window-->
							
							<p>
     <strong>MILEAGE Allotment</strong> for SELF-DRIVE only: <strong>(A) Unlimited mileage</strong> - 3 days or more rental <strong>(B) 150km</strong> – Less than 24hrs rental <strong>(C) 300km/day</strong> – 24-48hrs rental <br><br>
	 Any excess will be charged Php 15 per 1km. Vehicle can be driven to anywhere in Luzon <strong>excluding MIMAROPA region.</strong> An additional of Php 4,500 per day will be charged should the vehicle be driven outside of this region. <br><br>
	 <strong>FUEL</strong> Each vehicle is supplied with a full tank of  fuel or at amount specified in the <strong>Vehicle Condition Form.</strong> It should be refilled at the renter’s expense upon return unless specified by 8Drive.<br><br>
	 <strong>CLEANING FEE</strong> 8Drive will provide you with a well maintained car. It has been cleaned inside-out for your comfort. Please keep it clean and well maintained. A minimum of Php500 cleaning fee will be charged if the car is returned dirty. <br><br>
	 <strong>IN CASE OF DAMAGE TO VEHICLE: For Self-drive, it is expected that the RENTER is fully responsible for the care of the rented vehicle.</strong> Renter must immediately report any damage or incident to 8Drive and secure all the following documents. <strong>Renter will shoulder all expenses in case these documents are not secured.</strong> <br><br>
	 1. Police report <br> 2. Photocopy of driver's license of all involved parties,  <br> 3. Video recording or photo evidences   <br><br>
	 <strong>Damages shall be deducted from the R.I + 10% of the total parts replacement and 50% of the regular daily rate while vehicle is not available for repair, exclusive of insurance liability. In case of loss or total damage to the said vehicle, the Renter shall shoulder 10% of the current market value and 50% of the daily rate for the number of days vehicle is not available, exclusive of the insurance liability within 7 days from date of accident / loss. 8Drive reserves the right to choose its accredited repair shop.  <br><br>
	 INSURANCE EXCLUSIONS:</strong> The renter will be liable, however, for the full cost of damage if: (a) the car is driven in violation of the Rental Agreement; (b) for failure to submit a police report & a photocopy of the driver’s license & passport; (c) under-chassis & overhead damages; (d) if vehicles are driven on unsealed or unable roads or surfaces; (e) caused or traceable to natural calamities like typhoons, floods, earthquakes or volcanic eruptions, etc.  <br><br>
	 <strong>PARKING & TOLL FEES / TRAFFIC & TOW FINES / FLAT TIRES WHILE ON RENTAL:</strong> Will be shouldered by the renter for self-drive agreement.  <br><br>
	 <strong>LOST / DAMAGED KEYS:</strong> Renter's failure to return car keys in good condition is charged with a fee of Php 12,500.00.
	 <strong>SMOKING:</strong> Although we respect each and every one's right, we would want to promote a healthy environment for all of our clients. The vehicle you have rented will be used by others who will appreciate that we keep it free of any harmful cigarette contaminants. <strong>Please do not smoke in the vehicle.</strong> Any evidence of smoking in the car will be charged Php 11,500.00.<br><br>
     <strong>TERMS OF PAYMENT</strong> 8Drive accepts CASH and both international and local Visa & Mastercard CREDIT CARDS. Other IDs might be required to show proof of identity. Rental fee is paid upon the start of the rental period.  For each rental, 50% of total rent is collected to secure the reserved rental dates. This amount is deducted from the total amount of the rental fee. In case of a lease period of less than 6 months, the total rental fee shall be paid at the start of lease. For lease of more than 6 months, we require 2 months advance and 1 month deposit. Late payment is subject to 15% penalty of total dues.<br><br>
	 <strong>RATES</strong> 8Drive reserves the right to amend the rates without prior notice.  <br><br>
	<strong>RENTAL EXTENSION:</strong> An extension can be requested 12 hours prior to return time. Extension is Php 250/hr at a maximum of 6 hours. Longer than 6 hours extension will be considered as 1 day rent. Failure to request for an extension will be deemed as EXCESS HOURS. The cost of <strong>extension will be billed to the RENTER and will have to be settled within 48hrs.</strong> Otherwise, 8Drive will pull out the vehicle and charge the RENTER for the excess rent period.<br><br>  
	 <strong>EXCESS HOURS:</strong> Use of the vehicle beyond the agreed return time specified herein shall be subjected to the EXCESS HOUR rate of Php 350/hr. A fraction of an hour is considered as a full hour. <strong>Any delay in the return of the vehicle without any advise whatsoever will be immediately reported as carnapped to Task force Limbas / Anti-Carnapping Group.</strong> <br><br>
	 <strong>CANCELLATION:</strong> Unused days are non-refundable should <strong>RENTER</strong> terminate the rental before the agreed rental end time and should renter violate any of the terms and conditions stated. The reservation fee is nonrefundable but can be used to re-book another rent within a period of 30 days. <br><br> 
	<strong>MAINTENANCE:</strong> For long term rentals, <strong>RENTER agrees and will coordinate</strong> the best time for them to let 8Drive pull out the rented vehicle and bring it in <strong>for preventive maintenance.</strong><br><br>
  <strong>DRIVER'S LICENSE</strong> Renter must possess a valid driver’s license which must have been held for at least two (2) years. A foreign driver’s license is valid for a maximum of 90 days from the date of arrival in the Philippines. An international driving permit (IDP) will be required of a renter holding a non - English license. <br><br>
  <strong>IDENTIFICATION REQUIREMENT</strong> LOCAL RENTER - Valid driver's license and two (2) Identification Card with picture and proof of billing named under the renter. FOREIGN RENTER – Valid Passport, valid driver's license / International Driving Permit (IDP), Passport & any Identification Card with picture and a proof of stay in the country.<br><br>
  <strong>INDEMNITY</strong> Regardless of insurance coverage, Renter shall fully indemnify the Owner for any loss, damage, and legal actions, including reasonable attorney’s fees that Owner suffers due to Renter’s use of Vehicle during the term of this Agreement, including but not limited to, damage to the Vehicle, damage to the property of others, injury to Renter, and injury to others. This provision survives the termination of this Agreement. <br><br>
  <strong>OWNER WARRANTY</strong> The Owner represents that to the best of his knowledge and belief that the Vehicle is in sound and safe condition and free of any known faults or defects that would affect its safe operation under normal use.<br><br>
  <strong>RENTER WARRANTIES</strong> The Renter agrees that Renter will not (a) use the Vehicle to carry any passengers other than Renter; (b) allow any other person to operate the Vehicle; (c) operate the Vehicle in violation of any laws or for an illegal purpose and that if Renter does, Renter is responsible for all associated, tickets, fines, and fees; (d) use the Vehicle to push or tow another vehicle; (e) use the Vehicle for any race or competition; (f) operate the vehicle in a negligent manner. <br><br>
  <strong>ARBITRATION</strong> In the event that the Parties cannot amicably resolve a dispute or damage claim resulting from this Agreement, the Parties agree to resolve any such dispute or damage claim by arbitration. The arbitration proceeding shall be conducted in Makati City in accordance with the r ules of the Philippine Institute of Arbitrators then in effect with one (1) arbitrator to be selected by mutual agreement of the Parties. If the Parties cannot agree on an arbitrator, then the Philippine Institute of Arbitrators shall select an arbitrator from the National Panel of Arbitrators. The laws of the Republic of the Philippines shall apply to the arbitration proceedings. The Parties agree that the arbitrator cannot award punitive damages to either Party and agree to be bound by the arbitrator’s findings. Judgment upon the award rendered by the arbitrator may be entered in any court having jurisdiction. <br><br>
  <strong>DISPUTES AND GOVERNING LAW</strong> The laws of the Republic of the Philippines without regard to any conflict of law principles govern this Agreement. No action, arising out of the transactions under this Agreement may be brought by either Party more than one year after the cause of action has accrued.<br><br>
  <strong>GENERAL</strong> This Agreement, including all Exhibit(s), constitutes the entire agreement between the Parties in connection with the subject matter hereof and supersedes all agreements, proposals, representations and other understandings, oral or written, of the Parties and any current or subsequent purchase order(s) provided by Affiliate. No alteration or modification of this Agreement or any Exhibits shall be valid unless made in writing and signed by an authorized Affiliate of each Party. The waiver by either Party of a breach of any provision of the Agreement shall not operate or be construed as a waiver of any subsequent breach and any waiver must be in writing and signed by an authorized Affiliate of the Parties hereto. If any provision of this Agreement is held to be invalid or unenforceable, the remaining provisions shall continue in full force and effect. Any notice or other communication required or permitted hereunder shall be given in writing to the other Party at the address stated above, or at such other address as shall be given by either Party to the other in writing. Any terms of this Agreement which by their nature extend beyond its termination remain in effect until fulfilled, and apply to respective successors and rightful assignees.
	 
	 </p><br>
								<button type="submit" name="submitagree" class="btn btn-warning tm-btn tm-btn-search text-uppercase" id="btnSubmit">I Agree</button>
								<br><br>
							</div>
							
							<?php } ?>
							
								
								<br><br>
                            </form> 
						</div> <!-- form-row -->							
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>							
							<?php 
								if ($cdrive == "Yes") {
									echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
								}
								
								
								?>  
								
                    </div> <!-- row -->
						
                        <div class="tm-banner-overlay"></div>
						
						
						<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                        
                </div>  <!-- .container -->                   
                               
            </section>
		
		</div>     <!-- .tm-container-outer -->  
			

<?php include "pickavailablefooter.php"; ?>
