<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>



<!-- 12/02 Update car info page
<?php
//isset get

// this made the update work in passing parameter. in addition, sidebar was used not sidebar2
//$_GET['edit'] was the key

    $the_car_id = $_GET['edit']; 

//post info
    $query = "SELECT * FROM cardetail WHERE car_id = $the_car_id ";
    $select_posts_by_id = mysqli_query($connection, $query);

    // ***ACTUAL ADDING OF DATA TO TABLE
    while($row = mysqli_fetch_assoc($select_posts_by_id)) {

			$carid = $row['car_id'];
			$cardesc = $row['car_desc'];
			$carmodel = $row['car_model'];
			$carimage = $row['car_image'];
			$carcapacity = $row['car_capacity'];
			$cartrans = $row['car_trans'];
			$cardiy = $row['car_diy'];
			$cardiy24peak = $row['car_diyperday_peak'];
			//$cardiy1wkpeak = $row['car_diy1wkpeak'];
			//$cardiy1mpeak = $row['car_diy1mpeak'];
			$cardiy24lean = $row['car_diyperday_lean'];
			//$cardiy1wklean = $row['car_diy1wklean'];
			//$cardiy1mlean = $row['car_diy1mlean'];

    }



//confirm update




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
				
                  <form class="form-validate form-horizontal" id="feedback_form" method="post" enctype="multipart/form-data" action="">
                    <div class="form-group ">
                      <label for="carmodel" class="control-label col-lg-2">Car Model </label>
                      <div class="col-lg-10">
                        <input class="form-control" name="carmodel"  value="<?php echo $carmodel; ?>" type="text" />
                      </div>
                    </div>
					
					<div class="form-group ">
                      <label for="cardesc" class="control-label col-lg-2">Car Description </label>
                      <div class="col-lg-10">
                        <input class="form-control" name="cardesc" value="<?php echo $cardesc; ?>" type="text"  />
                      </div>
                    </div>
					
					 <div class="form-group">
						<label for="carimage" class="control-label col-lg-2">Car Image </label>
						<div class="col-lg-10">
						    <img width="100" src="images/<?php echo $carimage; ?>" alt="">
							<input type="file" name="carimage">
						</div>
					</div>
					
                    <div class="form-group ">
                      <label for="carcapacity" class="control-label col-lg-2">Capacity </label>
                      <div class="col-lg-10">
                        <input class="form-control" name="carcapacity" value="<?php echo $carcapacity; ?>" type="text" />
                      </div>
                    </div>
					
					
					<!-------------------------------------------
					
					<div class="form-group ">
                        <label for="cartrans" class="control-label col-lg-2">Transmission : </label>
                        <div class="col-lg-2">
							<input class="form-control" name="cartrans" value="<?php echo $cartrans; ?>" type="text"  />
						<div>
                    
                        <label for="carDiy" class="control-label col-lg-2">DIY Available </label>
                        <div class="col-lg-2">
							<input class="form-control" name="carDiy" value="<?php echo $cardiy; ?>" type="text"  />
                        </div>
                    </div>
					
					
					------------------------------------------->
					
					
					
					<div class="form-group ">
                      <label for="cartrans" class="control-label col-lg-2">Transmission </label>
                      <div class="col-lg-10">
                        <input class="form-control" name="cartrans" value="<?php echo $cartrans; ?>" type="text"  />
                      </div>
                    </div>
					
					<div class="form-group ">
                      <label for="carDiy" class="control-label col-lg-2">DIY Available </label>
                      <div class="col-lg-10">
                        <input class="form-control" name="carDiy" value="<?php echo $cardiy; ?>" type="text"  />
                      </div>
                    </div>
					<!------------------------------------------->
					
					<div class="form-group ">
                      <label for="carDiy24" class="control-label col-lg-2">DIY Rate Peak</label>
                      <div class="col-lg-3">
					  <!--label for="carDiy" class="control-label col-lg-2">24hrs </label-->
                        <input class="form-control" name="carDiy24peak"  value="<?php echo $cardiy24peak; ?>" type="number"   />
                      </div>
                    <!--
                      <div class="col-lg-3">
					  <label for="carDiy" class="control-label col-lg-2">1Week </label>
                        <input class="form-control" name="carDiy1wkpeak"  value="<?php //echo $cardiy1wkpeak; ?>" type="number" />
                      </div>
                    
                      <div class="col-lg-3">
					  <label for="carDiy" class="control-label col-lg-2">1Month </label>
                        <input class="form-control" name="carDiy1mthpeak"  value="<?php //echo $cardiy1mpeak; ?>" type="number" />
                      </div>
					  -->
                    </div>
					
					<div class="form-group ">
                      <label for="carDiy24" class="control-label col-lg-2">DIY Rate Lean</label>
                      <div class="col-lg-3">
					  <!--label for="carDiy" class="control-label col-lg-2">24hrs </label-->
                        <input class="form-control" name="carDiy24lean"  value="<?php echo $cardiy24lean; ?>" type="number"   />
                      </div>
                    <!--
                      <div class="col-lg-3">
					  <label for="carDiy" class="control-label col-lg-2">1Week </label>
                        <input class="form-control" name="carDiy1wklean"  value="<?php //echo $cardiy1wklean; ?>" type="number" />
                      </div>
                    
                      <div class="col-lg-3">
					  <label for="carDiy" class="control-label col-lg-2">1Month </label>
                        <input class="form-control" name="carDiy1mthlean"  value="<?php// echo $cardiy1mlean; ?>" type="number" />
                      </div>
					  -->
                    </div>
					<!------------------------------------------->
					
					
					
					
                    <div class="form-group">
                      <div class="col-lg-offset-2 col-lg-10">
                       <input class="btn btn-primary" type="submit" name="submit" value="Update Car Detail">
                       <button class="btn btn-default" type="button"><a class="" href="carList.php">Back To Dashboard</a></button>
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
	
	
	<!--experiment-->
<?php
	if(isset($_POST['submit'])) {
	
		$carmodel = $_POST['carmodel'];
		$cardesc = $_POST['cardesc'];
	
		//$carimage = $_FILES['carimage']['name'];
		//$post_image_temp = $_FILES['carimage']['tmp_name'];
		
		$carcapacity = $_POST['carcapacity'];
		$cartrans = $_POST['cartrans'];       
		$carDiy = $_POST['carDiy']; 
		$carDiy24peak = $_POST['carDiy24peak'];   
		//$carDiy1wkpeak = $_POST['carDiy1wkpeak'];   
		//$carDiy1mthpeak = $_POST['carDiy1mthpeak'];
		$carDiy24lean = $_POST['carDiy24lean'];   
		//$carDiy1wklean= $_POST['carDiy1wklean'];   
		//$carDiy1mthlean = $_POST['carDiy1mthlean'];
		
        $querySelect = "SELECT * FROM cardetail WHERE car_id = $the_car_id ";
        
        //QUERY for uploading information
        $query = "UPDATE cardetail SET ";
        $query .= "car_model = '{$carmodel}', ";
        $query .= "car_desc = '{$cardesc}', ";
		
        //$query .= "car_image = '{$carimage}', ";
		
        $query .= "car_capacity = '{$carcapacity}', ";
        $query .= "car_trans = '{$cartrans}', ";
        $query .= "car_diy = '{$carDiy}', ";
		
		
        $query .= "car_diyperday_peak = '{$carDiy24peak}', ";
		//$query .= "car_diy1wkpeak = '{$carDiy1wkpeak}', ";
		//$query .= "car_diy1mpeak = '{$carDiy1mthpeak}', ";
		
		$query .= "car_diyperday_lean = '{$carDiy24lean}' ";
		//$query .= "car_diy1wklean = '{$carDiy1wklean}', ";
		//$query .= "car_diy1mlean = '{$carDiy1mthlean}' ";
		
		
		
        $query .= "WHERE car_id = {$carid} ";
        
        $update_post = mysqli_query($connection, $query);
        
        if(!$update_post) {
            die("Query Failed " . mysqli_error($connection));
        }
	header("Location: carList.php");
	
	}
?>
	
	<?php //include "8driveAdmin.php"; 
           //header("Location: carList.php");
	?>
	
	
	
	