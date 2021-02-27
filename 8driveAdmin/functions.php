<?php  

function confirmQuery($result) {
     global $connection;
    if(!$result) {
        
        die("QUERY FAILED ." . mysqli_error($connection));
    }
    
}



function deleteCars() {
		global $connection;
		if(isset($_GET['delete'])) {

        $the_car_id = $_GET['delete'];
		//echo $the_car_id;
        $query = "DELETE FROM cardetail WHERE car_model = {$the_car_id}";
        $delete_query = mysqli_query($connection, $query);
        
        //refresh page
        header("Location: carList.php");
		}
}