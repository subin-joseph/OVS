<?php
  include('session.php');
include('../config.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Candidate Dashboard</title>
  <!-- base:css -->
  <link rel="stylesheet" href="css/dataTables.bootstrap5.min.css" />
   <link rel="stylesheet" href="css/style1.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/style.css">
  <!-- endinject -->
  <link rel="icon" type="image/png" href="../favicons/favicon-16x16.png" sizes="16x16">
</head>
<style>

@import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;500&display=swap');

* {
    box-sizing: border-box;
}

body>div{
    min-height: 100vh;
    display: flex;
    font-family: 'Roboto', sans-serif;
}

.table_responsive {
    max-width: 900px;
    border: 1px solid #00bcd4;
    background-color: #efefef33;
    padding:10px;
    margin: auto;
    border-radius:10px;
}

table {
    width:10%;
    font-size: 13px;
    color: #444;
    white-space: nowrap;
    border-collapse: collapse;
   
}

table>thead {
    background: linear-gradient(180deg, #14149e 5%, #0000cd 100%);
    color: #fff;
}

table>thead th {
    padding: 15px;
}

table th,
table td {
    border: 1px solid #00000017;
    padding: 10px 15px;
}

table>tbody>tr>td>img {
    display: inline-block;
    width: 50px;
    height: 50px;
    object-fit: cover;
    border-radius:30%;
    border: 2px solid #fff;
    box-shadow: 0 2px 6px #0003;
}



table>tbody>tr {
    background-color: #fff;
    transition: 0.3s ease-in-out;
}


table>tbody>tr:nth-child(even) {
    background-color: rgb(238, 238, 238);
}

table>tbody>tr:hover{
    filter: drop-shadow(0px 2px 6px #0002);
}
a{
	text-decoration:none;
	color:black;
}

a:hover{
	text-decoration:none;
	color:black;
}
.img {
    display: inline-block;
    width:40%;
    height: 40%;
	margin:auto;
    object-fit: cover;
    border-radius:50%;
   
    box-shadow: 0 2px 6px #0003;
}
.img2{
    display: inline-block;
    width:100%;
    height:100%;
	margin:auto;
    object-fit: cover;
       
    box-shadow: 0 2px 6px #0003;
}
.img3{
    display: inline-block;
    width:45%;
    
	margin-left:60px;
    object-fit: cover;
    border-radius:48%;
    margin-bottom:6px;
    box-shadow: 0 2px 6px #0003;
}

.icon{
	 width:8%;
    height:8%;
}
.text-muted{
	margin-left:11px;
}
.vl {
  border-bottom: 4px solid #ffff;
    margin-bottom:10px;
 
}
</style>
<body>

 <?php
 $cand_id=$_SESSION['id'];
 $pay=mysqli_query($conn,"select payment from tbl_candidate where login_id='$cand_id'");
 $payfet=mysqli_fetch_array($pay);
 if($payfet['payment']==0){
	                header('Location:payment.php');
 }
 ?>
  <div class="container-scroller d-flex">
    <!-- partial:./partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
      <ul class="nav">
	  <img class="img" src="../<?php echo $_SESSION['img']; ?>"/>
        <li class="nav-item sidebar-category">
          <p style="margin-left:40%;"><?php echo $_SESSION['role']; ?></p>
          <span></span>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php">
            <i class="mdi mdi-view-quilt menu-icon"></i>
            <span class="menu-title">Dashboard</span>
          
          </a>
        </li>
        <li class="nav-item sidebar-category">
          <p>Controls</p>
          <span></span>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
           <i class="mdi mdi-view-headline menu-icon"></i>
            <span class="menu-title">Election</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="ui-basic">
            <ul class="nav flex-column sub-menu">
			
     
              <li class="nav-item"> <a class="nav-link" href="result.php"> <i class="mdi mdi-chart-pie menu-icon"></i>Result</a></li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="status.php">
           <i class="mdi mdi-grid-large menu-icon"></i>
            <span class="menu-title">Status</span>
          </a>
        </li>
         <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#ui-basic2" aria-expanded="false" aria-controls="ui-basic">
           <i class="mdi mdi-file-document-box-outline menu-icon"></i>
            <span class="menu-title">Payment</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="ui-basic2">
            <ul class="nav flex-column sub-menu">
     
   			<li class="nav-item"> <a class="nav-link" href="p_status.php"> <i class="mdi mdi-assistant"></i>&nbsp;&nbsp;Status</a></li>
             <li class="nav-item"> <a class="nav-link" href="p_receipt.php"> <i class="mdi mdi-account-card-details"></i>&nbsp;&nbsp;Reciept</a></li>
			</ul>
          </div>
        </li>
		
        <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
            <i class="mdi mdi-account menu-icon"></i>
            <span class="menu-title"><?php echo $_SESSION['name']; ?></span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="auth">
            <ul class="nav flex-column sub-menu">
     
              <li class="nav-item"> <a class="nav-link" href="changepass.php"> <i class="mdi mdi-settings text-primary"></i> Change Password</a></li>
              <li class="nav-item"> <a class="nav-link" href="logout.php"><i class="mdi mdi-logout text-primary"></i>Logout </a></li>
            </ul>
          </div>
        </li>
        
      </ul>
    </nav>
    <!-- partial -->
    
      <!-- partial:./partials/_navbar.html -->
     
      <!-- partial -->
   
	   
        <div class="content-wrapper"> <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>
		  <div class="navbar-menu-wrapper navbar-search-wrapper d-none d-lg-flex align-items-center">
          
          
        </div>
         
          <div class="row">
		  <!-- Payment Gateway -->
		  
		  
		  <div class="col-12 col-xl-6 grid-margin stretch-card">
              <div class="row w-100 flex-grow">
                <div class="col-md-6 grid-margin stretch-card">
				
				  
				 <div class="card" > 
				 
				 <?php
				 $sid=$_SESSION['id'];
				 $sql3=mysqli_query($conn,"select * from tbl_login where id='$sid'");
                 $row3=mysqli_fetch_array($sql3);
				 $sql2= "SELECT * from tbl_candidate where login_id='$sid'";
				 
 $result2= $conn->query($sql2);
 
 if ($result2->num_rows > 0) {
  // output data of each row
  while($row2 = $result2->fetch_assoc()) {
	  ?>
	 
	  <img style="border-radius:10px;" class="img2" src="../<?php echo $row2['proof'];?>">
      
                  </div> &nbsp;
                  <div class="card" style="border-radius:20px; background:url('images/profile.jpg');">
                    <div class="card-body">
                      <p class="card-title" style="color:#ffff; margin-left:34%; margin-bottom:8px;">My Profile</p>
					  <div class="vl">
					  <img class="img3" src="../<?php echo $_SESSION['img']; ?>"/>
					   </div>
                      <p class="text-muted"><img class="icon" src="images/name.png">&nbsp;<?php echo $row2['first name']." ".$row2['lastname']?></p>
					   <p class="text-muted"><img class="icon" src="images/email.png">&nbsp;<?php echo $row3['email'];?></p>
					   <p class="text-muted"><img class="icon" src="images/phone.png">&nbsp;<?php echo $row2['contact'];?></p>
					   <p class="text-muted"><img class="icon" src="images/age.png">&nbsp;<?php echo $row2['Age'];?></p>
					   <p class="text-muted"><img class="icon" src="images/gen.png">&nbsp;<?php echo $row2['gender'];?></p>
                      <p class="text-muted"><img class="icon" src="images/loc.png">&nbsp;<?php echo $row2['address'];?></p>
					  <button class="btn bg-white font-12" type="button" style="margin-left:50px; margin-top:8px; font-size:15px; padding:5px;" data-toggle="modal" type="button" data-target="#update_modal<?php echo $row2['login_id']?>"> 
					  <i class="fa fa-edit"></i>&nbsp;Edit Profile</button>
                    </div>
                  </div>
				  
				  
				
				  
				  
				  
				  
                </div>
               
              </div>
            </div>
			 
	<div class="col-12 col-xl-6 grid-margin stretch-card">
              <div class="row w-100 flex-grow">
                <div class="col-md-12 grid-margin stretch-card">
                  <div class="card">
              <div class="card">
              <div class="card-header">
                <span><i class="bi bi-table me-2"></i></span>Regional Administrators
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table
                    id="example"
                    class="table table-striped data-table"
                    style="width: 100%"
                  >
                    <thead>
<tr> <th>Region</th>
    <th>Officer name</th>
	<th>Contact</th>

</tr>
</thead>
                    <tbody>

					<?php 
			
			include 'updateprofile.php'; }}?>
    </main>
        
  
 <?php
 $sql = "SELECT * from tbl_users where status=1";
 $result = $conn->query($sql);
 if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
	  ?>
  <tr>
    <td><?php echo $row['area'] ?></td>
    <td><?php echo $row['first name']." ". $row['lastname'] ?></td>
	<td><?php echo $row['contact'] ?></td>

  </tr>
 <?php
 }
 }
    ?> 
	 </tbody>
                    
                  </table>
                </div>
              </div>
           
			  
			
                  </div>
                </div>
                
              </div>
            </div>
		
	      
          </div>
		
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Voter List</h4>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>Photo</th>

    <th>Name</th>
	<th>Age</th>
	<th>Gender</th>
	<th>Region</th>

                        </tr>
                      </thead>
                      <tbody>

    </main>
        
  
 <?php
 $sql = "SELECT * from tbl_voters where status=2";
 $result = $conn->query($sql);
 if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
	  ?>
   <tr>
  
    <td align="center"><img width="60" height="50" src="../<?php echo $row['img'];?>"> </td>
    <td><?php echo $row['first name']." ". $row['lastname'] ?></td>
	<td><?php echo $row['Age'] ?></td>
	<td><?php echo $row['gender'] ?></td>
	<td><?php echo $row['area'] ?></td>
  </tr>
 <?php
 }
 }
    ?> 
	 </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
     
         <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Candidate List</h4>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>Photo</th>
    <th>Name</th>
	<th>Age</th>
	<th>Gender</th>
	<th>Party</th>
	<th>Symbol</th>

                        </tr>
                      </thead>
                      <tbody>

    </main>
        
  
 <?php
 $sql = "SELECT * from tbl_candidate where status=2";
 $result = $conn->query($sql);
 if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
	  ?>
  <tr>
    <td align="center"><img width="60" height="50" src="../<?php echo $row['img'];?>"> </td>
    <td><?php echo $row['first name']." ". $row['lastname'] ?></td>
	<td><?php echo $row['Age'] ?></td>
	<td><?php echo $row['gender'] ?></td>
	<td><?php echo $row['party'] ?></td>
	<td align="center"><img width="60" height="50" src="../<?php echo $row['symbol'];?>"> </td>

  </tr>
 <?php
 }
 }
    ?> 
	 </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          <!-- row end -->
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:./partials/_footer.html -->
        
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
   
    <!-- page-body-wrapper ends -->
  
  <!-- container-scroller -->

  <!-- base:js -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="vendors/chart.js/Chart.min.js"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <!-- endinject -->
  <!-- plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- Custom js for this page-->
  <script src="js/dashboard.js"></script>
  <!-- End custom js for this page-->
  <script src="../js/jquery-3.5.1.js"></script>
    <script src="../js/jquery.dataTables.min.js"></script>
    <script src="../js/dataTables.bootstrap5.min.js"></script>
    <script src="../js/script.js"></script>
	<script src="js/jquery-3.2.1.min.js"></script>	
<script src="js/bootstrap.js"></script>	
</body>

</html>