<?php
    
/**
* sql configuration
*/
$mysqli = new mysqli("mysql.eecs.ku.edu", "slopez", "Password123!", "slopez");

/**
*	Check to see if SQL server is properly connected
*/
if ($mysqli->connect_errno) 
{
	printf("Connect failed: %s\n", $mysqli->connect_error);
	exit();
}

/**
 * Allows for reading of stored session variables, and for ability to store session variables
 */
session_start();

$groupAdmin = $_SESSION['GroupAdmin'];

$billName = $_POST['Name'];
if(!empty($_POST['Name'])) 
{
    /**
    * Deletes the bill based on the name and the associated group.
    */
    $query = "DELETE FROM Bills WHERE Name = '$billName' AND GroupAdmin = '$groupAdmin' ";
    if ($result = $mysqli->query($query)) {}
    
    $query = "DELETE FROM UserBills WHERE Name = '$billName' AND GroupAdmin = '$groupAdmin' ";
    if ($result = $mysqli->query($query)) {}

    header("Location: Bills.html");
    $result->free();
}
else
{
	header("Location: Bills.html");
}
		
?>
