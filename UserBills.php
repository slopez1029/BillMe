<?php

    session_start();
    $groupAdmin = $_SESSION['GroupAdmin'];
    $payerID = $_SESSION['PayerID'];
	/**
	* This query is retrieving all the information from the Bills table, to be displayed in the front end with an option to remove a bill with each row.
	*/

    $query = "SELECT * FROM UserBills WHERE GroupAdmin = '$groupAdmin' AND PayerID = '$payerID'";
    if ($result = $mysqli->query($query)) 
    {        
        while ($row = $result->fetch_assoc()) 
        {
            echo 
            "<tr>
            <td>{$row['Name']}</a></td>
            <td>{$row['AmtOwed']}</td>
            <td>{$row['AmtPaid']}</td>
            <td>{$row['DueDate']}</td>
            </tr>";           		
        }
		
        $result->free();
    }
?>
                                  
