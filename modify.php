<?php
/**
 * SQL configuration
 */
$mysqli = new mysqli("mysql.eecs.ku.edu", "slopez", "Password123!", "slopez");

$payerID = $_POST['name2'];
$password = $_POST['password2'];
$groupName = $_POST['group2'];
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

$validLogin = false;
$groupExists = false;

/**
 * Validate Login
 */
$query = "SELECT PayerID,Password FROM BillPayers";

if ($result = $mysqli->query($query)) {

    while ($row = $result->fetch_assoc()) 
    {	
    	if($row["PayerID"] == $payerID && $row["Password"] == $password)
		{
		  $validLogin = true;
		}
		    	
    }
}

if($groupAdmin != "")
{
	/**
   * If the existing user is seeking to join an existing group, this query is to check if the entered group exists by comparing the entered post value for groupAdmin
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
 * If the credentials are valid, the existing account is either added to an existing group or a newly created one by the user. GroupAdmin value is determined by PayerID (username) in the case of the latter.
 */
 
$query = "UPDATE BillPayers SET GroupName = '$groupName', GroupAdmin = '$groupAdmin' WHERE PayerID = '$payerID' "; 
if (!$validLogin)
{
	echo "The username and password don't match an account on our server.";
}
else if (!$groupExists && $join != "")
{
    echo "No group named $groupName was found with the administrator's username $groupAdmin, could not join the group.";
}
else if ($result = $mysqli->query($query))
{
	header("Location: login.html");
    $result->free();        
}

?>
