<?php include "../../8driveAdmin/db.php"; ?>


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
	$upsw = 0;
?>



<?php  
	/*This passes the car id from pickavailable */
	$loginsw = $_GET['logsw']; //&logsw={$loginsw}
	$car_id = $_GET['carid'];  
	$cardesc = $_GET['cardesc'];
	$cartrans = $_GET['cartrans'];
	$carcapacity = $_GET['carcap'];
	$carmodel = $_GET['carmodel'];
	$cdrive = $_GET['wdrive'];
	$indate = $_GET['begdate'];
	$retdate = $_GET['retdate'];
	$cardayratepeak = $_GET['totalrate'];
	$custfname = $_GET['fname'];
	$custlname = $_GET['lname'];
	$cust_id = $_GET['custid'];
	$cdrive = $_GET['wdrive'];
	$residency = $_GET['residence']; // --> 02/06
	$passwordsw = $_GET['ispassword'];
	//$airportpick = $_GET['airpick'];
	//$airdetail = $_GET['airdetail'];
	
	
	//ispassword={$passwordsw}&   $passwordsw = $_GET['ispassword'];
	
?>

<?php 
//********************* 
		$custQuery = "SELECT * FROM customerinfo";
		$select_cust_by_id = mysqli_query($connection, $custQuery);

		//this was done in register.php. check if it is redundant and will need to be removed...
		while ($row = mysqli_fetch_assoc($select_cust_by_id)) {
			if($row['cust_fname'] == $custfname AND $row['cust_lname'] == $custlname ) {
				$cust_id = $row['cust_id'];
				//echo $cust_id;
			}
		}
		
		//***reminder: get login info and insert along with doc here!!
		if(isset($_POST['create_docs'])) {
			//$residency = $_POST['residency']; // --> 02/06
			$doc1 = $_FILES['docone']['name'];
			$post_image_temp1 = $_FILES['docone']['tmp_name'];
			$doc2 = $_FILES['doctwo']['name'];
			$post_image_temp2 = $_FILES['doctwo']['tmp_name'];
			$doc3 = $_FILES['docthree']['name'];
			$post_image_temp3 = $_FILES['docthree']['tmp_name'];
			$doc4 = $_FILES['docfour']['name'];
			$post_image_temp4 = $_FILES['docfour']['tmp_name'];
			$doc5 = $_FILES['docfive']['name'];
			$post_image_temp5 = $_FILES['docfive']['tmp_name'];
			$doc6 = $_FILES['docsix']['name'];
			$post_image_temp6 = $_FILES['docsix']['tmp_name'];
			
			$docempty = 0;
			
			if(!empty($doc1) OR !empty($doc2) OR !empty($doc3)) {
				$docempty = 1;
				
				move_uploaded_file($post_image_temp1, "docimage/$doc1");
				move_uploaded_file($post_image_temp2, "docimage/$doc2");
				move_uploaded_file($post_image_temp3, "docimage/$doc3");
				move_uploaded_file($post_image_temp4, "docimage/$doc4");
				move_uploaded_file($post_image_temp5, "docimage/$doc5");
				move_uploaded_file($post_image_temp6, "docimage/$doc6");
			}
			
			
			/***update database with docs and residency status***/
			$custQuery = "SELECT customerlogins";
			$custQuery = "UPDATE customerlogins SET ";
			
				$custQuery .= "cust_doc1 = '{$doc1}', ";
				$custQuery .= "cust_doc2 = '{$doc2}', ";
				$custQuery .= "cust_doc3 = '{$doc3}', ";
				$custQuery .= "cust_doc4 = '{$doc4}', ";
				$custQuery .= "cust_doc5 = '{$doc5}', ";
				$custQuery .= "cust_doc6 = '{$doc6}', ";
				$custQuery .= "cust_residency = '{$residency}' ";
				$custQuery .= "WHERE cust_id = {$cust_id} ";
			
				$update_query = mysqli_query($connection, $custQuery);
			
				if(!$update_query) {
					die("Query Failed " . mysqli_error($connection));
				}
			
			header("location: picktripdetails.php?ispassword={$passwordsw}&residence={$residency}&carid={$car_id}&carmodel={$carmodel}&cardesc={$cardesc}&cartrans={$cartrans}&carcap={$carcapacity}&wdrive={$cdrive}&begdate={$indate}&retdate={$retdate}&upload=0&totalrate={$cardayratepeak}&fname={$custfname}&lname={$custlname}&custid={$cust_id}&wdrive={$cdrive}&logsw={$loginsw}"); 
	
			
				$upsw = 1;
			
			
			
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
									echo "<form action='pickuploaddocs2.php?ispassword={$passwordsw}&residence={$residency}&carid={$car_id}&carmodel={$carmodel}&cardesc={$cardesc}&cartrans={$cartrans}&carcap={$carcapacity}&wdrive={$cdrive}&begdate={$indate}&retdate={$retdate}&upload=0&totalrate={$cardayratepeak}&fname={$custfname}&lname={$custlname}&custid={$cust_id}&wdrive={$cdrive}&logsw={$loginsw}' method='post' enctype='multipart/form-data' class='tm-search-form tm-section-pad-2'>";
								?>
								
								<h6 class="text-center"><strong>ALMOST THERE... Please upload photos of required documents for approval.</strong></h6>
								<hr>
								<!--
								<p><strong>NOTE:</strong><br>
								<strong>For Philippine residents:</strong> 2 government issued id's with photo and residential address, billing statement under your name or under your parents', siblings' or relatives' name.<br><br>
								<strong>For non-Philippine residents: </strong>Copy of itinerary, passport and driver's license. 
										</p> <hr>--> 
								
								
								<div class="form-row tm-search-form-row"> 							
									<div class="form-group tm-form-group tm-form-group-3">                                    
										<label for="inputAdult">Residency Status</label>     
										<p><strong><?php echo $residency; ?></strong></p>
									</div>
								</div>

								<!-- upload documents depending on residency-->
								<?php  
									if($residency == "Philippine Resident") { ?>
									
								<hr>
								<p><strong>Please upload required documents for Philippine residents</strong>
								</p>
								
								<div class="form-row tm-search-form-row">
									<div class="form-row tm-search-form-row">
						
										<div class="form-group tm-form-group tm-form-group-pad tm-form-group-2">
											<label for="inputCity">Driver's Liscense</label>
											<input name="docone" type="file">
										</div>
						
									</div>	

									<div class="form-row tm-search-form-row">
						
										<div class="form-group tm-form-group tm-form-group-pad tm-form-group-2">
											<label for="inputCity">Proof of Income</label>
											<input name="doctwo" type="file">
										</div>
						
									</div>
								</div>
					
								<div class="form-row tm-search-form-row">
						
									<div class="form-group tm-form-group tm-form-group-pad tm-form-group-3">
										<label for="inputCity">Proof of Residency</label>
										<input name="docthree" type="file">
									</div>
						
								</div>
								
								
								
								<?php } else {?>
								
								<hr>
								<p><strong>Please upload required documents for Non-Philippine residents</strong>
								</p>
								
								<div class="form-row tm-search-form-row">
									<div class="form-row tm-search-form-row">
						
										<div class="form-group tm-form-group tm-form-group-pad tm-form-group-2">
											<label for="inputCity">Driver's Liscense</label>
											<input name="docone" type="file">
										</div>
						
									</div>	

									<div class="form-row tm-search-form-row">
						
										<div class="form-group tm-form-group tm-form-group-pad tm-form-group-2">
											<label for="inputCity">Passport</label>
											<input name="doctwo" type="file">
										</div>
						
									</div>
								</div>
					
								<div class="form-row tm-search-form-row">
						
									<div class="form-group tm-form-group tm-form-group-pad tm-form-group-3">
										<label for="inputCity">Itinerary</label>
										<input name="docthree" type="file">
									</div>
						
								</div>
								
								
								<?php } ?>
								
								<hr>
								<p><strong>Upload supporting documents if any</strong>
								</p>
								<div class="form-row tm-search-form-row">
									<div class="form-row tm-search-form-row">
						
										<div class="form-group tm-form-group tm-form-group-pad tm-form-group-2">
											<label for="inputCity">Supporting Doc 1</label>
											<input name="docfour" type="file">
										</div>
						
									</div>	

									<div class="form-row tm-search-form-row">
						
										<div class="form-group tm-form-group tm-form-group-pad tm-form-group-2">
											<label for="inputCity">Supporting Doc 2</label>
											<input name="docfive" type="file">
										</div>
						
									</div>
								</div>
					
								<div class="form-row tm-search-form-row">
						
									<div class="form-group tm-form-group tm-form-group-pad tm-form-group-3">
										<label for="inputCity">Supporting Doc 3</label>
										<input name="docsix" type="file">
									</div>
						
								</div>
										
										<!------------->
								
								<!---EDIT or CONFIRM buttons-->
								<?php
								//if ($upsw == 0) {
									
									echo	"<button type='submit' name='create_docs' role='button' class='btn btn-warning tm-btn tm-btn-search text-uppercase'>Submit</button>";
								//} else {
									//if($docempty == 0) {
									//	echo "<h6  class='text-center'><strong>You have opted not to upload documents for now...</strong></h6>";
									//}
									//echo "<a href='picktripdetails.php?carid={$car_id}&carmodel={$carmodel}&cardesc={$cardesc}&cartrans={$cartrans}&carcap={$carcapacity}&wdrive={$cdrive}&begdate={$indate}&retdate={$retdate}&totalrate={$cardayratepeak}&custid={$cust_id}&wdrive={$cdrive}&logsw={$loginsw}' role='button' class='btn btn-warning tm-btn tm-btn-search text-uppercase'>click here for next step.</a>";
								//&docempty={$docempty}
								//} 
								?>
							</form>  		
                                    
                           </div> <!-- row -->
                        <div class="tm-banner-overlay"></div>
						<br><br><br><br><br><br><br><br>
                        
                    </div>  <!-- .container -->                   
                </div>     <!-- .tm-container-outer -->                 
            </section>     <!-- .tm-container-outer  --> 

<?php include "pickavailablefooter.php"; ?>
