

<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>


    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-files-o"></i> Chauffered Service Fee Details (Add entry)</h3>
            
          </div>
        </div>
	
			
		
        <!-- Form validations -->
        <div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <!--<header class="panel-heading">
                Car Details
              </header>-->
              <div class="panel-body">
                <div class="form">
				
				<!-- ENCTYPE is for uploading pictures*****************
                  <form action="" method="post" enctype="multipart/form-data">-->
				
                  <form class="form-validate form-horizontal" id="feedback_form" method="post" action="">
                    <div class="form-group ">
                      <label for="carmodel" class="control-label col-lg-2">Metro Manila to: <span class="required">*</span></label>
                      <div class="col-lg-10">
                        <!--input class="form-control" name="carmodel"  type="text" required /-->
						
						<select name="destination_id" id="">
        
						<?php 
            
							$query = "SELECT * FROM manila_to";

							$select_destination = mysqli_query($connection, $query);

							//call the function
							//confirmQuery($select_categories);
            
							// ***ACTUAL EDITING OF DATA 
							while($row = mysqli_fetch_assoc($select_destination)) {

							$dest_id = $row['mnl_to_id'];
							$dest_title = $row['mnl_to_where'];

							echo "<option value='{$dest_id}'>{$dest_title}</option>";
                
							}
            
						?>
        
						</select>   
						
						
						
						
                      </div>
                    </div>
					
					<div class="form-group ">
					  
                      <label for="cardesc" class="control-label col-lg-2">Sedan 4 seater<span class="required">*</span></label>
                      <div class="col-lg-3">
                        <input class="form-control" name="cardesc"  placeholder="8 Hours" type="text" required />
                      </div>
					  <div class="col-lg-3">
                        <input class="form-control" name="cardesc"  placeholder="12 Hours"type="text" required />
                      </div>
					  <div class="col-lg-3">
                        <input class="form-control" name="cardesc"  placeholder="airport"type="text" required />
                      </div>
                    </div>
					
					<div class="form-group ">
					  
                      <label for="cardesc" class="control-label col-lg-2">Innova 6 seater<span class="required">*</span></label>
                      <div class="col-lg-3">
                        <input class="form-control" name="cardesc"  placeholder="8 Hours" type="text" required />
                      </div>
					  <div class="col-lg-3">
                        <input class="form-control" name="cardesc"  placeholder="12 Hours"type="text" required />
                      </div>
					  <div class="col-lg-3">
                        <input class="form-control" name="cardesc"  placeholder="airport"type="text" required />
                      </div>
                    </div>
					
					<div class="form-group ">
					  
                      <label for="cardesc" class="control-label col-lg-2">SUV 6 seater<span class="required">*</span></label>
                      <div class="col-lg-3">
                        <input class="form-control" name="cardesc"  placeholder="8 Hours" type="text" required />
                      </div>
					  <div class="col-lg-3">
                        <input class="form-control" name="cardesc"  placeholder="12 Hours"type="text" required />
                      </div>
					  <div class="col-lg-3">
                        <input class="form-control" name="cardesc"  placeholder="airport"type="text" required />
                      </div>
                    </div>
					
					<div class="form-group ">
					  
                      <label for="cardesc" class="control-label col-lg-2">Land Cruiser 6 seater<span class="required">*</span></label>
                      <div class="col-lg-3">
                        <input class="form-control" name="cardesc"  placeholder="8 Hours" type="text" required />
                      </div>
					  <div class="col-lg-3">
                        <input class="form-control" name="cardesc"  placeholder="12 Hours"type="text" required />
                      </div>
					  <div class="col-lg-3">
                        <input class="form-control" name="cardesc"  placeholder="airport"type="text" required />
                      </div>
                    </div>
					
					<div class="form-group ">
					  
                      <label for="cardesc" class="control-label col-lg-2">Hiace Commuter 14 seater<span class="required">*</span></label>
                      <div class="col-lg-3">
                        <input class="form-control" name="cardesc"  placeholder="8 Hours" type="text" required />
                      </div>
					  <div class="col-lg-3">
                        <input class="form-control" name="cardesc"  placeholder="12 Hours"type="text" required />
                      </div>
					  <div class="col-lg-3">
                        <input class="form-control" name="cardesc"  placeholder="airport"type="text" required />
                      </div>
                    </div>
					
					<div class="form-group ">
					  
                      <label for="cardesc" class="control-label col-lg-2">Super Grandia 10 seater<span class="required">*</span></label>
                      <div class="col-lg-3">
                        <input class="form-control" name="cardesc"  placeholder="8 Hours" type="text" required />
                      </div>
					  <div class="col-lg-3">
                        <input class="form-control" name="cardesc"  placeholder="12 Hours"type="text" required />
                      </div>
					  <div class="col-lg-3">
                        <input class="form-control" name="cardesc"  placeholder="airport"type="text" required />
                      </div>
                    </div>
					
					
                    
					
                    <div class="form-group">
                      <div class="col-lg-offset-2 col-lg-10">
                       <input class="btn btn-primary" type="submit" name="create_post" value="Add Fee Detail">
                       <button class="btn btn-default" type="button"><a class="" href="index.php">Cancel</a></button>
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
	
	<?php include "8driveAdmin.php"; ?>
	
	
	
	