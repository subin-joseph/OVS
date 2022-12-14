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
else {
	 $msg = "";
if (isset($_POST['submit'])){
$id = $_SESSION['id'];
$oldpass=md5($_POST['Old_password']);
$Password= md5($_POST['New_password']);
$Confirmpassword= md5($_POST['Confirm_New_password']);
$login=mysqli_query($conn,"select * from tbl_login where id='$id'");
$row=mysqli_fetch_array($login);
if ($row["password"] == "$oldpass")
     {
		 if($Password==$Confirmpassword){
			 if($Password==$row["password"] ){
		      $msg = "<div class='alert alert-info'>Early used password are not allowed</div>";
		     }
		 else{
          $update=mysqli_query($conn,"UPDATE `tbl_login` SET `password`='$Password' WHERE id='$id'");
		  $msg = "<div class='alert alert-succes'>Password Updated Successfully</div>";
		 }
		 }
		
		 else{
			 $msg = "<div class='alert alert-danger'>Passwords do not match.</div>";
		     }
		 }
		 
	  else
	     {
	      $msg = "<div class='alert alert-danger'>Old password is Incorrect.</div>";
	     }
   }
 }


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Voter Dashboard</title>
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

.text-muted{
	margin-left:11px;
}
.vl {
  border-bottom: 4px solid #ffff;
    margin-bottom:10px;
 
}
.alert-succes{
    color:#f8f9fa;
    background-color: #0c932b;
    border-color: #b8f2dc;
}
.alert-info{
    color:#f8f9fa;
    background-color:red;
    border-color: #b8f2dc;
}
.alert-danger{
    color: #f8f9fa;
    background-color:red;
    border-color: #b8f2dc;
}
.btn-primary {
    color: #fff;
    background-color: #223e9c;
    border-color: #223e9c;
}
.btn-primary:hover{
background-color:#102c8d;
}
</style>
<body>
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
			
              <li class="nav-item"> <a class="nav-link" href="ballot.php"> <i class="mdi mdi-grid-large menu-icon"></i>Ballot</a></li>
              <li class="nav-item"> <a class="nav-link" href="result.php"> <i class="mdi mdi-chart-pie menu-icon"></i>Result</a></li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="status.php">
            <i class="mdi mdi-file-document-box-outline menu-icon"></i>
            <span class="menu-title">Status</span>
          </a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
            <i class="mdi mdi-account menu-icon"></i>
            <span class="menu-title"><?php echo $_SESSION['name']; ?></span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="auth">
            <ul class="nav flex-column sub-menu">
     
              <li class="nav-item"> <a class="nav-link" href="changepass.php"> <i class="mdi mdi-settings text-primary"></i>Change Password </a></li>
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
		  
		   <div class="col-md-6 grid-margin stretch-card" style="margin:auto;">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title" style="text-align:center; font-size:20px;">Change Password</h4><br>
					<div> <?php echo $msg; ?></div>
                    <form class="forms-sample" action="#" method="POST">
                      <div class="form-group">
                        <label for="exampleInputUsername1">Old Password</label>
                        <input type="password" name="Old_password" class="form-control" id="exampleInputUsername1" placeholder="" />
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">New Password</label>
                        <input type="password" name="New_password" class="form-control" id="exampleInputEmail1" placeholder="" />
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Confirm New Password</label>
                        <input type="password" name="Confirm_New_password"  class="form-control" id="exampleInputPassword1" placeholder="" />
                      </div>
                      <button type="submit" name="submit" class="btn btn-primary mr-2"> Save </button>
                      <button class="btn btn-light">Cancel</button>
                    </form>
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
</body>

</html>