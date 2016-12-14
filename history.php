<?php

    session_start();
    $groupAdmin = $_SESSION['GroupAdmin'];
    $payerID = $_SESSION['PayerID'];

	/**
	* This query is retrieving all the information from the Bills table, to be displayed in the front end with an option to remove a bill with each row.
	*/
    $query = "SELECT * FROM PaidBills WHERE GroupAdmin = '$groupAdmin' ORDER BY Name,DueDate ASC";
    if ($result = $mysqli->query($query)) 
    {        
        while ($row = $result->fetch_assoc()) 
        {
            echo 
            "<tr>
            <td>{$row['Name']}</a></td>
            <td>{$row['TotalDue']}</td>
			<td>{$row['DueDate']}</td>
            </tr>";                             
        }

        /* free result set */
        $result->free();
    }
?>                                 