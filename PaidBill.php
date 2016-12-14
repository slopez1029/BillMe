<?php

$mysqli = new mysqli("mysql.eecs.ku.edu", "slopez", "Password123!", "slopez");

if ($mysqli->connect_errno) 
{
	printf("Connect failed: %s\n", $mysqli->connect_error);
	exit();
}

session_start();

$groupAdmin = $_SESSION['GroupAdmin'];
$totalDue = 0;
$dueDate = "";
$billName = $_POST['Name'];
if(!empty($_POST['Name'])) 
{
    
    $query = "SELECT TotalDue,DueDate FROM Bills WHERE GroupAdmin = '$groupAdmin' AND Name = '$billName'";
    if ($result = $mysqli->query($query)) 
    {        
        while ($row = $result->fetch_assoc()) 
        {
			$totalDue = $row["TotalDue"];
			$dueDate = $row["DueDate"];
		}
    }
	
    $query = "INSERT INTO PaidBills (Name,TotalDue,DueDate,GroupAdmin) VALUES ('$billName','$totalDue','$dueDate','$groupAdmin')";
    if ($result = $mysqli->query($query)){}

    /**
    * Deletes the bill based on the name and the associated group.
    */
    $query = "DELETE FROM Bills WHERE Name = '$billName' AND GroupAdmin = '$groupAdmin' ";
    if ($result = $mysqli->query($query)) {}
    
    $query = "DELETE FROM UserBills WHERE Name = '$billName' AND GroupAdmin = '$groupAdmin' ";
    if ($result = $mysqli->query($query)) {}


    header("Location: UserBills.html");
    $result->free();
}
else
{
	echo"hi";
}
		
?>
