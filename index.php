
<?php
  session_start();
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

  $msg = "";

    if (isset($_GET['verification'])) {
        if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tbl_login WHERE code='{$_GET['verification']}'")) > 0) {
            $query = mysqli_query($conn, "UPDATE tbl_login SET code='' WHERE code='{$_GET['verification']}'");
            
            if ($query) {
                $msg = "<div class='alert alert-success'>Account verification has been successfully completed.</div>";
            }
        } else {
            header("Location: login.php");
        }
    }
	
	
	
if (isset($_POST['submit'])){

$UserName=$_POST['username'];
$Password= md5($_POST['password']);
$sql=mysqli_query($conn,"select * from tbl_login where Status=1");
$cnt=mysqli_num_rows($sql);

$sql2=mysqli_query($conn,"select * from tbl_login where role='Candidate'");
$cnt2=mysqli_num_rows($sql2);

$sql3=mysqli_query($conn,"select * from tbl_login where role='Voter'");
$cnt3=mysqli_num_rows($sql3);

$sql4=mysqli_query($conn,"select * from tbl_login where role='Subadmin'");
$cnt4=mysqli_num_rows($sql4);

$login=mysqli_query($conn,"select * from tbl_login where email='$UserName' and password='$Password'");
$count=mysqli_num_rows($login);
$row=mysqli_fetch_array($login);
if ($count > 0){
$id=$row['id'];
$login2=mysqli_query($conn,"select * from tbl_candidate where login_id='$id'");
$rw=mysqli_fetch_array($login2);


$login3=mysqli_query($conn,"select * from tbl_voters where login_id='$id'");
$rw1=mysqli_fetch_array($login3);

$adm=mysqli_query($conn,"select * from tbl_users where login_id='$id'");
$ad=mysqli_fetch_array($adm);
$_SESSION['id']=$row['id'];
$_SESSION['role'] =$row["role"];
$_SESSION['email'] =$row["email"];
$user=$row['email'];
$role=$row['role'];
	 if($row["role"]=="Candidate")
	    {
         if($row["Status"]==1)
		 {
			 
		  $_SESSION['name'] = $rw["first name"]." ".$rw["lastname"];
		  $_SESSION['img'] = $rw["img"];
		   if (empty($row['code'])) {
               header('Location:Candidate/index.php');
			  $sql2="INSERT INTO tbl_history VALUES('','$user','$role','Login', NOW())";
		  $result=$conn->query($sql2);
            } 
			else {
                $msg = "<div class='alert alert-info'>First verify your account and try again.</div>";
            }
		 }
		 else{
		     $msg = "<div class='alert alert-danger'>Incorrect username or Password.</div>";
			}
	    } 
	  else if($row["role"]=="Admin")
	    {
		   if($row["Status"]==1)
		     {
		 
		   $_SESSION['contact'] =$ad["contact"];
		   $_SESSION['img'] =$ad["img"];
		   $_SESSION['name'] =$ad["first name"]." ".$ad["lastname"];
		   $_SESSION['count'] =$cnt;
		   $_SESSION['c_count'] =$cnt2;
		   $_SESSION['v_count'] =$cnt3;
		   $_SESSION['s_count'] =$cnt4;
		  header('Location: Admin/index/home.php');
	     
		  $sql2="INSERT INTO tbl_history VALUES('','$user','$role','Login', NOW())";
		  $result=$conn->query($sql2);
		 }
		  else{
		     $msg = "<div class='alert alert-danger'>Incorrect username or Password.</div>";
			}
		}
	  else if($row["role"]=="Voter")
	     {
	         if($row["Status"]==1)
		     {
		     $_SESSION['name'] =$rw1["first name"]." ".$rw1["lastname"];
			$_SESSION['img'] = $rw1["img"];
		   
		    if (empty($row['code'])) {
              header('Location: Voter/index.php');
			  $sql2="INSERT INTO tbl_history VALUES('','$user','$role','Login', NOW())";
		      $result=$conn->query($sql2);
            } 
			else {
                $msg = "<div class='alert alert-info'>First verify your account and try again.</div>";
            }
			 }
		  else{
		     $msg = "<div class='alert alert-danger'>Incorrect username or Password.</div>";
			}
		 }
		  else if($row["role"]=="Subadmin")
	     {
	         if($row["Status"]==1)
		     {
				 
		       if($ad['Status']==0){
				 
				 $msg = "<div class='alert alert-danger'>Your Account has been Deactivated</div>";
			    }else{
			   $_SESSION['contact'] =$ad["contact"];
		       $_SESSION['img'] =$ad["img"];
		       $_SESSION['img'] =$ad["img"];
		       $_SESSION['name'] =$ad["first name"]." ".$ad["lastname"];
			   $_SESSION['count'] =$cnt;
		       $_SESSION['c_count'] =$cnt2;
		       $_SESSION['v_count'] =$cnt3;
		       $_SESSION['s_count'] =$cnt4;
		       if (empty($row['code'])) {
		       header('Location:subadmin/index/home.php');
	           $sql2="INSERT INTO tbl_history VALUES('','$user','$role','Login', NOW())";
		       $result=$conn->query($sql2);
			   }
			  
			  else {
                $msg = "<div class='alert alert-info'>First verify your account and try again.</div>";
               }
			 }
			 }
		  else{
		     $msg = "<div class='alert alert-danger'>Incorrect username or Password.</div>";
			}
		 }
		 
	  else
	     {
	      $msg = "<div class='alert alert-danger'>Email or password do not match.</div>";
	     }
   }
   else
    {
	$msg = "<div class='alert alert-danger'>Incorrect username or Password.</div>";
	}
}
$fet=mysqli_query($conn,"SELECT * FROM `tbl_notify`");
$row=mysqli_fetch_array($fet);
?>

<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Online Voting System - Home</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
<link rel="icon" type="image/png" href="favicons/favicon-16x16.png" sizes="16x16">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <!-- chat bot css-->
 <link href="style.css" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

   <link rel="stylesheet" href="css2/style1.css" type="text/css" media="all" />
	

  
  <!-- =======================================================
  * Template Name: Bootslander - v4.9.1
  * Template URL: https://bootstrapmade.com/bootslander-free-bootstrap-landing-page-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  
  <style>
#input,#submit,#captcha_message,#captcha{
	width:94.5%;
	margin-left:10px;
	box-sizing: border-box;
	margin-top:10px;
}

#input2{
	margin-bottom:10px;
	width:94.5%;
	margin-left:10px;
    font-size: 16px;
    color: #999;
    text-align: left;
    padding: 14px 20px;
    display: inline-block;
    border: none;
    outline: none;

    border: 1px solid #e5e5e5;
    transition: 0.3s all ease;
}
#submit{
	background-color:#0033c4;
	color:#ffff;
	height:56px;
}
#submit:hover{
	background-color:#0c2772;
		color:#ffff;
}

.error_form
{
	top: 12px;
	color: rgb(216, 15, 15);
    font-size: 15px;
	font-weight:bold;
    font-family: Helvetica;
}
.btn1{
  background:transparent;
  border: none;
  color: white;
  padding: 12px 16px;
  font-size: 16px;
  cursor: pointer;
}
li:hover{
	color:red;
}

.notify{
	color:red;
	font-weight:bold;
}
</style>
<!-- chatbot script -->

<script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center header-transparent">
   
      <div class="logo">
	 


        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
 
      <nav id="navbar" class="navbar">
        <ul>
		
          <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="#about">About</a></li>
          <li><a class="nav-link scrollto" href="#features">Features</a></li>
          <li><a class="nav-link scrollto" href="#gallery">Gallery</a></li>
		   <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
          <li class="dropdown"><a href="#"><span>Election</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li class="dropdown"><a href="#"><span>Registrations</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                  <li><a href="#">Voter List</a></li>
                  <li><a href="#">Candidate List</a></li>
                </ul>
              </li>
              <li><a href="#">Result</a></li>
             
            </ul>
			 <li><a href="#">&nbsp;</a></li>
          </li>
         
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
 
    </div>
	<!-- Running notification -->
	<marquee behavior="scroll" direction="left"><p class="notify"><?php echo $row['text'];?></p></marquee>

  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero">

    <div class="container">
      <div class="row justify-content-between">
        <div class="col-lg-7 pt-5 pt-lg-0 order-2 order-lg-1 d-flex align-items-center">
          <div data-aos="zoom-out" >
	<img src="images/icon1.png" style="width:100px; height:85px;" alt="Sports"><img src="images/lion.png" style="width:100px; height:85px;" alt="Sports">
            <h1 style="font-size:20px;">Election Commission Of India<br> Legislative Assembly Election Portal</h1>
            
            <div class="text-center text-lg-start">
              <a href="#about" class="btn-get-started scrollto">Get Started</a>
            </div>
          </div>
        </div>
        <div class="col-lg-4 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="300">
		<div class="card" style="width:130%;">
          <div class="card-body" ><br>
                       
					   <img src="login.gif" style="width:25%; margin-left:34%;" alt="login">
                        <form action="" id="login_form" method="post">
						 <div id="input" ><?php echo $msg; ?></div>
                            <input type="text" class="email" id="input2" name="username" placeholder="Enter Your E-mail" required>
                            <input type="password" id="input2" class="password" name="password" placeholder="Enter Your Password" style="margin-bottom: 2px;" required>
                            
                            <span class="error_form" id="captcha_message"></span>
						     <div  class="g-recaptcha" id="captcha" data-sitekey="6LcOSFYiAAAAALzBGK9rglmn5uufXvWmiCSf2Rl1"></div>
							
							<button name="submit" name="submit" id="submit" class="btn" type="submit">Login</button>
							<p><a href="forgotpass.php" style="margin-left:25px;font-weight:bold;">Forgot Password?</a></p>
                        </form>
                        <div class="social-icons">
                            <p style="font-weight:bold; color:green;">Candidate Signup! <a href="candidate_reg.php">Register</a>
							<p style="font-weight:bold; color:green;">Voter Signup! <a href="voter_reg.php">Register</a>.</p>
                        </div>
                   </div></div>
				   
        </div>
      </div>
    </div>

    <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28 " preserveAspectRatio="none">
      <defs>
        <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z">
      </defs>
      <g class="wave1">
        <use xlink:href="#wave-path" x="50" y="3" fill="rgba(255,255,255, .1)">
      </g>
      <g class="wave2">
        <use xlink:href="#wave-path" x="50" y="0" fill="rgba(255,255,255, .2)">
      </g>
      <g class="wave3">
        <use xlink:href="#wave-path" x="50" y="9" fill="#fff">
      </g>
    </svg>

  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container-fluid">

        <div class="row">
          <div class="col-xl-5 col-lg-6 video-box d-flex justify-content-center align-items-stretch" data-aos="fade-right">
           
          </div>

          <div class="col-xl-7 col-lg-6 icon-boxes d-flex flex-column align-items-stretch justify-content-center py-5 px-lg-5" data-aos="fade-left">
            <h3>Online Voting System</h3>
            <p>Online Voting is a web-based voting system that will help you manage your elections easily and securely. This voting system can be used for casting votes during the elections held in colleges, etc. In this system the voter do not have to go to the polling booth to cast their vote. They can use their personal computer to cast their votes. There is a database which is maintained in which all the name of the voters with their complete information is stored. </p>

            <div class="icon-box" data-aos="zoom-in" data-aos-delay="100">
              <div class="icon"><i class="bx bx-fingerprint"></i></div>
              <h4 class="title"><a href="">Authentication</a></h4>
              <p class="description">Fingerprint Authentication is the act of verifying an individual's identity based on one or more of their fingerprints. The concept has been leveraged for decades across various efforts including digital identity, criminal justice, financial services, and border protections.</p>
            </div>

            <div class="icon-box" data-aos="zoom-in" data-aos-delay="200">
              <div class="icon"><i class="bx bx-lock"></i></div>
              <h4 class="title"><a href="">Security</a></h4>
              <p class="description">Data Security Council of India (DSCI), is a not-for-profit, industry body on data protection in India, setup by NASSCOM®, committed to making the cyberspace safe, secure and trusted by establishing best practices, standards and initiatives in cyber security and privacy. To further its objectives, DSCI engages with governments and their agencies, regulators, industry sectors, industry associations and think tanks for policy advocacy, thought leadership, capacity building and outreach activities.</p>
            </div>

            <div class="icon-box" data-aos="zoom-in" data-aos-delay="300">
              <div class="icon"><i class="bx bx-book"></i></div>
              <h4 class="title"><a href="">Login</a></h4>
              <p class="description">A user can create his/her password for authentication during the registration and also can change/update the same .Using the password the user can log in to the system. </p>
            </div>

          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Features Section ======= -->
    <section id="features" class="features">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Features</h2>
        </div>

        <div class="row" data-aos="fade-left">
          <div class="col-lg-3 col-md-4">
            <div class="icon-box" data-aos="zoom-in" data-aos-delay="50">
              <i class="bx bx-lock" style="color: #ffbb2c;"></i>
              <h3><a href="">Security</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
            <div class="icon-box" data-aos="zoom-in" data-aos-delay="100">
              <i class="ri-bar-chart-box-line" style="color: #5578ff;"></i>
              <h3><a href="">Authentication</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
            <div class="icon-box" data-aos="zoom-in" data-aos-delay="150">
              <i class="ri-calendar-todo-line" style="color: #e80368;"></i>
              <h3><a href="">Encryption</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4 mt-lg-0">
            <div class="icon-box" data-aos="zoom-in" data-aos-delay="200">
              <i class="ri-paint-brush-line" style="color: #e361ff;"></i>
              <h3><a href="">Biometric Verification</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4">
            <div class="icon-box" data-aos="zoom-in" data-aos-delay="250">
              <i class="ri-database-2-line" style="color: #47aeff;"></i>
              <h3><a href="">Report Generation</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4">
            <div class="icon-box" data-aos="zoom-in" data-aos-delay="300">
              <i class="ri-gradienter-line" style="color: #ffa76e;"></i>
              <h3><a href="">Chat Bot</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4">
            <div class="icon-box" data-aos="zoom-in" data-aos-delay="350">
              <i class="ri-file-list-3-line" style="color: #11dbcf;"></i>
              <h3><a href="">Data visualization</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4">
            <div class="icon-box" data-aos="zoom-in" data-aos-delay="400">
              <i class="ri-price-tag-2-line" style="color: #4233ff;"></i>
              <h3><a href="">User Dashboard</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4">
            <div class="icon-box" data-aos="zoom-in" data-aos-delay="450">
              <i class="ri-anchor-line" style="color: #b2904f;"></i>
              <h3><a href="">History Backup</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4">
            <div class="icon-box" data-aos="zoom-in" data-aos-delay="500">
              <i class="bx bx-key" style="color: #b20969;"></i>
              <h3><a href="">Anonymity</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4">
            <div class="icon-box" data-aos="zoom-in" data-aos-delay="550">
              <i class="ri-base-station-line" style="color: #ff5828;"></i>
              <h3><a href="">Remote Access</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4">
            <div class="icon-box" data-aos="zoom-in" data-aos-delay="600">
              <i class="ri-fingerprint-line" style="color: #29cc61;"></i>
              <h3><a href="">Finger print verification</a></h3>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End Features Section -->

    <!-- ======= Counts Section ======= -->
    

    <!-- ======= Details Section ======= -->
    <section id="details" class="details">
      <div class="container">

        <div class="row content">
          <div class="col-md-4" data-aos="fade-right">
            <img src="assets/img/details-1.png" class="img-fluid" alt="">
          </div>
          <div class="col-md-8 pt-4" data-aos="fade-up">
            <h3>Registration</h3>
            <p class="fst-italic">
              Candidate registration, Voters Registration,document verification, auto-generated User IDs and Passwords for local admin ,finger verification for voting and authentication are all features of the online election system. Election Commission will handle the admin login. Voters and Candidates can create a Login. which will be managed by the user(candidate /voter). 
            </p>
 
          </div>
        </div>

        <div class="row content">
          <div class="col-md-4 order-1 order-md-2" data-aos="fade-left">
            <img src="assets/img/details-2.png" class="img-fluid" alt="">
          </div>
          <div class="col-md-8 pt-5 order-2 order-md-1" data-aos="fade-up">
            <h3>Document Verification</h3>
            <p class="fst-italic">
             Super Admin Can verify the Candidate registration by verifying the submitted documents. The registered candidate can participate in the election only after the approval of the Admin(Election Authority). Admin confirming that a candidate is eligible for election, the administrator can check each candidate's details, confirm the documents, and reject invalid accounts. The administrator has complete control over the system and is able to moderate and delete any information that is unrelated to election rules.
            </p>
            <p class="fst-italic">
              Local admin module is also present to handle the voters of particular region. Since there  are multiple local administrators according to the number of regions present in the constituency. This user can verify or reject the voter according to the documents submitted by the voter at the time of registration.
            </p>
            
          </div>
        </div>

        <div class="row content">
          <div class="col-md-4" data-aos="fade-right">
            <img src="assets/img/details-3.png" class="img-fluid" alt="">
          </div>
          <div class="col-md-8 pt-5" data-aos="fade-up">
            <h3>Voting process</h3>
            <p class="fst-italic">Voting is done with a finger authentication mechanism ,it ensures the security and prevents impersonation etc… A voter can cast vote only once.After a successful voting he/she will get an sms in their phone or email that is the individual is successfully casted their vote</p>
            <ul>
              <li><i class="bi bi-check"></i>Register and wait for approval</li>
              <li><i class="bi bi-check"></i>Login and authenticate yourself with the finger verification </li>
              <li><i class="bi bi-check"></i> Get the ballot and cast vote</li>
			  <li><i class="bi bi-check"></i>Provide feedback</li>
            </ul>
            
          </div>
        </div>

        <div class="row content">
          <div class="col-md-4 order-1 order-md-2" data-aos="fade-left">
            <img src="assets/img/details-4.png" class="img-fluid" alt="">
          </div>
          <div class="col-md-8 pt-5 order-2 order-md-1" data-aos="fade-up">
            <h3>Result Calculation and publishing of result</h3>
            <p class="fst-italic">
              Result is calculated automatically by the system.The polled votes are
			  encrypted in the database and no one can know the 
			  count until it is published.
			  After publishing the result the result will 
			  be available at all users portal and the public page.Any one can generate the print of the result 
            </p>
            
          </div>
        </div>

      </div>
    </section><!-- End Details Section -->

    <!-- ======= Gallery Section ======= -->
    <section id="gallery" class="gallery">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Gallery</h2>
 
        </div>

        <div class="row g-0" data-aos="fade-left">

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item" data-aos="zoom-in" data-aos-delay="100">
              <a href="assets/img/gallery/gallery-1.jpg" class="gallery-lightbox">
                <img src="assets/img/gallery/gallery-1.jpg" alt="" class="img-fluid">
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item" data-aos="zoom-in" data-aos-delay="150">
              <a href="assets/img/gallery/gallery-2.jpg" class="gallery-lightbox">
                <img src="assets/img/gallery/gallery-2.jpg" alt="" class="img-fluid">
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item" data-aos="zoom-in" data-aos-delay="200">
              <a href="assets/img/gallery/gallery-3.jpg" class="gallery-lightbox">
                <img src="assets/img/gallery/gallery-3.jpg" alt="" class="img-fluid">
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item" data-aos="zoom-in" data-aos-delay="250">
              <a href="assets/img/gallery/gallery-4.jpg" class="gallery-lightbox">
                <img src="assets/img/gallery/gallery-4.jpg" alt="" class="img-fluid">
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item" data-aos="zoom-in" data-aos-delay="300">
              <a href="assets/img/gallery/gallery-5.jpg" class="gallery-lightbox">
                <img src="assets/img/gallery/gallery-5.jpg" alt="" class="img-fluid">
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item" data-aos="zoom-in" data-aos-delay="350">
              <a href="assets/img/gallery/gallery-6.jpg" class="gallery-lightbox">
                <img src="assets/img/gallery/gallery-6.jpg" alt="" class="img-fluid">
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item" data-aos="zoom-in" data-aos-delay="400">
              <a href="assets/img/gallery/gallery-7.jpg" class="gallery-lightbox">
                <img src="assets/img/gallery/gallery-7.jpg" alt="" class="img-fluid">
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item" data-aos="zoom-in" data-aos-delay="450">
              <a href="assets/img/gallery/gallery-8.jpg" class="gallery-lightbox">
                <img src="assets/img/gallery/gallery-8.jpg" alt="" class="img-fluid">
              </a>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Gallery Section -->

    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials">
      <div class="container">

        <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
          <div class="swiper-wrapper">

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="assets/img/testimonials/testimonials-1.jpg" class="testimonial-img" alt="">
                <h3>Mahatma Gandhi</h3>
                <h4>Father of the Nation</h4>
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  Democracy is an impossible thing until the power is shared by all, but let not democracy degenerate into mobocracy..
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="assets/img/testimonials/testimonials-2.jpg" class="testimonial-img" alt="">
                <h3>Jawaharlal Nehru</h3>
                <h4>Former Prime Minister</h4>
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
           Freedom, democracy and peace are not just mere words, but powerful ideas and thoughts that guide us as a nation and its citizens..
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="assets/img/testimonials/testimonials-3.jpg" class="testimonial-img" alt="">
                <h3>Dr B.R. Ambedkar</h3>
                <h4>Former Law Minister</h4>
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                 Democracy is not merely a form of government. It is primarily a mode of associated living, of conjoint communicated experience. It is essentially an attitude of respect and reverence towards fellow men..
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="assets/img/testimonials/testimonials-4.jpg" class="testimonial-img" alt="">
                <h3>Dr Rajendra Prasad</h3>
                <h4>Former President</h4>
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
              The highest from of freedom carries with it the greatest measure of discipline and humility. Freedom that comes from discipline and humility cannot be denied, unbridled license is a sign of vulgarity injurious alike to self and one's neighbours..
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->

             <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="assets/img/testimonials/testimonials-1.jpg" class="testimonial-img" alt="">
                <h3>Mahatma Gandhi</h3>
                <h4>Father of the Nation</h4>
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  Democracy is an impossible thing until the power is shared by all, but let not democracy degenerate into mobocracy..
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->

          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>
    </section><!-- End Testimonials Section -->

    

   

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Contact</h2>
          <p>Contact Admin</p>
        </div>

        <div class="row">

          <div class="col-lg-4" data-aos="fade-right" data-aos-delay="100">
            <div class="info">
              <div class="address">
                <i class="bi bi-geo-alt"></i>
                <h4>Location:</h4>
                <p>Kanjirappally, Kottyam,685552</p>
              </div>

              <div class="email">
                <i class="bi bi-envelope"></i>
                <h4>Email:</h4>
                <p>ovssystem2022@gmail.com</p>
              </div>

              <div class="phone">
                <i class="bi bi-phone"></i>
                <h4>Call:</h4>
                <p>+91 9947059704</p>
				<p>+91 9496075704</p>
              </div>

            </div>

          </div>

          <div class="col-lg-8 mt-5 mt-lg-0" data-aos="fade-left" data-aos-delay="200">

            <form action="forms/contact.php" method="post" role="form" class="php-email-form">
              <div class="row">
                <div class="col-md-6 form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                </div>
              </div>
              <div class="form-group mt-3">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
              </div>
              <div class="form-group mt-3">
                <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
              </div>
              <div class="my-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div>
              <div class="text-center"><button type="submit">Send Message</button></div>
            </form>

          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-md-6 footer-newsletter">
           <input style="margin-left:140%;"type="submit" value="Back To Top">
          </div>
        </div>
      </div>
    </div>

  </footer><!-- End Footer -->

  <a id="myBtn" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-robot"></i></a>
  <div id="myModal" style="background:transparent;" class="modal">
  <div class="chatbox" style="border:2px solid #198754;background:url('chat.png');">
        <div class="title">Chatbot <i style="margin-left:68%;" class="fa fa-close"  id="bn"></i></div>
        <div class="form">
            <div class="bot-inbox inbox">
               
                    <i class="fas fa-user"></i>
                
                <div class="msg-header">
                    <p>Hello there, how can I help you?</p>
                </div>
            </div>
        </div>
        <div class="typing-field">
            <div class="input-data">
                <input id="data" type="text" placeholder="Type something here.." required>
                <button type="submit" id="send-btn">Send</button>
            </div>
        </div>
    </div>
    </div>
  <div id="preloader"></div>

   <script>
        $(document).ready(function(){
            $("#send-btn").on("click", function(){
                $value = $("#data").val();
                $msg = '<div class="user-inbox inbox"><div class="msg-header"><p>'+ $value +'</p></div></div>';
                $(".form").append($msg);
                $("#data").val('');
                
                // start ajax code
                $.ajax({
                    url: 'message.php',
                    type: 'POST',
                    data: 'text='+$value,
                    success: function(result){
                        $replay = '<div class="bot-inbox inbox"><i class="fas fa-user"></i><div class="msg-header"><p>'+ result +'</p></div></div>';
                        $(".form").append($replay);
                        // when chat goes down the scroll bar automatically comes to the bottom
                        $(".form").scrollTop($(".form")[0].scrollHeight);
                    }
                });
            });
        });
    </script>
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
  
  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

  <script src="https://kit.fontawesome.com/af562a2a63.js" crossorigin="anonymous"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script src="https://code.jquery.com/jquery-3.2.1.js"></script>


<script type="text/javascript">
 
  $(document).on('click','#submit',function()
  {  $("#captcha_message").hide();
	  var response = grecaptcha.getResponse();
	  if(response.length == 0)
	  {
		  $("#captcha_message").html("Please verify you are not a robot");
               $("#captcha_message").show();
		  return false;
	  }
	  else{
		  $("#captcha_message").hide();
		  return true;
	  }
  });
  
  
</script>

<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
    async defer>
</script>

</body>

</html>