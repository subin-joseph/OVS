<?php
    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
session_start();
    if (isset($_SESSION['SESSION_EMAIL'])) {
        header("Location: welcome.php");
        die();
    }
    //Load Composer's autoloader
    require 'vendor/autoload.php';

   $servername = "localhost";
$username = "root";
$password = "";
$dbname = "ovs";
 
 // Create connection
$conn = new mysqli($servername, 
    $username, $password, $dbname);
	
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " 
        . $conn->connect_error);
}


$query ="SELECT area FROM tbl_users where status=1";
    $result = $conn->query($query);
    if($result->num_rows> 0){
      $options= mysqli_fetch_all($result, MYSQLI_ASSOC);
    }




    $msg = "";

    if (isset($_POST['submit'])) {
        $firstname = mysqli_real_escape_string($conn, $_POST['first_name']);
		$lastname = mysqli_real_escape_string($conn, $_POST['last_name']);
		$age= mysqli_real_escape_string($conn, $_POST['age']);
		$gender= mysqli_real_escape_string($conn, $_POST['gender']);
		$address= mysqli_real_escape_string($conn, $_POST['address']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
		$contact= mysqli_real_escape_string($conn, $_POST['contact']);
		$postal= mysqli_real_escape_string($conn, $_POST['postal']);
        $password = mysqli_real_escape_string($conn, md5($_POST['password']));
        $confirm_password = mysqli_real_escape_string($conn, md5($_POST['confirm_password']));
        $code = mysqli_real_escape_string($conn, md5(rand()));
       $image=$_FILES['image']["name"];
       $temp = explode(".", $_FILES["image"]["name"]);
       $newfilename = round(microtime(true)) . '.' . end($temp);
       $image= addslashes(file_get_contents($_FILES['image']['tmp_name']));
	   $image_name= addslashes($_FILES['image']['name']);
	   $image_size= getimagesize($_FILES['image']['tmp_name']);
	   move_uploaded_file($_FILES["image"]["tmp_name"],"upload/" .$newfilename);			
			$location="upload/" .$newfilename;
			
			function generateRandomString($length = 25) {
              $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
              $charactersLength = strlen($characters);
              $randomString = '';
             for ($i = 0; $i < $length; $i++) {
             $randomString .= $characters[rand(0, $charactersLength - 1)];
              }
             return $randomString;
              }
		
			
	   $proof=$_FILES['proof']["name"];
       $temp2 = explode(".", $_FILES["proof"]["name"]);
       $newfilename2 = generateRandomString(7). '.' . end($temp2);
       $proof= addslashes(file_get_contents($_FILES['proof']['tmp_name']));
	   $image_name2= addslashes($_FILES['proof']['name']);
	   $image_size2= getimagesize($_FILES['proof']['tmp_name']);
	   move_uploaded_file($_FILES["proof"]["tmp_name"],"upload/" .$newfilename2);			
			$location2="upload/" .$newfilename2;			
        if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tbl_login WHERE email='{$email}'")) > 0) {
            $msg = "<div class='alert alert-danger'>{$email} - This email address has been already exists.</div>";
        } else {
            if ($password === $confirm_password) {
               $sql="INSERT INTO tbl_login VALUES (DEFAULT,'$firstname','$email','$password','Voter','$code',1)";
				$result = mysqli_query($conn, $sql);

                if ($result) {
					$val="Select id from tbl_login where email='".$email."'";
					if ($res=$conn->query($val)){
						foreach($res as $data)
						{
							$login_id=$data['id'];
						}
					    $sql2= "INSERT INTO tbl_voters VALUES (DEFAULT,'$login_id','$firstname','$lastname',$age,'$contact','$gender','$address','$postal','$location','$location2',1,'')";
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
                        $mail->Body    = 'Here is the verification link <b><a href="http://localhost/OVS/index.php?verification='.$code.'">http://localhost/OVS/index.php?verification='.$code.'</a></b>';

                        $mail->send();
                        echo 'Message has been sent';
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
                    echo "</div>";
                    $msg = "<div class='alert alert-info'>We've send a verification link on your email address.</div>";
                } else {
                    $msg = "<div class='alert alert-danger'>Something wrong went.</div>";
                }
            } else {
                $msg = "<div class='alert alert-danger'>Password and Confirm Password do not match</div>";
            }
        }
    }
?>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Voter Registration</title>
    <!-- plugins:css -->
    <meta name="keywords"content="Login Form" />
     <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="assets/vendors/select2/select2.min.css" />
    <link rel="stylesheet" href="assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css" />
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/demo_1/style.css" /> 
	 
    <!-- End layout styles -->
    <link rel="icon" type="image/png" href="favicons/favicon-16x16.png" sizes="16x16">
	
  </head>
  <style>
  .check-label{
	  margin-left:20px;
  }
  #lb{
	  font-weight:bold;
  }
  .error_form
  {
	top: 12px;
	color: rgb(216, 15, 15);
    font-size: 15px;
	font-weight:bold;
    font-family: Helvetica;
   }
   .alert-danger {
    color: #e4e9f0;
	font-weight:bold;
    background-color: #f90505;
    border-color: #ffbacf;
	max-width:600px;
}
.alert-info {
    color: #e4e9f0;
	font-weight:bold;
    background-color: #09a92e;
    border-color: #b8f2fc;
max-width:600px;
}
  </style>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_horizontal-navbar.html -->
      <div class="horizontal-menu">
        <nav class="bottom-navbar">
          <div class="container">
            <ul class="nav page-navigation">
              <li class="nav-item">
                <a class="nav-link" href="index.php">
                  <i class="mdi mdi-home-circle"></i>
                  <span class="menu-title">Home</span>
                </a>
              </li>
              
              <li class="nav-item">
                <div class="nav-link d-flex">
                 
                 
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </div>
      <!-- partial -->
      
	    <?php 
		 $chck=mysqli_query($conn,"select * from tbl_election");
            $count=mysqli_num_rows($chck);
	    if($count!=0){
					$regst=mysqli_query($conn,"select * from tbl_election");
                    $reg=mysqli_fetch_array($regst);
					if($reg['voter_reg']==1)
					{
					?>

      
            
            <div class="row">
     
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Voter Registration</h4>&nbsp; <div>
				   <?php echo $msg; ?>
				  </div>
                    <form action="" method="post" class="form-sample" id="registration_form" enctype="multipart/form-data">
                      <p class="card-description">Personal info</p>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
						  
                            <label class="col-sm-3 col-form-label" id="lb">First Name</label>
                            <div class="col-sm-9">
							 <span class="error_form" id="fname_error_message"></span>	
                              <input type="text" id="form_fname" name="first_name" class="form-control" />
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label" id="lb">Last Name</label>
                            <div class="col-sm-9">
							<span class="error_form" id="sname_error_message"></span>
                              <input type="text" id="form_sname" name="last_name" class="form-control" />
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label" id="lb">Gender</label>
                            <div class="col-sm-9">
							<span class="error_form" id="gen_error_message"></span>
                              <select name="gender" id="form_gen" class="form-control">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label" id="lb">Date of Birth</label>
                            <div class="col-sm-9">
							<span class="error_form" id="age_error_message"></span>	
                              <input type="date" class="form-control" id="form_age" name="age" placeholder="dd/mm/yyyy" />
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
               
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label name="address" class="col-sm-3 col-form-label" id="lb">Address</label>
                            <div class="col-sm-9">
                              <input type="text" name="address" class="form-control" required/>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label" id="lb">Postal Code</label>
                            <div class="col-sm-9">
                              <input type="number" name ="postal" class="form-control" required/>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                     
                  </div>
                </div>
              </div>
			  
	 <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Contact Details</h4>
            
        
                      <div class="form-group">
                        <label for="exampleInputName1" id="lb">Phone Number</label>
						<span class="error_form" id="pno_error_message"></span>	
                        <input type="number" class="form-control" id="form_pno" name="contact" required />
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail3" id="lb">Email address</label>
						 <span class="error_form" id="email_error_message"></span>	
                        <input type="email" class="form-control" id="form_email" name="email" required />
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword4" id="lb">Password</label>
						<span class="error_form" id="password_error_message"></span>
                        <input type="password" class="form-control" id="form_password" name="password" required />
                      </div>
					  <div class="form-group">
                        <label for="exampleInputPassword4" id="lb">Re-enter Password</label>
						<span class="error_form" id="retype_password_error_message"></span>
                        <input type="password" class="form-control"  id="form_retype_password" name="confirm_password" required />
                      </div>
                      </div>
                </div>
              </div>
			  
			  <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Documents</h4>
					 
					  <div class="form-group">
                        <label id="lb">Identity Proof</label>
						<span class="error_form" id="proof_error_message"></span><br>
                        <input type="file" id="form_proof" name="proof" required />
                        
                      </div>
					  <div class="form-group">
                        <label id="lb">Photo</label>
						<span class="error_form" id="photo_error_message"></span><br>
                        <input type="file" id="form_photo"  name="image" required />
                  
                      </div>
                      <button type="submit" name="submit" class="btn btn-primary mr-2"> Submit </button>
                      <button  class="btn btn-light" type="reset">Cancel</button>
                    </form>
                   </div>
                </div>
              </div>
             
             
              
            </div>
          
          <!-- content-wrapper ends -->
          
        
        <!-- main-panel ends -->
      
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
	<script src="assets/vendors/js/vendor.bundle.base.js"></script>
   <script src="assets/vendors/select2/select2.min.js"></script>
    <script src="assets/vendors/typeahead.js/typeahead.bundle.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/js/file-upload.js"></script>
    <script src="assets/js/typeahead.js"></script>
    <script src="assets/js/select2.js"></script>
	 <!-- form validation script -->
	 <script src="js/jquery.min.js"></script>
	 <script>
	 $(function() {

          $("#fname_error_message").hide();
         $("#sname_error_message").hide();
		 $("#age_error_message").hide();
         $("#pno_error_message").hide();
         $("#gen_error_message").hide();
         $("#email_error_message").hide();
         $("#password_error_message").hide();
         $("#retype_password_error_message").hide();
		 $("#proof_error_message").hide();
         $("#photo_error_message").hide();
		 
         var error_fname = false;
         var error_sname = false;
         var error_email = false;
		 var error_pno = false;
		 var error_gen = false;
		 var error_age = false;
         var error_password = false;
         var error_retype_password = false;
		 var error_proof = false;
		 var error_photo = false;
		 var error_face = false;

         $("#form_fname").focusout(function(){
            check_fname();
         });
         $("#form_sname").focusout(function() {
            check_sname();
         });
            $("#form_age").focusout(function() {
            check_age();
         });
           
		 $("#form_pno").focusout(function() {
                check_pno();
            });
			
	    $("#form_gen").focusout(function() {
                check_gen();
            });
			
         $("#form_email").focusout(function() {
            check_email();
         });
         $("#form_password").focusout(function() {
            check_password();
         });
         $("#form_retype_password").focusout(function() {
            check_retype_password();
         });
		 
		 $("#form_proof").focusout(function() {
                check_proof();
            });
			
         $("#form_photo").focusout(function() {
            check_photo();
         });
		 	
         $("#form_photo").focusout(function() {
            check_face();
         });

         function check_fname() {
            var pattern = /^[a-zA-Z]*$/;
            var fname = $("#form_fname").val();
            if (pattern.test(fname) && fname !== '') {
               $("#fname_error_message").hide();
               $("#form_fname").css("border-bottom","2px solid #34F458");
            } else {
               $("#fname_error_message").html("Should contain only Characters");
               $("#fname_error_message").show();
               $("#form_fname").css("border-bottom","2px solid #F90A0A");
               error_fname = true;
            }
         }

         function check_sname() {
            var pattern = /^[a-zA-Z]*$/;
            var sname = $("#form_sname").val()
            if (pattern.test(sname) && sname !== '') {
               $("#sname_error_message").hide();
               $("#form_sname").css("border-bottom","2px solid #34F458");
            } else {
               $("#sname_error_message").html("Should contain only Characters");
               $("#sname_error_message").show();
               $("#form_sname").css("border-bottom","2px solid #F90A0A");
               error_fname = true;
            }
         }
		 
		 
		 function check_age() {
            var age = $("#form_age").val();
			var dob = new Date(age);  
    //calculate month difference from current date in time  
    var month_diff = Date.now() - dob.getTime();  
      
    //convert the calculated difference in date format  
    var age_dt = new Date(month_diff);   
      
    //extract year from date      
    var year = age_dt.getUTCFullYear();  
      
    //now calculate the age of the user  
    var age = Math.abs(year - 1970);  
            if (age >18 ) {
               $("#age_error_message").hide();
               $("#form_age").css("border-bottom","2px solid #34F458");
            } else {
               $("#age_error_message").html("Age must be greaterthan 18");
               $("#age_error_message").show();
               $("#form_age").css("border-bottom","2px solid #F90A0A");
               error_gen = true;
            }
         }

		 
		 
		 
		 
		 function check_pno() {
                var pattern = /[0-9 -()+]+$/;
                var pno = $("#form_pno").val()
                if (pattern.test(pno) && pno.length == 10) {
                    $("#pno_error_message").hide();
                    $("#form_pno").css("border-bottom", "2px solid #34F458");
                } else {
                    $("#pno_error_message").html("Should contain only 10 digits");
                    $("#pno_error_message").show();
                    $("#form_pno").css("border-bottom", "2px solid #F90A0A");
                    error_pno = true;
                }
            }
			
			function check_gen() {
            var gen = $("#form_gen").val();
            if ( gen=='Male' || gen=='Female' ) {
               $("#gen_error_message").hide();
               $("#form_gen").css("border-bottom","2px solid #34F458");
            } else {
               $("#gen_error_message").html("Select Male or Female");
               $("#gen_error_message").show();
               $("#form_gen").css("border-bottom","2px solid #F90A0A");
               error_gen = true;
            }
         }
			
			
			function check_email() {
                var pattern = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                var email = $("#form_email").val();
                if (pattern.test(email) && email !== '') {
                    document.getElementById("regbtn").disabled = false;
                    $("#email_error_message").hide();
                    $("#form_email").css("border-bottom", "2px solid #34F458");
                } else {
                    $("#email_error_message").html("Invalid Email");
                    $("#email_error_message").show();
                    $("#form_email").css("border-bottom", "2px solid #F90A0A");
                    error_email = true;
                }
            }

         
            function check_password() {
                var pattern =/^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{7,15}$/;
                var password = $("#form_password").val();
                if (pattern.test(password) && password !== '') {
                    $("#password_error_message").hide();
                    $("#form_password").css("border-bottom", "2px solid #34F458");
                } else {
                    $("#password_error_message").html("Password format is:User@1234");
                    $("#password_error_message").show();
                    $("#form_password").css("border-bottom", "2px solid #F90A0A");
                    error_password = true;
                }
            }


         function check_retype_password() {
            var password = $("#form_password").val();
            var retype_password = $("#form_retype_password").val();
            if (password !== retype_password) {
               $("#retype_password_error_message").html("Passwords not Matched");
               $("#retype_password_error_message").show();
               $("#form_retype_password").css("border-bottom","2px solid #F90A0A");
               error_retype_password = true;
            } else {
               $("#retype_password_error_message").hide();
               $("#form_retype_password").css("border-bottom","2px solid #34F458");
            }
         }

         function check_email() {
            var pattern = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            var email = $("#form_email").val();
            if (pattern.test(email) && email !== '') {
               $("#email_error_message").hide();
               $("#form_email").css("border-bottom","2px solid #34F458");
            } else {
               $("#email_error_message").html("Invalid Email");
               $("#email_error_message").show();
               $("#form_email").css("border-bottom","2px solid #F90A0A");
               error_email = true;
            }
         }
		 function check_proof() {
            const fi = document.getElementById('form_proof');
        // Check if any file is selected.
        if (fi.files.length > 0) {
            for (const i = 0; i <= fi.files.length - 1; i++) {
 
                const fsize = fi.files.item(i).size;
                const file = Math.round((fsize / 1024));
                // The size of the file.
                if (file >= 4096) {
                    $("#proof_error_message").html("File too big(choose less than 4mb)");
                    $("#proof_error_message").show();
                    $("#form_proof").css("border-bottom","2px solid #F90A0A");
                    error_symb = true;
                } else {
                    $("#proof_error_message").hide();
                    $("#form_proof").css("border-bottom","2px solid #34F458");
                } 
            }
        }
         }
		 function check_photo() {
            const fi = document.getElementById('form_photo');
        // Check if any file is selected.
        if (fi.files.length > 0) {
            for (const i = 0; i <= fi.files.length - 1; i++) {
 
                const fsize = fi.files.item(i).size;
                const file = Math.round((fsize / 1024));
                // The size of the file.
                if (file >= 4096) {
                    $("#photo_error_message").html("File too big(choose less than 4mb)");
                    $("#photo_error_message").show();
                    $("#form_photo").css("border-bottom","2px solid #F90A0A");
                    error_symb = true;
                } else {
                    $("#photo_error_message").hide();
                    $("#form_photo").css("border-bottom","2px solid #34F458");
                } 
            }
        }
         }
		 
 function check_face(){
 const fileInput = document.getElementById('photo');                
  const file = fileInput.files[0];

  // Load the selected file into an image element
  const image = new Image();
  image.src = URL.createObjectURL(file);

  // Wait for the image to load, then detect faces in the image
  image.onload = async () => {
    // Load the face detection model and detect faces in the image
    await faceapi.nets.tinyFaceDetector.loadFromUri('/models');
    const results = await faceapi.detectAllFaces(image).withFaceLandmarks().withFaceDescriptors();

    // Count the number of faces detected
    const numFaces = results.length;

    // Validate the form based on the number of faces detected
    if (numFaces === 1) {
      // If one face was detected, proceed with the form submission
      form.submit();
    } else {
      // If no faces or multiple faces were detected, display an error message
      const errorMessage = document.getElementById('error-message');
      if (numFaces === 0) {
        errorMessage.textContent = 'Error: No faces detected in the image.';
      } else {
        errorMessage.textContent = 'Error: Multiple faces detected in the image.';
      }
    }
  };
		 }

         $("#registration_form").submit(function() {
            
			
		 error_fname = false;
         error_sname = false;
         error_email = false;
		 error_pno = false;
		 error_gen = false;
		 error_age = false;
         error_password = false;
         error_retype_password = false;
		 error_proof = false;
         error_photo = false;


            check_fname();
            check_sname();
			check_age();
			check_pno();
			check_gen();
            check_email();
            check_password();
            check_retype_password();
			

            if (error_fname === false && error_gen === false && error_pno === false && error_age === false && error_sname === false && error_email === false && error_password === false && error_retype_password === false) {
               alert("Registration in process!!");
               return true;
            } else {
               alert("Please Fill the form Correctly");
               return false;
            }


         });
      });
    </script>
	<?php }
						else {
                    $msg = "<div class='alert alert-danger'>Voter registration is Closed by Election commission </div>";
					?>
					<br><br><br><br><br><br><div style="width:60%; margin-left:30%; text-align:center;">
					<?php
					 echo $msg;
                }
		}
				
				else{
		  
		   $msg = "<div class='alert alert-danger'>Voter registration is not opened yet</div>";
		   ?>
		   <br><br><br><br><br><br><div style="width:60%;  margin-left:30%; text-align:center;">
		   <?php
		   echo $msg;
	  }
					?>

  </body>
</html>