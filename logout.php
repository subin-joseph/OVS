<?php
  include('session.php');
include('config.php');


	session_start();
	$id = $_SESSION['id'];
$login=mysqli_query($conn,"select * from tbl_login where id='$id'");
$row=mysqli_fetch_array($login);
$user=$row['email'];
$role=$row['role'];
$sql2="INSERT INTO tbl_history VALUES('','$user','$role','Logout', NOW())";
 $result=$conn->query($sql2);
	session_destroy();

	header('location:index.php');
?>