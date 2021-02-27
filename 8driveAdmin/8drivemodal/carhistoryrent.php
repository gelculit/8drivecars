<?php ob_start(); ?>
<?php include "../db.php"; ?>



<?php

$carid = $_GET['carid'];

//get customer vehicle
$query = "SELECT * FROM cardetail WHERE car_id = '$carid'";
$result = mysqli_query($connection, $query);
												
while($row = mysqli_fetch_assoc($result)) {
														
	$cust_car_model = $row['car_model'];
							
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
				<h3> Vehicle Rent History for <strong><?php echo $cust_car_model; ?></strong></h3><br>
            </div>
        </div>

		<table class="table table-bordered table-hover">
			<thead>
				<tr>
				   <th><center>Customer Name</center></th>
				   <th><center>Rent Start Date</center></th>
				   <th><center>Return Date </center></th>
				   
				</tr> 
			</thead>
			
			<tbody>
			
				<?php
				
				
				
					
					//get customer info
					$query = "SELECT * FROM car_cash_inventory WHERE car_id = '$carid' AND car_rent_status = 'Completed / Returned'";
					$result = mysqli_query($connection, $query);
					
					/*
					$count = mysqli_num_rows($result);
					echo $count;*/

						
					while($row = mysqli_fetch_assoc($result)) {
						
						$date_completed = $row['date_completed'];							
						$car_rent_start = $row['car_rent_start'];
						$cust_id = $row['cust_id'];
					
					
						//format date
						$stamp_indate = strtotime($car_rent_start);
						$start_day = date('d', $stamp_indate);
						$start_month = date('F', $stamp_indate);
						$start_year = date('Y', $stamp_indate);
						
									
						$stamp_retdate = strtotime($date_completed);
						$end_day = date('d', $stamp_retdate);
						$end_month = date('F', $stamp_retdate);
						$end_year = date('Y', $stamp_retdate);
						
						$rent_start = "{$start_month} {$start_day}, {$start_year}";
						$rent_stop = "{$end_month} {$end_day}, {$end_year}";
						
						
						
						//get customer's name
						$namequery = "SELECT * FROM customerinfo WHERE cust_id = {$cust_id}";

						$select_id = mysqli_query($connection, $namequery);

						while($row = mysqli_fetch_assoc($select_id)) {

							$cust_fname = $row['cust_fname'];
							$cust_lname = $row['cust_lname'];
							$cust_name = $cust_fname . " " . $cust_lname;
						}
					
					
						echo "<tr>";

						echo "<td><center>{$cust_name}</center></td>";
						echo "<td><center>{$rent_start}</center></td>";
						echo "<td><center>{$rent_stop}</center></td>";
						//echo "<td><center><button class='btn btn-primary' type='button' data-toggle='modal' data-target='#myModal5'>{$cust_status}</button></center></td>";
						echo "</tr>";
				
					}
				
				
				
				
					
				?>
			</tbody>
		</table>	
		


		<div class="row">
			
			<div class="col-lg-4">
				<a href="../carinventory.php" role="button" class="btn  btn-primary">Back to Car Inventory List</a>
			</div>
		</div>		
		
		
	</div><!---- /.container ------->


	</div>

</body>
</html>
