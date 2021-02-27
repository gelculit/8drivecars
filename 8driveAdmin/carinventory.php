<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>

		



<!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"> Car Inventory Maintenance</h3>
            
          </div>
        </div>


<table class="table table-bordered table-hover  table-striped table-condensed">
    <thead>
       <tr>
           <th><center>Model</center></th>
           <th><center>Description</center></th>
           <th><center>Image</center></th>
           <th><center>Capacity</center></th>
           <th><center>Transmission Type</center></th>
		    <th><center>Check Rent History</center></th>
           <th><center>Edit Status</center></th>
		   <!--<th>Status</th>
           <th>Edit</th>
           <th>Delete</th>-->
       </tr> 
    </thead>

    <tbody>
	
	<?php
	
		//global $connection;
		$query = "SELECT * FROM cardetail";
		$select_carList = mysqli_query($connection, $query);

		// ***ACTUAL ADDING OF DATA TO TABLE
		while($row = mysqli_fetch_assoc($select_carList)) {

			
			$carid = $row['car_id'];
			$cardesc = $row['car_desc'];
			$carmodel = $row['car_model'];
			$carimage = $row['car_image'];
			$carcapacity = $row['car_capacity'];
			$cartrans = $row['car_trans'];
			$cardiy = $row['car_diy'];
			$carstatus = $row['car_rentstatus'];
			
			//check if cust have rent history
			$rentquery = "SELECT * FROM car_cash_inventory WHERE car_id = '$carid'";
			$rentresult = mysqli_query($connection, $rentquery);
			$count = mysqli_num_rows($rentresult);
		
	
			echo "<tr>";
			echo "<td><center>{$carmodel}</center></td>";
			echo "<td><center>{$cardesc}</center></td>";
			echo "<td><center><img width='100'  src='images/$carimage' alt='image'></center></td>";
			echo "<td><center>{$carcapacity} seater</center></td>";
			echo "<td><center>{$cartrans}</center></td>";
			if($count > 0) {
				echo "<td><center><a href='8drivemodal/carhistoryrent.php?carid={$carid}'>Check History</a></center></td>";
			} else {
				echo "<td><center><a href='#'>No History</a></center></td>";
			}
			echo "<td><center><a href='8drivemodal/carinventorymaint.php?carid={$carid}' class='btn btn-info btn-sm' type='submit' name='submit'>{$carstatus}</a></center></td>";
							
			
		
		echo "</tr>";
		
		
		
		}
		
	?>
	<?php
		global $connection;
		if(isset($_GET['delete'])) {

        $the_car_id = $_GET['delete'];
		//echo $the_car_id;
        $query = "DELETE FROM cardetail WHERE car_id = {$the_car_id}";
        $delete_query = mysqli_query($connection, $query);
        
        //refresh page
        header("Location: carList.php");
		}
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

      