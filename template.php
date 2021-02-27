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
	
    
	$loginsw = $_GET['logsw'];
	$cust_id = $_GET['custid']; //&custid={$cust_id}

/*	
$cust_id = $_GET['custid'];
$cust_doc1 = $_GET['cust_doc1'];
$cust_doc2 = $_GET['cust_doc2'];
$cust_doc3 = $_GET['cust_doc3'];
//$cust_doc4 = $_GET['cust_doc4'];
//$cust_doc5 = $_GET['cust_doc5'];
//$cust_doc6 = $_GET['cust_doc6'];
$cust_status = $_GET['cust_status'];

//echo "im here..."
*/
	
?>

		<div class="tm-page-wrap mx-auto">
            <section class="tm-banner">
                <div class="tm-container-outer tm-banner-bg">
                    <div style="background: url(img/about-bg.jpg) center top no-repeat; background-attachment: fixed;" class="container">
						
						
                        <div class="row tm-banner-row" id="tm-section-search">
							
							<div class="tm-search-form tm-section-pad-2">
							<?php
								//echo "<form action='' method='post' enctype='multipart/form-data' class='tm-search-form tm-section-pad-2'>";
							?>
								
								
								<h6 class="text-center"><strong>Hi (name), we are in the process of reviewing the documents you have submitted. To help complete the review process, please select the task that you need to complete.</strong></h6>
								<hr>

								
							<?php
								//echo "</form>";
							?>
							</div>  	   
							

                        </div> <!-- row -->
                        <div class="tm-banner-overlay"></div>
						<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                        
                    </div>  <!-- .container -->                   
                </div>     <!-- .tm-container-outer -->                 
            </section>


            

            

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