<?php include "pickavailableheader.php"; ?>

  
<?php  
	$docempty = 0;
	/*This passes the car id from pickavailable */
	//$loginsw = 0;
	$loginsw = $_GET['logsw']; //&logsw={$loginsw}
	$cust_id = $_GET['custid'];  
	$car_id = $_GET['carid'];  
	$cardesc = $_GET['cardesc'];
	$cartrans = $_GET['cartrans'];
	$carcapacity = $_GET['carcap'];
	$carmodel = $_GET['carmodel'];
	$cdrive = $_GET['wdrive'];
	$indate = $_GET['begdate'];
	$retdate = $_GET['retdate'];
	$cardayratepeak = $_GET['totalrate'];
	$cdrive = $_GET['wdrive'];
	$airportpick = $_GET['airpick'];
	$airdetail = $_GET['airdetail'];
	
	if($loginsw == 0) {
		$docempty = $_GET['docempty'];
	} 
	
	$stamp_indate = strtotime($indate);
	$start_day = date('d', $stamp_indate);
	$start_month = date('F', $stamp_indate);
	$start_year = date('Y', $stamp_indate);
	
	$stamp_retdate = strtotime($retdate);
	$end_day = date('d', $stamp_retdate);
	$end_month = date('F', $stamp_retdate);
	$end_year = date('Y', $stamp_retdate);
	
	$diff_date = ($stamp_retdate - $stamp_indate)/60/60/24;

	
?>

	  
	  
	 
        

        <div class="tm-page-wrap mx-auto">
            <section class="tm-banner">
                <div class="tm-container-outer tm-banner-bg">
                    <div style="background: url(img/about-bg.jpg) center top no-repeat; background-attachment: fixed;" class="container">
						<div class="row tm-banner-row" id="tm-section-search">
							
								<?php
									echo "<form action='pickthankyou.php?screenshot=2&carid={$car_id}&begdate={$indate}&retdate={$retdate}&totalrate={$cardayratepeak}&docempty={$docempty}&custid={$cust_id}&diffdate={$diff_date}&wdrive={$cdrive}&airpick={$airportpick}&airdetail={$airdetail}&logsw={$loginsw}' method='post' enctype='multipart/form-data' class='tm-search-form tm-section-pad-2'>";
									echo "<h4 class='text-center'><strong>You have chosen {$carmodel} {$carcapacity}-seater {$cartrans}  Transmission</strong></h4>	";	
								?>
								
								<hr>
								
								<!--------->
								<?php
								$cardayrateformat = number_format($cardayratepeak, 2);
								echo "<h6>You have scheduled using the vehicle for <strong>{$diff_date} day/s</strong>. <br></h6>";
								
								echo "<h6>Start Date : <strong>{$start_day} {$start_month} {$start_year}</strong></h6>";
								echo "<h6>Return Date: <strong>{$end_day} {$end_month} {$end_year}</strong></h6>";
								echo "<h6>Total Amount: <strong>Php {$cardayrateformat}</strong></h6>";
								?>
								
								<!--&wdrive={$cdrive}- determines if with driver or no driver -->
								<?php 
								if($cdrive == "Yes") {
									$wdrive = "With Driver";
								} else {
									$wdrive = "Drive It Yourself";
								}
								
								echo "<h6>Vehicle will be for <strong>Delivery </strong>to the address you have provided and is <strong>{$wdrive}</strong>.</h6>";
								?>
								<hr>
								<h6>To facilitate the approval of your request, you may make payment thru the following:</h6>
								<h6>•	Bank of the Philippine Island account number 8379297900</h6>
								<h6>•	Banco de Oro account number 8379297900</h6>
								<h6>•	Paypal or Gcash</h6>
								
								<?php
								if($docempty == 1 OR $loginsw == 1) {
									echo "<hr>";
									if($docempty == 1) {
									echo "<h6><strong>Thank you submitting documents. It will be reviewed prior to approval. Once notification of approval is recieved, please upload screenshot once payment is made. An email confirmation will be sent to you once payment is confirmed. Upload now?</strong></h6>";
								    } else {
										echo "<h6><strong>Please upload screenshot once payment is made. An email confirmation will be sent to you once payment is confirmed. Upload now?</strong></h6>";
									}
									echo "<br>";
									echo "<div class='form-row tm-search-form-row'>";
						
									echo "	<div class='form-group tm-form-group tm-form-group-pad tm-form-group-2'>";
									echo "		<label for='inputCity'>Payment  </label>";
									echo "		<input type='file' name='billdoc'>";
									echo "	</div>";
									
									echo "	<div class='form-group tm-form-group tm-form-group-pad tm-form-group-2'>";
                                    echo "	    <button type='submit' name='submitpay' class='btn btn-warning tm-btn tm-btn-search text-uppercase' id='btnSubmit'>Submit Payment Screenshot</button>";
                                    echo "	</div>";
						
									echo "</div>";
								} else {
									echo "<hr>";
									echo "<h6><strong>You will recieve an email and text confirmation once all required documents are completed. Once approved, please upload screenshot of payment.</strong></h6>";
									echo "<hr>";
								}
								?>
								
								<!---------->
								<br>
								<!---EDIT or CONFIRM buttons-->
								<?php
									echo	"<a href='pickthankyou.php?screenshot=1&carid={$car_id}&begdate={$indate}&retdate={$retdate}&totalrate={$cardayratepeak}&docempty={$docempty}&custid={$cust_id}&diffdate={$diff_date}&wdrive={$cdrive}&airpick={$airportpick}&airdetail={$airdetail}&logsw={$loginsw}' role='button' class='btn btn-warning tm-btn tm-btn-search text-uppercase'>Upload Later</a>";
								?>
								
								
								
							</form>  		
                                    
                           </div> <!-- row -->
                        <div class="tm-banner-overlay"></div>
						<br><br>
                        
                    </div>  <!-- .container -->                   
                </div>     <!-- .tm-container-outer -->                 
            </section>     <!-- .tm-container-outer  --> 

<?php include "pickavailablefooter.php"; ?>
