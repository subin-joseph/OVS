<?php

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


$sql = "SELECT * from tbl_candidate";
 $result = $conn->query($sql);
 if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
      $user =$row['username'];
               }
 }
$id = $_GET['id']; // get id through query string
$up = mysqli_query($conn,"UPDATE `tbl_candidate` SET `Status`=2 where login_id = '$id'"); // delete query
if($up)
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