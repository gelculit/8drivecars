<?php include "pickavailableheader.php"; ?>

<?php
	/*if NEXT STEP button is pressed*/
	$sw = 0;
	if(isset($_POST['create_cust'])) {
	
		$custfname = $_POST['fname'];
		$custlname = $_POST['lname'];
		$custnname = $_POST['nname'];
		$custaddr1 = $_POST['addr1'];
		$custaddr2 = $_POST['addr2'];       
		$custcity = $_POST['city']; 
		$custprovince = $_POST['province']; 
		$custzip = $_POST['zipcode'];	
		$custpnum = $_POST['pnum'];   
		$custemail = $_POST['custemail'];
		
		
		$custQuery = "SELECT * FROM customerinfo";
		$custQuery = "INSERT INTO customerinfo (cust_fname, cust_lname, cust_nname, cust_address, cust_address2, cust_city, cust_prov, cust_zip, cust_cpnum, cust_email) ";
		$custQuery .= "VALUES ('{$custfname}', '{$custlname}', '{$custnname}', '{$custaddr1}', '{$custaddr2}', '{$custcity}', '{$custprovince}', '{$custzip}', '{$custpnum}', '{$custemail}')";
		
		$create_cust_query = mysqli_query($connection, $custQuery);
		
		
		if(!$create_cust_query) {
            die("Query Failed " . mysqli_error($connection));
        }
		
		$sw = 1;
	
	}
?>





  
<?php  
	/*This passes the car id from pickavailable */
	$cust_id = $_GET['custid']; 
	$loginsw = $_GET['logsw']; 
	$car_id = $_GET['carid'];  //*
	$cardesc = $_GET['cardesc']; //*
	$cartrans = $_GET['cartrans']; //*
	$carcapacity = $_GET['carcap']; //*
	$carmodel = $_GET['carmodel']; //*
	$cdrive = $_GET['wdrive']; 
	$indate = $_GET['begdate']; 
	$retdate = $_GET['retdate'];
	$cardayratepeak = $_GET['totalrate']; 
	$cdrive = $_GET['wdrive']; 
	//$airportpick = $_GET['airpick']; //* this goes to tripdetails
	//$airdetail = $_GET['airdetail']; //* this goes to tripdetails
	
?>

	  
	  

        

        <div class="tm-page-wrap mx-auto">
            <section class="tm-banner">
                <div class="tm-container-outer tm-banner-bg">
                    <div style="background: url(img/about-bg.jpg) center top no-repeat; background-attachment: fixed;" class="container">
						<div class="row tm-banner-row" id="tm-section-search">
							
								<?php
									echo "<form action='pickcustinfo.php?carid={$car_id}&carmodel={$carmodel}&cardesc={$cardesc}&cartrans={$cartrans}&carcap={$carcapacity}&wdrive={$cdrive}&begdate={$indate}&retdate={$retdate}&totalrate={$cardayratepeak}&wdrive={$cdrive}&logsw={$loginsw}&custid={$cust_id}' method='post' class='tm-search-form tm-section-pad-2'>";
									//echo "<h4 class='text-center'><strong>{$carmodel} {$carcapacity}-seater {$cartrans}  Transmission</strong></h4><br>	";	
								?>
								
								
										<h6><strong>Let's gather all the needed information...</strong> </h6>
								<br>
								
								<!--------->
								
								<div class="form-row tm-search-form-row"> 
									
                                    <div class="form-group tm-form-group tm-form-group-pad tm-form-group-1">
                                        <label for="inputCity">First Name</label>
                                        <input name="fname" type="text" class="form-control" placeholder="Juan Carlo" <?php if($sw == 1) {echo "value={$custfname}";} ?> required/> 
									</div>
									
									<div class="form-group tm-form-group tm-form-group-pad tm-form-group-1">
                                        <label for="inputCity">Last Name</label>
                                        <input name="lname" type="text" class="form-control" placeholder="Dela Cruz" <?php if($sw == 1) {echo "value={$custlname}";} ?> required/> 
									</div>
								</div>
								
								<div class="form-row tm-search-form-row"> 
								
									<div class="form-group tm-form-group tm-form-group-pad tm-form-group-1">
                                        <label for="inputCity">Nickname</label>
                                        <input name="nname" type="text" class="form-control" placeholder="JayCee" <?php if($sw == 1) {echo "value={$custnname}";} ?> required/> 
									</div>
									
                                    <div class="form-group tm-form-group tm-form-group-pad tm-form-group-1">
                                        <label for="inputCity">Address 1</label>
                                        <input name="addr1" type="text" class="form-control" placeholder="Block #, lot #, street name" <?php if($sw == 1) {echo "value={$custaddr1}";} ?> required/> 
									</div>
									
									
								</div>
								
								<div class="form-row tm-search-form-row"> 
								
									<div class="form-group tm-form-group tm-form-group-pad tm-form-group-1">
                                        <label for="inputCity">Address 2</label>
                                        <input name="addr2" type="text" class="form-control" placeholder="Subdivision name, barangay" <?php if($sw == 1) {echo "value={$custaddr2}";} ?> required/> 
									</div>
									
                                    <div class="form-group tm-form-group tm-form-group-pad tm-form-group-1">
                                        <label for="inputCity">City</label>
                                        <input name="city" type="text" class="form-control" placeholder="Manila" <?php if($sw == 1) {echo "value={$custcity}";} ?> required/> 
									</div>
									
								</div>
								
								<div class="form-row tm-search-form-row"> 
								
									<div class="form-group tm-form-group tm-form-group-pad tm-form-group-1">
                                        <label for="inputCity">Zip Code</label>
                                        <input name="zipcode" type="text" class="form-control" placeholder="1000" <?php if($sw == 1) {echo "value={$custzip}";} ?> required/> 
									</div>
									
									<div class="form-group tm-form-group tm-form-group-pad tm-form-group-1">
                                        <label for="inputCity">Province</label>
                                        <input name="province" type="text" class="form-control" placeholder="Metro Manila" <?php if($sw == 1) {echo "value={$custprovince}";} ?> required/> 
									</div>
								</div>
								
								<div class="form-row tm-search-form-row"> 
									
                                    <div class="form-group tm-form-group tm-form-group-pad tm-form-group-1">
                                        <label for="">Phone Number</label>
                                        <input name="pnum" type="text" class="form-control" value="" placeholder="0995 138 6499" <?php if($sw == 1) {echo "value={$custfname}";} ?> required/> 
									</div>
									
									<div class="form-group tm-form-group tm-form-group-pad tm-form-group-1">
                                        <label for="inputCity">email address</label>
                                        <input name="custemail" type="email" class="form-control" placeholder="angelguiangcaculitan@gmail.com" <?php if($sw == 1) {echo "value={$custemail}";} ?> required/> 
									</div>
								</div>
								
								<!---------->
								
								<!---EDIT or CONFIRM buttons-->
								<?php
								if($sw == 0) {
								echo "<div class='form-row tm-search-form-row'>";
								
									echo "<div class='form-group tm-form-group tm-form-group-pad tm-form-group-1'>";
									echo	"<a href='../index.php' role='button' class='btn btn-warning tm-btn tm-btn-search text-uppercase'>Cancel</a>";
									echo "</div>";
								
									echo "<div class='form-group tm-form-group tm-form-group-pad tm-form-group-1 center'>";
										
									echo	"<button type='submit' name='create_cust' role='button' class='btn btn-warning tm-btn tm-btn-search text-uppercase'>Submit</button>";
										
									echo "</div>";
								echo "</div>";
								}
								
								if($sw == 1) {
									echo "<a href='../8drivelogin/register.php?carid={$car_id}&carmodel={$carmodel}&cardesc={$cardesc}&cartrans={$cartrans}&carcap={$carcapacity}&wdrive={$cdrive}&begdate={$indate}&retdate={$retdate}&totalrate={$cardayratepeak}&fname={$custfname}&lname={$custlname}&wdrive={$cdrive}&logsw={$loginsw}&custid={$cust_id}' role='button' class='btn btn-warning tm-btn tm-btn-search text-uppercase'>We have saved your information.   Press for next step.</a>";
								}
								//?carid={$car_id}&carmodel={$carmodel}&cardesc={$cardesc}&cartrans={$cartrans}&carcap={$carcapacity}&wdrive={$cdrive}&begdate={$indate}&retdate={$retdate}&totalrate={$cardayratepeak}&fname={$custfname}&lname={$custlname}&wdrive={$cdrive}&airpick={$airportpick}&airdetail={$airdetail}&logsw={$loginsw}&custid={$cust_id}
								
								?>
								
								
								
							</form>  		
                                    
                           </div> <!-- row -->
                        <div class="tm-banner-overlay"></div>
						<br><br>
                        
                    </div>  <!-- .container -->                   
                </div>     <!-- .tm-container-outer -->                 
            </section>     <!-- .tm-container-outer  --> 

<?php include "pickavailablefooter.php"; ?>
