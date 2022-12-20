<?php
  include('session.php');
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
 $chck=mysqli_query($conn,"select * from tbl_election");
 $count=mysqli_num_rows($chck);
 $fet=mysqli_fetch_array($chck);
 $msg="";
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Admin-Election</title>
    <!-- plugins:css -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../../assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="../../assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End Plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../../assets/css/demo_1/style.css" />
    <!-- End layout styles -->
    <link rel="icon" type="image/png" href="../../../favicons/favicon-16x16.png" sizes="16x16">
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
    overflow: auto;
    margin: auto;
    border-radius:10px;
}

table {
    width:100%;
		overflow:hidden;
    font-size: 13px;
    color: #444;
    white-space: nowrap;
    border-collapse: collapse;
	align-items:center;
}

table>thead {
    background-color:green;
    color: #fff;
}

table>thead th {
   padding: 15px;
}

table th,
table td {
    border: 1px solid #00000017;
    padding:auto;
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

.deletebtn {
	font-family: Arial;
	color: #FFFFFF;
	font-size: 12px;
	text-decoration:none;
	border-radius: 5px;
	border: 1px #d83526 solid;
	background: linear-gradient(180deg, #fe1900 5%, #ce0000 100%);
	text-shadow: 1px 1px 1px #b23d35;
	box-shadow: inset 1px 1px 2px 0px #f29d93;
	cursor: pointer;
	display: inline-flex;
	align-items: center;
}
.deletebtn:hover {
		color: #FFFFFF;
	background: linear-gradient(180deg, #ce0000 5%, #fe1900 100%);
}
.deletebtn-icon {
	padding: 10px 0px;
}
.deletebtn-icon svg {
	vertical-align: middle;
	position: relative;
	top: -1px;
	left: 11px;
}
.deletebtn-text {
	padding: 10px 18px;
}

.editbtn {
	font-family: Arial;
	color: #FFFFFF;
	font-size: 12px;
	border-radius: 5px;
	text-decoration:none;
	border: 1px #3381ed solid;
	background: linear-gradient(180deg, #3d93f6 5%, #1e62d0 100%);
	text-shadow: 1px 1px 1px #1571cd;
	box-shadow: inset 1px 1px 2px 0px #97c4fe;
	cursor: pointer;
	display: inline-flex;
	align-items: center;
}
.editbtn:hover {
	background: linear-gradient(180deg, #1e62d0 5%, #3d93f6 100%);
	color: #FFFFFF;
}
.editbtn-icon {
	padding: 10px 7px;
}
.editbtn-icon svg {
	vertical-align: middle;
	position: relative;
	top: -1px;
	left: 11px;
}
.editbtn-text {
	padding: 10px 14px;
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


  input[type=text],input[type=email],input[type=number]select {
  width:30%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=submit] {
  width:30%;
  background-color: #31be4b;
  color: white;
  padding: 10px 20px;

  margin-left:5%;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}


input[type=reset] {
  width:30%;
  background-color:red;
  color: white;
  padding: 10px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  margin-left:10%;
}

input[type=reset]:hover {
  background-color:#DC143C;
}

#div {
  border-radius: 5px;
  padding: 20px;
  width:25%;
  height:40 %;
  margin-left:40%;
 background-color:#fdffff;
  margin-top:2%;
}


.css-button {
	font-family: Arial;
	color: #ffffff;
	text-decoration: none;
	font-size: 12px;
	padding:1px 5px;
	border-radius: 5px;
	border: 1px #74b807 solid;
	background: linear-gradient(180deg, #8ac403 5%, #78a809 100%);
	text-shadow: 1px 1px 1px #528009;
	box-shadow: inset 1px 1px 2px 0px #a4e271;
	cursor: pointer;
	display: inline-flex;
	align-items: center;
}
.css-button:hover {
	background: linear-gradient(180deg, #78a809 5%, #8ac403 100%);
	  color:#FFFFFF;
}
.css-button-icon {
	padding: 10px 10px;
	border-right: 1px solid rgba(255, 255, 255, 0.16);
	box-shadow: rgba(0, 0, 0, 0.14) -1px 0px 0px inset;
}
.css-button-icon svg {
	vertical-align: middle;
	position: relative;
}
.css-button-text {
	padding: 10px 18px;
}



.css-button2 {
	font-family: Arial;
	color: #ffffff;
	font-size: 12px;
	text-decoration: none;
	padding:1px 5px;
	border-radius: 5px;
	border: 1px #3381ed solid;
	background: linear-gradient(180deg, #0000cd 5%, #14149e 100%);



	text-shadow: 1px 1px 1px #1571cd;
	box-shadow: inset 1px 1px 2px 0px #97c4fe;
	cursor: pointer;
	display: inline-flex;
	align-items: center;
}
.css-button2:hover {
  background: linear-gradient(180deg, #14149e 5%, #0000cd 100%);
  color:#FFFFFF;
}
.css-button2-icon {
	padding: 10px 10px;
	border-right: 1px solid rgba(255, 255, 255, 0.16);
	box-shadow: rgba(0, 0, 0, 0.14) -1px 0px 0px inset;
}
.css-button2-text {
	padding: 10px 18px;
}

.css-button3{
	font-family: Arial;
	color: #FFFFFF;
	font-size: 12px;
	text-decoration: none;
	font-size: 12px;
	padding:1px 5px;
	border-radius: 5px;
	border: 1px #d83526 solid;
	background: linear-gradient(180deg, #fe1900 5%, #ce0000 100%);
	text-shadow: 1px 1px 1px #b23d35;
	box-shadow: inset 1px 1px 2px 0px #f29d93;
	cursor: pointer;
	display: inline-flex;
	align-items: center;
}
.css-button3:hover {
	background: linear-gradient(180deg, #ce0000 5%, #fe1900 100%);
	color: #FFFFFF;
}
.css-button3-icon {
	padding: 10px 10px;
	border-right: 1px solid rgba(255, 255, 255, 0.16);
	box-shadow: rgba(0, 0, 0, 0.14) -1px 0px 0px inset;
}
.css-button3-text {
	padding: 10px 18px;
}
#btngrp{
	margin-left:14.5%;
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



.editbtn-text {
	font-family: Arial;
	color: #ffffff;
	font-size: 13px;
	width:100px;
	text-decoration:none;
	border-radius: 5px;
	border: 1px #3381ed solid;
	background: linear-gradient(180deg, #3d93f6 5%, #1e62d0 100%);
	cursor: pointer;
	display: inline-flex;
	align-items: center;
}
.editbtn-text:hover {
	color: #ffffff;
	background: linear-gradient(180deg, #1e62d0 5%, #3d93f6 100%);
}
.editbtn-text-icon {
	padding: 8px 3px;
	color: #ffffff;
	text-shadow: none;
}


#input{
	width:70.5%;
	margin-left:13%;
	text-align:center;
	
}
img {
    display: inline-block;
    width: 40px;
    height: 40px;
    object-fit: cover;
    border-radius:50%;
   
    box-shadow: 0 2px 6px #0003;
}

  </style>
  <body>
  <?php
  if($count==0){
	  echo "<script>window.location.href='create.php';</script>";
  }
  ?>
    <div class="container-scroller">
      <!-- partial:../../partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile border-bottom">
            <a href="#" class="nav-link flex-column">
              <div class="nav-profile-image">
                <img src="../../../<?php echo $_SESSION['img']; ?>"/>
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
            <a class="nav-link" href="../home.php">
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
                  <a class="nav-link" href="prev.php">Previous</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="newelect.php">New</a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="regcontrol.php">
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
        <!-- partial:../../partials/_settings-panel.html -->
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
        <!-- partial:../../partials/_navbar.html -->
        <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
          <div class="navbar-menu-wrapper d-flex align-items-stretch">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
              <span class="mdi mdi-chevron-double-left"></span>
            </button>
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
              <a class="navbar-brand brand-logo-mini" href="../../index.html"><img src="../../../assets/images/logo-mini.svg" alt="logo" /></a>
            </div>
          
            <ul class="navbar-nav navbar-nav-right">
              <li class="nav-item nav-logout d-none d-md-block mr-3">
               
              </li>
              <li class="nav-item nav-logout d-none d-md-block">
			   <?php if($fet['election_status']==1){?>
			     <button class="" style="background:transparent; border:none;">
			<a class="btn btn-sm btn-danger" style ="background-color:#228B22; border:1px solid #228B22;" href="start_poll.php?id=<?php echo $fet['id'];?>">
           Start Poll</a></button>

			 <?php } else if($fet['election_status']==2){ ?><div>
			 <button class="btn btn-sm btn-danger" style ="background-color:#228B22; border:1px solid #228B22;">polling on</button>
			  <button class="" style="background:transparent; border:none;">
			  <a class="btn btn-sm btn-danger" style ="background-color:#DC143C; border:1px solid #DC143C;" href="end.php?id=<?php echo $fet['id'];?>" style="text-color:#ffff;">
	Stop poll
</a></button>

</div>
<?php  }  else if($fet['election_status']==3){?>  <div>  <button class="" style="background:transparent; border:none;">
<a class="btn btn-sm btn-danger" style ="background-color:#228B22; border:1px solid #228B22;" href="voted.php">
	voted
</a></button>

  <button class="" style="background:transparent; border:none;">
<a class="btn btn-sm btn-danger" style ="background-color:#DC143C; border:1px solid #DC143C; " href="unvoted.php">
	Unvoted
</a>
</button>
  <button class="" style="background:transparent; border:none;">
<a class="btn btn-sm btn-danger" style ="background-color:#40826D; border:1px solid #40826D;" id="myBtn">
	Publish Result
</a>
</button>
</div><?php } else if($fet['election_status']==4){
	echo "<script>window.location.href='result_final.php';</script>";
}?>
			  
                
              </li>
              <li class="nav-item nav-profile dropdown d-none d-md-block">
                <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                  <div class="nav-profile-text"><i class="mdi mdi-account-outline"></i> &nbsp;<?php echo $_SESSION['name']; ?> </div>
                </a>
                <div class="dropdown-menu center navbar-dropdown" aria-labelledby="profileDropdown">
                 
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">
                    <i class="fa fa-lock" style="font-size:25px"></i>&nbsp;Change Password </a>
					 <div class="dropdown-divider"></div>
					 <a class="dropdown-item" href="../../../logout.php">
                     <i class="fa fa-sign-out" style="font-size:25px"></i>&nbsp;Logout</a>
                </div>
              </li>
              <li class="nav-item nav-logout d-none d-lg-block">
                <a class="nav-link" href="../../index.html">
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
          <div class="content-wrapper">
            
            
                      
            <div class="row">
              <div class="col-sm-12 stretch-card grid-margin">
                <div class="card">
               
			    <div class="card">
		 
		 
		 <div>

		 
			
			
			
			
			
			
			
			
              <div class="card-header">
                <span><i class="bi bi-table me-2"></i></span>Final Voter List
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
	<th>Status</th>
	
</tr>
</thead>
<tbody>
 
 <?php
 $sql = "SELECT * from tbl_voters where status=2 or status=5";
 $result = $conn->query($sql);
 if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
	  ?>
  <tr>
    <td align="center"><img width="60" height="50" src="../../../<?php echo $row['img'];?>"> </td>
    <td><?php echo $row['first name']." ". $row['lastname'] ?></td>
	<td><?php echo $row['Age'] ?></td>
	<td><?php echo $row['gender'] ?></td>
	<td><?php if ($row['Status']==5){
		
		?>
		
		<button class="" style="background:transparent; border:none;">
<a class="btn btn-sm btn-danger" style ="background-color:#228B22; border:1px solid #228B22;" >
	voted
</a></button>
		<?php
		
	} 
	
	else {?>
	<button class="" style="background:transparent; border:none;">
<a class="btn btn-sm btn-danger" style ="background-color:red; border:1px solid red;" >
	Unvoted
</a></button>
	<?php }?></td>
</a>
</td>
  </tr>
  </tr>
 <?php
 }
 }
    ?> 
	 </tbody>
</table> 
 </div>
 </div>
<div class="card-header">
                <span><i class="bi bi-table me-2"></i></span>Final Candidate List 
              </div>
			  <div class="card-body">
                <div class="table-responsive">
                  
<table
  id="example"
  class="table table-striped data-table"
  style="width: 100%">
<thead>
<tr> <th>Photo</th>
    <th>Name</th>
	<th>Age</th>
	<th>Gender</th>
	<th>Party</th>
	<th>Symbol</th>
</tr>
</thead>
<tbody>

 <?php
 $sql = "SELECT * from tbl_candidate where status=2";
 $result = $conn->query($sql);
 if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
	  ?>
  <tr>
    <td align="center"><img width="60" height="50" src="../../../<?php echo $row['img'];?>"> </td>
    <td><?php echo $row['first name']." ". $row['lastname'] ?></td>
	<td><?php echo $row['Age'] ?></td>
	<td><?php echo $row['gender'] ?></td>
	<td><?php echo $row['party'] ?></td>
    <td align="center"><img width="60" height="50" src="../../../<?php echo $row['symbol'];?>"> </td>
  </tr>
 <?php
 }
 }
    ?> 
	 </tbody>
</table> 

		 
</div>
<div class="col-md-12 mb-3">
            <div class="card">
               </div>
		  <div id="myModal" class="modal">

  <div class="modal-content" id="div">
 
    <form action="result.php?id=<?php echo $fet['id'];?>" method="POST" >
	<div>
    <label style="font-weight:bold;">Are you sure want to publish final result?</label><br>
<input type="reset" id="bn" name="reset" value="Cancel">   <input type="submit" id="bn" name="submit" value="Publish">
	</div>
  </form>
  </div>

</div>
  
        </div>
                </div>
              </div>
            </div>
			   
			   
              </div>
            </div>
            
		
    <!-- plugins:js -->

	
    <script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
		<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
var bn = document.getElementById("bn");
bn.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

</script>
	
    <script src="../../assets/js/off-canvas.js"></script>
    <script src="../../assets/js/hoverable-collapse.js"></script>
    <script src="../../assets/js/misc.js"></script>
    <script src="../../assets/js/settings.js"></script>
    <script src="../../assets/js/todolist.js"></script>
	<script src="../js/jquery-3.5.1.js"></script>
    <script src="../js/jquery.dataTables.min.js"></script>
    <script src="../js/dataTables.bootstrap5.min.js"></script>
    <script src="../js/script.js"></script
    <!-- endinject -->
    <!-- Custom js for this page -->
    <!-- End custom js for this page -->
  </body>
</html>