<?php 
include('session.php');
include('../config.php');
$x=50000;
 $cand_id=$_SESSION['id'];
	
		  $sql2="UPDATE `tbl_candidate` SET `payment`='50000' WHERE login_id='$cand_id'";
		  $result=$conn->query($sql2);
			   $_SESSION['payment_id']=$x;
			   if($result)
			   {
				   header('Location:index.php');
			   }
	  	   ?>