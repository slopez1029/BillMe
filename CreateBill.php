<?php
/**
 * SQL configuration
 */
$mysqli = new mysqli("mysql.eecs.ku.edu", "slopez", "Password123!", "slopez");

/**
 * Allows for reading of stored session variables, and for ability to store session variables
 */
session_start();
$name = $_POST['name'];
$totalDue = $_POST['totalDue'];
$groupName = $_SESSION['GroupName'];
$groupAdmin = $_SESSION['GroupAdmin'];
$payerID = $_SESSION['PayerID'];
$dueDate = strtotime($_POST["dueDate"]);
$dueDate = date('Y-m-d H:i:s', $dueDate);

$groupArray = Array();
$amtOwedArray = Array();
/**
 * Checks to see if sql connection is properly configured
 */
 if ($mysqli->connect_errno) {
    exit();
}
/*
echo "Name: $name <br>"; 
echo "Total Due: $totalDue <br>"; 
echo "Group Name: $groupName <br>"; 
echo "Due Date: $dueDate <br>"; 
echo "Group Admin: $groupAdmin <br>"; 
echo "Payer ID: $payerID <br>"; 
*/
$amtPaid = $row["AmtPaid"];

/**
 * This query creates a new bill by taking in post form input variables from the front end as well as session variables initialized upon login to create a bill associated with a group.
 */
$query = "INSERT INTO Bills (Name,TotalDue,TotalPaid,DueDate,PayerID,GroupAdmin) VALUES ('$name','$totalDue','$totalPaid','$dueDate','$payerID','$groupAdmin')";
if ($result = $mysqli->query($query))
{
 	//echo "The $name bill was successfully added to the group $groupName by $payerID!";
    //$result->free();        
}

$groupCount = 0;
$query = "SELECT * FROM BillPayers where GroupAdmin = '$groupAdmin'";
if ($result = $mysqli->query($query)) 
{
    while ($row = $result->fetch_assoc()) 
    {	
        array_push($groupArray,$row["PayerID"]);		
        //array_push($amtOwedArray,$row["AmtOwed"]);
        $groupCount = $groupCount + 1;			
    }		
    //$result->free();
}

$split = $totalDue / $groupCount;	
$splitCost = round($split,2);
foreach($groupArray as $id)
{
    $amtOwed = $splitCost;      	
	if($payerID != $id)
	{
        $query = "INSERT INTO UserBills (Name,AmtOwed,AmtPaid,DueDate,PayerID,GroupAdmin) VALUES ('$name','$amtOwed','$amtPaid','$dueDate','$id','$groupAdmin')";
        if ($result = $mysqli->query($query))
        {
            //$result->free();        
        }
    }
	
}	
//echo "<br>";
//echo "The billpayers' personal billing accounts in the $groupName group have been successfully updated!";
header("Location: Bills.html");
$result->free();   

/**
 * Closes the connection.
 */

?>
