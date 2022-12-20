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

$id = $_SESSION['id2'];
$del = mysqli_query($conn,"UPDATE `tbl_candidate` SET `Status`=-1 where login_id = '$id'"); // delete query

if($del)
{
    mysqli_close($conn); // Close connection
    header("location:candreg.php"); // redirects to all records page
    exit;	
}
else
{
    echo "Error deleting record"; // display error message if not delete
}
?>