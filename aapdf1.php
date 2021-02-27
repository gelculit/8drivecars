<?php
/*
Steps in making a PDF downloader:
Go to https://getcomposer.org/download/
click and install Composer-Setup.exe 
Once installed, go to cmd: go to root directory of project, ex.:
cd\
cd xampp
cd htdocs
cd 8drivecar
cd pickavailability
type on cmd prompt:[space]composer require mpdf/mpdf

skeleton format eo invoke mpdf:
$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML('<h1>Hello world!</h1>');
$mpdf->Output();
*/
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Cash Flow</title>
<!-- 
Journey Template 
http://www.templatemo.com/tm-511-journey
-->
    <!-- load stylesheets -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">  <!-- Google web font "Open Sans" -->
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">                <!-- Font Awesome -->
    <link rel="stylesheet" href="css/bootstrap.min.css">                                      <!-- Bootstrap style -->
    <link rel="stylesheet" type="text/css" href="css/datepicker.css"/>
	
	<link href="css/style.css" rel="stylesheet">
	  <link href="css/style-responsive.css" rel="stylesheet" />

	
    <link rel="stylesheet" href="css/templatemo-style.css">                                   <!-- Templatemo style -->
    </head>

    <body>
		<div class="container mt-5">
		
			<form action="aapdf2.php" method="post" class="offset-md-3 col-md-6">
				<h1>Create your own PDF</h1>
				<p>Fill out the details below and the PDF will be downloaded</p>
		
				<div class="row mb-2">
					<div class="col-md-6">
						<input type="text" name="fname" placeholder="First Name" class="form-control" required>
					</div>
					<div class="col-md-6">
						<input type="text" name="lname" placeholder="SurName" class="form-control" required>
					</div>
				
				</div>
				
				<div class="mb-2">
					<input type="email" name="email" placeholder="Email" class="form-control" required>
				
				</div>
				
				<div class="mb-2">
					<input type="tel" name="phone" placeholder="Phone" class="form-control" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" required>
				
				</div>
				
				<div class="mb-2">
					<textarea name="message" placeholder="Your Message" class="form-control"></textarea>
				
				</div>
		
				<button type="submit" class="btn btn-success btn-lg btn-block">Create PDF</button>
		
			</form>
		
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