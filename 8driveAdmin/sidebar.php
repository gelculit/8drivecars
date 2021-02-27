<?php ob_start(); ?>
<?php include "db.php"; ?>




    <!--sidebar start-->
    <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu">
          <li class="sub-menu"><!--li class="active-->
			<a href="javascript:;" class="">
                          <i class="glyphicon glyphicon-dashboard"></i>
                          <span>Dashboard</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
            </a>
		  
		  <!--
            <a class="" href="index.php">
                <i class="icon_house_alt"></i>
                <span>Dashboard</span>
				<span class="menu-arrow arrow_carrot-right"></span>
             </a>
			 -->
			 
			 <ul class="sub">
				<li><a href="carprice.php">Season Pricing</a></li>
				<li><a href="zoneDestination.php">Zone Maintenance</a></li>
				
            </ul>
          </li>
          <li class="sub-menu">
            <a href="javascript:;" class="">
                          <i class="glyphicon glyphicon-th-list"></i>
                          <span>Car Detail</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
            <ul class="sub">
              <!--<li><a class="" href="form_component.html">Form Elements</a></li>-->
              
			 
				
			  <li><a class="" href="cardetail.php">Add Car Information</a></li>
			  <!--<li><a class="" href="#">Drive It Yourself</a></li>-->
			  <li><a class="" href="carList.php">Car List Maintenance</a></li>
			  <li><a class="" href="carinventory.php">Car Inventory</a></li>
            </ul>
          </li>
		  
		  <!--
		  <li class="sub-menu">
            <a href="javascript:;" class="">
                          <i class="icon_table"></i>
                          <span>Chauffered</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
            <ul class="sub">
              <!--<li><a class="" href="form_component.html">Form Elements</a></li>-->
              

			  
			  <!--<li><a class="" href="#">Drive It Yourself</a></li>-->
			  <!--
			  <li><a class="" href="ChaufServ.php">Add Fee List</a></li>
			  <?php //include "table.php"; ?>
			  <li><a class="" href="chaufDestination.php">Destination</a></li>
			  <li><a class="" href="chaufCarType.php">Car Type</a></li>
            </ul>
          </li>-->
		  
		  <li class="sub-menu">
            <a href="javascript:;" class="">
                          <i class="glyphicon glyphicon-user"></i>
                          <span>Customer</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
            <ul class="sub">
              <!--<li><a class="" href="form_component.html">Form Elements</a></li>-->
              

			  
			  <!--<li><a class="" href="#">Drive It Yourself</a></li>-->
			  
			  <li><a class="" href="customerlist.php">Customer Info</a></li>
			  <?php //include "table.php"; ?>
			 
			  <li><a class="" href="custrentmaint.php">Customer Rent Status</a></li>
			  
            </ul>
          </li>
		  
		  <li class="sub-menu">
            <a href="javascript:;" class="">
                          <i class="glyphicon glyphicon-book"></i>
                          <span>Reservations</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
            <ul class="sub">
              <!--<li><a class="" href="form_component.html">Form Elements</a></li>-->
              

			  
			  <!--<li><a class="" href="#">Drive It Yourself</a></li>-->
			  
			  <li><a class="" href="docapprove.php">Document Approval</a></li>
			  <?php //include "table.php"; ?>
			  
			  <li><a class="" href="reservevehiclepage.php">Vehicle Reservation</a></li>
			  
            </ul>
          </li>
		  
		  <li class="sub-menu">
            <a href="javascript:;" class="">
                          <i class="glyphicon glyphicon-usd"></i>
                          <span>Cash Flow</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
            <ul class="sub">
				<!--
				<li><a class="" href="#">Update Payment</a></li>
				<li><a class="" href="#">Pay Completion</a></li>
				-->
				<li><a class="" href="../8drivecar/pickavailability/cashflow.php">Review Cashflow</a></li>
            </ul>
          </li>

		  

        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>
    <!--sidebar end-->
	
	<!--
	<section id="main-content">
      <section class="wrapper">
        <!--overview start
        <div class="row">
          <div class="col-lg-12">
            <img src="img/slide1.jpg" alt="" width=100%>
          </div>
        </div>
	  </section>
	</section>
	-->
<!---***********************************************************************************-->
	