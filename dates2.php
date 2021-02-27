<?php
global $count, $query;

	
if(isset($_POST['submit'])) {
	echo '<h2>Found</h2>';
	$textdatestart=$_POST['textdatestart'];
	echo $textdatestart;
	$textdatestop=$_POST['textdatestop'];
	echo $textdatestop;
	
	$dateq = "SELECT * FROM addemp WHERE joindate BETWEEN '$textdatestart' AND '$textdatestop' ORDER BY joindate";
	$query = mysqli_query($connection, $dateq);

	$count = mysqli_num_rows($query);
	
	
}
if($count == 0) {
			echo '<h2>Not Found</h2>' . $count;
} else {
	
			while($row = mysqli_fetch_array($query)) {
				$result = $row['empname'];
				echo '<h2>'.$result.'</h2>';
				
			}
		} 	
		
?>