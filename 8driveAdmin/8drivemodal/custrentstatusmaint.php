<?php ob_start(); ?>
<?php include "../db.php"; ?>

<?php
$car_trans_id = $_GET['car_trans_id'];
$cust_id = $_GET['cust_id'];
$carid = $_GET['car_id'];


//get customer's name
$query = "SELECT * FROM customerinfo WHERE cust_id = {$cust_id}";

$select_id = mysqli_query($connection, $query);

while($row = mysqli_fetch_assoc($select_id)) {

	$cust_fname = $row['cust_fname'];
	$cust_lname = $row['cust_lname'];
	$cust_name = $cust_fname . " " . $cust_lname;
}

//get customer vehicle
$query = "SELECT * FROM cardetail WHERE car_id = '$carid'";
$result = mysqli_query($connection, $query);
											
while($row = mysqli_fetch_assoc($result)) {
						
	$carimage = $row['car_image'];
	$carmodel = $row['car_model'];
}




/* update car rental status */
if(isset($_POST['status'])) {
	$cust_rental_status = $_POST['reqstatus'];
	
	$rentQuery = "SELECT car_cash_inventory";
	$rentQuery = "UPDATE car_cash_inventory SET ";
	$rentQuery .= "car_rent_status = '{$cust_rental_status}' ";
	$rentQuery .= "WHERE car_id = {$carid} ";
	
	$update_query = mysqli_query($connection, $rentQuery);
			
	if(!$update_query) {
		die("Query Failed " . mysqli_error($connection));
	}
	
	if($cust_rental_status == "Unreturned (Exceeded)" OR $cust_rental_status == "Unreturned (Extended)" OR $cust_rental_status == "Approved - Payment Made") {
		$cust_rental_status = "On-going";
	}
	if($cust_rental_status == "Completed / Returned") {
		$cust_rental_status = "Available";
		
		//place a completed date indicator
		$rentQuery = "SELECT car_cash_inventory";
		$rentQuery = "UPDATE car_cash_inventory SET ";
		$rentQuery .= "date_completed  = now() ";
		$rentQuery .= "WHERE car_trans_id = {$car_trans_id} ";
		
		$update_query = mysqli_query($connection, $rentQuery);
				
		if(!$update_query) {
			die("Query Failed " . mysqli_error($connection));
		}
		
		
	}
	
	$custQuery = "SELECT cardetail";
	$custQuery = "UPDATE cardetail SET ";
	$custQuery .= "car_rentstatus = '{$cust_rental_status}' ";
	$custQuery .= "WHERE car_id = {$carid} ";
	
	$update_query = mysqli_query($connection, $custQuery);
			
	if(!$update_query) {
		die("Query Failed " . mysqli_error($connection));
	}
}

/* update payment information */
if(isset($_POST['updatepayment'])) {

	$adminnotes = $_POST['adminnotes'];   //admin's notes
	$extdate = $_POST['extdate'];         //proposed return date
	$numberxdate = $_POST['numberxdate']; //proposed number of days
	$payment = $_POST['payment'];         //payment made today
	
	$extamt = 0;
	//get extension amount
	if($numberxdate != 0) {
		$payQuery = "SELECT * FROM carseason";
		$result = mysqli_query($connection, $payQuery);
		
		while($row = mysqli_fetch_assoc($result)) {
			$season = $row['car_season'];
		}
		
		$carQuery = "SELECT * FROM cardetail WHERE car_id = '$carid'";
		$result = mysqli_query($connection, $carQuery);
		
		while($row = mysqli_fetch_assoc($result)) {
			
			if ($season == "Peak Season Pricing") {
				$carday = $row['car_diyperday_peak'];
			} else {
				$carday = $row['car_diyperday_lean'];
			}
			
		}
		
		$extamt = $numberxdate * $carday;

	}
	
	
	//Add payment detail to custpay_per_trans
	$carQuery = "SELECT * FROM custpay_per_trans";
	$carQuery = "INSERT INTO custpay_per_trans (trans_id, pay_date, pay_amt, admin_comment) ";
	$carQuery .= "VALUES ('{$car_trans_id}', now(), '{$payment}', '{$adminnotes}')";
		
	$create_post_query = mysqli_query($connection, $carQuery);
		
	if(!$create_post_query) {
           die("Query Failed " . mysqli_error($connection));
    }
	
	//get total payment made by cu for this transaction
	$query = "SELECT * FROM custpay_per_trans WHERE trans_id = '$car_trans_id'";
	$result = mysqli_query($connection, $query);
			
	$total_payment = 0;
	while($row = mysqli_fetch_assoc($result)) {
			
		$pay_amt = $row['pay_amt'];			
		$total_payment = $total_payment + $pay_amt;
	}
	
	
	//update car_cash_inventory with new payment amount
	$custQuery = "SELECT car_cash_inventory";
	$custQuery = "UPDATE car_cash_inventory SET ";
	$custQuery .= "actual_payment_made = '{$total_payment}', extension_total_fee = '{$extamt}', extend_ret_date = '{$extdate}', extend_days_rented = '{$numberxdate}' ";
	$custQuery .= "WHERE car_trans_id = {$car_trans_id} ";
	
	$update_query = mysqli_query($connection, $custQuery);
			
	if(!$update_query) {
		die("Query Failed " . mysqli_error($connection));
	}
	
	
	
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
	  <title>8DriveCars Picture Canvas</title>
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="css/bootstrap.min.css">
	  <script src="js/jquery.min.js"></script>
	  <script src="js/popper.min.js"></script>
	  <script src="js/bootstrap.min.js"></script>
	   <link href="css/style.css" rel="stylesheet">
	  <link href="css/style-responsive.css" rel="stylesheet" />
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

				<div class="top-nav notification-row">
					<!-- notificatoin dropdown start-->
					<ul class="nav pull-right top-menu">

					</ul>
				<!-- notificatoin dropdown end-->
				</div>
		 </header>
	</div>
	<br><br><br>
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h3> Vehicle Rent Maintenance for <strong><?php echo $cust_name; ?></strong></h3><br>
            </div>
        </div>
		
<!----------------->		
		
				<?php
					
					$query = "SELECT * FROM car_cash_inventory  WHERE car_trans_id = {$car_trans_id}";
					$select_carList = mysqli_query($connection, $query);

					// ***ACTUAL ADDING OF DATA TO TABLE
					while($row = mysqli_fetch_assoc($select_carList)) {

						
						$pick_date = $row['car_rent_start'];
						$ret_date = $row['car_rent_end'];
						$carstatus = $row['car_rent_status'];
						$car_inirent = $row['car_initial_rent_amt'];
						$car_deli_fee = $row['delivery_fee'];
						
						$total_amt = $row['car_total_rent_amt'];
						$total_ext_amt = $row['extension_total_fee'];
						$tot_amt = $total_amt + $total_ext_amt;
						
						$actual_paid = $row['actual_payment_made'];
						
						$tot_x_amt = number_format($total_ext_amt,2);
						$init_tot_amt = number_format($total_amt,2);
						$total_form = number_format($tot_amt,2);
						$actual_pay_form = number_format($actual_paid,2);
						
						$extend_ret_date = $row['extend_ret_date']; //proposed extension return date
						$extend_days_rented = $row['extend_days_rented']; //number of days extended
						
						//format date
						$stamp_date = strtotime($extend_ret_date);
						$ext_day = date('d', $stamp_date);
						//$start_month = date('F', $stamp_indate); full month is spelled
						$ext_month = date('M', $stamp_date);
						$ext_year = date('Y', $stamp_date);
						
						
						
						//format date
						$stamp_indate = strtotime($pick_date);
						$start_day = date('d', $stamp_indate);
						//$start_month = date('F', $stamp_indate);
						$start_month = date('M', $stamp_indate);
						$start_year = date('Y', $stamp_indate);
									
						$stamp_retdate = strtotime($ret_date);
						$end_day = date('d', $stamp_retdate);
						//$end_month = date('F', $stamp_retdate);
						$end_month = date('M', $stamp_retdate);
						$end_year = date('Y', $stamp_retdate);	
						
						/*
						echo "<tr>";
						
						
						
						echo "<td><center><img width='200'  src='../../8driveAdmin/images/$carimage' alt='image'></center></td>";
						echo "<td><center>{$carmodel}</center></td>";
						echo "<td><center>{$start_day} {$start_month} {$start_year}</center></td>";
						echo "<td><center>{$end_day} {$end_month} {$end_year}</center></td>";
						echo "<td><center><button class='btn btn-info' type='button' data-toggle='modal' data-target='#myModal'>{$carstatus}</button></center></td>";
					*/
					}
				?>
		
		
		
<!---------------->		
		
		<div class="row">
			<div class="col-lg-6">
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th><center><?php echo $carmodel;  ?></center></th>
						</tr>
					</thead>
					<thead>
						<tr>
							<th><center><?php
											echo "<img width='200'  src='../../8driveAdmin/images/$carimage' alt='image'>";
										?>
							</center></th>
						</tr>
					</thead>
				</table>
			</div>
			<div class="col-lg-6">
				<table class="table table-bordered table-hover">
					<tbody>
						<tr>
							<td>Initial Rent Date:</td>
							<td><center><?php echo "{$start_day} {$start_month} {$start_year} Up To {$end_day} {$end_month} {$end_year}";  ?></center></td>
						</tr>
					</tbody>
					<tbody>
						<tr>
							<td>Initial Amount Due (including fees):</td>
							<td><center><?php echo $init_tot_amt;  ?></center></td>
						</tr>
					</tbody>
					<tbody>
					
						<!------------>
					
						<tr>
							<td>Extension Amount Due:</td>
							<td><center><?php echo $tot_x_amt;  ?></center></td> 
						</tr>
						
						<!------------>
						
					<tbody>
					<tbody>
						<tr>
							<td>Change Current Rent Status?</td>
							
							<?php echo "<td><center><button class='btn btn-sm btn-info' type='button' data-toggle='modal' data-target='#myModal'>{$carstatus}</button></center></td>"; ?>
						</tr>
					<tbody>
				</table>
			</div>
		</div>
		
		<?php
			echo "<form action='custrentstatusmaint.php?car_trans_id={$car_trans_id}&car_id={$carid}&cust_id={$cust_id}' method='post'>";
		?>
		
		 <table class="table table-bordered table-hover">
			<thead>
				<tr>
					<th><center>Proposed Return Date (if extended)</center></th>
					<th><center>No. of Days Extended</center></th>
					<th><center>Total (incl. extension fee)</center></th>
					<th><center>Total Payment Made</center></th>
					<th><center>Today's Payment</center></th>
					<th><center>Check Bill Proof</center></th>
				    
				   
			   </tr> 
			</thead>
			
			<tbody>
				<tr>
					<td><center><input type="date" name="extdate" class="form-control" style="text-align:right;" value="<?php echo $extend_ret_date; ?>"></center></td>
					<td><center><input type="number" name="numberxdate" class="form-control" style="text-align:right;" value="<?php echo $extend_days_rented;  ?>"></center></td>
					<td><center><p style="text-align:center;"><?php echo $total_form;  ?></p></center></td>
					<td><center><p style="text-align:center;"><?php echo $actual_pay_form;  ?></p></center></td>  
					<td><center><input type="number" name="payment" class="form-control" style="text-align:right;"  placeholder="0"></center></td>
					<?php echo "<td><center><button class='btn btn-sm btn-info' type='button' data-toggle='modal' data-target='#myModal1'>Verify</button></center></td>"; ?>
						
				</tr>
			</tbody>
		</table>
		<div class="container">
            <p><strong>Admin's Notes</strong></p>
             
                <div class="form-group">
                    <textarea class="form-control" name="adminnotes" rows="1" placeholder="Place admin notations here..." value=" "></textarea>
                </div>
                <button type="submit" name="updatepayment" class="btn btn-sm btn-primary">Submit</button>
            
        </div>
		<br>
		
		</form>
		
		
		<div class="col-lg-4">
			<a href="../../8driveAdmin/custrentmaint.php" role="button" class="btn btn-sm btn-primary">Back to Rent Status Page</a>
		</div>
		
	</div>	

<!--------------------------------------->			
			
	<!-- Set Status Modal -->
	<div class="modal fade" id="myModal">
		<div class="modal-dialog modal-lg"> <!--modal sizes: xl, lg, sm -->
			<div class="modal-content">
      
					<!-- Modal Header -->
					<div class="modal-header">
						<h4 class="modal-title"><strong>Customer Rent Status</strong></h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
        
				<!-- Modal body -->
				<div class="modal-body text-center">
					
					<div class="container">
						<?php
							echo "<form action='custrentstatusmaint.php?car_trans_id={$car_trans_id}&car_id={$carid}&cust_id={$cust_id}' method='post'>";
						?>
							<div class="row">
							
								<div class="col-lg-6 col-md-4 col-xs-6 thumb">
									<!--label class="form-control" for="wdrive">Where to deliver? (select one)</label-->     
									<select name="reqstatus" class="form-control tm-select" id="inputAdult">
										<option value="Approved - Payment Made">Approved - Payment Made</option>
										<option value="Unreturned (Exceeded)">Unreturned (Exceeded)</option>
										<option value="Unreturned (Extended)">Unreturned (Extended)</option>
										<option value="Completed / Returned">Completed / Returned</option>
									</select>  
								</div>
								
								<div class="col-lg-6 col-md-4 col-xs-6 thumb">
									<button type="submit" name="status" class="btn btn-primary tm-btn tm-btn-search text-uppercase" id="btnSubmit">Submit</button>
								</div>
								
							</div>
						</form>
					</div>
				</div>
        <br>
					<!-- Modal footer -->
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					</div>
					
					

			</div>
		</div>
	</div>			
	
	
	
</body>
</html>
