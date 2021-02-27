<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>

		



<!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"> Customer Information List</h3>
            
          </div>
        </div>


<table class="table table-bordered table-hover table-striped table-condensed">
    <thead>
       <tr>
           <th>First Name</th>
           <th>Last Name</th>
           <th>Address</th>
           <th>Phone Number</th>
           <th>Email Address</th>
		   <th>Status</th>
           <th>View</th>
		   <!--th>Documents</th-->
       </tr> 
    </thead>

    <tbody>
	
	<?php
	
		//global $connection;
		$query = "SELECT * FROM customerinfo";
		$select_customer = mysqli_query($connection, $query);

		// ***ACTUAL ADDING OF DATA TO TABLE
		while($row = mysqli_fetch_assoc($select_customer)) {

			
			$cust_id = $row['cust_id'];
			$cfname = $row['cust_fname'];
			$clname = $row['cust_lname'];
			$caddr1 = $row['cust_address'];
			$caddr2 = $row['cust_address2'];
			$caddr3 = $row['cust_city'];
			$caddr4 = $row['cust_prov'];
			$ctel = $row['cust_cpnum'];
			$cemail = $row['cust_email'];
			$caddr=$caddr1." ".$caddr2." ".$caddr3.", ".$caddr4;
			
			$statquery = "SELECT * FROM customerlogins WHERE cust_id = '$cust_id'";
			$result = mysqli_query($connection, $statquery);
							
			while($row = mysqli_fetch_assoc($result)) {
									
				$cust_status = $row['cust_status'];
			}
			
			//check if cust have rent history
			$rentquery = "SELECT * FROM car_cash_inventory WHERE cust_id = '$cust_id'";
			$rentresult = mysqli_query($connection, $rentquery);
			$count = mysqli_num_rows($rentresult);
			
	
			echo "<tr>";
			echo "<td>{$cfname}</td>";
			echo "<td>{$clname}</td>";
		
			echo "<td>{$caddr}</td>";
			echo "<td>{$ctel}</td>";
			echo "<td>{$cemail}</td>";
			echo "<td><strong>{$cust_status}</strong></td>";
			// add this button to view specific customer history and info
			if($cust_status == "APPROVED" AND $count > 0) {
				echo "<td><center><a href='8drivemodal/custhistoryrent.php?cust_id={$cust_id}'>History</a></center></td>";
			} else {
				echo "<td><center><a href=''>No History</a></center></td>";
			}
			//echo "<td><a href='carList.php?delete={$carid}'>Delete</a></td>";
			//echo "<td><a href='carList.php?edit={$carmodel}'>Edit</a></td>";
		
		echo "</tr>";
		
		
		
		}
		
	?>
	<?php/*
		global $connection;
		if(isset($_GET['delete'])) {

        $the_car_id = $_GET['delete'];
		//echo $the_car_id;
        $query = "DELETE FROM cardetail WHERE car_id = {$the_car_id}";
        $delete_query = mysqli_query($connection, $query);
        
        //refresh page
        header("Location: carList.php");
		}*/
	?>
	
	
	
	<!--12/01-->
	<?php //Update and Include Query
        //if(isset($_GET['edit'])) {
                            
            //$car_id = $_GET['edit'];
            //include "updateCarInfo.php";
			
       // }
    ?>
		
		
	</tbody>
	
	
	 <!-- page end-->
      </section>
    </section>
    <!--main content end-->
	
	<?php include "8driveAdmin.php"; ?>

      