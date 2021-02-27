<?php //include "db.php"; ?>
<!--- 11/26/2019 For now, the only way to make this work is if I include db.php to 
this page. How can I make $connection global?


<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>


<?php

		
		if(isset($_POST['create_post'])) {
		//echo "good";
		$carmodel = $_POST['carmodel'];
		$cardesc = $_POST['cardesc'];
		$carcapacity = $_POST['carcapacity'];
		$cartrans = $_POST['cartrans'];       
		$carDiy = $_POST['carDiy'];
		$carDiy24peak = $_POST['carDiy24peak'];   
		//$carDiy1wkpeak = $_POST['carDiy1wkpeak'];   
		//$carDiy1mthpeak = $_POST['carDiy1mthpeak'];    
		$carDiy24lean = $_POST['carDiy24lean'];   
		//$carDiy1wklean = $_POST['carDiy1wklean'];   
		//$carDiy1mthlean = $_POST['carDiy1mthlean'];    
		
		$carimage = $_FILES['carimage']['name'];
		$post_image_temp = $_FILES['carimage']['tmp_name'];
		
		
		//upload chosen image file to database
		move_uploaded_file($post_image_temp, "images/$carimage");
		
		
    
		$carQuery = "SELECT * FROM cardetail";
		$carQuery = "INSERT INTO cardetail (car_desc, car_model, car_image, car_capacity, car_trans, car_diy, car_diyperday_peak, car_diyperday_lean, car_rentstatus) ";
		$carQuery .= "VALUES ('{$cardesc}', '{$carmodel}', '{$carimage}', '{$carcapacity}', '{$cartrans}', '{$carDiy}', '{$carDiy24peak}', '{$carDiy24lean}', 'Available')";
		
		$create_post_query = mysqli_query($connection, $carQuery);
		
	
		//confirmQuery($create_post_query);
		if(!$create_post_query) {
            die("Query Failed " . mysqli_error($connection));
        }
		
		
		}
		
		
?>
			




    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-files-o"></i> Car Details</h3>
            
          </div>
        </div>
	
			
		
        <!-- Form validations -->
        <div class="row">
          <div class="col-lg-12">
            <section class="panel">
              
              <div class="panel-body">
                <div class="form">
				
				<!-- ENCTYPE is for uploading pictures*****************
                  <form action="" method="post" enctype="multipart/form-data">-->
				
                  <form class="form-validate form-horizontal" id="feedback_form" method="post" enctype="multipart/form-data" action="cardetail.php">
                    <div class="form-group ">
                      <label for="carmodel" class="control-label col-lg-2">Car Model </label>
                      <div class="col-lg-10">
                        <input class="form-control" name="carmodel"  type="text" required />
                      </div>
                    </div>
					
					<div class="form-group ">
                      <label for="cardesc" class="control-label col-lg-2">Car Description </label>
                      <div class="col-lg-2">
                        <select name="cardesc" id="">
							<option value="Sedan">Sedan   </option>
							<option value="MPV">MPV  </option>
							<option value="SUV">SUV     </option>
						</select>

                      </div>
                    </div>
					
					 <div class="form-group">
						<label for="carimage" class="control-label col-lg-2">Car Image </label>
						
						<div class="col-lg-10">
							<input type="file" name="carimage">
						</div>
					</div>
					
                    <div class="form-group ">
                      <label for="carcapacity" class="control-label col-lg-2">Capacity </label>
                      <div class="col-lg-10">
                        <input class="form-control" name="carcapacity" type="number" required />
                      </div>
                    </div>
					
					<div class="form-group ">
                      <label for="cartrans" class="control-label col-lg-2">Transmission </label>
                      <div class="col-lg-2">
                        <select name="cartrans" id="">
							<!--option value="">Select One</option-->
							<option value="Manual">Manual</option>
							<option value="Automatic">Automatic  </option>
						</select>

                      </div>
                    
                      <label for="carDiy" class="control-label col-lg-2">DIY Available </label>
                      <div class="col-lg-2">
                        <select name="carDiy" id="">
							<!--option value="">Select One</option-->
							<option value="Yes">Yes</option>
							<option value="No">No</option>
						</select>
                      </div>
                    </div>
					
					<div class="form-group ">
                      <label for="carDiy24" class="control-label col-lg-2">DIY Rate Peak</label>
                      <div class="col-lg-3">
                        <input class="form-control" name="carDiy24peak"  placeholder="24 hours peak rate" type="number" />
                      </div>
                    <!--
                      <div class="col-lg-3">
                        <input class="form-control" name="carDiy1wkpeak"  placeholder="1 week peak rate" type="number" />
                      </div>
                    
                      <div class="col-lg-3">
                        <input class="form-control" name="carDiy1mthpeak"  placeholder="1 month peak rate" type="number" />
                      </div>
					  -->
                    </div>
					
					<div class="form-group ">
                      <label for="carDiy24" class="control-label col-lg-2">DIY Rate Lean</label>
                      <div class="col-lg-3">
                        <input class="form-control" name="carDiy24lean"  placeholder="24 hours lean rate" type="number" />
                      </div>
                    <!--
                      <div class="col-lg-3">
                        <input class="form-control" name="carDiy1wklean"  placeholder="1 week lean rate" type="number" />
                      </div>
                    
                      <div class="col-lg-3">
                        <input class="form-control" name="carDiy1mthlean"  placeholder="1 month lean rate" type="number" />
                      </div>
					  -->
                    </div>
					
                    <div class="form-group">
                      <div class="col-lg-offset-2 col-lg-10">
                       <input class="btn btn-primary" type="submit" name="create_post" value="Add Car Detail">
                       <button class="btn btn-default" type="button"><a class="" href="index.php">Back To Dashboard</a></button>
                      </div>
                    </div>
                  </form>
                </div>

              </div>
            </section>
          </div>
        </div>
		
		
		
		
		
        <!-- page end-->
      </section>
    </section>
    <!--main content end-->
	
	<?php //include "8driveAdmin.php"; ?>
	
	
	
	