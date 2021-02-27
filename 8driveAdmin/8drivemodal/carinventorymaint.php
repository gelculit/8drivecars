<?php ob_start(); ?>
<?php include "../db.php"; ?>

<?php
$carid = $_GET['carid'];


if(isset($_POST['status'])) {
	$cust_rental_status = $_POST['reqstatus'];
	
	$custQuery = "SELECT cardetail";
	$custQuery = "UPDATE cardetail SET ";
	$custQuery .= "car_rentstatus = '{$cust_rental_status}' ";
	$custQuery .= "WHERE car_id = {$carid} ";
	
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
	<br><br><br><br>
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h3> Car Inventory Maintenance</h3><br>
            </div>
        </div>
		

	
	
		 <table class="table table-bordered table-hover">
			<thead>
				<tr>
					<th><center>Vehicle Image</center></th>
					<th><center>Vehicle Model</center></th>
					<th><center>Vehicle Description</center></th>
				    <th><center>Change Inventory Status</center></th>
				   
			   </tr> 
			</thead>

			<tbody>
			
				<?php
					
					$query = "SELECT * FROM cardetail  WHERE car_id = {$carid}";
					$select_carList = mysqli_query($connection, $query);

					// ***ACTUAL ADDING OF DATA TO TABLE
					while($row = mysqli_fetch_assoc($select_carList)) {

						//$carid = $row['car_id'];
						$cardesc = $row['car_desc'];
						$carmodel = $row['car_model'];
						$carimage = $row['car_image'];
						$carstatus = $row['car_rentstatus'];
						
						
						echo "<tr>";
						
						echo "<td><center><img width='200'  src='../../8driveAdmin/images/$carimage' alt='image'></center></td>";
						echo "<td><center>{$carmodel}</center></td>";
						echo "<td><center>{$cardesc}</center></td>";
						//echo "<td><center>{$carstatus}</center></td>";
						echo "<td><center><button class='btn btn-info' type='button' data-toggle='modal' data-target='#myModal1'>{$carstatus}</button></center></td>";
					
					}
				?>
	
			</tbody>
		</table>
	
	<br><br><br>
			
		<div class="col-lg-4">
			<a href="../../8driveAdmin/carinventory.php" role="button" class="btn  btn-primary">Back to Car Inventory Maintenance</a>
		</div>
		
	</div>	

<!--------------------------------------->			
			
	<!-- Set Status Modal -->
	<div class="modal fade" id="myModal1">
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
							echo "<form action='carinventorymaint.php?carid={$carid}' method='post'>";
						?>
							<div class="row">
							
								<div class="col-lg-6 col-md-4 col-xs-6 thumb">
									<!--label class="form-control" for="wdrive">Where to deliver? (select one)</label-->     
									<select name="reqstatus" class="form-control tm-select" id="inputAdult">
										<option value="On-going">On-Going</option>
										<option value="Available">Available</option>
										<option value="Reserved">Reserved</option>
										<option value="On Maintenance">On Maintenance</option>
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