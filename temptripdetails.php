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

$nextsw = 0; //to check if info has been typed and submit button pressed

if(isset($_POST['tripdetail'])) {
		//$airportpick = $_POST['airportpick'];
		//$airdetail = $_POST['airdetail'];
		$nextsw = 1;
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
							echo "<form action='picktripdetails.php?edit={$the_car_id}&carid={$carid}&carmodel={$carmodel}&cardesc={$cardesc}&cartrans={$cartrans}&carcap={$carcapacity}&wdrive={$cdrive}&begdate={$indate}&retdate={$retdate}&totalrate={$cardayratepeak}&wdrive={$cdrive}&logsw={$loginsw}&custid={$cust_id}' method='post' class='tm-search-form tm-section-pad-2'>";
							echo "<h4 class='text-center'><strong>{$carmodel} {$carcapacity}-seater {$cartrans}  Transmission</strong></h4><br>	";						
						?>
						
							<?php
							//IF WITHOUT DRIVER
							if($cdrive == "No") {
						
							
								$cardayrateformat = number_format($cardayratepeak, 2);
								echo "<h6>You have scheduled using the vehicle for <strong>{$diff_date}</strong> day/s <strong>{$withdrive}</strong>. <br></h6>";
								
								echo "<h6>Start Date : <strong>{$start_day} {$start_month} {$start_year}</strong></h6>";
								echo "<h6>Return Date: <strong>{$end_day} {$end_month} {$end_year}</strong></h6>";
								echo "<h6>Start Time: <strong>9 AM</strong></h6>";
								echo "<h6>Vehicle Total Amount: <strong>Php {$cardayrateformat}</strong></h6>";
								
								echo "<hr>";
							echo "<div class='form-row tm-search-form-row'> ";
							echo "	<h6><strong>Now that we have your preferred vehicle and schedule, tell us more about your trip...</strong><br>";
							echo "	</h6>";
							echo "</div>";
							
							
							echo "*If first time renter: Where to deliver, address on file or nominate? <br>";
							echo "*IF clause: if regular customer: For Pick-up, deliver to address or nominate delivery address?  <br>";
							echo "*Create T&C window with I Agree button  <br><br>";
							
								
							
							/*
							echo "<div class='form-row tm-search-form-row'>" ;							
							echo "	<div class='form-group tm-form-group tm-form-group-3'>  "     ;                             
                            echo "        <label for='inputAdult'>Airport Pick-up?</label> ";    
                            echo "        <select name='airportpick' class='form-control tm-select' id='inputAdult'>";
                            echo "           <option value='Yes' selected>Yes</option>";
                            echo "           <option value='No'>No</option>";
                            echo "       </select> "; 
							echo "	</div>";
							echo "</div>";	
							
							echo "<div class='form-row tm-search-form-row'> ";	
								
							echo "	<div class='form-group tm-form-group tm-form-group-1'>";
							echo "		<label for='inputAdult'>(If Yes) Please provide flight details</label>";
							echo "		<input type='text' id='contact_subject' name='airdetail' class='form-control' placeholder='expected arrival date and time, which airport terminal, etc...' >";
							echo "  </div>";
							echo "</div>";
							
							if($loginsw == 1) {
							echo "<div class='form-row tm-search-form-row'>" ;							
							echo "	<div class='form-group tm-form-group tm-form-group-3'>  "     ;                             
                            echo "        <label for='inputAdult'>Deliver or Pick up car?</label> ";    
                            echo "        <select name='delipick' class='form-control tm-select' id='inputAdult'>";
                            echo "           <option value='Yes' selected>Deliver</option>";
                            echo "           <option value='No'>Pick Up</option>";
                            echo "       </select> "; 
							echo "	</div>";
							echo "</div>";	
							
							}
							*/
							
							/*
							
							echo "<div class='form-row tm-search-form-row'> 	";
								
							echo "	<div class 'form-group tm-form-group tm-form-group-1'>";
							echo "		<label for='inputAdult'>(if deliver) Please provide deliver address</label>";
							echo "		<input type='text' name'airdetail' class='form-control' placeholder='address...'>";
							echo "	</div>";
							*/
							
								/*<!--TEXT AREA for typing and viewing large body of messages
								<div class="form-group tm-form-group tm-form-group-3">
									<textarea id="contact_message" name="contact_message" class="form-control" rows="9" placeholder="Message" required></textarea>
								</div>
								-->*/
							//echo "</div>";
							
							//if with driver
							} else {
							
							echo "<div class='form-row tm-search-form-row'> ";
							echo "	<h6><strong>Since you wanted a vehicle with a driver, you will be contacted thru phone after submitted documents are approved. Press the button to continue to the next step.</strong><br>";
							echo "	</h6>";
							echo "</div>	";
							echo "<br><br>";
							}
							?>
							
							
							<?php
							if($nextsw == 1) {
								//if?
								if($loginsw == 1) {
									echo "<a href='pickqoute.php?carid={$carid}&carmodel={$carmodel}&cardesc={$cardesc}&cartrans={$cartrans}&carcap={$carcapacity}&wdrive={$cdrive}&begdate={$indate}&retdate={$retdate}&totalrate={$cardayratepeak}&wdrive={$cdrive}&logsw={$loginsw}&custid={$cust_id}' role='button' class='btn btn-warning tm-btn tm-btn-search text-uppercase'>next step</a>";
								} else {
									echo "<a href='pickcustinfo.php?carid={$carid}&carmodel={$carmodel}&cardesc={$cardesc}&cartrans={$cartrans}&carcap={$carcapacity}&wdrive={$cdrive}&begdate={$indate}&retdate={$retdate}&totalrate={$cardayratepeak}&wdrive={$cdrive}logsw=0&custid={$cust_id}' role='button' class='btn btn-warning tm-btn tm-btn-search text-uppercase'>next step</a>";
								}
							
							
							} else {
								echo "<button type='submit' name='tripdetail' class='btn btn-warning tm-btn tm-btn-search text-uppercase'>confirm?</button>";
							}
							?>		
								   <!--</div>-->
								 
                                </div> <!-- form-row -->
								
								<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                            </form>   
							<?php 
								if ($cdrive == "Yes") {
									echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
								}
								
								
								?>  
								
                        </div> <!-- row -->
						
                        <div class="tm-banner-overlay"></div>
						
						
						<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                        
                    </div>  <!-- .container -->                   
                </div>     <!-- .tm-container-outer -->                 
            </section>
					
			

<?php include "pickavailablefooter.php"; ?>
