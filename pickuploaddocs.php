<?php include "../../8driveAdmin/db.php"; ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Make A Reservation</title>
<!-- 
Journey Template 
http://www.templatemo.com/tm-511-journey
-->
    <!-- load stylesheets -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">  <!-- Google web font "Open Sans" -->
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">                <!-- Font Awesome -->
    <link rel="stylesheet" href="css/bootstrap.min.css">                                      <!-- Bootstrap style -->
    <link rel="stylesheet" type="text/css" href="css/datepicker.css"/>
    <link rel="stylesheet" href="css/templatemo-style.css">                                   <!-- Templatemo style -->
      </head>

      <body>
<?php 
	$upsw = 0;
?>



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
	$cust_id = $_GET['custid'];
	$cdrive = $_GET['wdrive'];
	$passwordsw = $_GET['ispassword'];
	//$airportpick = $_GET['airpick'];
	//$airdetail = $_GET['airdetail'];
	
	//ispassword={$passwordsw}&   $passwordsw = $_GET['ispassword'];
	
?>

<?php 
//*********************
		
		if(isset($_POST['create_docs'])) {
			$residency = $_POST['residency']; // --> 02/06
			header("location: pickuploaddocs2.php?ispassword={$passwordsw}&residence={$residency}&carid={$car_id}&carmodel={$carmodel}&cardesc={$cardesc}&cartrans={$cartrans}&carcap={$carcapacity}&wdrive={$cdrive}&begdate={$indate}&retdate={$retdate}&upload=0&totalrate={$cardayratepeak}&fname={$custfname}&lname={$custlname}&custid={$cust_id}&wdrive={$cdrive}&logsw={$loginsw}"); 
		}
//*********************
?>
	  
	  <div class="tm-page-wrap mx-auto">
            <section class="tm-banner">
                <div class="tm-container-outer tm-banner-bg">
                    <div style="background: url(img/about-bg.jpg) center top no-repeat; background-attachment: fixed;" class="container">
						<div class="row tm-banner-row" id="tm-section-search">
							<!--<form action="pickavailable.php" method="get" class="tm-search-form tm-section-pad-2">-->
							
								<?php
									echo "<form action='pickuploaddocs.php?ispassword={$passwordsw}&carid={$car_id}&carmodel={$carmodel}&cardesc={$cardesc}&cartrans={$cartrans}&carcap={$carcapacity}&wdrive={$cdrive}&begdate={$indate}&retdate={$retdate}&upload=0&totalrate={$cardayratepeak}&fname={$custfname}&lname={$custlname}&custid={$cust_id}&wdrive={$cdrive}&logsw={$loginsw}' method='post' enctype='multipart/form-data' class='tm-search-form tm-section-pad-2'>";
								?>
								
								<h6 class="text-center"><strong>ALMOST THERE... Please upload photos of required documents for approval.</strong></h6>
								<hr>
								<!--
								<p><strong>NOTE:</strong><br>
								<strong>For Philippine residents:</strong> 2 government issued id's with photo and residential address, billing statement under your name or under your parents', siblings' or relatives' name.<br><br>
								<strong>For non-Philippine residents: </strong>Copy of itinerary, passport and driver's license. 
										</p> <hr>--> 
								
								
								<div class="form-row tm-search-form-row"> 							
									<div class="form-group tm-form-group tm-form-group-3">                                    
										<label for="inputAdult">Residency Status</label>     
										<select name="residency" class="form-control tm-select" id="inputAdult">
											<option value="Philippine Resident" selected>Philippine Resident</option>
											<option value="Non-Philippine Resident">Non-Philippine Resident</option>
										</select>  
									</div>
								</div>	
										<!------------->
								
								<!---EDIT or CONFIRM buttons-->
								<?php
								if ($upsw == 0) {  //I retained the if for personal preference, this is not needed in reality
									
									echo	"<button type='submit' name='create_docs' role='button' class='btn btn-warning tm-btn tm-btn-search text-uppercase'>Submit</button>";
								
								}
								?>
							</form>  		
                                
                           </div> <!-- row -->
                        <div class="tm-banner-overlay"></div>
						<br><br><br><br><br><br><br><br> <br><br><br><br><br><br><br><br>    <br><br><br><br><br>
                        
                    </div>  <!-- .container -->                   
                </div>     <!-- .tm-container-outer -->                 
            </section>     <!-- .tm-container-outer  --> 

<?php include "pickavailablefooter.php"; ?>
