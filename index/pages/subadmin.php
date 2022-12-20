
<?php
  include('../../../session.php');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ovs";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require '../../../vendor/autoload.php';
 // Create connection
$conn = new mysqli($servername,$username,$password,$dbname);
	
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " 
        . $conn->connect_error);
}
 $chck=mysqli_query($conn,"select * from tbl_election");
	 $fet=mysqli_fetch_array($chck);
	 
  $msg = "";

    if (isset($_POST['submit'])) {
  $first_name = $_REQUEST['first_name'];
 $last_name = $_REQUEST['last_name'];
 $area = $_REQUEST['address'];
 $Contact=$_REQUEST['contact'];
 $gender = $_REQUEST['gender'];
 $email = $_REQUEST['email'];
  $code = mysqli_real_escape_string($conn, md5(rand()));
 function generatePassword($_len) {

    $_alphaSmall = 'abcdefghijklmnopqrstuvwxyz';            // small letters
    $_alphaCaps  = strtoupper($_alphaSmall);                // CAPITAL LETTERS
    $_numerics   = '1234567890';                            // numerics
    $_specialChars = '`~!@#$%^&*()-_=+]}[{;:,<.>/?\'"\|';   // Special Characters

    $_container = $_alphaSmall.$_alphaCaps.$_numerics.$_specialChars;   // Contains all characters
    $password = '';         // will contain the desired pass

    for($i = 0; $i < $_len; $i++) {                                 // Loop till the length mentioned
        $_rand = rand(0, strlen($_container) - 1);                  // Get Randomized Length
        $password .= substr($_container, $_rand, 1);                // returns part of the string [ high tensile strength ;) ] 
    }

    return $password;       // Returns the generated Pass
}
 
 $hash = md5(generatePassword(10));
 $password=$hash;
 $image=$_FILES['image']["name"];
 $temp = explode(".", $_FILES["image"]["name"]);
  $newfilename = round(microtime(true)) . '.' . end($temp);
$image= addslashes(file_get_contents($_FILES['image']['tmp_name']));
	$image_name= addslashes($_FILES['image']['name']);
	$image_size= getimagesize($_FILES['image']['tmp_name']);
	move_uploaded_file($_FILES["image"]["tmp_name"],"../../../upload/" .$newfilename);			
			$location="upload/" .$newfilename;
        if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tbl_login WHERE email='{$email}'")) > 0) {
            $msg = "<div class='alert alert-danger'>{$email} - This email address has been already exists.</div>";
        } 
		
		else if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tbl_users WHERE contact='{$Contact}'")) > 0) {
            $msg = "<div class='alert alert-danger'>{$contact} - This number has been already exists.</div>";
        }
		
		
		else {
			 $sql="INSERT INTO tbl_login VALUES (DEFAULT,'$first_name','$email','$password','Subadmin','$code',1)";
				$result = mysqli_query($conn, $sql);
			
					$val="Select id from tbl_login where email='".$email."'";
					if ($res=$conn->query($val)){
						foreach($res as $data)
						{
							$login_id=$data['id'];
						}
					    $sql2= "INSERT INTO tbl_users VALUES (DEFAULT,'$login_id','$first_name','$last_name','$Contact','$gender','$area','$location',1)";
					   $result2 = mysqli_query($conn, $sql2);
					}
                    echo "<div style='display: none;'>";
                    //Create an instance; passing `true` enables exceptions
                    $mail = new PHPMailer(true);

                    try {
                        //Server settings
                        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                        $mail->isSMTP();                                            //Send using SMTP
                        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                        $mail->Username   = 'ovssystem2022@gmail.com';                     //SMTP username
                        $mail->Password   = 'fblchmmpzrdghjrs';                               //SMTP password
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                        //Recipients
                        $mail->setFrom('ovssystem2022@gmail.com');
                        $mail->addAddress($email);

                        //Content
                        $mail->isHTML(true);                                  //Set email format to HTML
                        $mail->Subject = 'no reply';
                        $mail->Body    = 'Here is the verification link <b><a href="http://localhost/OVS/changepassword.php?reset='.$code.'">http://localhost/OVS/changepassword.php?reset='.$code.'</a></b>';

                        $mail->send();
                        echo 'Message has been sent';
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
                    echo "</div>";
                    $msg = "<div class='alert alert-info'>Sent a login link on the email address.</div>";
                
                }

            }
        
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Admin-Administrators</title>
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
.stop {
	font-family: Arial;
	color: #FFFFFF;
	font-size: 16px;
	border-radius: 8px;
	border: 0px #c81414 solid;
	background: linear-gradient(180deg, #ff0000 5%, #c81414 100%);
	text-shadow: 0px 1px 1px #ffffff;
	box-shadow: 0px 10px 14px -7px #616174;
	cursor: pointer;
	display: inline-flex;
	align-items: center;
	text-decoration:none;
}
.stop:hover {
	background: linear-gradient(180deg, #c81414 5%, #ff0000 100%);
	color: #FFFFFF;
}
.stop-icon {
	padding: 10px 10px;
}
.stop-icon svg {
	vertical-align: middle;
	position: relative;
	font-size: 21px;
	top: 0px;
	left: -2px;
}
.stop-text {
	padding: 10px 5px;
	
}
.stop-text span{
	display: block;
	position: relative;
	transform: rotate(0deg);
	top: 0px;
	left: -9px;
}
.start {
	font-family: Arial;
	color: #FFFFFF;
	font-size: 16px;
	text-decoration:none;
	border-radius: 8px;
	border: 0px #24a6a2 solid;
	background: linear-gradient(180deg, #48d1cc 5%, #24a6a2 100%);
	text-shadow: 0px 1px 1px #ffffff;
	box-shadow: 0px 10px 14px -7px #616174;
	cursor: pointer;
	display: inline-flex;
	align-items: center;
}
.start:hover {
	background: linear-gradient(180deg, #24a6a2 5%, #48d1cc 100%);
		color: #FFFFFF;
}
.start-icon {
	padding: 10px 10px;
}
.start-icon svg {
	vertical-align: middle;
	position: relative;
	font-size: 21px;
	top: 0px;
	left: -2px;
}
.start-text {
	padding: 10px 5px;
}
.start-text span{
	display: block;
	position: relative;
	transform: rotate(0deg);
	top: 0px;
	left: -9px;
}
#myModal{
  border-radius: 5px;
  padding: 20px;
  width:82.5%;
  height:80%;
  margin-left:17%;
  margin-top:60px;
 background-color:#ffffff;
}
.alert-danger {
    color: #e4e9f0;
	font-weight:bold;
    background-color: #f90505;
    border-color: #ffbacf;
}
.alert-info {
    color: #e4e9f0;
	font-weight:bold;
    background-color: #09a92e;
    border-color: #b8f2fc;
}
  </style>
  <body onload="myFunction()">
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
              <a class="navbar-brand brand-logo-mini" href="../../home.php"><img src="../../../assets/images/logo-mini.svg" alt="logo" /></a>
            </div>
            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <a class="nav-link" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                  <i class="mdi mdi-email-outline"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-left navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                  <h6 class="p-3 mb-0 font-weight-semibold">Messages</h6>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <img src="../../assets/images/faces/face1.jpg" alt="image" class="profile-pic">
                    </div>
                    <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                      <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Mark send you a message</h6>
                      <p class="text-gray mb-0"> 1 Minutes ago </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <img src="../../../assets/images/faces/face6.jpg" alt="image" class="profile-pic">
                    </div>
                    <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                      <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Cregh send you a message</h6>
                      <p class="text-gray mb-0"> 15 Minutes ago </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <img src="../../assets/images/faces/face7.jpg" alt="image" class="profile-pic">
                    </div>
                    <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                      <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Profile picture updated</h6>
                      <p class="text-gray mb-0"> 18 Minutes ago </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <h6 class="p-3 mb-0 text-center text-primary font-13">4 new messages</h6>
                </div>
              </li>
              <li class="nav-item dropdown ml-3">
                <a class="nav-link" id="notificationDropdown" href="#" data-toggle="dropdown">
                  <i class="mdi mdi-bell-outline"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-left navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                  <h6 class="px-3 py-3 font-weight-semibold mb-0">Notifications</h6>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-success">
                        <i class="mdi mdi-calendar"></i>
                      </div>
                    </div>
                    <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                      <h6 class="preview-subject font-weight-normal mb-0">New order recieved</h6>
                      <p class="text-gray ellipsis mb-0"> 45 sec ago </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-warning">
                        <i class="mdi mdi-settings"></i>
                      </div>
                    </div>
                    <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                      <h6 class="preview-subject font-weight-normal mb-0">Server limit reached</h6>
                      <p class="text-gray ellipsis mb-0"> 55 sec ago </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-info">
                        <i class="mdi mdi-link-variant"></i>
                      </div>
                    </div>
                    <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                      <h6 class="preview-subject font-weight-normal mb-0">Kevin karvelle</h6>
                      <p class="text-gray ellipsis mb-0"> 11:09 PM </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <h6 class="p-3 font-13 mb-0 text-primary text-center">View all notifications</h6>
                </div>
              </li>
            </ul>
			
			
            <ul class="navbar-nav navbar-nav-right">
              <li class="nav-item nav-logout d-none d-md-block mr-3">
			  <div style="margin-top:13px;"><?php echo $msg; ?></div>
              </li>
              <li class="nav-item nav-logout d-none d-md-block">
               <button class="btn btn-sm btn-danger" id="myBtn" style="background-color:#268b3d;border-color:#268b3d;">Add new</button>
			   
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
            
                      
            <div <div class="row">
                 <div class="card-body">
			  
                <div class="table-responsive">
                  <table
                    id="example"
                    class="table table-striped data-table"
                    style="width: 100%"
                  >
                   <thead>
<tr><th>Photo</th>
    <th>Name</th>
	<th>Gender</th>
	<th>Area</th>
	<th>Action</th>
	
</tr>
</thead>
                    <tbody>

  <?php
 $sql = "SELECT * from tbl_users where Status <>3";
 $result = $conn->query($sql);
 if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
	  ?>
  <tr>
    <td align="center"><img width="60" height="50" src="../../../<?php echo $row['img'];?>"> </td>
    <td><?php echo $row['first name']." ". $row['lastname'] ?></td>
	<td><?php echo $row['gender'] ?></td>
	<td><?php echo $row['area'] ?></td>
	 <td><?php if ($row['Status']==1) { 
	 ?> <a class="">
	<span class="editbtn-icon"><i class="fa fa-tags" aria-hidden="true"></i></span>
	<span class="editbtn-text">Edit</span>
</a> <a class="btn btn-sm btn-danger" style="background: linear-gradient(180deg, #fe1900 5%, #ce0000 100%);" href="subadmin_del.php?id=<?php echo $row['login_id'];?>">
	<span class="deletebtn-icon"><svg width="16" height="16" viewBox="2 2 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M10 2l1.669.864 1.858.282.842 1.68 1.337 1.32L15.4 8l.306 1.854-1.337 1.32-.842 1.68-1.858.282L10 14l-1.669-.864-1.858-.282-.842-1.68-1.337-1.32L4.6 8l-.306-1.854 1.337-1.32.842-1.68 1.858-.282L10 2z"/>
<path d="M6 13.794V18l4-1 4 1v-4.206l-2.018.306L10 15.126 8.018 14.1 6 13.794z"/>
</svg></span>
	 <span class="deletebtn-text">Deactivate</span>
</a> <?php } else{?>
<a href="activate_subadmin.php?id=<?php echo $row['login_id'];?>" 
class="btn btn-sm btn-danger" style="background:linear-gradient(180deg, #03c443 5%, #324505 100%); 
border-color:green;">
	<span class="actbtn-btn-icon"><svg width="16" height="16" viewBox="2 2 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V4a2 2 0 00-2-2H6zm6 4a2 2 0 11-4 0 2 2 0 014 0zm-2 3a3.5 3.5 0 100 7 3.5 3.5 0 000-7z" clip-rule="evenodd"/>
</svg></span>
	<span class="actbtn-text">Activate</span>
</a><?php }?></td>
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
            
             
            <div id="myModal" class="modal">
                  
                    <form class="form-sample" action="" method="POST" id="registration_form" enctype="multipart/form-data">
                     
					  <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">First Name</label>
                            <div class="col-sm-9">
                              <input type="text" id="form_fname" name="first_name" class="form-control" />
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Last Name</label>
                            <div class="col-sm-9">
                              <input type="text" id="form_sname" name="last_name" class="form-control" />
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Gender</label>
                            <div class="col-sm-9">
                              <select name="gender" class="form-control">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Date of Birth</label>
                            <div class="col-sm-9">
                              <input class="form-control" placeholder="dd/mm/yyyy" />
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Contact</label>
                            <div class="col-sm-9">
                              <input type="number" class="form-control" id="form_pno" placeholder="Contact" name="contact" class="input"/ required>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Address</label>
                            <div class="col-sm-9">
                              <input type="text"  class="form-control" name="address" class="input"/ required>
                            </div>
                          </div>
                        </div>
                      </div>
                     
                      <div class="row">
                        
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                              <input type="email" class="form-control"  id="form_email" placeholder="E-mail" name="email" class="input"/ required />
                            </div>
                          </div>
                        </div>
					 <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Photo</label>
                            <div class="col-sm-9">
                              <input  type="file" name="image"/required />
                            </div>
                          </div>
                        </div>
                      </div>
                  <button type="submit" class="btn btn-primary mb-2" name="submit"  id="regbtn"> Submit </button>
                    </form>
                  
                
             
 

</div>
            </div>
            
    <!-- plugins:js -->
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
	    <!-- Toast message-->
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
  </body>
</html>