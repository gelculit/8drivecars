
	<?php
	$sw = $_GET['sw'];
	
	if($sw == 1) {
	echo "dumaan dito";
		$query = "SELECT * FROM carseason";
		$select_season = mysqli_query($connection, $query);
		
		while($row = mysqli_fetch_assoc($select_season)) {
			
			$cpay = $row['car_season'];
			$cstat = $row['carseason_stat'];
			
			if($cstat = "cur") {
				$cstat = " ";
			} else {
				$cstat = "cur";
			}
			
			$query = "UPDATE carseason SET car_season = '{$cpay}', carseason_stat = '{$cstat}'";
        
			$update_post = mysqli_query($connection, $query);
        
			if(!$update_post) {
				die("Query Failed " . mysqli_error($connection));
			}
		
		}	
		
	}	

	//header("Location: carprice.php");
	?>
		
		

	
	
	
	
	
	?>
	