<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>

		



<!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><center> <strong>Customer's Vehicle Request List (for approval)</strong></center></h3>
            
          </div>
        </div>
 
 
 <table class="table table-bordered table-hover table-striped table-condensed">
    <thead>
       <tr>
           <th><center>Customer Name</center></th>
           <!--th>Last Name</th-->
           <th><center>Vehicle Model</center></th>
		   <th><center>Pick-up Date</center></th>
		   
           <th><center>Return Date</center></th>
           <th><center>Rent Amount</center></th>
           <th><center>Delivery Fee</center></th>
		   <th><center>Request Status</center></th>
		   <!--th><center>Approval Status</center></th-->
		   
       </tr> 
    </thead>

    <tbody>

    <?php   
         $query = "SELECT * FROM custrentinfo";
         $select_cust_rent = mysqli_query($connection, $query);
		
        // ***get cust id and rent status 1 record at a time

        while($row = mysqli_fetch_assoc($select_cust_rent)) {
			$cust_id = $row['cust_id'];
			$cust_car_id = $row['cust_car_id'];
			
			/**********test if cust id shows approved in cust login***********/
			$query = "SELECT * FROM customerlogins WHERE cust_id = {$cust_id}";
			
			$select_cust = mysqli_query($connection, $query);

			while($row = mysqli_fetch_assoc($select_cust)) {
				$cust_doc_status = $row['cust_status'];
				
			}
			
			if($cust_doc_status == "APPROVED") {
						
				//get customer first and last name
				$query = "SELECT * FROM customerinfo WHERE cust_id = {$cust_id}";
				$select_id = mysqli_query($connection, $query);

				while($row = mysqli_fetch_assoc($select_id)) {

					$cust_fname = $row['cust_fname'];
					//echo $cust_fname;
					$cust_lname = $row['cust_lname'];
					$cust_name = $cust_fname . " " . $cust_lname;
				}
						
				//get customer vehicle
				$query = "SELECT * FROM cardetail WHERE car_id = '$cust_car_id'";
				$result = mysqli_query($connection, $query);
										
				while($row = mysqli_fetch_assoc($result)) {
												
					$cust_car_model = $row['car_model'];
					//echo $cust_car_model;
				}
					
				/***********check if for review or awaiting payment*****************/
				$query = "SELECT * FROM custrentinfo WHERE cust_id = {$cust_id}";
				$select_review = mysqli_query($connection, $query);
				
				
				//$cust_id1 = $row['cust_id'];
				while($row = mysqli_fetch_assoc($select_review)) {
					$cust_rental_status = $row['cust_rental_status'];
					
								$car_trans_id = $row['car_trans_id'];
								$cust_pickup_date = $row['cust_pickup_date'];
								$cust_return_date = $row['cust_return_date'];
								$cust_rent_amt = $row['cust_rent_amt'];
								$cust_deli_fee = $row['cust_deli_fee'];
								$cust_bill_status = $row['cust_bill_status'];
								
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
					
					
					
					
					
					
				}
					//if($cust_id == $cust_id1) {
						
						if($cust_rental_status == "For Review" OR $cust_rental_status == "Awaiting Payment") {
							
								echo "<tr>";

								echo "<td><center>{$cust_name}</center></td>";
								echo "<td><center>{$cust_car_model}</center></td>";
								echo "<td><center>{$start_day} {$start_month} {$start_year}</center></td>";
								echo "<td><center>{$end_day} {$end_month} {$end_year}</center></td>";
								echo "<td><center>Php {$cust_rent_amt1}</center></td>";
								echo "<td><center>Php {$cust_deli_fee1}</center></td>";
									 //echo "<td>{$cust_rental_status}</td>";
									 //echo "<td><center><a href='8drivemodal/reserveapprove.php' class='btn btn-info' type='submit' name='submit'>Review</a></center></td>";
									 //echo "<td><center><button class='btn btn-primary' type='button' data-toggle='modal' data-target='#myModal5'>{$cust_rental_status}</button></center></td>";
								echo "<td><center><a href='8drivemodal/reserveapprove.php?car_trans_id={$car_trans_id}&cust_id={$cust_id}&cust_car_id={$cust_car_id}&cust_name={$cust_name}&cust_car_model={$cust_car_model}&cust_pickup_date={$cust_pickup_date}&cust_return_date={$cust_return_date}&cust_rent_amt={$cust_rent_amt}&cust_deli_fee={$cust_deli_fee}&cust_rental_status={$cust_rental_status}&cust_bill_status={$cust_bill_status}' class='btn btn-info' type='submit' name='submit'>{$cust_rental_status}</a></center></td>";
								echo "</tr>";
						}	
				
					//}
					
					
			}
		}
		
				 
	?>


    </tbody>

</table>



 <!-- page end-->
      </section>
    </section>
    <!--main content end-->
	
	<?php include "8driveAdmin.php"; ?>

      
