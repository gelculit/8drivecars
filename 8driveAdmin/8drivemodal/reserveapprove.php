<?php ob_start(); ?>
<?php include "../db.php"; ?>

<?php


$car_trans_id = $_GET['car_trans_id'];
$cust_id = $_GET['cust_id'];
$cust_car_id = $_GET['cust_car_id'];
$cust_name = $_GET['cust_name'];
$cust_car_model = $_GET['cust_car_model'];
$cust_pickup_date = $_GET['cust_pickup_date'];
$cust_return_date = $_GET['cust_return_date'];
$cust_rent_amt = $_GET['cust_rent_amt'];
$cust_deli_fee = $_GET['cust_deli_fee'];
$cust_rental_status = $_GET['cust_rental_status'];
$cust_bill_status = $_GET['cust_bill_status'];

$totalfee1 = ($cust_rent_amt + $cust_deli_fee);
$totalfee = number_format($totalfee1, 2);
$cust_deli_fee1 = number_format($cust_deli_fee, 2);
$cust_rent_amt1 = number_format($cust_rent_amt, 2);

	//convert all variables to be used for displaying date
	$stamp_indate = strtotime($cust_pickup_date);
	$start_day = date('d', $stamp_indate);
	$start_month = date('F', $stamp_indate);
	$start_year = date('Y', $stamp_indate);
	
	$stamp_retdate = strtotime($cust_return_date);
	$end_day = date('d', $stamp_retdate);
	$end_month = date('F', $stamp_retdate);
	$end_year = date('Y', $stamp_retdate);
	
	
	
	
if(isset($_POST['status'])) {
	$cust_rental_status = $_POST['reqstatus'];
	
	$custQuery = "SELECT custrentinfo";
	$custQuery = "UPDATE custrentinfo SET ";
	$custQuery .= "cust_rental_status = '{$cust_rental_status}' ";
	$custQuery .= "WHERE cust_id = {$cust_id} ";
	
	$update_query = mysqli_query($connection, $custQuery);
			
	if(!$update_query) {
		die("Query Failed " . mysqli_error($connection));
	}
	
	
	if($cust_rental_status == "Approved - Payment Made" OR $cust_rental_status == "Approved - Awaiting Payment" OR $cust_rental_status == "Rejected" OR $cust_rental_status == "Customer Cancelled") {
		
		
		if($cust_rental_status == "Rejected" OR $cust_rental_status == "Customer Cancelled") {
			$cust_rent_amt = 0;
			$cust_deli_fee = 0;
			$totalfee1 = 0;
		}
		
		$cashQuery = "SELECT car_cash_inventory";
		$cashQuery = "INSERT INTO car_cash_inventory (car_trans_id, cust_id, car_id, car_rent_start, car_rent_end, car_rent_status, car_initial_rent_amt, delivery_fee, car_total_rent_amt) ";
		$cashQuery .= "VALUES ('{$car_trans_id}', '{$cust_id}', '{$cust_car_id}', '{$cust_pickup_date}', '{$cust_return_date}', '{$cust_rental_status}', '{$cust_rent_amt}', '{$cust_deli_fee}', '{$totalfee1}')";
	
		$create_post_query = mysqli_query($connection, $cashQuery);
		if(!$create_post_query) {
			die("Query Failed " . mysqli_error($connection));
		}
	
	
		if($cust_rental_status == "Approved - Payment Made" OR $cust_rental_status == "Approved - Awaiting Payment") {
			$car_rent_status = "On-going";
		}
		if($cust_rental_status == "For Review" OR $cust_rental_status == "Rejected" OR $cust_rental_status == "Customer Cancelled") {
			$car_rent_status = "Available";
		}
		if($cust_rental_status == "Awaiting Payment") {
			$car_rent_status = "Reserved";
		}
	
	
		$cardetailQuery = "SELECT FROM cardetail";
		$cardetailQuery = "UPDATE cardetail SET ";
		$cardetailQuery .= "car_rentstatus  = '{$car_rent_status}' ";
		$cardetailQuery .= "WHERE car_id = {$cust_car_id} ";
			
		$create_cardetail_query = mysqli_query($connection, $cardetailQuery);
		if(!$create_cardetail_query) {
			die("Query Failed " . mysqli_error($connection));
		}
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
	<br><br><br><br>
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h3> Customer Approval Page</h3><br>
            </div>
        </div>
		

	
	
		 <table class="table table-bordered table-hover">
			<thead>
				<tr>
					<th><center>Customer Name</center></th>
					<!--th>Last Name</th-->
					<th><center>Vehicle Model</center></th>
					<th><center>Pick-up Date</center></th>
				   
					<th><center>Return Date</center></th>
					<th><center>Rent Amount</center></th>
					<th><center>Delivery Fee</center></th>
					<th><center>Actual Bill</center></th>
					<th><center>Proof Of Payment</center></th>
					<th><center>Approval Status</center></th>
				   
			   </tr> 
			</thead>

			<tbody>
			
				<?php
					
					echo "<tr>";

					echo "<td><center>{$cust_name}</center></td>";
					echo "<td><center>{$cust_car_model}</center></td>";
					echo "<td><center>{$start_day} {$start_month} {$start_year}</center></td>";
					echo "<td><center>{$end_day} {$end_month} {$end_year}</center></td>";
					echo "<td><center>Php {$cust_rent_amt1}</center></td>";
					echo "<td><center>Php {$cust_deli_fee1}</center></td>";
					echo "<td><center>Php {$totalfee}</center></td>";
					
					if($cust_bill_status == "") {
						$srcimg = "proofplacehold.jpg";
					} else {
						$srcimg = $cust_bill_status;
					} 
					
					echo "<td><center><button class='btn btn-default' type='button' data-toggle='modal' data-target='#myModal1'>
					<img width='50'  src='../../8drivecar/pickavailability/8driveuploads/docimage/$srcimg' width='100' alt='image'></button></center></td>"
					;
					
					echo "<td><center><button class='btn btn-primary' type='button' data-toggle='modal' data-target='#myModal5'>{$cust_rental_status }</button></center></td>";
					
					echo "</tr>";
				?>
	
			</tbody>
		</table>
	
	<br><br><br>
			
		<div class="col-lg-4">
			<a href="../reservevehiclepage.php" role="button" class="btn  btn-primary">Back to Approval List</a>
		</div>
		
	</div>	

<!--------------------------------------->			
			
	<!-- Set Status Modal -->
	<div class="modal fade" id="myModal5">
		<div class="modal-dialog modal-lg"> <!--modal sizes: xl, lg, sm -->
			<div class="modal-content">
      
					<!-- Modal Header -->
					<div class="modal-header">
						<h4 class="modal-title"><strong>Vehicle Request Status</strong></h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
        
				<!-- Modal body -->
				<div class="modal-body text-center">
					
					<div class="container">
						<?php
							echo "<form action='reserveapprove.php?car_trans_id={$car_trans_id}&cust_id={$cust_id}&cust_car_id={$cust_car_id}&cust_name={$cust_name}&cust_car_model={$cust_car_model}&cust_pickup_date={$cust_pickup_date}&cust_return_date={$cust_return_date}&cust_rent_amt={$cust_rent_amt}&cust_deli_fee={$cust_deli_fee}&cust_rental_status={$cust_rental_status}&cust_bill_status={$cust_bill_status}' method='post'>";
						?>
							<div class="row">
							
								<div class="col-lg-6 col-md-4 col-xs-6 thumb">
									<!--label class="form-control" for="wdrive">Where to deliver? (select one)</label-->     
									<select name="reqstatus" class="form-control tm-select" id="inputAdult">
										<option value="For Review">For Review</option>
										<option value="Awaiting Payment">Awaiting Payment</option>
										<option value="Approved - Payment Made">Approved - Payment Made</option>
										<option value="Approved - Awaiting Payment">Approved - Awaiting Payment</option>
										<option value="Rejected">Rejected</option>
										<option value="Customer Cancelled">Customer Cancelled</option>
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
	
	
	
	<!----------------Proof of Payment----------------------->			
			
	<!-- The Modal -->
		<div class="modal fade" id="myModal1">
			<div class="modal-dialog modal-lg"> <!--modal sizes: xl, lg, sm -->
				<div class="modal-content">
      
					<!-- Modal Header -->
					<div class="modal-header">
						<h4 class="modal-title"><strong>Proof Of Payment</strong></h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
        
					<!-- Modal body -->
					<div class="modal-body text-center">
						<img src="../../8drivecar/pickavailability/8driveuploads/docimage/<?php echo $srcimg ?>" width="75%">
					</div>
        
					<!-- Modal footer -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					</div>
        
				</div>
			</div>
		</div>	
        

</body>
</html>