



<!-------------MAIN GALLERY ------->

<!-- Portfolio section
================================================== -->
<section id="portfolio" class="parallax-section">
	<div class="container">
		<div class="row">

			<!-- Section title
			================================================== -->
			<div class="col-md-offset-2 col-md-8 col-sm-offset-2 col-sm-8">
				<div>
					<!--h5 class="wow bounceIn">WE ARE DELIGENT</h5-->
					<h4 class="heading">Car Gallery</h4>
					<!--hr>
					<p>Pellentesque mollis purus ipsum. Fusce tristique ante et est placerat dignissim. Curabitur tincidunt risus non dui vulputate tincidunt.</p-->
				</div>
			</div>

			
			<!--  Gallery
			================================================== -->
			
			
		<?php 
			global $loginsw;
			global $cust_id; 
			$query = "SELECT * FROM cardetail";

            $select_all_posts_query = mysqli_query($connection, $query);

            while($row = mysqli_fetch_assoc($select_all_posts_query)) {

            $carid = $row['car_id'];
			$cardesc = $row['car_desc'];
			$carmodel = $row['car_model'];
			$carimage = $row['car_image'];
			$carcapacity = $row['car_capacity'];
			$cartrans = $row['car_trans'];
			$cardiy = $row['car_diy'];


        ?>

			
			<div class="col-sm-4">
				<!-- Thumbnail-->
				<a href="#home" class="thumbnail home-thumb smoothScroll">
					<img src="../8driveAdmin/images/<?php echo $carimage; ?>" alt="">
				</a>
				<h3><?php echo $carmodel; ?></h3>
								
				<?php
				
					echo "<h6>Drive It Option: {$cardiy}</h6>";
					
				
				echo "<a href='pickavailability/pickcheckavailability.php?edit={$carid}&logsw={$loginsw}&custid={$cust_id};' role='button' class='btn btn-primary smoothScroll bottomPad'>Check Availability</a>";
				?>

			</div>
			
			<?php } ?>
			<!--  Gallery
			================================================== -->
			



















            <!-- Portfolio bottom section
			================================================== 
            <div class="col-md-offset-2 col-md-8 col-sm-12">
            	<div class="portfolio-bottom">
            		<h2>INTERESTED?</h2>
					<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet. Lorem ipsum dolor sit 	amet.</p>
					<a href="#plan" class="smoothScroll btn btn-default">LET'S GO!</a>
            	</div>
            </div>   
			-->

		</div>
	</div>
</section>		




<!-- FAQs section
================================================== -->
<br><br><br><br>
<section id="faqs" class="parallax-section">
	<div class="container">
		<div class="col-md-6 col-md-8 col-sm-offset-2 col-sm-8">
			<div>
				<!--h5 class="wow bounceIn">WE ARE DELIGENT</h5-->
				<h4 class="heading"><center>Ask Us</center></h4>
				<hr>
				<h3><center>Frequently Asked Questions</center></h4>
			</div>
			<br><br>
		</div>
		
		<div class="row">	
			<div class="col-md-6 col-md-6">
				<h4>How do we start the process of renting?</h4>
				<p>1. Please start by sending a quotation request.<br>
					2. We will then reply with a quote via email.<br>
					3. Should you accept the proposal, please reply with photos of the requirements via email.<br>
					4. After which we will send payment options so you can confirm your reservation.<br> </p>
			
			</div>
			<div class="col-md-6 col-md-6">
				<h4>What are the requirements?</h4>
				<p> -At least 2 Government issued IDs with photo and residential address. <br>
					-Any billing statement under your name or the following (Parents, Siblings, Relatives).<br>
					-For non-Philippine residents; itinerary, passport and driver's license would do.<br></p>
			
			</div>
		</div>
		
		<div class="row">	
			<div class="col-md-6 col-md-6">
				<h4>Is there a mileage limit and free gas?</h4>
				<p> Mileage is unlimited for 3 days or more rental. We will provide with full tank of gas. Vehicles should be returned with full tank as well.</p>
			
			</div>
			<div class="col-md-6 col-md-6">
				<h4>Can we pick up the car from your garage?</h4>
				<p> For first time renters, we require the vehicle to be delivered as part of our background check. Return clients may pick up from garage.p>
			
			</div>
		</div>
		
		<div class="row">	
			<div class="col-md-6 col-md-6">
				<h4>How much to rent a car?</h4>
				<p>We have a detailed table of rates in the Cars and Rates section. You may also send us a request for quotation.</p>
			
			</div>
			<div class="col-md-6 col-md-6">
				<h4>We need the car within 24hrs.</h4>
				<p>Please send a request for quotation then send us an SMS so we can prioritize it. Please scroll down for our contact info. </p>
			
			</div>
		</div>
		
	</div>
</section>
			

			<!-- Section title
			================================================== 
			<div class="col-md-offset-2 col-md-8 col-sm-offset-2 col-sm-8">
				<div class="section-title">
					<h5 class="wow bounceIn">PLAN YOUR TRIP</h5>
					<h1 class="heading">CONTACT US</h1>
					<hr>
					<p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla. Excepteu sunt in culpa qui officia deserunt mollit.</p>
				</div>
			</div> -->





<!-- Contact section
================================================== -->
<section id="contact" class="parallax-section">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-8 col-sm-offset-2 col-sm-8">
				<div>
					<!--h5 class="wow bounceIn">WE ARE DELIGENT</h5-->
					<h4 class="heading"><center>Contact Us</center></h4>
					<hr>
					<h3><center>Send Us Your Inquiry</center></h4>
				</div>
				<br><br>
			</div>
			

			<!-- Contact form section
			================================================== -->
			<div class="col-md-offset-1 col-md-10 col-sm-12">
				<form action="#" method="post" class="wow fadeInUp" data-wow-delay="0.6s">
					<div class="col-md-4 col-sm-6">
						<input type="text" class="form-control" placeholder="Name" name="name">
					</div>
					<div class="col-md-4 col-sm-6">
						<input type="email" class="form-control" placeholder="Email" name="email">
					</div>
					<div class="col-md-4 col-sm-12">
						<input type="text" class="form-control" placeholder="Subject" name="subject">
					</div>
					<div class="col-md-12 col-sm-12">
						<textarea class="form-control" placeholder="Message" rows="7" name"message"></textarea>
					</div>
					<div class="col-md-offset-2 col-md-8 col-sm-offset-2 col-sm-8">
						<input type="submit" class="form-control" value="Send Us Your Inquiry">
					</div>
				</form>
			</div>

			<!-- Contact detail section
			================================================== -->
			<div class="contact-detail col-md-12 col-sm-12">
				<div class="col-md-6 col-sm-6">
					<h3><i class="icon-envelope medium-icon wow bounceIn" data-wow-delay="0.6s"></i> EMAIL</h3>
					<p>book@8drivecars.com</p>
				</div>
				<div class="col-md-6 col-sm-6">
					<h3><i class="icon-phone medium-icon wow bounceIn" data-wow-delay="0.6s"></i> PHONES</h3>
					<p>+63 (917) 533 2141 | +63 (920) 959 5564 <br> +63 (917) 135 4254 | +63 (917) 325 5428</p>
				</div>
				
			</div>

		</div>
	</div>
</section>

<br><br><br>

<?php /*include "mainfooter.php"; */?>


