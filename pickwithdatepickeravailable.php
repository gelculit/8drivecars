<?php include "../../8driveAdmin/db.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Get A Qoutation</title>
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

        <div class="tm-page-wrap mx-auto">
            <section class="tm-banner">
                <div class="tm-container-outer tm-banner-bg">
                    <div style="background: url(img/about-bg.jpg) center top no-repeat; " class="container">
						
						
                        <div class="row tm-banner-row" id="tm-section-search">
                            <form action="index.html" method="get" class="tm-search-form tm-section-pad-2"><!------DATE PICKER -->
                                <div class="form-row tm-search-form-row">

                                    <div class="form-group tm-form-group tm-form-group-pad tm-form-group-3">
                                        <label for="inputCheckIn">Begin Date</label>
                                        <input name="check-in" type="text" class="form-control" id="inputCheckIn" placeholder="Choose Start Date">
                                    </div>
                                    <div class="form-group tm-form-group tm-form-group-pad tm-form-group-3">
                                        <label for="inputCheckOut">End Date</label>
                                        <input name="check-out" type="text" class="form-control" id="inputCheckOut" placeholder="Choose End Date">
                                    </div>
                                    <div class="form-group tm-form-group tm-form-group-pad tm-form-group-1">
                                        <label for="btnSubmit">&nbsp;</label>
                                        <button type="submit" class="btn btn-warning tm-btn tm-btn-search text-uppercase" id="btnSubmit">Check Availability</button>
                                    </div>
                                </div>  
								
                            </form>   
							

                        </div> <!-- row -->
                        <div class="tm-banner-overlay"></div>
						<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                        
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