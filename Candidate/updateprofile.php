<?php
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
	$id = $row2['login_id'];
	if(ISSET($_POST['update'])){
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$contact = $_POST['contact'];
		
		$sql="UPDATE `tbl_candidate` SET `first name`='$firstname',`lastname`='$lastname',`contact`='$contact' WHERE login_id='$id'";
				$result = mysqli_query($conn, $sql);
				if($sql) {
					echo "<script>window.location.href='index.php';</script>";
		       $_SESSION['name'] =$firstname." ".$lastname;
              header('Location:index.php');
	}
	}
	
	 if (isset($_POST['upload'])) {
	 
	 $id=$_SESSION['id'];
       $image=$_FILES['image']["name"];
       $temp = explode(".", $_FILES["image"]["name"]);
       $newfilename = round(microtime(true)) . '.' . end($temp);
       $image= addslashes(file_get_contents($_FILES['image']['tmp_name']));
	   $image_name= addslashes($_FILES['image']['name']);
	   $image_size= getimagesize($_FILES['image']['tmp_name']);
	   move_uploaded_file($_FILES["image"]["tmp_name"],"../upload/" .$newfilename);			
			$location="upload/" .$newfilename;
       

			$sql="UPDATE `tbl_candidate` SET `img`='$location' WHERE login_id='$id'";
				$result = mysqli_query($conn, $sql);
				if($sql) {
				 $_SESSION['img'] =$location;
              echo "<script>window.location.href='index.php';</script>";
              header('Location:index.php');
 }
 }
}
?>
<style>
.img4 {
    display: inline-block;
    width: 100px;
    height: 100px;
    object-fit: cover;
    border-radius:50%;
   margin-top:30%;
    box-shadow: 0 2px 6px #0003;
}
.modal-body{
	margin-left:5%;
	
}
.form-control{
	width:150%;
	border:1px solid black;
}

#div {
  border-radius: 5px;
  padding: 20px;
  width:17%;
  height:45 %;
  margin-left:45%;
 background-color:#ffffff;
  margin-top:15%;
}
input[type=submit] {
  width:40%;
  background-color: #2a5889;
  margin-left:20%;
  color: white;
  padding: 7px 17px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}
input[type=submit]:hover {
  background-color: #28517c;
}
.btn-warning {
    color: #f8f9fa;
    background-color: #2d5176;
    border-color: #363bff;
}

</style>
<div class="modal fade" id="update_modal<?php echo $row2['login_id']?>" aria-hidden="true" >
	<div class="modal-dialog" >
		<div class="modal-content" >
			<form method="POST" action="">
				<div class="modal-body">
					<div class="col-md-8">
					<div class="form-group" style="margin-left:45%;">
							<img class="img4" src="../<?php echo $row2['img']?>"><br>

							<i id="myBtn" class="fa fa-camera"  style="margin-left:41px;" aria-hidden="true"></i>
						</div>
						<div class="form-group">
							<label>Firstname</label>
							<input type="text" name="firstname" value="<?php echo $row2['first name']?>" class="form-control" required="required"/>
						</div>
						<div class="form-group">
							<label>Lastname</label>
							<input type="text" name="lastname" value="<?php echo $row2['lastname']?>" class="form-control" required="required" />
						</div>
						<div class="form-group">
							<label>Contact</label>
							<input type="text" name="contact" value="<?php echo $row2['contact']?>" class="form-control" required="required"/>
						</div>
					</div>
				</div>
				<div style="clear:both;"></div>
				<div class="modal-footer">
					<button name="update" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span> Update</button>
					<button class="btn btn-danger" type="button" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
				</div>
				</div>
			</form>
		</div>
	</div>
	<div id="myModal" class="modal" >

  <div class="modal-content" id="div">

    <form action="#" method="POST" enctype="multipart/form-data">
	<div>
   <input type="file" id="txt" name="image" required>
   <input type="submit" style="margin-left:50%;"name="upload" value="upload">
	</div>
  </form>
  </div>
</div>
</div>
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