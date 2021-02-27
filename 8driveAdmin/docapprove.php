<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>

		



<!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><center> <strong>Customer's Document Approval List</strong></center></h3>
            
          </div>
        </div>
 
 
 <table class="table table-bordered table-hover table-striped table-condensed">
    <thead>
       <tr>
           <th>Customer Name</th>
           <!--th>Last Name</th-->
           <th>Residency</th>
		   <th>Reserve Date</th>
		   
           <th><center>Document 1</center></th>
           <th><center>Document 2</center></th>
           <th><center>Document 3</center></th>
		   <th><center>Status</center></th>
           <th><center>Review Documents</center></th>
		   
       </tr> 
    </thead>

    <tbody>

       <?php 
	   
	    
			
       
        $query = "SELECT * FROM customerlogins";
         $select_cust = mysqli_query($connection, $query);

        // ***ACTUAL ADDING OF DATA TO TABLE
         while($row = mysqli_fetch_assoc($select_cust)) {
			
			$cust_status = $row['cust_status'];	
			if($cust_status == "UNVERIFIED" OR $cust_status == "PRIMARY DOCS REQUIRED" OR $cust_status == "ADDITIONAL DOCS REQUIRED" OR $cust_status == "AWAITING PAYMENT") {
			 
				
				$cust_id = $row['cust_id'];
				$cust_doc1 = $row['cust_doc1'];
				$cust_doc2 = $row['cust_doc2'];
				$cust_doc3 = $row['cust_doc3'];
				$cust_residency = $row['cust_residency'];
				//echo $cust_id;
				
				
				//get customer first and last name
				$query = "SELECT * FROM customerinfo WHERE cust_id = {$cust_id}";

				$select_id = mysqli_query($connection, $query);

				while($row = mysqli_fetch_assoc($select_id)) {

				$cust_fname = $row['cust_fname'];
				//echo $cust_fname;
				$cust_lname = $row['cust_lname'];
				$cust_name = $cust_fname . " " . $cust_lname;
				//echo $cust_name;
				}
			
				
				//get customer reserve date
				$query = "SELECT * FROM custrentinfo WHERE cust_id = '$cust_id'";
				$result = mysqli_query($connection, $query);
					
				while($row = mysqli_fetch_assoc($result)) {
							
					$cust_reserve_date = $row['cust_reserve_date'];
					$cust_delitoaddress = $row['cust_delitoaddress'];
					$cust_car_id = $row['cust_car_id'];
					$cust_bill_status = $row['cust_bill_status'];
				}
			
			
			
				 echo "<tr>";

				echo "<td>{$cust_name}</td>";
				 //echo "<td>{$cust_fname}</td>";
				 //echo "<td>{$cust_lname}</td>";
				 echo "<td>{$cust_residency}</td>";
				 echo "<td>{$cust_reserve_date}</td>";
				 
				 if(!empty($cust_doc1)) {
					echo "<td><center><img width='50'  src='../8drivecar/pickavailability/8driveuploads/docimage/$cust_doc1' alt='image'></center></td>";
				 } else {
					 echo "<td><center><p><strong>*to be submitted</strong></p></center></td>";
				 }
				 if(!empty($cust_doc2)) {
					echo "<td><center><img width='50'  src='../8drivecar/pickavailability/8driveuploads/docimage/$cust_doc2' alt='image'></center></td>";
				 } else {
					 echo "<td><center><p><strong>*to be submitted</strong></p></center></td>";
				 }
				 if(!empty($cust_doc3)) {
					echo "<td><center><img width='50'  src='../8drivecar/pickavailability/8driveuploads/docimage/$cust_doc3' alt='image'></center></td>";
				 } else {
					 echo "<td><center><p><strong>*to be submitted</strong></p></center></td>";
				 }
				 echo "<td><center>{$cust_status}</center></td>";

				 echo "<td><center><a href='8drivemodal/docapprovalpage.php?custname={$cust_name}&custid={$cust_id}&cust_reserve_date={$cust_reserve_date}&cust_delitoaddress={$cust_delitoaddress}&cust_car_id={$cust_car_id}&cust_bill_status={$cust_bill_status}&custdoc1={$cust_doc1}&custdoc2={$cust_doc2}&custdoc3={$cust_doc3}&custres={$cust_residency}&custstat={$cust_status}' class='btn btn-info btn-sm' type='submit' name='submit'>Review</a></center></td>";
			
			}
        }
			
        ?>


    </tbody>

</table>


 <!-- page end-->
      </section>
    </section>
    <!--main content end-->
	
	<?php include "8driveAdmin.php"; ?>

      
