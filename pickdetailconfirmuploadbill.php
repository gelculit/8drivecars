<?php include "../../8driveAdmin/db.php"; ?>



<?php 
$cust_id = $_GET['custid'];
$date = date('Y-m-d'); //compare with custrentinfo -> cust_reserve_date

$custQuery = "SELECT * FROM custrentinfo WHERE cust_id = $cust_id";
$select_cust_by_id = mysqli_query($connection, $custQuery);
//$count = mysqli_num_rows($select_cust_by_id);
//echo $count;

	while ($row = mysqli_fetch_assoc($select_cust_by_id)) {
		$cdate = $row['cust_reserve_date'];
		$nowdate = strtotime($date);
		$tabledate = strtotime($cdate);
		if($nowdate == $tabledate) {
			$trans_id = $row['car_trans_id'];
			
		}
	}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Make A Reservation</title>
<!-- 
Journey Template 
http://www.templatemo.com/tm-511-journey
-->
    <!-- load stylesheets -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">  <!-- Google web font "Open Sans" -->
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">                <!-- Font Awesome -->
    <link rel="stylesheet" href="css/bootstrap.min.css">                                      <!-- Bootstrap style -->
    <link rel="stylesheet" type="text/css" href="css/datepicker.css"/>
    <link rel="stylesheet" href="css/templatemo-style.css">                                   <!-- Templatemo style -->
      </head>

      <body>
<?php 
	
?>



<?php  
	
?>

<?php 

		
		//***reminder: get login info and insert along with doc here!!
		if(isset($_POST['create_docs'])) {
			
			$doc1 = $_FILES['docone']['name'];
			$post_image_temp1 = $_FILES['docone']['tmp_name'];
			
			if(!empty($doc1)) {
				move_uploaded_file($post_image_temp1, "docimage/$doc1");
			}
			
			
			/***update database with docs and residency status***/
			$custQuery = "SELECT custrentinfo";
			$custQuery = "UPDATE custrentinfo SET ";
			
				$custQuery .= "cust_bill_status = '{$doc1}' ";
				$custQuery .= "WHERE car_trans_id = {$trans_id} ";
			
				$update_query = mysqli_query($connection, $custQuery);
			
				if(!$update_query) {
					die("Query Failed " . mysqli_error($connection));
				}
			
			header("location: ../index.php"); 
	
		}
//*********************
?>
	  
	  <div class="tm-page-wrap mx-auto">
            <section class="tm-banner">
                <div class="tm-container-outer tm-banner-bg">
                    <div style="background: url(img/about-bg.jpg) center top no-repeat; background-attachment: fixed;" class="container">
						<div class="row tm-banner-row" id="tm-section-search">
							<!--<form action="pickavailable.php" method="get" class="tm-search-form tm-section-pad-2">-->
							
								<?php
									echo "<form action='pickdetailconfirmuploadbill.php?custid={$cust_id}' method='post' enctype='multipart/form-data' class='tm-search-form tm-section-pad-2'>";
								?>
								
								<h6 class="text-center"><strong>Please Upload Your Proof of Payment.</strong></h6>
								<hr>
								<br>
								<div class="form-row tm-search-form-row">
						
										<div class="form-group tm-form-group tm-form-group-pad tm-form-group-2">
											<label for="inputCity">Driver's Liscense</label>
											<input name="docone" type="file">
										</div>
										
								</div>
								
								<label for="btnSubmit">&nbsp;</label>
								<button type='submit' name='create_docs' role='button' class='btn btn-warning tm-btn tm-btn-search text-uppercase'>All Done</button>
										
					
								
							</form>  		
                                    
                           </div> <!-- row -->
                        <div class="tm-banner-overlay"></div>
						<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                        
                    </div>  <!-- .container -->                   
                </div>     <!-- .tm-container-outer -->                 
            </section>     <!-- .tm-container-outer  --> 

<?php include "pickavailablefooter.php"; ?>
