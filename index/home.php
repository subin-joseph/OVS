<?php
  include('../../session.php');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ovs";
 
 // Create connection
$conn = new mysqli($servername,$username,$password,$dbname);
	
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " 
        . $conn->connect_error);
}
else {
// Change notification
$fet=mysqli_query($conn,"SELECT * FROM `tbl_notify`");
$row=mysqli_fetch_array($fet);
 if (isset($_POST['submit'])) {
	 
	 $not = mysqli_real_escape_string($conn, $_POST['not']);
	 $sql="TRUNCATE TABLE tbl_notify";
	  $result= mysqli_query($conn, $sql);
	   $sql2="INSERT INTO `tbl_notify`(`id`, `text`) VALUES ('DEFAULT','$not')";  
	   $result2 = mysqli_query($conn, $sql2);
	   header("Location:home.php");
 }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  
  
  
  
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Admin Dashboard</title>
    <!-- plugins:css -->
	 <link rel="stylesheet" href="css3/bootstrap.min.css" />
	  <link rel="stylesheet" href="css3/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="css3/style.css" />
	<link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"
    />
	 
    <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="../assets/vendors/jquery-bar-rating/css-stars.css" />
    <link rel="stylesheet" href="../assets/vendors/font-awesome/css/font-awesome.min.css" />
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../assets/css/demo_1/style.css" />
    <!-- End layout styles -->
    <link rel="icon" type="image/png" href="../../favicons/favicon-16x16.png" sizes="16x16">
  </head>
  <body>
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
	overflow:scroll;
}

table {
    width: 100%;
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
#a{
	text-decoration:none;
	color:black;
}
img {
    display: inline-block;
    width: 40px;
    height: 40px;
    object-fit: cover;
    border-radius:50%;
   
    box-shadow: 0 2px 6px #0003;
}

.save{
	
	 font-size: 15px;
    color: #fff;
    width:10%;
	height:45px;
	float:right;
	border-radius:5px;
	margin-top:5px;
    background:green;
    border: none;
    padding: 14px 15px;
    font-weight: 500;
    transition: .3s ease;
    -webkit-transition: .3s ease;
    -moz-transition: .3s ease;
    -ms-transition: .3s ease;
    -o-transition: .3s ease;

}

#scroll{
  
    width:100%; 
    overflow:auto; 
    position:relative;
    height:720px;

}
</style>
  
  
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile border-bottom">
            <a href="#" class="nav-link flex-column">
              <div class="nav-profile-image">
                <img src="../../<?php echo $_SESSION['img']; ?>"/>
                <!--change to offline or busy as needed-->
              </div>
              <div class="nav-profile-text d-flex ml-0 mb-3 flex-column">
                <span class="font-weight-semibold mb-1 mt-2 text-center"><?php echo $_SESSION['name']; ?></span>
                <span class="text-secondary icon-sm text-center"><?php echo $_SESSION['role']; ?></span>
              </div>
            </a>
          </li>
          
          <li class="pt-2 pb-1">
            <span class="nav-item-head">Admin Control</span>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="home.php">
              <i class="mdi mdi-compass-outline menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="mdi mdi-file-document-box menu-icon"></i>
              <span class="menu-title">Elections</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="pages/prev.php">Previous</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="pages/newelect.php">New</a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/regcontrol.php">
               <i class="mdi mdi-contacts menu-icon"></i>
              <span class="menu-title">Registrations</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/chatbot.php">
			 <i class="mdi mdi-crosshairs-gps menu-icon"></i>
              <span class="menu-title">Chat bot</span>
            </a>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_settings-panel.html -->
        <div id="settings-trigger"><i class="mdi mdi-settings"></i></div>
        <div id="theme-settings" class="settings-panel">
          <i class="settings-close mdi mdi-close"></i>
          <p class="settings-heading">SIDEBAR SKINS</p>
          <div class="sidebar-bg-options selected" id="sidebar-default-theme">
            <div class="img-ss rounded-circle bg-light border mr-3"></div>Default
          </div>
          <div class="sidebar-bg-options" id="sidebar-dark-theme">
            <div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark
          </div>
          <p class="settings-heading mt-2">HEADER SKINS</p>
          <div class="color-tiles mx-0 px-4">
            <div class="tiles default primary"></div>
            <div class="tiles success"></div>
            <div class="tiles warning"></div>
            <div class="tiles danger"></div>
            <div class="tiles info"></div>
            <div class="tiles dark"></div>
            <div class="tiles light"></div>
          </div>
        </div>
        <!-- partial -->
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
          <div class="navbar-menu-wrapper d-flex align-items-stretch">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
              <span class="mdi mdi-chevron-double-left"></span>
            </button>
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
              <a class="navbar-brand brand-logo-mini" href="home.php"><img src="../assets/images/logo-mini.svg" alt="logo" /></a>
            </div>
          
            <ul class="navbar-nav navbar-nav-right">
              <li class="nav-item nav-logout d-none d-md-block mr-3">
               
              </li>
              <li class="nav-item nav-logout d-none d-md-block">
             
              </li>
              <li class="nav-item nav-profile dropdown d-none d-md-block">
                <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                  <div class="nav-profile-text"> <i class="mdi mdi-account-outline"></i> &nbsp;<?php echo $_SESSION['name']; ?> </div>
                </a>
                <div class="dropdown-menu center navbar-dropdown" aria-labelledby="profileDropdown">
                 
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">
                    <i class="fa fa-lock" style="font-size:25px"></i>&nbsp;Change Password </a>
					 <div class="dropdown-divider"></div>
					 <a class="dropdown-item" href="../../logout.php">
                     <i class="fa fa-sign-out" style="font-size:25px"></i>&nbsp;Logout</a>
                </div>
              </li>
              <li class="nav-item nav-logout d-none d-lg-block">
                <a class="nav-link" href="home.php">
                  <i class="mdi mdi-home-circle"></i>
                </a>
              </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
              <span class="mdi mdi-menu"></span>
            </button>
          </div>
        </nav>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper pb-0">
           
            <!-- first row starts here -->
            <div class="row">
              <div class="col-xl-9 stretch-card grid-margin">
                <div class="card">
		 
		 
		 <div>
<form action="#" method="POST">
		 <div class="card-header">
                <span><i class="bi bi-table me-2"></i></span>Notification
              </div>
			  <div class="card-body">
                <div class="table-responsive">
				<label style="font-weight:bold;">
					Current Notification
				</label> &nbsp; 			   <div>
				<input type="text" style="width:100%; 	height:50px;" id="form_fname" name="not" value="<?php echo $row['text'];?>">
			
                  
<label style="margin-top:5px; font-weight:bold;">
				New Notification
				</label > &nbsp; <span class="error_form" id="fname_error_message"></span>			   <div>
				<input type="text" style="width:100%; 	margin-top:5px; height:50px;" id="form_fname" name="not" required="">
		 <button name="submit" class="save" id="regbtn" type="submit">Save</button>

		 
</div>
<div class="col-md-12 mb-3">
            <div class="card">
               </div>
		  
  
        </div>
                </div>
              </div>
			  </form>
            </div>
			
			
			
			
          </div>
        </div>
              </div>
              <div class="col-xl-3 stretch-card grid-margin">
                <div class="card card-img"  style="border-radius:10px;">
              
                   <table>
				   <tr style="background:transparent;">
				<th style="color:#ffff;text-align:center; font-size:15px;border:none;">My Profile</th>
                </tr>
				   
				   <tr style="background:transparent;">
                       <td style="border:none;">
                <img style="font-size:100px; margin-left:40%;" src="../../<?php echo $_SESSION['img']; ?>"/>
                <!--change to offline or busy as needed-->
                       </td>
				<tr style="background:transparent;">
				<td style="color:#ffff;text-align:center; border:none;"><?php echo $_SESSION['name']; ?></td>
                </tr>
               <tr style="background:transparent;">
				<td style="color:#ffff;text-align:center; border:none;"><?php echo $_SESSION['role']; ?></td>
                </tr>
<tr style="background:transparent;">
				<td style="color:#ffff;text-align:center; border:none;"><?php echo $_SESSION['contact']; ?></td>
				<tr style="background:transparent;">
				<td style="color:#ffff;text-align:center; border:none;"><?php echo $_SESSION['email']; ?></td>
                </tr>	
                </tr>	
<tr style="background:transparent;">
				<td style="color:#ffff;text-align:center; border:none;"><button class="btn bg-white font-12">Edit Profile</button></td>
                </tr>					
                   </table>
				   
                   
                  
                </div>
              </div>
            </div>
            <!-- chart row starts here -->
            <div class="row">
              <div class="col-sm-6 stretch-card grid-margin">
                <div class="card">
              <div class="card-header">
                <span><i class="bi bi-table me-2"></i></span>Sub Administrators
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
              <div class="col-sm-6 stretch-card grid-margin">
                    <div class="card" >
              <div class="card-header">
                <span><i class="bi bi-table me-2"></i></span>Verified Voters
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table
                    id="example"
                    class="table table-striped data-table"
                    style="width: 100%"
                  >
                    <thead>
<tr> <th>Photo</th>
    <th>Name</th>
	<th>Age</th>
	<th>Gender</th>
	<th>Address</th>
	

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
  
    <td align="center"><img width="60" height="50" src="../../<?php echo $row['img'];?>"> </td>
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
            </div>
            <!-- image card row starts here -->
           
            <!-- table row starts here -->
            <div class="row">
              <div class="col-xl-4 grid-margin">
                <div class="card card-img"  style="border-radius:10px;">
                  <div class="card-body">
                    <div class="">
                      <div class="text-white">
                   <img style="width:50%; height:5%; border-radius:2px; margin-left:25%;" src="../assets/images/logo2.png"><br>
				    <img style="width:50%; height:10%; border-radius:2px; margin-left:25%;" src="../assets/images/stamp.jpg">
                        
                      </div>
                     
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-body">
				  
				  
				   <div class="d-flex border-bottom mb-4 pb-2">
                      <div class="hexagon">
                        <div class="hex-mid hexagon-danger">
                          <i class="mdi mdi-account-outline"></i>
                        </div>
                      </div>
                      <div class="pl-4">
                        <h4 class="font-weight-bold text-danger mb-0"><?php  echo $_SESSION['count']; ?></h4>
                        <h6 class="text-muted">Total users </h6>
                      </div>
                    </div>
				  <div class="d-flex border-bottom mb-4 pb-2">
                      <div class="hexagon">
                        <div class="hex-mid hexagon-success">
                          <i class="mdi mdi-account-outline"></i>
                        </div>
                      </div>
                      <div class="pl-4">
                        <h4 class="font-weight-bold text-success mb-0"><?php  echo $_SESSION['c_count']; ?></h4>
                        <h6 class="text-muted" ><a href="pages/candreg.php">Registered Candidates</a> </h6>
                      </div>
                    </div>
					
					 
                    <div class="d-flex border-bottom mb-4 pb-2">
                      <div class="hexagon">
                        <div class="hex-mid hexagon-info">
                          <i class="mdi mdi-account-outline"></i>
                        </div>
                      </div>
                      <div class="pl-4">
                        <h4 class="font-weight-bold text-info mb-0"><?php  echo $_SESSION['v_count']; ?></h4>
                        <h6 class="text-muted"><a href="pages/voters_list.php">Verified Voters</a> </h6>
                      </div>
                    </div>
					
					
                    <div class="d-flex border-bottom mb-4 pb-2">
                      <div class="hexagon">
                        <div class="hex-mid hexagon-warning">
                          <i class="mdi mdi-account-outline"></i>
                        </div>
                      </div>
                      <div class="pl-4">
                        <h4 class="font-weight-bold text-warning mb-0"><?php  echo $_SESSION['s_count']; ?></h4>
                        <h6 class="text-muted"><a href="pages/subadmin.php">Administrators</a> </h6>
                      </div>
                    </div>
                  
                  </div>
                </div>
              </div>
              <div class="col-xl-8 stretch-card grid-margin">
                <div class="card">
                 
                      <div class="row">
          <div class="col-md-12 mb-3">
            <div class="card" id="scroll">
              <div class="card-header">
                <span><i class="bi bi-table me-2"></i></span>History Log
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table
                    id="example"
                    class="table table-striped data-table"
                    style="width: 100%"
                  >
                    <thead>
                      <tr>
                        <th>USERNAME</th>
                        <th>ROLE</th>
	                    <th>ACTION</th>
	                    <th>DATE</th>
                      </tr>
                    </thead>
                    <tbody>
                      
 <?php
 $sql = "SELECT * from tbl_history";
 $result = $conn->query($sql);
 if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
	 ?>
  <tr>
   
	<td><?php echo $row['username'] ?></td>
	<td><?php echo $row['role'] ?></td>
	<td><?php echo $row['Action'] ?></td>
	<td><?php echo $row['date'] ?></td>
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
            </div>
            <!-- doughnut chart row starts -->
            
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
	
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="../assets/vendors/jquery-bar-rating/jquery.barrating.min.js"></script>
    <script src="../assets/vendors/chart.js/Chart.min.js"></script>
    <script src="../assets/vendors/flot/jquery.flot.js"></script>
    <script src="../assets/vendors/flot/jquery.flot.resize.js"></script>
    <script src="../assets/vendors/flot/jquery.flot.categories.js"></script>
    <script src="../assets/vendors/flot/jquery.flot.fillbetween.js"></script>
    <script src="../assets/vendors/flot/jquery.flot.stack.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../assets/js/off-canvas.js"></script>
    <script src="../assets/js/hoverable-collapse.js"></script>
    <script src="../assets/js/misc.js"></script>
    <script src="../assets/js/settings.js"></script>
    <script src="../assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->

    <script src="../assets/js/dashboard.js"></script>
	
	
	 <script src="./js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
    <script src="./js/jquery-3.5.1.js"></script>
    <script src="./js/jquery.dataTables.min.js"></script>
    <script src="./js/dataTables.bootstrap5.min.js"></script>
    <script src="./js/script.js"></script>
    <!-- End custom js for this page -->
  </body>
</html>