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
	
    $the_car_id = $_GET['edit']; 
	$loginsw = $_GET['logsw'];
	$cust_id = $_GET['custid']; //&custid={$cust_id}
	$switch = 0;
	
	//get season pricing Peak Season Pricing
	$query = "SELECT * FROM carseason";
	$select_season = mysqli_query($connection, $query);
		
	while($row = mysqli_fetch_assoc($select_season)) {
		$carseason = $row['car_season'];
	}
	
	//post info
    $query = "SELECT * FROM cardetail WHERE car_id = $the_car_id ";
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
			if ($carseason == "Peak Season Pricing") {
				$cardayratepeak = $row['car_diyperday_peak'];
			} else {
				$cardayratepeak = $row['car_diyperday_lean'];
			}
			$carindate = $row['car_rentfrom'];
			$carretdate = $row['car_return'];
			//$cardiy24 = $row['car_diy24'];
			//$cardiy1wk = $row['car_diy1wk'];
			//$cardiy1m = $row['car_diy1m'];

    }
	$cdrive = "No";

if(isset($_POST['checkavail'])) {
		//$diy = $_POST['diy'];
		$cdrive = $_POST['wdrive'];
		
		$indate = $_POST['check-in'];
		$retdate = $_POST['check-out'];
		$chosenbegdate = $_POST['check-in'];
		$chosenenddate = $_POST['check-out'];
		
		$timestamp = strtotime($indate); 
		$indate = date('Y-m-d', $timestamp);
		
		$timestamp = strtotime($retdate); 
		$retdate = date('Y-m-d', $timestamp);
		
		
		$carindate = strtotime($carindate);
		$carretdate = strtotime($carretdate);
		$indte = strtotime($indate);
		$retdte = strtotime($retdate);
		
		
		
		
		
		date_default_timezone_set('Asia/Manila');	
		
		$date = date('Y-m-d');
		$date = strtotime($date);
		
		$diff_date = ($retdte - $indte)/60/60/24; // calculate how many days
		
		$cardayratepeak = $cardayratepeak * $diff_date; //calculate rent based on no. of days
		
		
		if ($indte >= $date AND $retdte >= $indte) {
			if ($indte == $carindate OR $indte == $carretdate OR $retdte == $carretdate OR $retdte == $carindate) {
				$switch = 2; //unavailable
			} else {
				//echo "available"; PROBLEM: if cx chooses lesser beg date and within retdate
				$switch = 1;
			}
		}	else {
			$switch = 3; //select date range
		}	
		//experiment on this validation--> not correct!!!-->
		if ($indte < $carindate AND $retdte > $carretdate OR $indte > $carindate AND $retdte < $carretdate) {
			$switch = 2;
		}
}
?>

		<div class="tm-page-wrap mx-auto">
            <section class="tm-banner">
                <div class="tm-container-outer tm-banner-bg">
                    <div style="background: url(img/about-bg.jpg) center top no-repeat; background-attachment: fixed;" class="container">
						
						
                        <div class="row tm-banner-row" id="tm-section-search">
							<?php
                            echo "<form action='pickcheckavailability.php?edit={$the_car_id}&logsw={$loginsw}&custid={$cust_id}' method='post' class='tm-search-form tm-section-pad-2'>";
                            ?>
							   <!--echo "<form action='pickavailableqoute.php?carid={$carid}&cardesc={$cardesc}&cartrans={$cartrans}' method='post' class='tm-search-form tm-section-pad-2'>";
								-->
								<?php
									if ($switch == 1) {
										$cardayrateformat = number_format($cardayratepeak, 2);
										echo "<h4 class='text-center'><strong>{$carmodel} {$carcapacity}-seater {$cartrans}  Transmission</strong></h4><br>	";	
										echo "<h4 class='text-center'><strong>Total: {$cardayrateformat}</strong></h4><br>	";
									} else {
										echo "<h4 class='text-center'><strong>{$carmodel} {$carcapacity}-seater {$cartrans}  Transmission</strong></h4><br>	";
									}
								?>
								
								<div class="form-row tm-search-form-row">

                                    <div class="form-group tm-form-group tm-form-group-pad tm-form-group-3">
                                        <label for="inputCheckIn">Begin Date</label>
                                        <input name="check-in" type="text" class="form-control" id="inputCheckIn" placeholder="Choose Start Date" <?php if($switch == 1) {  echo "value={$indate}";} ?> >
                                    </div>
                                    <div class="form-group tm-form-group tm-form-group-pad tm-form-group-3">
                                        <label for="inputCheckOut">End Date</label>
                                        <input name="check-out" type="text" class="form-control" id="inputCheckOut" placeholder="Choose End Date"  <?php if($switch == 1) { echo "value={$retdate}";} ?> >
                                    </div>
									
									<div class="form-group tm-form-group tm-form-group-pad tm-form-group-3">                                       
                                            <label for="wdrive">With Driver</label>     
                                            <select name="wdrive" class="form-control tm-select" id="inputAdult">
                                                <option value="No" selected>No</option>
                                                <option value="Yes">Yes</option>
                                            </select>  
									</div>
									
                                    <div class="form-group tm-form-group tm-form-group-pad tm-form-group-3">
                                        <label for="btnSubmit">&nbsp;</label>
                                        <button type="submit" name="checkavail" class="btn btn-warning tm-btn tm-btn-search text-uppercase" id="btnSubmit">Check Availability</button>
                                    </div>
                                </div> 

								<?php
								
								/*********Next step if car is available indicated by switch************/
								if($switch == 1) {
									
									//$cdrive = $_GET['wdrive'];
									
									echo "<label for='btnSubmit'>&nbsp;</label>";
									echo "<h4 class='text-center'>Vehicle is available on selected date range</h4>";
								
								echo "<div class='form-row tm-search-form-row'>";
									echo "<div class='form-group tm-form-group tm-form-group-pad tm-form-group-1'>";
										echo "<a href='' role='button' class='btn btn-warning tm-btn tm-btn-search text-uppercase'>Home</a>";
									echo "</div>";
									
									
									/**********************************************************************
									If statement to check if customer is new or logged in
									*********************************************/
									
									if($loginsw == 1) {
										echo "<div class='form-group tm-form-group tm-form-group-pad tm-form-group-1'>";
											echo "<a href='picktripdetailslogged.php?edit={$the_car_id}&wdrive={$cdrive}&begdate={$indate}&retdate={$retdate}&totalrate={$cardayratepeak}&logsw={$loginsw}&custid={$cust_id}&carid={$the_car_id}&cardesc={$cardesc}&cartrans={$cartrans}&carcap={$carcapacity}&carmodel={$carmodel}' role='button' class='btn btn-warning tm-btn tm-btn-search text-uppercase'>Confirm?</a>";
										echo "</div>";
								
									} else {
										echo "<div class='form-group tm-form-group tm-form-group-pad tm-form-group-1'>";
											echo "<a href='pickcustinfo.php?edit={$the_car_id}&wdrive={$cdrive}&begdate={$indate}&retdate={$retdate}&totalrate={$cardayratepeak}&logsw={$loginsw}&custid={$cust_id}&carid={$the_car_id}&cardesc={$cardesc}&cartrans={$cartrans}&carcap={$carcapacity}&carmodel={$carmodel}' role='button' class='btn btn-warning tm-btn tm-btn-search text-uppercase'>Confirm?</a>";
										echo "</div>";
									}
								
								
								echo "</div>";
								}
								
								if($switch == 2) {
									echo "<label for='btnSubmit'>&nbsp;</label>";
									echo "<h4 class='text-center'>Vehicle is not available on selected date range</h4>";
								}
								
								if($switch == 3) {
									echo "<label for='btnSubmit'>&nbsp;</label>";
									echo "<h4 class='text-center'>Please make a valid date range selection</h4>";
								}
								
								
								
								
								
								
								
								?>
                            </form>   
							

                        </div> <!-- row -->
                        <div class="tm-banner-overlay"></div>
						<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                        
                    </div>  <!-- .container -->                   
                </div>     <!-- .tm-container-outer -->                 
            </section>


            

            

    <!-- load JS files -->
    <script src="js/jquery-1.11.3.min.js"></script>             <!-- jQuery (https://jquery.com/download/) -->
    <!--script src="js/popper.min.js"></script-->                    <!-- https://popper.js.org/ -->       
    <script src="js/bootstrap.min.js"></script>                 <!-- https://getbootstrap.com/ -->
    <script src="js/datepicker.min.js"></script>                <!-- https://github.com/qodesmith/datepicker -->
    
    <script> 
        /* Google Maps
        ------------------------------------------------*/


        /* DOM is ready
        ------------------------------------------------*/
        $(function(){

            

            // Date Picker in Search form
            var pickerCheckIn = datepicker('#inputCheckIn');
            var pickerCheckOut = datepicker('#inputCheckOut');
         
        });

    </script>             

</body>
</html>