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
$groupArray = Array();
$amtOwedArray = Array();
//$totalDueArray = Array();

$groupCount = 0;
$query = "SELECT * FROM BillPayers where GroupAdmin = '$groupAdmin'";
if ($result = $mysqli->query($query)) 
{
    while ($row = $result->fetch_assoc()) 
    {	
        array_push($groupArray,$row["PayerID"]);		
        array_push($amtOwedArray,$row["AmtOwed"]);
        $groupCount = $groupCount + 1;			
    }		
    //$result->free();
}

$billName = $_POST['Name'];
if(!empty($_POST['Name'])) 
{
    $totalDue = 0;
    $query = "SELECT * FROM Bills WHERE Name = '$billName' AND GroupAdmin = '$groupAdmin'";
    if ($result = $mysqli->query($query)) 
    {   
        while ($row = $result->fetch_assoc()) 
        {	
            //array_push($totalDueArray,$row["TotalDue"]);	
            $totalDue = $totalDue + $row["TotalDue"];
        }		
        //$result->free();
    } 
    
   // echo "Success! The billpayers' accounts in the group have been updated. <br>";
    $split = $totalDue / $groupCount;	
    $splitCost = round($split,2);
    $counter = 0;	
    foreach($groupArray as $id)
    {
        $amtOwed = $amtOwedArray[$counter];        	
        $AmtOwed = $amtOwed - $splitCost;
        $query = "UPDATE BillPayers SET AmtOwed = '$AmtOwed' WHERE PayerID = '$id' AND GroupAdmin = '$groupAdmin' "; 	
        if ($result = $mysqli->query($query))
        {
            //$result->free();        
        }
        $counter = $counter + 1;
    }
    
	//echo "Success! The following bills were removed: <br>";

	//	echo $billName."<br />"; 
		/**
		* Deletes the bill based on the name and the associated group.
		*/
		$query = "DELETE FROM Bills WHERE Name = '$billName' AND GroupAdmin = '$groupAdmin' ";

	/*close query*/
		if ($result = $mysqli->query($query)) 
		{                                                                
			
		}
		header("Location: Bills.html");
		$result->free();
}
else
{
	header("Location: Bills.html");
}
		
?>
