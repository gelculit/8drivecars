<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>

<?php	
$sw = $_GET['sw'];
$brsw = 0;
	if($sw == 1) {
		$brsw = 1;
		$query = "SELECT * FROM carseason";
		$select_season = mysqli_query($connection, $query);
		
		while($row = mysqli_fetch_assoc($select_season)) {
			
			$cpay = $row['car_season'];
			//$cstat = $row['carseason_stat'];
			
			if($cpay == "Peak Season Pricing") {
				$cpay = "Lean Season Pricing";
			} else {
				$cpay = "Peak Season Pricing";
			}
			
			$query = "UPDATE carseason SET car_season = '{$cpay}'";
        
			$update_post = mysqli_query($connection, $query);
        
			if(!$update_post) {
				die("Query Failed " . mysqli_error($connection));
			}
		
		}	
		
	}	

	//header("Location: carprice.php");
	$sw = 0;

?>	

<!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
		  <?php
			if ($brsw == 1) {
				echo "<br><br>";
				$brsw = 0;
			}
		  ?>
            <h3 class="page-header"> Price Season Maintenance</h3>
            
          </div>
        </div>


<table class="table table-bordered table-hover">
    <thead>
       <tr>
           <th>Current Selected Season</th>
           <th>Change?</th>
          
       </tr> 
    </thead>

    <tbody>
	
	<?php
	$query = "SELECT * FROM carseason";
	$select_season = mysqli_query($connection, $query);

	// ***ACTUAL ADDING OF DATA TO TABLE
	while($row = mysqli_fetch_assoc($select_season)) {

		$cpay = $row['car_season'];
		//$cstat = $row['carseason_stat'];
		//$cpaycur = $cpay;
		//if($cstat == "cur") {

			echo "<tr>";
		
			echo "<td>{$cpay}</td>";

			//***Add a DELETE button to enable deleting
			echo "<td><a href='carprice.php?sw=1' class='btn btn-warning' type='submit' name='submit'>Change Pricing Option</a></td>";
			echo "<td><a href='index.php' class='btn btn-danger' type='submit' name='submit'>Back to Dashboard</a></td>";
			echo "</tr>";
		//}
		
		
	}
	
	?>


	</tbody>
	
	
	 <!-- page end-->
      </section>
    </section>
    <!--main content end-->
	
	
	
	
	<?php include "8driveAdmin.php"; ?>

