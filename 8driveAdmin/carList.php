<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>

		



<!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"> View All / Maintenance</h3>
            
          </div>
        </div>


<table class="table table-bordered table-hover table-striped table-condensed">
    <thead>
       <tr>
           <th>Model</th>
           <th>Description</th>
           <th>Image</th>
           <th>Capacity</th>
           <th>Transmission Type</th>
           <th>DIY</th>
		   <!--<th>Status</th>-->
           <th>Edit</th>
           <th>Delete</th>
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
		
	
			echo "<tr>";
			echo "<td>{$carmodel}</td>";
			echo "<td>{$cardesc}</td>";
			echo "<td><img width='100'  src='images/$carimage' alt='image'></td>";
			echo "<td>{$carcapacity} seater</td>";
			echo "<td>{$cartrans}</td>";
			echo "<td>{$cardiy}</td>";
			//echo "<td>{$carstatus}</td>";
			
			echo "<td><a href='updateCarInfo.php?edit={$carid}'>Edit</a></td>";
			echo "<td><a href='carList.php?delete={$carid}'>Delete</a></td>";
			//echo "<td><a href='carList.php?edit={$carmodel}'>Edit</a></td>";
		
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

      