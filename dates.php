<?php 

include "../../8driveAdmin/db.php";


global $count, $query;

	
if(isset($_POST['submit'])) {
	echo '<h2>Found</h2>';
	$textdatestart=$_POST['textdatestart'];
	echo $textdatestart;
	$textdatestop=$_POST['textdatestop'];
	echo $textdatestop;
	
	$dateq = "SELECT * FROM addemp WHERE joindate BETWEEN '$textdatestart' AND '$textdatestop' ";
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




<!DOCTYPE html>
<html>
<head>
<center>
<h1>PHP How To Find Records Between Date Range</h1>
<hr/>
</head>
<body>
	<form action="dates.php">
		<input type="date" name="textdatestart">
	    <input type="date" name="textdatestop">
		<p>
			<input type="submit" name="submit" value="submit!!">
		</p>
		
	</form>
<?php 



?>

	
</center>
</body>
</html>