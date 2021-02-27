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
	$swopt1 = "Primary";
	$swopt2 = "Additional";
    $swopt3 = "Payment";
	
	$cust_fname = $_GET['cust_fname'];
	$cust_bill_status = $_GET['cust_bill_status'];
	$notemptybill = $_GET['notemptybill'];
	$notempty = $_GET['notempty'];
	$notemptysup = $_GET['notemptysup'];
	$loginsw = $_GET['logsw'];
	$cust_id = $_GET['custid'];
	$cust_doc1 = $_GET['cust_doc1'];
	$cust_doc2 = $_GET['cust_doc2'];
	$cust_doc3 = $_GET['cust_doc3'];
	$cust_doc4 = $_GET['cust_doc4'];
	$cust_doc5 = $_GET['cust_doc5'];
	$cust_doc6 = $_GET['cust_doc6'];
	$cust_residency = $_GET['cust_residency'];
	$cust_status = $_GET['cust_status'];
	
	if(isset($_POST['selectoption'])) {
		$whatoption = $_POST['upload'];
		
		switch ($whatoption) {
			case $swopt1:
				header("location: ../pickavailability/8driveuploads/uploadprimary.php?logsw={$loginsw}&notempty={$notempty}&custid={$cust_id}&cust_doc1={$cust_doc1}&cust_doc2={$cust_doc2}&cust_doc3={$cust_doc3}&cust_status={$cust_status}&cust_residency={$cust_residency}");
				break;
			
			case $swopt2:
				header("location: ../pickavailability/8driveuploads/uploadadditional.php?logsw={$loginsw}&custid={$cust_id}&cust_doc4={$cust_doc4}&cust_doc5={$cust_doc5}&cust_doc6={$cust_doc6}&cust_status={$cust_status}");
				break;
			 
			case $swopt3:
				header("location: ../pickavailability/8driveuploads/uploadpayment.php?logsw={$loginsw}&notemptybill={$notemptybill}&custid={$cust_id}&cust_bill_status={$cust_bill_status}");
				break;
			
			default:
				header("location: ../pickavailability/logincheckdocs.php?logsw={$loginsw}&cust_fname={$cust_fname}&cust_bill_status={$cust_bill_status}&notemptybill={$notemptybill}&notempty={$notempty}&notemptysup={$notemptysup}&custid={$cust_id}&cust_doc1={$cust_doc1}&cust_doc2={$cust_doc2}&cust_doc3={$cust_doc3}&cust_doc4={$cust_doc4}&cust_doc5={$cust_doc5}&cust_doc6={$cust_doc6}&cust_status={$cust_status}&cust_residency={$cust_residency}");
		}
		
	}
		
	
?>

	<div class="tm-page-wrap mx-auto">
        <section class="tm-banner">
            <div class="tm-container-outer tm-banner-bg">
                <div style="background: url(img/about-bg.jpg) center top no-repeat; background-attachment: fixed;" class="container">
						
						
                    <div class="row tm-banner-row" id="tm-section-search">
						<?php
							echo "<form action='logincheckdocs.php?logsw={$loginsw}&cust_fname={$cust_fname}&cust_bill_status={$cust_bill_status}&notemptybill={$notemptybill}&notempty={$notempty}&notemptysup={$notemptysup}&custid={$cust_id}&cust_doc1={$cust_doc1}&cust_doc2={$cust_doc2}&cust_doc3={$cust_doc3}&cust_doc4={$cust_doc4}&cust_doc5={$cust_doc5}&cust_doc6={$cust_doc6}&cust_status={$cust_status}&cust_residency={$cust_residency}' method='post' enctype='multipart/form-data' class='tm-search-form tm-section-pad-2'>";
						?>
								
						<h6 class="text-center"><strong>Hi <?php echo $cust_fname; ?>, we are in the process of reviewing the documents you have submitted. To help complete the review process, please select the task that you need to complete.</strong></h6>
						<hr>
						<!--
						<p><strong>NOTE:</strong><br>
						<strong>For Philippine residents:</strong> 2 government issued id's with photo and residential address, billing statement under your name or under your parents', siblings' or relatives' name.<br><br>
						<strong>For non-Philippine residents: </strong>Copy of itinerary, passport and driver's license. 
								</p> <hr>--> 
								
								
						<div class="form-row tm-search-form-row"> 	
								
							<div class="form-group tm-form-group tm-form-group-pad tm-form-group-1">                                    
								<label for="inputAdult">&nbsp;</label>     
								<select name="upload" class="form-control tm-select" id="inputAdult">
									<option value=" " selected>Select An Option</option>
									
										<?php 
											if($notempty == 0) {
										?>		
											
									<option value="Primary">Upload Primary Required Documents</option>
										<?php } ?>
										
										<?php 
											if($notemptysup == 0) {
										?>	
									<option value="Additional">Upload Additional Requested Documents</option>
										<?php } ?>
										
										<?php 
											if($notemptybill == 0) {
										?>	
									<option value="Payment">Upload Photo Of Payment</option>
										<?php } ?>
									
								</select>  
							</div>
							
							<div class="form-group tm-form-group tm-form-group-pad tm-form-group-1">
								<label for="btnSubmit">&nbsp;</label>
								<button type="submit" name="selectoption" class="btn btn-warning tm-btn tm-btn-search text-uppercase" id="btnSubmit">Submit</button>
							</div>
									
						</div>	
						<?php
							echo "<a href='../index.php?logsw=1&custid={$cust_id}' role='button' class='btn btn-warning tm-btn tm-btn-search text-uppercase'>I'll Do It Later</a>";
						?>		
						</form>  	   
							

                    </div> <!-- row -->
                    <div class="tm-banner-overlay"></div>
					<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                        
                </div>  <!-- .container -->                   
            </div>     <!-- .tm-container-outer -->                 
        </section>
	</div>


            

            

    <!-- load JS files -->
    <script src="js/jquery-1.11.3.min.js"></script>             <!-- jQuery (https://jquery.com/download/) -->
    <!--script src="js/popper.min.js"></script-->                    <!-- https://popper.js.org/ -->       
    <script src="js/bootstrap.min.js"></script>                 <!-- https://getbootstrap.com/ -->
    <script src="js/datepicker.min.js"></script>                <!-- https://github.com/qodesmith/datepicker -->
    
    <script> 
        /* Google Maps
        ------------------------------------------------*/


        /* DOM is ready
        ------------------------------------------------*/
        $(function(){

            

            // Date Picker in Search form
            var pickerCheckIn = datepicker('#inputCheckIn');
            var pickerCheckOut = datepicker('#inputCheckOut');
         
        });

    </script>             

</body>
</html>