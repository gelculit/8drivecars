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

	$car_id = $_GET['carid'];  /*This passes the car id from pickavailable */
	$cardesc = $_GET['cardesc'];
	$cartrans = $_GET['cartrans'];
	$carcapacity = $_GET['carcap'];
	$carmodel = $_GET['carmodel'];
	//$cardiy24 = $_POST['diyhowmuch']; 
	//$cardiy = $_POST['diy'];
	
//isset get

   //$the_car_id = $_GET['diyhowlong']; 

//post info
 //   $query = "SELECT * FROM cardetail WHERE car_id = $the_car_id ";
 //   $select_car_by_id = mysqli_query($connection, $query);


/*

    // ***ACTUAL ADDING OF DATA TO TABLE
    while($row = mysqli_fetch_assoc($select_car_by_id)) {

			$carid = $row['car_id'];
			$cardesc = $row['car_desc'];
			//$carmodel = $row['car_model'];
			//$carimage = $row['car_image'];
			//$carcapacity = $row['car_capacity'];
			$cartrans = $row['car_trans'];
			$cardiy = $row['car_diy'];
			$cardiy24 = $row['car_diy24'];
			$cardiy1wk = $row['car_diy1wk'];
			$cardiy1m = $row['car_diy1m'];

    }



//confirm update


*/

?>

	  
	  <div class="tm-page-wrap mx-auto">
            <section class="tm-banner">
                <div class="tm-container-outer tm-banner-bg">
                    <div style="background: url(img/about-bg.jpg) center top no-repeat; " class="container">
						<div class="row tm-banner-row" id="tm-section-search">
							<!--<form action="pickavailable.php" method="get" class="tm-search-form tm-section-pad-2">-->
							
								<?php
									echo "<form action='pickcustinfo.php?carid={$carid}&carmodel={$carmodel}&cardesc={$cardesc}&cartrans={$cartrans}&carcap={$carcapacity}' method='post' class='tm-search-form tm-section-pad-2'>";
									echo "<h4 class='text-center'><strong>{$carmodel} {$carcapacity}-seater {$cartrans}  Transmission</strong></h4>	";	
								?>
								
								<div class="form-row tm-search-form-row"> 
									<div class="form-group tm-form-group tm-form-group-pad tm-form-group-1">
										<h6><strong>Let's log you in to complete the order. New to 8drive cars? Sign up.<br></strong>
										</h6>
									</div>
									<div class="form-group tm-form-group tm-form-group-pad tm-form-group-1">
										<h4>Sign up info: username, create password, verify password<br>
										</h4>
									</div>
								</div>
								<!--
                                <div class="form-row tm-search-form-row"> 
									
                                    <div class="form-group tm-form-group tm-form-group-pad tm-form-group-1">
                                        <label for="inputCity">Destination:</label>
										<!----make this a select form using destination database---->
										<?php 
											//if($cardiy == "Yes") {
											//	$cardiy = "With Driver";
											//} else {
											//	$cardiy = "Drive It Yourself";
											//}
										
											//echo "<input type='text' class='form-control' value='$cardiy'>";
										
										?>
                                    <!--    
									</div>
									
									<div class="form-group tm-form-group tm-form-group-pad tm-form-group-1">                                       
                                        <label for="inputAdult">With Driver</label>  
										
                                        <?php //echo "<input name='diy' type='text' class='form-control' value='$cardiy'>";   ?>                            
                                    </div>
								</div>
								
								<div class="form-row tm-search-form-row">
										<div class="form-group tm-form-group tm-form-group-1">                                    
											<label for="inputAdult">Duration</label>     
                                            <select name="diyhowlong" class="form-control tm-select" id="inputAdult">
                                                
                                                <option value="<?php //echo $cardiy24; ?>" selected>24 hours</option>
                                                <option value="<?php //echo $cardiy1wk; ?>">1 week</option>
                                                <option value="<?php //echo $cardiy1m; ?>">1 month</option>
                                                
                                            </select> 
                                        
										</div>
										<?php //$cardiy24 = number_format($cardiy24, 2); ?>
										<div class="form-group tm-form-group tm-form-group-pad tm-form-group-2">
                                            <label for="inputRoom">Total Amount:</label>
                                            <?php //echo "<h3>Php {$cardiy24}</h3>"; ?>                                    
                                        </div>

                                </div> 
								
								
								<!---EDIT or CONFIRM buttons-->
								<div class="form-row tm-search-form-row">
										<div class="form-group tm-form-group tm-form-group-1"> 
											<!-- this will be href back to index,php -->
											<a href="" role="button" class="btn btn-warning tm-btn tm-btn-search text-uppercase">Home</a>"
										</div>
										
										<div class="form-group tm-form-group tm-form-group-1"> 
											<button type="submit" class="btn btn-warning tm-btn tm-btn-search text-uppercase">Continue</button>
										</div>
                                    
								
								</div>
								
							</form>  		
                                    
                           </div> <!-- row -->
                        <div class="tm-banner-overlay"></div>
						<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                        
                    </div>  <!-- .container -->                   
                </div>     <!-- .tm-container-outer -->                 
            </section>     <!-- .tm-container-outer  --> 

<?php include "pickavailablefooter.php"; ?>
