<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>




<!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-files-o"></i> Chauffered Service Destination Table</h3>
            
          </div>
        </div>


     <div class="col-xs-6">

        <!-- Add Category Form -->
         <?php //insert_categories(); ?><!--******Insert/add categories-->
		 
		 
		 <?php
		 if(isset($_POST['submit'])) {

			$query = "SELECT * FROM manila_to";

			$des_title = $_POST['des_title'];
       
			if($des_title == "" || empty($des_title)) {
				echo "Field should not be empty";
			} else {

				$query = "INSERT INTO manila_to(mnl_to_where) VALUE('{$des_title}')";

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
                <input class="btn btn-primary" type="submit" name="submit" value="Add Destination">
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
           <th>Metro Manila to: </th>
           <th>Delete </th>
       </tr> 
    </thead>

    <tbody>
	
	<!---*******************List all destinations-->
	<?php
	$query = "SELECT * FROM manila_to";
	$select_categories = mysqli_query($connection, $query);

	// ***ACTUAL ADDING OF DATA TO TABLE
	while($row = mysqli_fetch_assoc($select_categories)) {

		$des_id = $row['mnl_to_id'];
		$des_title = $row['mnl_to_where'];

		echo "<tr>";
		
		echo "<td>{$des_title}</td>";

		//***Add a DELETE button to enable deleting
		echo "<td><a href='chaufDestination.php?delete={$des_id}'>Delete</a></td>";

		echo "</tr>";
		
		$des_id = "";
		$des_title = "";
	}
	?>
	
	<!---*******************List all destinations-->
		
		
	<!--********************DELETE function-->
	
	<?php
		global $connection;
		if(isset($_GET['delete'])) {

        $destination_id = $_GET['delete'];
		//echo $the_car_id;
        $query = "DELETE FROM manila_to WHERE mnl_to_id = {$destination_id}";
        $delete_query = mysqli_query($connection, $query);
        
        //refresh page
        header("Location: chaufDestination.php");
		}
	?>
	
	
	<!--********************DELETE function-->
		
	</tbody>
	
	
	 <!-- page end-->
      </section>
    </section>
    <!--main content end-->
	
	
	<?php include "8driveAdmin.php"; ?>

      