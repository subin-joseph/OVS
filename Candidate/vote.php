<?php
include('session.php');
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

$id = $_GET['id'];
$name= mysqli_query($conn,"SELECT * FROM `tbl_login` where id = '$id'"); 
$row=mysqli_fetch_array($name);
$poll=md5($row['email']);

$insrt=mysqli_query($conn,"INSERT INTO `tbl_votes`VALUES ('DEFAULT','$poll')"); 
$id2= $_SESSION['id']; //
if($insrt){
$del= mysqli_query($conn,"UPDATE `tbl_voters` SET `Status`=5 where login_id = '$id2'");
if($del)
{
    mysqli_close($conn); // Close connection
     header('Location:ballot.php'); // redirects to all records page
    exit;	
}
else
{
    echo "Error deleting record"; // display error message if not delete
}
}


?>