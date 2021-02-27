<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>

chaufcar_type  --> carseat_type


<!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-files-o"></i> Chauffered Service Car-Seater Table</h3>
            
          </div>
        </div>


     <div class="col-xs-6">

        <!-- Add Category Form -->
         <?php //insert_categories(); ?><!--******Insert/add categories-->
		 
		 
		 <?php
		 if(isset($_POST['submit'])) {

			$query = "SELECT * FROM chaufcar_type";

			$carseater = $_POST['car_seat'];
       
			if($carseater == "" || empty($carseater)) {
				echo "Field should not be empty";
			} else {

				$query = "INSERT INTO chaufcar_type(carseat_type) VALUE('{$carseater}')";

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
                <label for="cat-title">Add a car type </label>
				<input type="text" class="form-control"  placeholder="Car Type / Capacity" name="car_seat">
            </div>
			
            <div class="form-group">
                <input class="btn btn-primary" type="submit" name="submit" value="Add Type / Seater">
            </div>
        </form><!-- /.Add Category Form -->
                        
                        
                     <?php //Update and Include Query
                        //if(isset($_GET['edit'])) {
                            
                            //$cat_id = $_GET['edit'];
                            //include "includes/update_categories.php";
                        //}
                      ?>
                        
                        
    </div><!-- /.col-xs-6 -->


<table class="table table-bordered table-hover">
    <thead>
       <tr>
           <th>Car Type / Sitting Capacity: </th>
           <th>Delete </th>
       </tr> 
    </thead>

    <tbody>
	
	<!---*******************List all destinations-->
	<?php
	$query = "SELECT * FROM chaufcar_type";
	$select_cartypes = mysqli_query($connection, $query);

	// ***ACTUAL ADDING OF DATA TO TABLE
	while($row = mysqli_fetch_assoc($select_cartypes)) {

		$car_id = $row['carseat_id'];
		$car_title = $row['carseat_type'];

		echo "<tr>";
		
		echo "<td>{$car_title}</td>";

		//***Add a DELETE button to enable deleting
		echo "<td><a href='chaufCarType.php?delete={$car_id}'>Delete</a></td>";

		echo "</tr>";
		
	}
	?>
	
	<!---*******************List all destinations-->
	
		
	<!--********************DELETE function-->
	
	<?php
		global $connection;
		if(isset($_GET['delete'])) {

        $destination_id = $_GET['delete'];
		//echo $the_car_id;
        $query = "DELETE FROM chaufcar_type WHERE carseat_id = {$destination_id}";
        $delete_query = mysqli_query($connection, $query);
        
        //refresh page
        header("Location: chaufCarType.php");
		}
	?>
	
	
	<!--********************DELETE function-->
		
	</tbody>
	
	
	 <!-- page end-->
      </section>
    </section>
    <!--main content end-->
	
	
	<?php include "8driveAdmin.php"; ?>

      