<?php

    session_start();
    $groupAdmin = $_SESSION['GroupAdmin'];
    $payerID = $_SESSION['PayerID'];
    $groupCount = 0;

    $query = "SELECT * FROM BillPayers WHERE GroupAdmin = '$groupAdmin'";
    if ($result = $mysqli->query($query)) 
    {        
        while ($row = $result->fetch_assoc()) 
        {
	   $groupCount = $groupCount + 1;
	}
    }

	/**
	* This query is retrieving all the information from the Bills table, to be displayed in the front end with an option to remove a bill with each row.
	*/
    $query = "SELECT * FROM Bills WHERE GroupAdmin = '$groupAdmin' AND PayerID = '$payerID'";
    if ($result = $mysqli->query($query)) 
    {        
        while ($row = $result->fetch_assoc()) 
        {
            $var = $row['TotalDue'];
	    $split = round($var/$groupCount,2);	
	    $splitCost = number_format($split,2);
            echo 
            "<tr>
            <td>{$row['Name']}</a></td>
            <td>{$row['TotalDue']}</td>
            <td>{$row['TotalPaid']}</td>
	    <td>{$splitCost}</td>
            <td>{$row['DueDate']}</td>
            <td>
			    <button class='btn btn-success btn-xs'  type= 'submit' name = 'Name' value = '{$row['Name']}' formaction='PaidBill.php'><i class='fa fa-check'></i></button>
            </td>
            </tr>";                             
        }

        /* free result set */
        $result->free();
    }
?>
                                  
