<?php
  include('../../../session.php');
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

 $cand= mysqli_query($conn,"SELECT * from tbl_candidate where status=2");
 $cand_cnt=mysqli_num_rows($cand);
 $voter=mysqli_query($conn, "SELECT * from tbl_voters where status=5");
 $voter_cnt=mysqli_num_rows($voter);
 $unvoted_voter= mysqli_query($conn,"SELECT * from tbl_voters where status=2");
 $unvoted_voter_cnt = mysqli_num_rows($unvoted_voter);
 $win_name= "SELECT `Name` FROM `tbl_result` HAVING MAX(Vote_count)";
 $result = $conn->query($win_name);
 $row = $result->fetch_array();
 $winner=$row['Name'];
 $chck=mysqli_query($conn,"select * from tbl_election");
 $fet=mysqli_fetch_array($chck);
 $year=$fet['year'];
 $state=$fet['State'];
 $type=$fet['type'];
 $stdate=$_SESSION['stdate'];
 $sql2=mysqli_query($conn, "INSERT INTO `tbl_previous` VALUES ('DEFAULT','$stdate', '$cand_cnt','$voter_cnt','$unvoted_voter_cnt','$type','$state','$year')");
 if($sql2){
	$val="Select * from tbl_result";
	if ($res=$conn->query($val)){
	foreach($res as $data)
		{
			$id=$data['id'];
			$photo=$data['Photo'];
			$name=$data['Name'];
			$age=$data['Age'];
			$party=$data['Party'];
			$symbol=$data['Symbol'];
			$vote_cnt=$data['Vote_count'];
		$inprev= "INSERT INTO `tbl_prev_res` VALUES ('$id','$photo','$name','$age','$party','$symbol','$vote_cnt','$state','$year')";
	     $rslt= mysqli_query($conn,$inprev);
		}
	}
	
				
	$updt= mysqli_query($conn,"UPDATE `tbl_election` SET `report`='0' WHERE `election_status`=4");
	$del= mysqli_query($conn,"TRUNCATE tbl_election");
 }
header('Location:newelect.php');
?>