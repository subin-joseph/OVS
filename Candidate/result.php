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

$id=$_SESSION['id'];

$msg="";
if (isset($_POST['print'])){
   require('../mpdf/vendor/autoload.php');
    $query="select * from tbl_result";
    $queryRes=mysqli_query($conn, $query);
    if(mysqli_num_rows($queryRes)>0){
        $date=date("Y/m/d");
        $time=date("h:i:sa");
        
        $html='<style>
                    .heading{
                        font-size:25px; 
                        text-align:center;
                        margin-top:10px;
                        font-weight:bold;
                    }
                    .sub-head{
                        text-align:center;
                        margin-top:12px;
                    }
                    .sub-head span{
                        font-weight:bold;
                    }
                    .table{
                        margin-top:32px;
                        position: absolute;
                        margin-left:10%;
                        transform:translateX(-50%);
						
                    }
                    th,td{
                        padding:6px 10px;
                        font-size:20px;
                        text-align:left;
						
                    }
                </style>
				<img src="eci.jpg" width=100 height=100></img>
                <div class="heading">Election Result</div>
                <div class="sub-head">Date: <span>'.$date.'</span></div>
                <div class="sub-head">Time: <span>'.$time.'</span></div>
                <table border=1 class="table">
                <tr>
                    <th width=200>Name</th>
                    <th width=100>Age</th>
					<th width=100>Party</th>
					<th width=100>Vote Count</th>
                </tr>';
        while($row=mysqli_fetch_assoc($queryRes)){
            $html.='<tr>
			            <td width=250>'.$row["Name"].'</td>
                        <td width=80>'.$row["Age"].'</td>
                        <td width=80>'.$row["Party"].'</td>
                         <td width=80>'.$row["Vote_count"].'</td>
                    </tr>';
        }
        $html.='</table>';

        // echo $html;
        $mpdf = new \Mpdf\Mpdf(['tempDir' => __DIR__ . '/tmp']);
        $mpdf->WriteHTML($html);
        $file=time().'.pdf';
        $mpdf->output($file,'I');
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

.print {
	font-family: Arial;
	color: #FFFFFF;
	font-size: 16px;
	margin-left:80%;
	text-decoration:none;
	border-radius: 5px;
	border: 0px #145f35 solid;
	background: linear-gradient(180deg, #2e8b56 5%, #145f35 100%);
	text-shadow: 1px 1px 1px #ffffff;
	box-shadow: 0px 10px 14px -7px #616174;
	cursor: pointer;
	display: inline-flex;
	align-items: center;
}
.print:hover {
	background: linear-gradient(180deg, #145f35 5%, #2e8b56 100%);
}
.print-icon {
	padding: 8px 10px;
	border-right: 1px solid rgba(255, 255, 255, 0.16);
	box-shadow: rgba(0, 0, 0, 0.14) -1px 0px 0px inset;
}
.print-text {
	padding: 8px 11px;
}
.print-text span{
	display: block;
	position: relative;
	left: -6px;
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
              <li class="nav-item"> <a class="nav-link" href=""> <i class="mdi mdi-chart-pie menu-icon"></i>Result</a></li>
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
		  
		  <div class="col-12 col-xl-6 grid-margin stretch-card">
              <div class="row w-100 flex-grow">
                <div class="col-md-12 grid-margin stretch-card">
                  
                  
                    <?php
	
				
				 $com_elect=mysqli_query($conn,"select * from tbl_election");
	             $com=mysqli_fetch_array($com_elect);
				 	 if($com['election_status']==4){
				?>
				<div class="card-body" >
				 <div class="card-header" 
                <span><i class="bi bi-table me-2"></i></span>Result
              
		  <form action="#" method="POST">
				<button class="print" type="submit" name="print">
	<span class="print-icon"><i class="fa fa-print" aria-hidden="true"></i></span>
	<span class="print-text"><span>Print</span></span>
</button></form>
          </div>
              
              
			 
                <div class="table-responsive" style="margin-right:70%px;">
                  <table style="width:100%;">
                    <thead>
<tr> <th>Photo</th>
    <th>Name</th>
	<th>Age</th>
	<th>Party</th>
	<th>Symbol</th>
	<th>vote count</th>

	

</tr>
</thead>
                    <tbody>

 <?php
 $sql = "SELECT * from tbl_result";
 $result = $conn->query($sql);
 if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
	  ?>
  <tr>
    <td align="center"><img width="60" height="50" src="../<?php echo $row['Photo'];?>"> </td>
    <td><?php echo $row['Name'] ?></td>
	<td><?php echo $row['Age'] ?></td>
	<td><?php echo $row['Party'] ?></td>
    <td align="center"><img width="60" height="50" src="../<?php echo $row['Symbol'];?>"> </td>
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
         
	 </div><?php }
	 ?>
				  
				
				  
				  
				  
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
</body>

</html>