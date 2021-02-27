<?php ob_start(); ?>
<?php include "../db.php"; ?>

<?php 
$feesw = 0;


$custname = $_GET['custname'];
$cust_id = $_GET['custid'];
$cust_reserve_date = $_GET['cust_reserve_date'];
$cust_delitoaddress = $_GET['cust_delitoaddress'];
$cust_car_id = $_GET['cust_car_id'];
$cust_doc1 = $_GET['custdoc1'];
$cust_doc2 = $_GET['custdoc2'];
$cust_doc3 = $_GET['custdoc3'];
$cust_residency = $_GET['custres'];
$cust_status = $_GET['custstat'];
$cust_bill_status = $_GET['cust_bill_status'];

$dodelisw = 0;


//get customer vehicle
$query = "SELECT * FROM cardetail WHERE car_id = '$cust_car_id'";
$result = mysqli_query($connection, $query);
				
while($row = mysqli_fetch_assoc($result)) {
						
	$cust_car_model = $row['car_model'];
	//echo $cust_car_model;
}


//check if delivery fee is 0
$query = "SELECT * FROM custrentinfo WHERE cust_id = '$cust_id'";
$result = mysqli_query($connection, $query);
				
while($row = mysqli_fetch_assoc($result)) {
						
	$deli_fee = $row['cust_deli_fee'];
	
	if($deli_fee == 0) {
		$dodelisw = 1;
	}
	//echo $cust_car_model;
}





/*********get customer address if deliver to address on file***********/
if($cust_delitoaddress == "Yes") {
	
	$query = "SELECT * FROM customerinfo WHERE cust_id = '$cust_id'";
	$result = mysqli_query($connection, $query);
	
	while($row = mysqli_fetch_assoc($result)) {
		
		$addr1 = $row['cust_address'];
		$addr2 = $row['cust_address2'];
		$addr3 = $row['cust_city'];
		$addr4 = $row['cust_prov'];
		
		$caddr=" ".$addr1." ".$addr2.", ".$addr3.", ".$addr4;
		
	}
} 


	

if(isset($_POST['status'])) {
	
	$cust_status = $_POST['reqstatus'];
	
	$custQuery = "SELECT customerlogins";
	$custQuery = "UPDATE customerlogins SET ";
	$custQuery .= "cust_status = '{$cust_status}', cust_verify_date = now() ";
	$custQuery .= "WHERE cust_id = {$cust_id} ";
	$update_query = mysqli_query($connection, $custQuery);
			
	if(!$update_query) {
		die("Query Failed " . mysqli_error($connection));
	}
	
	
}


if(isset($_POST['getcity'])) {
	$city_id = $_POST['city_id'];
	$feesw = 1;
}

if(isset($_POST['getfee'])) {
	$deli_fee = $_POST['city_fee'];
	$feesw = 2;
	
	
	$custQuery = "SELECT custrentinfo";
	$custQuery = "UPDATE custrentinfo SET ";
	$custQuery .= "cust_deli_fee = '{$deli_fee}' ";
	$custQuery .= "WHERE cust_id = {$cust_id} ";
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


       
	<div class="container">
<br><br><br>

		<div class="row">
			<div class="col-lg-12">
				<h3> Customer Approval Page</h3><br>
            </div>
        </div>

		<table class="table table-bordered table-hover">
			<thead>
				<tr>
				   <th><center>Customer Name</center></th>
				   <th><center>Residency</center></th>
				   <th><center>Deliver to:</center></th>
				   <th><center>Vehicle Model</center></th>
				   <th><center>Reserve Date</center></th>
				   <th><center>Approval Status</center></th>
				   <?php if($cust_delitoaddress == "Yes") { ?>
						<!--th><center>Delivery Fee</center></th-->
				   <?php } ?>
				</tr> 
			</thead>
			
			<tbody>
			
				<?php
					if($cust_delitoaddress == "Yes") {
						$deliver_to = "Address on file";
					} else {
						$deliver_to = "Nominated Address";
					}
				
					echo "<tr>";

					echo "<td><center>{$custname}</center></td>";
					echo "<td><center>{$cust_residency}</center></td>";
					echo "<td><center>{$deliver_to}</center></td>";
					echo "<td><center>{$cust_car_model}</center></td>";
					echo "<td><center>{$cust_reserve_date}</center></td>";
					echo "<td><center><button class='btn btn-primary' type='button' data-toggle='modal' data-target='#myModal5'>{$cust_status}</button></center></td>";
					if($cust_delitoaddress == "Yes") {
						//echo "<td><center><button class='btn btn-primary' type='button' data-toggle='modal' data-target='#myModal6'>Set Delivery Fee</button></center></td>";
					}
					echo "</tr>";
				?>
			</tbody>
		</table>	
		
		
		<div class="container text-center">
		
		<?php  if($dodelisw == 1) {?>
		
			<?php if($feesw == 2) { ?>
				
				<h6><strong>Delivery Fee is Php<?php echo $deli_fee; ?>.00</strong></h6>
				
			<?php } else { ?>
				
				<h6><strong>Set-up Delivery Fee for: <?php echo $caddr; ?></strong></h6>
			
			<?php } ?>
			
			<!-------------------get city id ------------------->
			<div class="container">
						<?php
							echo "<form action='docapprovalpage.php?custname={$custname}&custid={$cust_id}&cust_reserve_date={$cust_reserve_date}&cust_delitoaddress={$cust_delitoaddress}&cust_car_id={$cust_car_id}&custdoc1={$cust_doc1}&custdoc2={$cust_doc2}&custdoc3={$cust_doc3}&custres={$cust_residency}&custstat={$cust_status}&cust_bill_status={$cust_bill_status}' method='post'>";
						?>
						
						<?php if($feesw == 0) { ?>
						
							<div>
								
								<h6>Please select <strong>CITY ADDRESS</strong></h6>
							</div>
							<div class="row">
								
								<div class="col-lg-6 col-md-4 col-xs-6 thumb">
									<!--label class="form-control" for="wdrive">Where to deliver? (select one)</label-->     
									<select name="city_id" class="form-control tm-select" id="inputAdult">
										<!--option value=" " selected>Select one</option
										<option value="UNVERIFIED">Unverified</option>-->
										
										<?php 
											$query = "SELECT * FROM zone_city";
											$select_city = mysqli_query($connection, $query);

												// ***ACTUAL ADDING OF DATA TO TABLE
											while($row = mysqli_fetch_assoc($select_city)) {

												$cityselect = $row['zone_ct'];
												$cityid = $row['zone_id'];
												
												echo "<option value={$cityid}>{$cityselect}</option>";
												
											}
										?>
									</select>  
								</div>
								
								
									<button type="submit" name="getcity" class="btn btn-primary tm-btn tm-btn-search text-uppercase" id="btnSubmit">Submit</button>
								
								
							</div>
							
						<?php } ?>
			<!---------------/.get city id---------------------------->		
			
			<!---------------get fee---------------------------->	

							<?php if($feesw == 1) { ?>
							
							<div>
								
								<h6>Please select <strong>MUNICIPALITY</strong></h6>
							</div>
							
							<div class="row">
								
								<div class="col-lg-6 col-md-4 col-xs-6 thumb">
									<!--label class="form-control" for="wdrive">Where to deliver? (select one)</label-->     
									<select name="city_fee" class="form-control tm-select" id="inputAdult">
										<!--option value=" " selected>Select one</option
										<option value="UNVERIFIED">Unverified</option>-->
										
										<?php
										
											$query = "SELECT * FROM zone_municipality";
											$select_municipality = mysqli_query($connection, $query);

											
											while($row = mysqli_fetch_assoc($select_municipality)) {
												$zone_ct_id = $row['zone_ct_id'];
												if($city_id == $zone_ct_id) { 
												
													$zonemunicipal = $row['zone_municipal'];
													$cust_deli_fee = $row['zone_fee'];
												
													echo "<option value={$cust_deli_fee}>{$zonemunicipal}</option>";
												}
											}
										
										
										?>
									</select>  
								</div>
								
								<div class="col-lg-6 col-md-4 col-xs-6 thumb">
									<button type="submit" name="getfee" class="btn btn-primary tm-btn tm-btn-search text-uppercase" id="btnSubmit">Submit</button>
								</div>
								
							</div>
							<?php } ?>
			<!---------------/.get fee---------------------------->	
			<?php } else { ?>
			
				<h6><strong>Delivery Fee is Php<?php echo $deli_fee; ?>.00</strong></h6>
			
			<?php } ?>
		
			<hr>
		</div>
		
		
		
		
<!--------------------------------------->			
			
	<!-- Set Status Modal -->
	<div class="modal fade" id="myModal5">
		<div class="modal-dialog modal-lg"> <!--modal sizes: xl, lg, sm -->
			<div class="modal-content">
      
					<!-- Modal Header -->
					<div class="modal-header">
						<h4 class="modal-title"><strong>Set-up Customer Request Status</strong></h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
        
				<!-- Modal body -->
				<div class="modal-body text-center">
					
					<div class="container">
						<?php
							echo "<form action='docapprovalpage.php?feesw={$feesw}&custname={$custname}&custid={$cust_id}&cust_reserve_date={$cust_reserve_date}&cust_delitoaddress={$cust_delitoaddress}&cust_car_id={$cust_car_id}&custdoc1={$cust_doc1}&custdoc2={$cust_doc2}&custdoc3={$cust_doc3}&custres={$cust_residency}&custstat={$cust_status}&cust_bill_status={$cust_bill_status}' method='post'>";
						?>
							<div class="row">
							
								<div class="col-lg-6 col-md-4 col-xs-6 thumb">
									<!--label class="form-control" for="wdrive">Where to deliver? (select one)</label-->     
									<select name="reqstatus" class="form-control tm-select" id="inputAdult">
										<!--option value=" " selected>Select one</option-->
										<option value="UNVERIFIED">Unverified</option>
										<option value="PRIMARY DOCS REQUIRED">Primary Documents Required</option>
										<option value="ADDITIONAL DOCS REQUIRED">Additional Documents Required</option>
										<!--option value="AWAITING PAYMENT">Awaiting Payment</option-->
										<option value="APPROVED">Approved</option>
										<option value="REJECTED">Rejected</option>
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
		
		
<!------------------------------------------------------>			
	<!-- Delivery Fee Modal -->
		<div class="modal fade" id="">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
      
					<!-- Modal Header -->
					<div class="modal-header">
						<h4 class="modal-title"><strong>Set-up Delivery Fee</strong></h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
        
        
					<!-- Modal body -->
					<div class="modal-body text-center">
						<p>For reference, customer's address on file is: <?php echo $caddr; ?></p>
						
						<div class="container">
						<?php
							echo "<form action='docapprovalpage.php?custname={$custname}&custid={$cust_id}&cust_reserve_date={$cust_reserve_date}&cust_delitoaddress={$cust_delitoaddress}&cust_car_id={$cust_car_id}&custdoc1={$cust_doc1}&custdoc2={$cust_doc2}&custdoc3={$cust_doc3}&custres={$cust_residency}&custstat={$cust_status}&cust_bill_status={$cust_bill_status}' method='post'>";
						?>
						
						<?php if($feesw == 0) { ?>
						
							<div>
								<br>
								<p>Please select city address</p>
							</div>
							<div class="row">
								
								<div class="col-lg-6 col-md-4 col-xs-6 thumb">
									<!--label class="form-control" for="wdrive">Where to deliver? (select one)</label-->     
									<select name="city_id" class="form-control tm-select" id="inputAdult">
										<!--option value=" " selected>Select one</option
										<option value="UNVERIFIED">Unverified</option>-->
										
										<?php 
											$query = "SELECT * FROM zone_city";
											$select_city = mysqli_query($connection, $query);

												// ***ACTUAL ADDING OF DATA TO TABLE
											while($row = mysqli_fetch_assoc($select_city)) {

												$cityselect = $row['zone_ct'];
												$cityid = $row['zone_id'];
												
												echo "<option value={$cityid}>{$cityselect}</option>";
												
											}
										?>
									</select>  
								</div>
								
								<div class="col-lg-6 col-md-4 col-xs-6 thumb">
									<button type="submit" name="getcity" class="btn btn-primary tm-btn tm-btn-search text-uppercase" id="btnSubmit">Submit</button>
								</div>
								
							</div>
							
						<?php } ?>
							
							
							<?php if($feesw == 1) { ?>
							
							<div>
								<br>
								<p>Please select municipality</p>
							</div>
							
							<div class="row">
								
								<div class="col-lg-6 col-md-4 col-xs-6 thumb">
									<!--label class="form-control" for="wdrive">Where to deliver? (select one)</label-->     
									<select name="city_id" class="form-control tm-select" id="inputAdult">
										<!--option value=" " selected>Select one</option
										<option value="UNVERIFIED">Unverified</option>-->
										
										<?php
										
											$query = "SELECT * FROM zone_municipality";
											$select_municipality = mysqli_query($connection, $query);

											
											while($row = mysqli_fetch_assoc($select_municipality)) {
												$zone_ct_id = $row['zone_ct_id'];
												if($city_id == $zone_ct_id) { 
												
													$zonemunicipal = $row['zone_municipal'];
													//$cust_deli_fee = $row['zone_fee'];
												
													echo "<option value={$zonemunicipal}>{$zonemunicipal}</option>";
												}
											}
										
										
										?>
									</select>  
								</div>
								
								<div class="col-lg-6 col-md-4 col-xs-6 thumb">
									<button type="submit" name="status" class="btn btn-primary tm-btn tm-btn-search text-uppercase" id="btnSubmit">Submit</button>
								</div>
								
							</div>
							<?php } ?>
						</form>
					</div>
						
					</div>
        
					<!-- Modal footer -->
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					</div>
        
				</div>
			</div>
		</div>		
			
<!--------------------------------------->
		

	</div>
<br>

	<div class="container">
		<div class="row">
		
			<?php 
				if($cust_residency == "Philippine Resident") {
					$label1 = "Driver's Liscense";
					$label2 = "Proof of Income";
					$label3 = "Proof of Residency";
					$label4 = "Proof of Payment";
				} else {
					$label1 = "Passport"; 
					$label2 = "Itinerary";
					$label3 = "Driver's Liscense";
					$label4 = "Proof of Payment";
				}
			?>
		
			<?php 
				if($cust_doc1 == "") {
					$srcimg = "placeholder.png";
				} else {
					$srcimg = $cust_doc1;
				}
			?>
			<div class="col-lg-3 col-md-4 col-xs-6 thumb">
				<center><label for="inputCity"><strong><?php echo $label1; ?></strong></label></center>
				
				<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal1">
				<center><img src="../../8drivecar/pickavailability/8driveuploads/docimage/<?php echo $srcimg ?>" width="200"/></center>
				</button>
			</div>
			
<!--------------------------------------->			
			
	<!-- The Modal -->
		<div class="modal fade" id="myModal1">
			<div class="modal-dialog modal-lg"> <!--modal sizes: xl, lg, sm -->
				<div class="modal-content">
      
					<!-- Modal Header -->
					<div class="modal-header">
						<h4 class="modal-title"><strong><?php echo $label1; ?></strong></h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
        
					<!-- Modal body -->
					<div class="modal-body text-center">
						<img src="../../8drivecar/pickavailability/8driveuploads/docimage/<?php echo $srcimg ?>" width="100%">
					</div>
        
					<!-- Modal footer -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					</div>
        
				</div>
			</div>
		</div>		
			
<!--------------------------------------->				
			
			<?php 
				if($cust_doc2 == "") {
					$srcimg = "placeholder.png";
				} else {
					$srcimg = $cust_doc2;
				}
			?>
			<div class="col-lg-3 col-md-4 col-xs-6 thumb">
				<center><label for="inputCity"><strong><?php echo $label2; ?></strong></label></center>
				<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal2">
				<center><img src="../../8drivecar/pickavailability/8driveuploads/docimage/<?php echo $srcimg ?>" width="200"/></center>
				</button>
			</div>
			
<!--------------------------------------->			
			
	<!-- The Modal -->
		<div class="modal fade" id="myModal2">
			<div class="modal-dialog modal-lg"> <!--modal sizes: xl, lg, sm -->
				<div class="modal-content">
      
					<!-- Modal Header -->
					<div class="modal-header">
						<h4 class="modal-title"><strong><?php echo $label2; ?></strong></h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
        
					<!-- Modal body -->
					<div class="modal-body text-center">
						<img src="../../8drivecar/pickavailability/8driveuploads/docimage/<?php echo $srcimg ?>" width="100%">
					</div>
        
					<!-- Modal footer -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					</div>
        
				</div>
			</div>
		</div>		
			
<!--------------------------------------->	
			
			
			<?php 
				if($cust_doc3 == "") {
					$srcimg = "placeholder.png";
				} else {
					$srcimg = $cust_doc3;
				}
			?>
			<div class="col-lg-3 col-md-4 col-xs-6 thumb">
				<center><label for="inputCity"><strong><?php echo $label3; ?></strong></label></center>
				<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal3">
				<center><img src="../../8drivecar/pickavailability/8driveuploads/docimage/<?php echo $srcimg ?>" width="200"/></center>
				</button>
			</div>
			
<!--------------------------------------->			
			
	<!-- The Modal -->
		<div class="modal fade" id="myModal3">
			<div class="modal-dialog modal-lg"> <!--modal sizes: xl, lg, sm -->
				<div class="modal-content">
      
					<!-- Modal Header -->
					<div class="modal-header">
						<h4 class="modal-title"><strong><?php echo $label3; ?></strong></h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
        
					<!-- Modal body -->
					<div class="modal-body text-center">
						<img src="../../8drivecar/pickavailability/8driveuploads/docimage/<?php echo $srcimg ?>" width="100%">
					</div>
        
					<!-- Modal footer -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					</div>
        
				</div>
			</div>
		</div>		
			
<!--------------------------------------->	
			
			<?php 
				if($cust_bill_status == "") {
					$srcimg = "proofplacehold.jpg";
				} else {
					$srcimg = $cust_bill_status;
				} 
			?>
			<div class="col-lg-3 col-md-4 col-xs-6 thumb">
				<center><label for="inputCity"><strong><?php echo $label4; ?></strong></label></center>
				<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal4">
				<center><img src="../../8drivecar/pickavailability/8driveuploads/docimage/<?php echo $srcimg ?>" width="200" height="150"/></center>
				</button>
			</div>
			
<!--------------------------------------->			
			
	<!-- The Modal -->
		<div class="modal fade" id="myModal4">
			<div class="modal-dialog modal-lg"> <!--modal sizes: xl, lg, sm -->
				<div class="modal-content">
      
					<!-- Modal Header -->
					<div class="modal-header">
						<h4 class="modal-title"><strong><?php echo $label4; ?></strong></h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
        
					<!-- Modal body -->
					<div class="modal-body text-center">
						<img src="../../8drivecar/pickavailability/8driveuploads/docimage/<?php echo $srcimg ?>" width="100%">
					</div>
        
					<!-- Modal footer -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					</div>
        
				</div>
			</div>
		</div>		
			
<!--------------------------------------->	
			
			
			
		</div><!---- /.row ------->

<hr>

		<div class="row">
			
			<div class="col-lg-4">
				<a href="../docapprove.php" role="button" class="btn  btn-primary">Back to Approval List</a>
			</div>
		</div>		
		
		
	</div><!---- /.container ------->


	</div>

</body>
</html>
