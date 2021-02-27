<?php include "../../8driveAdmin/db.php"; ?>



<?php


$start_day=""; 
$start_month="";
$start_year="";
$checkto = "";
$checkfrom = "";
$errmes = "";
$placeholdfrom = "Choose start date";
$placeholdto = "Choose end date";
$displaysw = 0;

if(isset($_POST['checkrecords'])) {
	
	$start_day=""; 
	$start_month="";
	$start_year="";
	$checkto = "";
	$checkfrom = "";
	$errmes = "";
	$placeholdfrom = "Choose start date";
	$placeholdto = "Choose end date";
	$displaysw = 0;
	
	
	$checkfrom = $_POST['checkfrom'];
	$checkto = $_POST['checkto'];
	
	//format date
	$stamp_indate = strtotime($checkfrom);
	$start_day = date('d', $stamp_indate);
	//$start_month = date('F', $stamp_indate);
	$start_month = date('M', $stamp_indate);
	$start_year = date('Y', $stamp_indate);
									
	$stamp_retdate = strtotime($checkto);
	$end_day = date('d', $stamp_retdate);
	//$end_month = date('F', $stamp_retdate);
	$end_month = date('M', $stamp_retdate);
	$end_year = date('Y', $stamp_retdate);	
	
	//$errmes = "**No records for date range {$start_day} {$start_month} to {$end_day} {$end_month}**";
	$placeholdfrom = "{$start_month} {$start_day}  {$start_year}";
	$placeholdto = "{$end_month} {$end_day} {$end_year}";
	
	
	$cashQuery = "SELECT * FROM car_cash_inventory WHERE car_rent_status = 'Completed / Returned'";
	$cashQuery = mysqli_query($connection, $cashQuery);
	
	$paymadetotal = 0;
	while($row = mysqli_fetch_assoc($cashQuery)) {
		$date_completed = $row['date_completed'];
		$date_completed1 = strtotime($date_completed);
		
					
		if($date_completed1 >= $stamp_indate AND $date_completed1 <= $stamp_retdate) {
			$pay_made = $row['actual_payment_made'];
			$paymadetotal = $paymadetotal + $pay_made;
		}	
	}
	
	if($paymadetotal == 0) {
		$errmes = "**No records for date range {$start_day} {$start_month} to {$end_day} {$end_month}**";
		$displaysw = 0;
	} else {
		$displaysw = 1;
	}

	$paymadetotalform = number_format($paymadetotal, 2);
	
	
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Cash Flow</title>
<!-- 
Journey Template 
http://www.templatemo.com/tm-511-journey
-->
    <!-- load stylesheets -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">  <!-- Google web font "Open Sans" -->
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">                <!-- Font Awesome -->
    <link rel="stylesheet" href="css/bootstrap.min.css">                                      <!-- Bootstrap style -->
    <link rel="stylesheet" type="text/css" href="css/datepicker.css"/>
	
	<link href="css/style.css" rel="stylesheet">
	  <link href="css/style-responsive.css" rel="stylesheet" />

	
    <link rel="stylesheet" href="css/templatemo-style.css">                                   <!-- Templatemo style -->
      </head>

      <body>
	<div class="container-fluid">
		<header class="header dark-bg">
				<div class="toggle-nav">
					<div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i class="icon_menu"></i></div>
				</div>

				<!--logo start-->
				<a href="header.php" class="logo">8Drive Cars <span class="lite">Admin Page</span></a>
				<!--logo end-->

				<!--
				<div class="top-nav notification-row">
					<ul class="nav pull-right">
						<li><a href="../../8driveAdmin/index.php" role="button" class="btn btn-warning btn-xs text-uppercase" style="margin-top: 3px; margin-right: 25px;">Back to Main</a></li>
					</ul>
				</div>
				-->
				
		 </header>
	</div>
	
	<br><br>


		<div class="tm-page-wrap mx-auto">
            <section class="tm-banner">
                <div class="tm-container-outer tm-banner-bg">
					<!--
                    <div style="background: url(img/about-bg.jpg) center top no-repeat; background-attachment: fixed;" class="container">
					-->
					<div class="container">
						
                        <div class="row tm-banner-row" id="tm-section-search">
							
							<form action="cashflow.php" method="post" class="tm-search-form tm-section-pad-2">
                            <h4 class="text-center"><strong>Cashflow Review Page</strong></h4><hr>
								<div class="form-row tm-search-form-row">

                                    <div class="form-group tm-form-group tm-form-group-pad tm-form-group-3">
                                        <label for="inputCheckIn">From</label>
                                        <input name="checkfrom" type="text" class="form-control" id="inputCheckIn" placeholder="<?php echo $placeholdfrom; ?>" >
                                    </div>
                                    <div class="form-group tm-form-group tm-form-group-pad tm-form-group-3">
                                        <label for="inputCheckOut">To</label>
                                        <input name="checkto" type="text" class="form-control" id="inputCheckOut" placeholder="<?php echo $placeholdto; ?>">
                                    </div>
									
									
									
                                    <div class="form-group tm-form-group tm-form-group-pad tm-form-group-3">
                                        <label for="btnSubmit">&nbsp;</label>
                                        <button type="submit" name="checkrecords" class="btn btn-warning tm-btn tm-btn-search text-uppercase" id="btnSubmit">Review</button>
                                    </div>
									
									
									<div class="form-group tm-form-group tm-form-group-pad tm-form-group-3">
                                        <label for="btnSubmit">&nbsp;</label>
                                        <a href="../../8driveAdmin/index.php" role="button" class="btn btn-warning tm-btn tm-btn-search text-uppercase" id="btnSubmit">Back to Main</a>
                                    </div>
									
									<div class="container text-center">
										<h6><strong><?php echo $errmes; ?></strong></h6>
									</div>
									
									
                                </div> 
								
		<?php 
			if($displaysw == 1) {
		?>
		
							
							<div class="container">
								<div class="row">
								
									<!--
									<div  class="col-md-4">
										<table class="table table-bordered table-hover table-striped table-condensed">
											
											<tbody>
												
												<tr>
													<td><h6><strong><center><?php //echo "$placeholdfrom To $placeholdto"; ?></center></strong></h6></td>
												</tr>
											</tbody>
										</table>
									</div>
									-->
							
									<div  class="col-md-6">
										<table class="table table-bordered table-hover">
											
											<tbody>
												
												<tr>
												   <td><h6><strong>Total Amount:</strong></h6></td>
													<td><h6><strong><?php echo "Php {$paymadetotalform}"; ?></strong></h6></td>
												</tr>
											</tbody>
										</table>
									</div>
									
									<div  class="col-md-6">
										<table class="table table-bordered table-hover">
											<tbody>
												<tr>
													<!--<td><center><button class="btn btn-warning btn-sm" type="button">Create PDF?</button></center></td>-->
													<?php
														echo "<td><center><a href='cashflowpdf.php?checkfrom=($checkfrom}&checkto={$checkto}&paymadetotal={$paymadetotal}&stamp_indate={$stamp_indate}&stamp_retdate={$stamp_retdate}' class='btn btn-warning btn-sm'>Create PDF?</a></center></td>";		
													?>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
								
							</div>	
								
	<?php   } ?>						
								
								
								
								
								
							
							

							
								
		<?php 
			if($displaysw == 1) {
		?>					
							
								<table class="table table-bordered table-hover table-striped table-condensed">
								
									<thead>
									   <tr>
										   <th><strong><center>Date</center></strong></th>
										   <th><strong><center>For Customer</center></strong></th>
										   <th><strong><center>Using Car Model</center></strong></th>
										   <th><strong><center>Payment Amount</center></strong></th>
										   <!--<th><strong><center>Review Details</center></strong></th>-->
										   
																					
									   </tr> 
									</thead>
								
		<?php   } ?>

		
		<!-- if there are data to display -->						
		<?php 
			if($displaysw == 1) {
				
				$cashQuery = "SELECT * FROM car_cash_inventory WHERE car_rent_status = 'Completed / Returned'";
				$cashQuery = mysqli_query($connection, $cashQuery);
				
				while($row = mysqli_fetch_assoc($cashQuery)) {
					$date_completed = $row['date_completed'];
					$date_completed1 = strtotime($date_completed);
					$cust_id = $row['cust_id'];
					$car_id = $row['car_id'];
					
					if($date_completed1 >= $stamp_indate AND $date_completed1 <= $stamp_retdate) {

						$cash_day = date('d', $date_completed1);
						$cash_month = date('M', $date_completed1);
						$cash_year = date('Y', $date_completed1);
						$pay_date =  "{$cash_month} {$cash_day}, {$cash_year}";
						$pay_made = $row['actual_payment_made'];
						$pay_made = number_format($pay_made,2);
						
						
						
						
					//get customer's name
					$custquery = "SELECT * FROM customerinfo WHERE cust_id = {$cust_id}";

					$select_id = mysqli_query($connection, $custquery);

					while($row = mysqli_fetch_assoc($select_id)) {

						$cust_fname = $row['cust_fname'];
						$cust_lname = $row['cust_lname'];
						$cust_name = $cust_fname . " " . $cust_lname;
					}
					
					
					//get customer vehicle
					$carquery = "SELECT * FROM cardetail WHERE car_id = '$car_id'";
					$result = mysqli_query($connection, $carquery);
											
					while($row = mysqli_fetch_assoc($result)) {
													
						$cust_car_model = $row['car_model'];
					}
						
						
						
						
						
						
									
		?>								
								
								
								
								
								

									<tbody>
										<tr>
										   <td><center><strong><?php echo "{$pay_date}"; ?></strong></center></td>
										   <td><center><strong><?php echo "{$cust_name}"; ?></strong></center></td>
										   <td><center><strong><?php echo "{$cust_car_model}"; ?></strong></center></td>
										   <td><center><strong><?php echo "Php {$pay_made}"; ?></strong></center></td>
										   <!--<td><center><strong>Review</strong></center></td>-->
										</tr>
										
										
										
									</tbody>
							
								
	<!-- /.if there are data to display -->							
	<?php       	
					} 
				}
			}
	?>
							
								</table>
							</form>  
						</div> <!-- row -->
                        <div class="tm-banner-overlay"></div>
						<br><br><br><br><br>
                    </div>  <!-- .container -->    
				</div>     <!-- .tm-container-outer -->                 
            </section>
		</div>
            

            

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