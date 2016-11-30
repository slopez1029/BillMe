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
        //$payString = "billPayer=$user&billName=$name&payAmount=$payAmount&totalDue=$totalDue&totalPaid=$paid&amtOwed=$amtOwed&amtPaid=$amtPaid";
        /* fetch associative array */
        while ($row = $result->fetch_assoc()) 
        {
            echo 
            "<tr>
            <td>{$row['Name']}</a></td>
            <td>{$row['AmtOwed']}</td>
            <td>{$row['AmtPaid']}</td>
            <td>{$row['DueDate']}</td>
            <td>
                <button class='btn btn-success btn-xs'><i value = '{$row['Name']}' class='fa fa-check'></i></button>
                <button class='btn btn-primary btn-xs'><i value = '{$row['Name']}' class='fa fa-pencil'></i></button>
                <button class='btn btn-danger btn-xs'> <i value = '{$row['Name']}' class='fa fa-trash-o'></i></button>
            </td>
            </tr>";                             
        }

        /* free result set */
        $result->free();
    }
?>
                                  
