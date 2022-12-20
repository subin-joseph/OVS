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
$yr=$_GET['year'];
$st=$_GET['state'];
?>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Admin-Previous Election</title>
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
            <a class="nav-link" href="chatbot.php">
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
            
            <div class="row">
              <d   <div class="col-sm-12 stretch-card grid-margin">
                <div class="card">
                 <div class="row">
          <div class="col-md-12 mb-3">
            <div class="card">
              <div class="card-header">
                <span><i class="bi bi-table me-2"></i></span>Election -result &nbsp; <?php echo $yr;?> &nbsp;<?php echo $st;?>

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
	<th>Photo</th>
	<th>Name</th>
    <th>Age</th>
    <th>Party</th>
    <th>Symbol</th>
	<th>Vote Count</th>
	
</tr>
</thead>
<tbody>
 
 <?php
 
$sql = "select * from tbl_prev_res where state='$st' and year='$yr'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
  <tr>
     <td align="center"><img width="60" height="50" src="../../../<?php echo $row['Photo'];?>"> </td>
    <td><?php echo $row['Name'] ?></td>
	<td><?php echo $row['Age'] ?></td>
	<td><?php echo $row['Party'] ?></td>
    <td align="center"><img width="60" height="50" src="../../../<?php echo $row['Symbol'];?>"> </td>
	<td><?php echo $row['Vote_count'] ?></td>
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
              
    <!-- plugins:js -->
    <script src="../../../assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../../../assets/js/off-canvas.js"></script>
    <script src="../../../assets/js/hoverable-collapse.js"></script>
    <script src="../../../assets/js/misc.js"></script>
    <script src="../../../assets/js/settings.js"></script>
    <script src="../../../assets/js/todolist.js"></script>
    <!-- endinject -->
  </body>
</html>