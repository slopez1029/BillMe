<?php
/**
 * SQL configuration
 */
$mysqli = new mysqli("mysql.eecs.ku.edu", "slopez", "Password123!", "slopez");

/**
 * Checks to see if sql connection is properly configured
 */
if ($mysqli->connect_errno) {
    echo "$mysqli->connect_error)";
    exit();
}
	/**
	 * Allows for reading of stored session variables, and for ability to store session variables
	 */
    session_start();
    $groupAdmin = "notset";	    
    $groupName = "notset";
    $email = "notset";
    
    $payerID = $_POST['user'];    
    //$payerID = $mysqli->real_escape_string($payerID)
    
    $password = $_POST['password'];
    //$password = $mysqli->real_escape_string($password)
    
	/**
	* This query is for validating login, enforcing that PayerID and password match.
	*/
    $query = "SELECT * FROM BillPayers";
    $validLogin = false;
    $error = false;
    
if ($result = $mysqli->query($query)) {

    while ($row = $result->fetch_assoc()) 
    {
	
		if($row["PayerID"] == $payerID && $row["Password"] == $password)
		{
		  $validLogin = true;
		  $groupAdmin = $row["GroupAdmin"];
		  $groupName = $row["GroupName"];
		  $email = $row["Email"];
		}		

    }
			
    $result->free();
}

/**
 * Initializes a set of necessary session variables upon valid login to be used and easily accessed with actions from home menu.
 */
if($validLogin)
{
    $_SESSION['PayerID'] = $payerID;
    $_SESSION['GroupAdmin'] = $groupAdmin;
    $_SESSION['GroupName'] = $groupName;
    $_SESSION['Email'] = $email;
    $_SESSION['Message'] = "notset";
    $_SESSION['EmailGroup'] = "false";
    $_SESSION['OtherEmail'] = "notset";
    $_SESSION['OtherMessage'] = "notset";

    header('Location: index.html');
}
else 
{
 	header('Location: login.html');
	$error = true;

}

/**
 * Closes the connection.
 */

?>
