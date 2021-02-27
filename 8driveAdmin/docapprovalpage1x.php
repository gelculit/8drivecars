<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>

<?php 

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


//get customer vehicle
$query = "SELECT * FROM cardetail WHERE car_id = '$cust_car_id'";
$result = mysqli_query($connection, $query);
				
while($row = mysqli_fetch_assoc($result)) {
						
	$cust_car_model = $row['car_model'];
	echo $cust_car_model;
}
		


?>


<!--main content start-->
    <section id="main-content">
      <section class="wrapper">
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
				   <th><center>Residency</center></th>
				   <th><center>Deliver to:</center></th>
				   <th><center>Vehicle Model</center></th>
				   <th><center>Reserve Date</center></th>
				   <th><center>Approval Status</center></th>
				   <th><center>Delivery Fee</center></th>
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
					echo "<td><center><button class='btn btn-primary' type='button'>{$cust_status}</button></center></td>";
					echo "<td><center><button class='btn btn-primary' type='button'>Set Fee</button></center></td>";
					
					echo "</tr>";
				?>
			</tbody>
		</table>	
	</div>
<br>

<!--
<button class="btn btn-default" type="button"><a class="" href="index.php">Back To Dashboard</a></button>
-->	


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
				<!--
				<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal1">-->
				<center><img src="../8drivecar/pickavailability/8driveuploads/docimage/<?php echo $srcimg ?>" width="200"/></center>
				<!--</button>-->
			</div>
			
			<?php 
				if($cust_doc2 == "") {
					$srcimg = "placeholder.png";
				} else {
					$srcimg = $cust_doc2;
				}
			?>
			<div class="col-lg-3 col-md-4 col-xs-6 thumb">
				<center><label for="inputCity"><strong><?php echo $label2; ?></strong></label></center>
				<center><img src="../8drivecar/pickavailability/8driveuploads/docimage/<?php echo $srcimg ?>" width="200"/></center>
				
			</div>
			
			<?php 
				if($cust_doc3 == "") {
					$srcimg = "placeholder.png";
				} else {
					$srcimg = $cust_doc3;
				}
			?>
			<div class="col-lg-3 col-md-4 col-xs-6 thumb">
				<center><label for="inputCity"><strong><?php echo $label3; ?></strong></label></center>
				<center><img src="../8drivecar/pickavailability/8driveuploads/docimage/<?php echo $srcimg ?>" width="200"/></center>
				
			</div>
			
			<!-- Place Bill Pay here -->
			
			<?php 
				if($cust_bill_status == "") {
					$srcimg = "proofplacehold.jpg";
				} else {
					$srcimg = $cust_bill_status;
				} 
			?>
			<div class="col-lg-3 col-md-4 col-xs-6 thumb">
				<center><label for="inputCity"><strong><?php echo $label4; ?></strong></label></center>
				<center><img src="../8drivecar/pickavailability/8driveuploads/docimage/<?php echo $srcimg ?>" width="200" height="150"/></center>
				
			</div>
			
		</div>
	</div>		

<hr>
	<div class="row">
			
			<div class="col-lg-4">
				<a href="docapprove.php" role="button" class="btn  btn-primary">Back to Approval List</a>
			</div>
		</div>
</div>





<!-- page end-->
      </section>
    </section>
    <!--main content end-->
	
	
<?php include "8driveAdmin.php"; ?>
