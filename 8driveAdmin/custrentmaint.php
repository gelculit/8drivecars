<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>

		

<!--
                 ONLY IF CAR_RENT_STATUS = Approved - Awaiting Payment OR Approved - Payment Made
-->


<?php 




?>


<!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><center><strong> Customer's Rented Vehicle Information Maintenance</strong></center></h3>
            
          </div>
        </div>


<table class="table table-bordered table-hover table-striped table-condensed">
    <thead>
       <tr>
           <th><center>Customer Name</center></th>
           <th><center>Vehicle Model</center></th>
		   <th><center>Vehicle Image</center></th>
		   <th><center>Pick-up Date</center></th>
		   <th><center>Return Date</center></th>
		   <th><center>Rent Status</center></th>
		   
													<!--INCLUDE IMAGE-->
		   
		   <!--th><center>Approval Status</center></th-->
       </tr> 
    </thead>

    <tbody>
		<?php
			$query = "SELECT * FROM car_cash_inventory"; // WHERE cust_id = {$cust_id}";
			
			$select_cust = mysqli_query($connection, $query);

			while($row = mysqli_fetch_assoc($select_cust)) {
				$car_trans_id = $row['car_trans_id'];
				$car_rent_status = $row['car_rent_status'];
				$cust_id = $row['cust_id'];
				$car_id = $row['car_id'];
				$car_rent_start = $row['car_rent_start'];
				$car_rent_end = $row['car_rent_end'];
				
				if($car_rent_status == "Approved - Awaiting Payment" OR $car_rent_status == "Approved - Payment Made" OR $car_rent_status == "Unreturned (Exceeded)" OR $car_rent_status == "Unreturned (Extended)") {
					
					//get customer's name
					$query = "SELECT * FROM customerinfo WHERE cust_id = {$cust_id}";

					$select_id = mysqli_query($connection, $query);

					while($row = mysqli_fetch_assoc($select_id)) {

						$cust_fname = $row['cust_fname'];
						$cust_lname = $row['cust_lname'];
						$cust_name = $cust_fname . " " . $cust_lname;
					}
					
					
					//get customer vehicle
					$query = "SELECT * FROM cardetail WHERE car_id = '$car_id'";
					$result = mysqli_query($connection, $query);
											
					while($row = mysqli_fetch_assoc($result)) {
						
						$carimage = $row['car_image'];							
						$cust_car_model = $row['car_model'];
					}
					
					//format date
					$stamp_indate = strtotime($car_rent_start);
					$start_day = date('d', $stamp_indate);
					$start_month = date('F', $stamp_indate);
					$start_year = date('Y', $stamp_indate);
								
					$stamp_retdate = strtotime($car_rent_end);
					$end_day = date('d', $stamp_retdate);
					$end_month = date('F', $stamp_retdate);
					$end_year = date('Y', $stamp_retdate);	
					
				
				
				
					echo "<tr>";

						echo "<td><center>{$cust_name}</center></td>";
						echo "<td><center>{$cust_car_model}</center></td>";
						echo "<td><center><img width='100'  src='../../8driveAdmin/images/$carimage' alt='image'></center></td>";
						echo "<td><center>{$start_day} {$start_month} {$start_year}</center></td>";
						echo "<td><center>{$end_day} {$end_month} {$end_year}</center></td>";
																	
				echo "<td><center><a href='8drivemodal/custrentstatusmaint.php?car_trans_id={$car_trans_id}&car_id={$car_id}&cust_id={$cust_id}' class='btn btn-info' type='submit' name='submit'>{$car_rent_status}</a></center></td>";
					echo "</tr>";
				
				}
			}
		?>
	

		
	</tbody>
	
	
	 <!-- page end-->
      </section>
    </section>
    <!--main content end-->
	
	<?php include "8driveAdmin.php"; ?>

      