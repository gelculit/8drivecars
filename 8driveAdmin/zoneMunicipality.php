<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>


<?php 
$zone_id = $_GET['zoneid'];
$zone_city = $_GET['cityname'];

?>

<?php
	if(isset($_POST['submit'])) {
		$zone_fee = $_POST['mun_fee'];
		$mun_title = $_POST['des_title'];
				
		$query = "SELECT * FROM zone_municipality";

		if($mun_title == "" || empty($mun_title)) {
			echo "Field should not be empty";
		} else {

		$query = "INSERT INTO zone_municipality(zone_ct_id, zone_municipal, zone_fee) VALUE('{$zone_id}', '{$mun_title}', '{$zone_fee}' )";

		$create_category_query = mysqli_query($connection, $query);

		//check if query is successful!!!
			if(!$create_category_query) {

				die('Query Failed' . mysqli_error($connection));

			}
		}
		
		
		
	}
		 
 ?>
 
 <!--********************DELETE function-->
			
<?php
	global $connection;
	if(isset($_GET['delete'])) {

		$mun_id = $_GET['delete'];
		$query = "DELETE FROM zone_municipality WHERE zone_mun_id = {$mun_id}";
		$delete_query = mysqli_query($connection, $query);
					
		//refresh page
		header("Location: zoneMunicipality.php?zoneid={$zone_id}&cityname={$zone_city}");
	}
?>

 
 <!--********************EDIT function-->
			
<?php
	global $connection;
	if(isset($_GET['edit'])) {

					
		//refresh page
		header("Location: zoneMunicipality.php?zoneid={$zone_id}&cityname={$zone_city}");
	}
?>



<!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
			 <div class="col-lg-12">
				<h3 class="page-header"><i class="fa fa-files-o"></i><strong><?php echo $zone_city; ?></strong> Zone Maintainance Table</h3>
				
			 </div>
        </div>


		<div class="col-xs-6">
	 
			<div class="container">
				<?php
					echo "<form action='zoneMunicipality.php?zoneid={$zone_id}&cityname={$zone_city}' method='post'>";
				?>
					
					<div class="row">
						<div class="col-lg-6 col-md-4 col-xs-6 thumb">
							<label for="cat-title">Add a delivery point </label>
							<input type="text" class="form-control"  placeholder="Municipality" name="des_title">
						</div>
					
						<div class="col-lg-3 col-md-4 col-xs-6 thumb">
							<label for="cat-title">Add fee</label>
							<input type="text" class="form-control"  placeholder="700" name="mun_fee">
						</div>
					
					</div>
					<br>
					<div>
						<label for="cat-title">&nbsp;</label>
						<input class="btn btn-primary" type="submit" name="submit" value="Submit">
						<br><br>
					</div>
					
					
					
					
				</form><!-- /.Add Category Form -->
								
			</div>                   
						
							
		</div><!-- /.col-xs-6 -->


		<table class="table table-bordered table-hover table-striped table-condensed">
			<thead>
			   <tr>
				   <th>Pick up point Municipality </th>
				   <th>Deliver Fee </th>
				   <th>Edit </th>
				   <th>Delete </th>
			   </tr> 
			</thead>

			<tbody>
			
			<!---*******************List all destinations-->
			<?php
			$query = "SELECT * FROM zone_municipality WHERE zone_ct_id = '$zone_id'";
			$select_categories = mysqli_query($connection, $query);

			// ***ACTUAL ADDING OF DATA TO TABLE
			while($row = mysqli_fetch_assoc($select_categories)) {

				$mun_title = $row['zone_municipal'];
				$mun_fee = $row['zone_fee'];
				$mun_id = $row['zone_mun_id'];

				echo "<tr>";
				
				echo "<td>{$mun_title}</td>";
				echo "<td>{$mun_fee}</td>";
				
				echo "<td><a href='zoneMunicipality.php?zoneid={$zone_id}&cityname={$zone_city}' class='btn btn-primary'>Edit</a></td>";


				//***Add a DELETE button to enable deleting
				echo "<td><a href='zoneMunicipality.php?delete={$mun_id}&zoneid={$zone_id}&cityname={$zone_city}' class='btn btn-danger'>Delete</a></td>";
				
				echo "</tr>";
				
				$des_id = "";
				$des_title = "";
			}
			?>
			
			<!---*******************List all destinations-->
				
				
			
				
			</tbody>
		</table>
		
		<div class="col-lg-4">
			<a href="zoneDestination.php" role="button" class="btn  btn-primary">Back to City Information List</a>
		</div>
	
	 <!-- page end-->
      </section>
    </section>
    <!--main content end-->
	
	
	<?php include "8driveAdmin.php"; ?>

      