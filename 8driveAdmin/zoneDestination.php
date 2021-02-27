<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>


		
	<!--********************DELETE function-->
	
	<?php
		global $connection;
		if(isset($_GET['delete'])) {

        $destination_id = $_GET['delete'];
        $query = "DELETE FROM zone_city WHERE zone_id = {$destination_id}";
        $delete_query = mysqli_query($connection, $query);
        
        //refresh page
        header("Location: zoneDestination.php");
		}
	?>

<!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-files-o"></i> Zone Maintainance Table</h3>
            
          </div>
        </div>


     <div class="col-xs-6">

        <!-- Add Category Form -->
         <?php //insert_categories(); ?><!--******Insert/add categories-->
		 
		 
		 <?php
		 if(isset($_POST['submit'])) {

			$query = "SELECT * FROM zone_city";

			$des_title = $_POST['des_title'];
       
			if($des_title == "" || empty($des_title)) {
				echo "Field should not be empty";
			} else {

				$query = "INSERT INTO zone_city(zone_ct) VALUE('{$des_title}')";

				$create_category_query = mysqli_query($connection, $query);

				//check if query is successful!!!
				if(!$create_category_query) {

					die('Query Failed' . mysqli_error($connection));

				}
			}
		}
		 
		 ?>
		 

        <form action="" method="post">
			
            <div class="form-group">
                <label for="cat-title">Add a destination </label>
				<input type="text" class="form-control"  placeholder="destination" name="des_title">
            </div>
			
            <div class="form-group">
                <input class="btn btn-primary" type="submit" name="submit" value="Submit">
				<br><br>
            </div>
			
        </form><!-- /.Add Category Form -->
                      
    </div><!-- /.col-xs-6 -->


<table class="table table-bordered table-hover table-striped table-condensed">
    <thead>
       <tr>
           <th>Pick up point City </th>
		   <th>Get Zone Info </th>
           <th>Delete </th>
		   
       </tr> 
    </thead>

    <tbody>
	
	<!---*******************List all destinations-->
	<?php
	$query = "SELECT * FROM zone_city";
	$select_categories = mysqli_query($connection, $query);

	// ***ACTUAL ADDING OF DATA TO TABLE
	while($row = mysqli_fetch_assoc($select_categories)) {

		$des_id = $row['zone_id'];
		$des_title = $row['zone_ct'];

		echo "<tr>";
		
		echo "<td>{$des_title}</td>";
		
		echo "<td><a href='zoneMunicipality.php?zoneid={$des_id}&cityname={$des_title}' class='btn btn-primary'>Select</a></td>";


		//***Add a DELETE button to enable deleting
		echo "<td><a href='zoneDestination.php?delete={$des_id}' class='btn btn-danger'>Delete</a></td>";
		
		echo "</tr>";
		
		$des_id = "";
		$des_title = "";
	}
	?>
	
	<!---*******************List all destinations-->
		


		
	</tbody>
</table>
	
	
	 <!-- page end-->
      </section>
    </section>
    <!--main content end-->
	
	
	<?php include "8driveAdmin.php"; ?>

      