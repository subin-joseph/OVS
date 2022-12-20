
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
$id=$_GET['id'];
$up1=mysqli_query($conn,"UPDATE `tbl_election` SET `cand_reg`='0' WHERE id=$id"); 
	
	header("Location:regcontrol.php");
?>