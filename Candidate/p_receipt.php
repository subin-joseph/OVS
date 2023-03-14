<?php
  include('session.php');
include('../config.php');

 if (isset($_POST['print'])){
   require('../mpdf/vendor/autoload.php');
   date_default_timezone_set('Asia/Kolkata');
        $date=date('Y-m-d H:i:s');
        $time=date("h:i:sa");
        
        $html='<style>
                    .heading{
                        font-size:15px; 
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
                        margin-left:20%;
                        transform:translateX(-50%);
						
                    }
                    th,td{
                        padding:6px 10px;
                        font-size:15px;
                        text-align:left;
						
                    }
					
                </style>
<img src="images/logo2.png" width=100 height=100></img>
                  <h2 class="heading">Payment Receipt</h2>
				<div id="mid">
      <div class="info">
	  <div class="sub-head" >Contact Info</div>
      
        <div class="sub-head">
            Address : Election Commission of India, Delhi 252106 , </br>
            Email   : electioncommissionofindia@gmail.com, </br>
            Phone   : 555-555-5555</br>
       </div>
      </div>
    </div>
                <div class="sub-head">Date: <span>'.$date.'</span></div>
                <div class="sub-head">Time: <span>'.$time.'</span></div>
                <table border=0 class="table">
                <tr>
                    <th><h2>Amount Payable</h2></th>
					<th><h2>Sub Total</h2></th>
                </tr>
				<tr>
								<td><p>Registration Fees</p></td>
								<td><p>Rs 45000.00/-</p></td>
							</tr>

							<tr>
								<td><p>Processing fees</p></td>
								<td><p>Rs 5000.00 /-</p></td>
							</tr>



							<tr >
								
								<td><h2>Total Amount Paid</h2></td>
								<td><h2>Rs 50000 /-</h2></td>
							</tr>
        
        </table>';

        // echo $html;
        $mpdf = new \Mpdf\Mpdf(['tempDir' => __DIR__ . '/tmp']);
        $mpdf->WriteHTML($html);
        $file=time().'.pdf';
        $mpdf->output($file,'D');
    

}
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
  <link rel="stylesheet" href="p_style.css"/>
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
		 <div id="invoice-POS">
    <center id="top">
      <div class="logo"></div>
      <div class="info"> 
        <h2>Payment Receipt</h2>
      </div><!--End Info-->
    </center><!--End InvoiceTop-->
    
    <div id="mid">
      <div class="info">
        <h2>Contact Info</h2>
        <p> 
            Address : Election Commission of India, Delhi 252106</br>
            Email   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: electioncommissionofindia@gmail.com</br>
            Phone   &nbsp;&nbsp;&nbsp;: 555-555-5555</br>
        </p>
      </div>
    </div><!--End Invoice Mid-->
    
    <div id="bot">

					<div id="table">
						<table>
							<tr class="tabletitle">
								<th class="item"><h2>Amount Payable</h2></th>
								<th class="Rate"><h2>Sub Total</h2></th>
								<th><form action="#" method="post"><button type="submit" name="print" class="btn btn-info btn-icon-text">
                          Print
                          <i class="mdi mdi-printer btn-icon-append"></i>                                                                              
                        </button>
						</form></th>
							</tr>

							<tr class="service">
								<td class="tableitem"><p class="itemtext">Registration Fees</p></td>
								<td class="tableitem"><p class="itemtext">Rs 45000.00/-</p></td>
							</tr>

							<tr class="service">
								<td class="tableitem"><p class="itemtext">Processing fees</p></td>
								<td class="tableitem"><p class="itemtext">Rs 5000.00 /-</p></td>
							</tr>



							<tr class="service">
								<td></td>
								<td class="Rate"><h2>Total Amount Paid</h2></td>
								<td class="payment"><h2>Rs 50000 /-</h2></td>
							</tr>


						</table>
					</div><!--End Table-->

					<div id="legalcopy" >
						<p class="legal" style="color:red;"><strong style="color:blue;">&nbsp;&nbsp;&nbsp;&nbsp;Thank you for Participating in the democratic process!</strong><br>Application of the candidate is valid only after the payment!!! 
						</p>
					</div>

				</div><!--End InvoiceBot-->
  </div><!--End Invoice-->
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