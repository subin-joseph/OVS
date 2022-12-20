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
$chck= mysqli_query($conn,"UPDATE `tbl_election` SET `election_status`=3 where id = '$id'"); // delete query

if($chck)
{
    mysqli_close($conn); // Close connection
     header('Location:newelect.php'); // redirects to all records page
    exit;	
}
else
{
    echo "Error deleting record"; // display error message if not delete
}
?>