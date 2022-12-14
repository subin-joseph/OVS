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


	session_start();
	$id = $_SESSION['id'];
$login=mysqli_query($conn,"select * from tbl_login where id='$id'");
$row=mysqli_fetch_array($login);
$user=$row['email'];
$role=$row['role'];
$sql2="INSERT INTO tbl_history VALUES('','$user','$role','Logout', NOW())";
 $result=$conn->query($sql2);
	session_destroy();

	header('location:../index.php');
?>