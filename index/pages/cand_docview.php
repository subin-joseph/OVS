
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

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Admin-Candidate Document</title>
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
  
 input[type=text] {
  width:100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}


input[type=submit] {
  width:20%;
  background-color:red;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  margin-left:80%;
}

input[type=submit]:hover {
  background-color:#DC143C;
}

#div {
  border-radius: 5px;
  padding: 20px;
  width:34%;
  height:45 %;
  margin-left:35%;
 background-color:#ffffff;
  margin-top:8%;
}
#h1{
	
	margin-left:30%;
	font-size:32px;
	color:blue;
	  font-family: "Times New Roman", Times, serif;
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
	text-decoration:none;
	font-size:12px;
	border-radius: 5px;
	border: 1px #268a16 solid;
	background: linear-gradient(180deg, #77d42a 5%, #5cb811 100%);
	text-shadow: 1px 1px 1px #aade7c;
	box-shadow: inset 1px 1px 2px 0px #c9efab;
	cursor: pointer;
	display: inline-flex;
	align-items: center;
}
.editbtn:hover {
	background: linear-gradient(180deg, #5cb811 5%, #77d42a 100%);
	color: #FFFFFF;
}
.editbtn-icon {
	padding: 10px 0px;
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
  </style>
  <body>
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
                <a class="nav-link" href="../home.php">
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
            <div class="page-header">
              
             
            </div>
            
                      
            <div class="row">
              <div class="col-sm-12 stretch-card grid-margin">
                <div class="card">
                 <div class="row">
          <div class="col-md-12 mb-3">
            <div class="card">
             
              <div class="card-body">
                <div class="table-responsive">
                  <table
                    id="example"
                    class="table table-striped data-table"
                    style="width: 100%"
                  >
<tbody>
		
 
 <?php
 
 $id2=$_GET['id'];

  if (isset($_POST['submit'])){
	$comments=$_POST['reason'];
	$rej=mysqli_query($conn,"UPDATE `tbl_candidate` SET `Comments`='$comments' WHERE login_id='$id2'");
	if($rej){
			
	 $_SESSION['id2']=$id2;
	echo "<script>window.location.href='cand_reject.php'</script>";
     }
 }
  $id=$_SESSION['id'];
 $sql2=mysqli_query($conn,"select * from tbl_users where login_id='$id'");
 $rw=mysqli_fetch_array($sql2);
 $region=$rw['area'];
 $sql = "SELECT * from tbl_candidate where login_id='$id2'";
 $result = $conn->query($sql);
 if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
	  ?>
	   <div class="card-header">
                <span><i class="bi bi-table me-2"></i></span>Identity Proof
              </div>
      <img width="400" height="700" src="../../../<?php echo $row['proof'];?>" alt="ID proof"><br><br>
  <div class="card-header">
                <span><i class="bi bi-table me-2"></i></span>Nomination
              </div>
 <img width="400" height="700" src="../../../<?php echo $row['nomin'];?>" alt="Nomination">
 
 <tr><td></td><td>
	 <a class="editbtn" href="select_cand.php?id=<?php echo $row['login_id'];?>">
	<span class="editbtn-icon"><svg width="16" height="16" viewBox="2 2 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16 5H4a1 1 0 00-1 1v8a1 1 0 001 1h12a1 1 0 001-1V6a1 1 0 00-1-1zM4 4a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2H4z" clip-rule="evenodd"/>
  <rect width="3" height="3" x="4" y="11" rx="1"/>
<path d="M3 7h14v2H3z"/>
</svg></span>
	<span class="editbtn-text">Approve</span>
</a>
<a class="deletebtn" id="myBtn">

	<span class="deletebtn-icon"><svg width="16" height="16" viewBox="2 2 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M7.5 7.5A.5.5 0 018 8v6a.5.5 0 01-1 0V8a.5.5 0 01.5-.5zm2.5 0a.5.5 0 01.5.5v6a.5.5 0 01-1 0V8a.5.5 0 01.5-.5zm3 .5a.5.5 0 00-1 0v6a.5.5 0 001 0V8z"/>
<path fill-rule="evenodd" d="M16.5 5a1 1 0 01-1 1H15v9a2 2 0 01-2 2H7a2 2 0 01-2-2V6h-.5a1 1 0 01-1-1V4a1 1 0 011-1H8a1 1 0 011-1h2a1 1 0 011 1h3.5a1 1 0 011 1v1zM6.118 6L6 6.059V15a1 1 0 001 1h6a1 1 0 001-1V6.059L13.882 6H6.118zM4.5 5V4h11v1h-11z" clip-rule="evenodd"/>
</svg></span>
	<span class="deletebtn-text">Reject</span>
</a>
</td></tr>
<?php }} ?>
 </tbody>
</table> 

 </div>
 </div>

			  
            </div>
          </div>
        </div>
              </div>
			  <div id="myModal" class="modal">

  <div class="modal-content" id="div">
  <img id="bn" width="20" height="20" style="margin-left:95%;" src="../../../images/close.png" alt="">
    <form action="#" method="POST" ><p id="h1">Comments</p>
	<div>
    <input type="text" id="txt" name="reason" placeholder="Rejection Reason" required>
   <input type="submit" name="submit" value="confirm">
	</div>
  </form>
  </div>

</div>
            </div>
            
			
			<!--modal script-->
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
    <!-- plugins:js -->
    <script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../../assets/js/off-canvas.js"></script>
    <script src="../../assets/js/hoverable-collapse.js"></script>
    <script src="../../assets/js/misc.js"></script>
    <script src="../../assets/js/settings.js"></script>
    <script src="../../assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <!-- End custom js for this page -->
  </body>
</html>