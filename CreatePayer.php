<?php
/**
 * SQL configuration
 */
$mysqli = new mysqli("mysql.eecs.ku.edu", "slopez", "Password123!", "slopez");

$payerID = $_POST['name'];
$password = $_POST['password'];
$groupName = $_POST['group'];
$groupAdmin = $_POST['groupAdmin'];
$join = $_POST['groupAdmin'];
$email = $_POST['email'];
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
	$groupExists = false;
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
 	//echo "The bill payer $payerID was created successfully with the group named $groupName!";
    $result->free();        
	header("Location: index.html");
}


/**
 * Closes the connection.
 */

?>
