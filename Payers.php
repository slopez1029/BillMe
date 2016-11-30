<?php

/**
 * Allows for reading of stored session variables, and for ability to store session variables
 */
session_start();

$groupAdmin = $_SESSION['GroupAdmin'];
/**
 * Retrieves and displays all the bill payers in the group, along with the ability to remove a payer.
 */
$query = "SELECT * FROM BillPayers WHERE GroupAdmin = '$groupAdmin'";
if ($result = $mysqli->query($query)) 
{        
	while ($row = $result->fetch_assoc()) 
	{
		//if($row['GroupAdmin'] == $_SESSION['GroupAdmin'])
		//{
		echo 
		"
		<div class='desc'>
        <div class='thumb'>
            <img class= 'img-circle' src='assets/img/ui-divya.jpg' width='35px' height='35px' align=''>
        </div>
        <div class='details'>
            <p><a href='#'>{$row['PayerID']}</a><br/>
                <muted>Available</muted>
                <input type='checkbox' name = 'checklist[]' value = '{$row['PayerID']}' />
            </p>                      		
        </div>
        </div>

		"; 
						
	}

	$result->free();
}

?>
