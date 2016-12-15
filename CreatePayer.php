<?php
/**
 * SQL configuration
 */
$mysqli = new mysqli("mysql.eecs.ku.edu", "slopez", "Password123!", "slopez");

$payerID = $_POST['name'];
$password = $_POST['password'];
$groupName = $_POST['group'];
$groupAdmin = $_POST['groupAdmin'];
$join = $groupAdmin;
$email = $_POST['email'];

$gBillNameArray = Array();
$splitCostArray = Array();
$dueDateArray = Array();
$payerIDArray = Array();

/**
 * Checks to see if SQL connection is properly configured
 */
if ($mysqli->connect_errno) {
     echo"$mysqli->connect_error)";
    exit();
}

$userExists = false;
$groupExists = false;

/**
 * This query is used to check to see if the account already exists, since duplicate accounts are not allowed.
 */
$query = "SELECT PayerID FROM BillPayers";

if ($result = $mysqli->query($query)) {

    while ($row = $result->fetch_assoc()) 
    {	
    	if($row["PayerID"] == $payerID)
		{
		  $userExists = true;
		}
		    	
    }
}

if($groupAdmin != "")
{
	/**
   * If a new user seeking to create an account wants to join an existing group upon creation, this query is to check if the entered group exists by comparing the entered post value for groupAdmin
   */
    $query = "SELECT * FROM BillPayers ";
    if ($result = $mysqli->query($query)) 
    {

        while ($row = $result->fetch_assoc()) 
        {	
  	
            if($row["GroupName"] == $groupName && $row["GroupAdmin"] == $groupAdmin)
            {
                $groupExists = true;
            }				
        }
    }
}
else
{
    $groupAdmin = $payerID;
}

 /**
 * If the user is not a duplicate, a new account is created with a group that already exists or one newly created by the new user. GroupAdmin value is determined by PayerID (username) in the case of the latter.
 */
 
$query = "INSERT INTO BillPayers (PayerID,Password,Email,GroupName,GroupAdmin) VALUES ('$payerID','$password','$email','$groupName','$groupAdmin')";
if ($userExists)
{
	echo "This bill payer is already created, cannot create duplicate account.";
}
else if (!$groupExists && $join != "")
{
    echo "No group named $groupName was found with the administrator's username $groupAdmin, could not create account.";
}
else if ($result = $mysqli->query($query))
{
 	//header("Location: login.html");	//$result->free();        
}

if(!$userExists)
{
$groupCount = 0;
$query = "SELECT PayerID FROM BillPayers where GroupAdmin = '$groupAdmin'";
if ($result = $mysqli->query($query)) 
{
    while ($row = $result->fetch_assoc()) 
    {	
	$user = $row["PayerID"];
        $groupCount = $groupCount + 1;	
	array_push($payerIDArray,$user);		
    }		
}

$splitCost = 0;
$query = "SELECT * FROM Bills WHERE GroupAdmin = '$groupAdmin'";
if ($result = $mysqli->query($query)) 
{
	while ($row = $result->fetch_assoc()) 
    {
		$totalDue = $row["TotalDue"];
		$split = $totalDue / $groupCount;	
		$splitCost = round($split,2);
		array_push($gBillNameArray,$row["Name"]);
		array_push($splitCostArray,$splitCost);
		array_push($dueDateArray,$row["DueDate"]);
	}
	$result->free();
}

//adding user bills into newly added member and updating bills of current members
$counter = 0;
foreach($gBillNameArray as $gBillName)
{
	$due = $splitCostArray[$counter];
	$dueDate = $dueDateArray[$counter];
	$query = "INSERT INTO UserBills (Name,AmtOwed,AmtPaid,DueDate,PayerID,GroupAdmin) VALUES ('$gBillName','$due','$amtPaid','$dueDate','$payerID','$groupAdmin')";
	if($result = $mysqli->query($query)) {}

	$query = "UPDATE UserBills SET AmtOwed= '$due' WHERE Name= '$gBillName' AND GroupAdmin = '$groupAdmin'";
	if ($result = $mysqli->query($query)) {}
	
	$counter = $counter + 1;
}

//notifying others in the group of the newly added member.
$counter = 0;
$type = "PayerAdded";
$payString = "";
$content = "$payerID has joined the $groupName group! Personal bills have been updated.";
$payer = "public";
//foreach($payerIDArray as $payer)
//{
	//if($payerID != $payer)
	//{
		$query = "INSERT INTO Notifications (Type,Content,PayerID,GroupName,GroupAdmin,PayString) VALUES ('$type','$content','$payer','$groupName','$groupAdmin','$payString')";
		if ($result = $mysqli->query($query)){ }
	//}
//}
	header("Location: login.html");

}

?>
